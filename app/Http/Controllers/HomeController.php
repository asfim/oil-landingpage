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
        $products = Product::where('is_active', true)->orderBy('sort_order')->get();
        $whyItems = \App\Models\WhyChooseItem::where('is_active', true)->orderBy('sort_order')->get();
        $benefits = \App\Models\Benefit::where('is_active', true)->orderBy('sort_order')->get();
        $settings = \App\Models\Setting::pluck('value', 'key')->toArray();

        // If whyItems is empty, fallback to default array for robustness if not seeded
        if ($whyItems->isEmpty()) {
            $whyItems = collect([
                (object)[
                    'title' => 'মানের নিশ্চয়তা',
                    'description' => 'প্রতিটি প্রোডাক্ট কোয়ালিটি চেক করে পাঠানো হয়।',
                    'icon' => '<path d="M12 2l8 4v6c0 5-3.5 8.5-8 10-4.5-1.5-8-5-8-10V6l8-4z"/><path d="M9 12l2 2 4-4"/>'
                ],
                (object)[
                    'title' => 'ফাস্ট ডেলিভারি',
                    'description' => 'ঢাকার ভিতরে ২৪-৪৮ ঘণ্টায় ডেলিভারি।',
                    'icon' => '<path d="M3 12h13M13 6l6 6-6 6"/>'
                ]
            ]);
        }

        return view('frontend.index', compact('products', 'whyItems', 'benefits', 'settings'));
    }

    /**
     * Store customer order in database.
     */
    public function storeOrder(Request $request)
    {
        // Phone normalization
        $phone = $request->input('phone', '');
        $phone = preg_replace('/^(?:\+?88)?(01\d{9})$/', '+88$1', trim($phone));
        $request->merge(['phone' => $phone]);

        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => ['required', 'regex:/^\+8801\d{9}$/'],
            'address' => 'required|string|max:1000',
            'product_ids' => 'required|array|min:1',
            'product_ids.*' => 'exists:products,id',
            'quantity' => 'required|integer|min:1|max:10',
        ]);

        $products = Product::whereIn('id', $validated['product_ids'])->get();
        
        $subtotal = 0;
        $productNames = [];
        foreach ($products as $p) {
            $subtotal += $p->price;
            $productNames[] = $p->name;
        }

        $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
        $deliveryCharge = isset($settings['delivery_charge']) ? (float)$settings['delivery_charge'] : 60.00;
        $totalAmount = ($subtotal * $validated['quantity']) + $deliveryCharge;

        $order = Order::create([
            'customer_name' => $validated['customer_name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'product_id' => null,
            'product_name' => implode(' + ', $productNames),
            'quantity' => $validated['quantity'],
            'unit_price' => $subtotal,
            'delivery_charge' => $deliveryCharge,
            'total_amount' => $totalAmount,
            'status' => 'pending',
        ]);

        // Create Order Items
        foreach ($products as $p) {
            $order->items()->create([
                'product_id' => $p->id,
                'product_name' => $p->name,
                'product_price' => $p->price,
                'quantity' => $validated['quantity'], // Master quantity applies to each selected package
                'subtotal' => $p->price * $validated['quantity'],
            ]);
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'অর্ডার রিসিভ হয়েছে। আমাদের টিম শীঘ্রই আপনার ফোনে যোগাযোগ করবে।',
                'order_id' => $order->id,
                'total_amount' => $totalAmount,
            ]);
        }

        return redirect()->back()->with('success', 'অর্ডার রিসিভ হয়েছে। আমাদের টিম শীঘ্রই আপনার ফোনে যোগাযোগ করবে।');
    }
}
