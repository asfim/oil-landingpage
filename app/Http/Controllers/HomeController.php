<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page with products from Model.
     */
    public function index()
    {
        $products = Product::where('is_active', true)->get();

        $whyItems = [
            [
                'title' => 'মানের নিশ্চয়তা',
                'desc' => 'প্রতিটি প্রোডাক্ট কোয়ালিটি চেক করে পাঠানো হয়।',
                'icon' => '<path d="M12 2l8 4v6c0 5-3.5 8.5-8 10-4.5-1.5-8-5-8-10V6l8-4z"/><path d="M9 12l2 2 4-4"/>'
            ],
            [
                'title' => 'ফাস্ট ডেলিভারি',
                'desc' => 'ঢাকার ভিতরে ২৪-৪৮ ঘণ্টায় ডেলিভারি।',
                'icon' => '<path d="M3 12h13M13 6l6 6-6 6"/>'
            ],
            [
                'title' => 'সহজ অর্ডার',
                'desc' => 'মাত্র কয়েকটি ক্লিকে অর্ডার সম্পন্ন করুন।',
                'icon' => '<circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.7 13.4a2 2 0 0 0 2 1.6h9.7a2 2 0 0 0 2-1.6L23 6H6"/>'
            ],
            [
                'title' => 'কাস্টমার সাপোর্ট',
                'desc' => 'যেকোনো প্রশ্নে আমাদের টিম সবসময় পাশে আছে।',
                'icon' => '<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>'
            ],
            [
                'title' => 'নিরাপদ পেমেন্ট',
                'desc' => 'ক্যাশ অন ডেলিভারি সহ নিরাপদ পেমেন্ট অপশন।',
                'icon' => '<rect x="3" y="11" width="18" height="10" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>'
            ],
            [
                'title' => 'সিকিউর প্যাকেজিং',
                'desc' => 'প্রতিটি প্রোডাক্ট নিরাপদে প্যাক করে পাঠানো হয়।',
                'icon' => '<path d="M21 8l-9-5-9 5 9 5 9-5z"/><path d="M3 8v8l9 5 9-5V8"/><path d="M12 13v8"/>'
            ],
        ];

        return view('frontend.index', compact('products', 'whyItems'));
    }

    /**
     * Store customer order in database.
     */
    public function storeOrder(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => ['required', 'regex:/^0\d{10}$/'],
            'address' => 'required|string|max:1000',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:10',
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $deliveryCharge = 60.00;
        $totalAmount = ($product->price * $validated['quantity']) + $deliveryCharge;

        $order = Order::create([
            'customer_name' => $validated['customer_name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'product_id' => $product->id,
            'product_name' => $product->name,
            'quantity' => $validated['quantity'],
            'unit_price' => $product->price,
            'delivery_charge' => $deliveryCharge,
            'total_amount' => $totalAmount,
            'status' => 'pending',
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'অর্ডার রিসিভ হয়েছে। আমাদের টিম শীঘ্রই আপনার ফোনে যোগাযোগ করবে।',
                'order_id' => $order->id,
            ]);
        }

        return redirect()->back()->with('success', 'অর্ডার রিসিভ হয়েছে। আমাদের টিম শীঘ্রই আপনার ফোনে যোগাযোগ করবে।');
    }
}
