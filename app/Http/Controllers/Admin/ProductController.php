<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('sort_order')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0|max:99999999',
            'old_price' => 'nullable|numeric|min:0|max:99999999',
            'rating' => 'required|numeric|min:0|max:5',
            'reviews' => 'required|integer|min:0',
            'badge' => 'nullable|string|max:50',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['img'] = 'images/p1.png'; // Default for now until we add upload
        $validated['code'] = 'PRD-' . strtoupper(uniqid());

        if ($request->hasFile('img_file')) {
            $path = $request->file('img_file')->store('products', 'public');
            $validated['img'] = 'storage/' . $path;
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0|max:99999999',
            'old_price' => 'nullable|numeric|min:0|max:99999999',
            'rating' => 'required|numeric|min:0|max:5',
            'reviews' => 'required|integer|min:0',
            'badge' => 'nullable|string|max:50',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('img_file')) {
            $path = $request->file('img_file')->store('products', 'public');
            $validated['img'] = 'storage/' . $path;
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
