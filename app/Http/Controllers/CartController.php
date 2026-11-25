<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Schema;

class CartController extends Controller
{
    private function cart(Request $request): Cart
    {
        $cart = $request->user()
            ? Cart::firstOrCreate(['user_id' => $request->user()->id])
            : Cart::firstOrCreate(['session_id' => $request->session()->getId()]);

        return $cart;
    }

    public function index(Request $request)
    {
        if (! Schema::hasTable('carts') || ! Schema::hasTable('cart_items')) {
            return view('cart.list', [
                'cart' => null,
                'items' => collect(),
                'subtotal' => 0,
            ]);
        }

        $cart = $this->cart($request);
        $items = $cart->items()->with(['product.images'])->get();
        $subtotal = $items->sum(fn (CartItem $item) => (float) $item->unit_price * $item->quantity);

        return view('cart.list', compact('cart', 'items', 'subtotal'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1', 'max:99'],
        ]);

        $product = Product::where('is_active', true)->findOrFail($validated['product_id']);

        if ($validated['quantity'] > $product->stock_quantity) {
            return back()->withErrors(['quantity' => 'Stock insuffisant pour ce produit.']);
        }

        $cart = $this->cart($request);
        $item = $cart->items()->where('product_id', $product->id)->first();

        if ($item) {
            $newQuantity = min($item->quantity + $validated['quantity'], $product->stock_quantity);
            $item->update(['quantity' => $newQuantity]);
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $validated['quantity'],
                'unit_price' => $product->price,
            ]);
        }

        return back()->with('status', 'Produit ajoute au panier.');
    }

    public function update(Request $request, CartItem $item)
    {
        $cart = $this->cart($request);

        if ($item->cart_id !== $cart->id) {
            abort(403);
        }

        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:99'],
        ]);

        $item->load('product');
        $quantity = min($validated['quantity'], $item->product->stock_quantity);
        $item->update(['quantity' => max(1, $quantity)]);

        return back()->with('status', 'Quantite mise a jour.');
    }

    public function destroy(Request $request, CartItem $item)
    {
        $cart = $this->cart($request);

        if ($item->cart_id !== $cart->id) {
            abort(403);
        }

        $item->delete();

        return back()->with('status', 'Produit retire du panier.');
    }

    public function clear(Request $request)
    {
        $this->cart($request)->items()->delete();

        return back()->with('status', 'Panier vide.');
    }
}
