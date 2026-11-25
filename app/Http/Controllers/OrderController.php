<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $cart = $request->user()
            ? Cart::where('user_id', $request->user()->id)->with('items.product')->first()
            : null;

        $items = $cart?->items ?? collect();
        $subtotal = $items->sum(fn ($item) => (float) $item->unit_price * $item->quantity);

        return view('checkout', compact('items', 'subtotal'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['required', 'email', 'max:255'],
            'address' => ['required', 'string', 'max:2000'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
            'zip' => ['required', 'string', 'max:20'],
        ]);

        if (! Schema::hasTable('orders') || ! Schema::hasTable('order_items')) {
            return back()->withErrors(['order' => 'La base de donnees des commandes nest pas disponible.']);
        }

        $order = DB::transaction(function () use ($request, $validated) {
            $cart = Cart::where('user_id', $request->user()->id)
                ->lockForUpdate()
                ->with('items.product')
                ->first();

            if (! $cart || $cart->items->isEmpty()) {
                abort(422, 'Votre panier est vide.');
            }

            $subtotal = 0;

            foreach ($cart->items as $item) {
                if (! $item->product || ! $item->product->is_active) {
                    abort(422, 'Un produit du panier nest plus disponible.');
                }

                if ($item->quantity > $item->product->stock_quantity) {
                    abort(422, "Stock insuffisant pour {$item->product->name}.");
                }

                $subtotal += (float) $item->unit_price * $item->quantity;
            }

            $order = Order::create([
                'user_id' => $request->user()->id,
                'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                'status' => 'pending',
                'subtotal' => $subtotal,
                'shipping_total' => 0,
                'total' => $subtotal,
                'customer_name' => $validated['name'],
                'customer_email' => $validated['email'],
                'customer_phone' => $validated['phone'],
                'shipping_address' => implode(', ', array_filter([
                    $validated['address'],
                    $validated['city'],
                    $validated['state'] ?? null,
                    $validated['country'] ?? null,
                    $validated['zip'],
                ])),
            ]);

            foreach ($cart->items as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->unit_price,
                    'total' => (float) $item->unit_price * $item->quantity,
                ]);

                $item->product->decrement('stock_quantity', $item->quantity);
            }

            $cart->items()->delete();
            $cart->delete();

            return $order;
        });

        return redirect()->route('thankyou', ['order' => $order->order_number]);
    }

    public function thankyou(Request $request)
    {
        $order = $request->query('order')
            ? $request->user()->orders()->where('order_number', $request->query('order'))->with('items.product')->first()
            : $request->user()->orders()->with('items.product')->latest()->first();

        return view('thankyou', compact('order'));
    }

    public function track(Request $request)
    {
        $orderNumber = $request->query('order');
        $order = $orderNumber
            ? $request->user()->orders()->where('order_number', $orderNumber)->with('items.product')->first()
            : $request->user()->orders()->with('items.product')->latest()->first();

        return view('order-tracking', compact('order'));
    }

    public function history(Request $request)
    {
        $orders = $request->user()->orders()->with('items')->latest()->paginate(10);

        return view('my-account', compact('orders'));
    }
}
