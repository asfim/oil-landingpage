<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::latest();

        // Detect repeat customers by normalizing phone numbers (last 9 digits)
        $allOrders = Order::select('id', 'phone')->get();
        $phoneGroups = [];
        foreach ($allOrders as $ord) {
            $digits = preg_replace('/\D/', '', $ord->phone);
            $key = strlen($digits) >= 9 ? substr($digits, -9) : $digits;
            if ($key) {
                $phoneGroups[$key][] = $ord->id;
            }
        }

        $repeatOrderIds = [];
        foreach ($phoneGroups as $ids) {
            if (count($ids) > 1) {
                $repeatOrderIds = array_merge($repeatOrderIds, $ids);
            }
        }

        $repeatCount = count($repeatOrderIds);

        // Filtering logic
        if ($request->get('filter') === 'repeat') {
            $query->whereIn('id', $repeatOrderIds);
        } elseif ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(20);

        return view('admin.orders.index', compact('orders', 'repeatCount'));
    }

    public function show(Order $order)
    {
        $order->load(['items.product', 'product']);
        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,processing,delivered,cancelled',
        ]);

        $order->update(['status' => $validated['status']]);

        return redirect()->back()->with('success', 'Order #' . $order->id . ' status updated to ' . ucfirst($order->status) . '.');
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:1000',
            'status' => 'required|in:pending,confirmed,processing,delivered,cancelled',
            'note' => 'nullable|string'
        ]);

        $order->update($validated);

        return redirect()->route('admin.orders.show', $order->id)->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully.');
    }
}
