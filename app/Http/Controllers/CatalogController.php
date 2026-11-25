<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\LengthAwarePaginator;

class CatalogController extends Controller
{
    public function home()
    {
        $homeProducts = collect();

        if (Schema::hasTable('products') && Schema::hasTable('categories') && Schema::hasTable('product_images')) {
            $homeProducts = Product::where('is_active', true)
                ->with(['category', 'images'])
                ->latest()
                ->limit(12)
                ->get();
        }

        return view('home', compact('homeProducts'));
    }

    public function index(Request $request)
    {
        if (! Schema::hasTable('categories') || ! Schema::hasTable('products')) {
            return view('shop', [
                'categories' => collect(),
                'products' => new LengthAwarePaginator([], 0, 12),
            ]);
        }

        $categories = Category::where('is_active', true)
            ->withCount(['products' => fn ($query) => $query->where('is_active', true)])
            ->orderBy('name')
            ->get();

        $products = Product::where('is_active', true)
            ->with(['category', 'images'])
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = $request->string('q')->toString();
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->whereHas('category', fn ($query) =>
                    $query->where('slug', $request->string('category')->toString())
                );
            })
            ->when($request->filled('min'), fn ($query) =>
                $query->where('price', '>=', $request->integer('min'))
            )
            ->when($request->filled('max'), fn ($query) =>
                $query->where('price', '<=', $request->integer('max'))
            )
            ->when($request->integer('orderby') === 3, fn ($query) => $query->orderBy('price'))
            ->when($request->integer('orderby') === 4, fn ($query) => $query->orderByDesc('price'))
            ->when(! in_array($request->integer('orderby'), [3, 4], true), fn ($query) => $query->latest())
            ->paginate(12)
            ->withQueryString();

        return view('shop', compact('categories', 'products'));
    }

    public function show(?string $slug = null)
    {
        if (! Schema::hasTable('products')) {
            return view('product.details', [
                'product' => null,
                'related' => collect(),
            ]);
        }

        $product = $slug
            ? Product::where('slug', $slug)->where('is_active', true)->with(['category', 'images'])->first()
            : Product::where('is_active', true)->with(['category', 'images'])->first();

        $related = $product
            ? Product::where('is_active', true)
                ->whereKeyNot($product->id)
                ->where('category_id', $product->category_id)
                ->with('images')
                ->limit(8)
                ->get()
            : collect();

        return view('product.details', compact('product', 'related'));
    }
}
