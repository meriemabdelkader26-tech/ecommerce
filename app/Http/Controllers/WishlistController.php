<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class WishlistController extends Controller
{
    public function index(Request $request)
    {
        if (! Schema::hasTable('wishlists')) {
            return view('wishlist.list', ['items' => collect()]);
        }

        $items = $request->user()
            ? $request->user()->wishlists()->with('product.images')->get()
            : collect();

        return view('wishlist.list', compact('items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
        ]);

        $product = Product::where('is_active', true)->findOrFail($validated['product_id']);

        Wishlist::firstOrCreate([
            'user_id' => $request->user()->id,
            'product_id' => $product->id,
        ]);

        return back()->with('status', 'Produit ajoute aux favoris.');
    }

    public function destroy(Request $request, Wishlist $wishlist)
    {
        if ($wishlist->user_id !== $request->user()->id) {
            abort(403);
        }

        $wishlist->delete();

        return back()->with('status', 'Produit retire des favoris.');
    }
}
