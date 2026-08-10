<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $confirmedOrders = Order::where('status', 'confirmed')->count();
        $processingOrders = Order::where('status', 'processing')->count();
        $deliveredOrders = Order::where('status', 'delivered')->count();
        $cancelledOrders = Order::where('status', 'cancelled')->count();
        
        $totalProducts = Product::count();
        $totalSales = Order::where('status', 'delivered')->sum('total_amount');
        
        $todayOrders = Order::whereDate('created_at', today())->count();
        $todaySales = Order::whereDate('created_at', today())->where('status', 'delivered')->sum('total_amount');
        
        $recentOrders = Order::latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'totalOrders', 'pendingOrders', 'confirmedOrders', 'processingOrders', 
            'deliveredOrders', 'cancelledOrders', 'totalProducts', 'totalSales', 
            'todayOrders', 'todaySales', 'recentOrders'
        ));
    }
}
