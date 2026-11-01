<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $notCancelled = Order::where('status', '!=', 'cancelled');

        return view('admin.dashboard', [
            'stats' => [
                'today'    => Order::whereDate('created_at', today())->count(),
                'pending'  => Order::where('status', 'pending')->count(),
                'orders'   => Order::count(),
                'revenue'  => (clone $notCancelled)->sum('total'),
                'products' => Product::count(),
            ],
            'recent' => Order::latest()->take(8)->get(),
        ]);
    }
}
