<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Schema;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products' => Schema::hasTable('products') ? Product::count() : 0,
            'categories' => Schema::hasTable('categories') ? Category::count() : 0,
            'customers' => Schema::hasTable('users') ? User::where('role', 'customer')->count() : 0,
            'orders' => Schema::hasTable('orders') ? Order::count() : 0,
            'revenue' => Schema::hasTable('orders') ? (float) Order::where('status', '!=', 'cancelled')->sum('total') : 0,
            'low_stock' => Schema::hasTable('products') ? Product::where('stock_quantity', '<=', 5)->count() : 0,
        ];

        $recentOrders = Schema::hasTable('orders')
            ? Order::with('user')->latest()->limit(8)->get()
            : collect();

        return view('admin.dashboard', compact('stats', 'recentOrders'));
    }
}
