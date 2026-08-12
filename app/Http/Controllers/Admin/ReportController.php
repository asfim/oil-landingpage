<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        $query = Order::query();

        // If date filter is provided
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        // Summary Data
        $totalOrders = (clone $query)->count();
        
        // Let's count revenue from Confirmed and Delivered orders
        $totalRevenue = (clone $query)->whereIn('status', ['confirmed', 'delivered'])->sum('total_amount');
        
        $deliveredOrders = (clone $query)->where('status', 'delivered')->count();
        $confirmedOrders = (clone $query)->where('status', 'confirmed')->count();
        $pendingOrders = (clone $query)->where('status', 'pending')->count();
        $cancelledOrders = (clone $query)->where('status', 'cancelled')->count();

        // Get Top Selling Products (Simple count based on product_name string)
        $topProducts = (clone $query)
            ->select('product_name', DB::raw('SUM(quantity) as total_sold'))
            ->whereIn('status', ['confirmed', 'delivered'])
            ->groupBy('product_name')
            ->orderByDesc('total_sold')
            ->limit(10)
            ->get();
            
        // Get Recent Orders (Last 50) for the report list
        $orders = $query->orderBy('created_at', 'desc')->paginate(50);

        return view('admin.reports.index', compact(
            'startDate', 'endDate',
            'totalOrders', 'totalRevenue',
            'deliveredOrders', 'confirmedOrders', 'pendingOrders', 'cancelledOrders',
            'topProducts', 'orders'
        ));
    }
}
