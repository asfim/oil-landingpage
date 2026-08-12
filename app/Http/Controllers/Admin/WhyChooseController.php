<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhyChooseItem;
use Illuminate\Http\Request;

class WhyChooseController extends Controller
{
    public function index()
    {
        $items = WhyChooseItem::orderBy('sort_order')->get();
        return view('admin.why-choose.index', compact('items'));
    }

    public function create()
    {
        return view('admin.why-choose.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string',
            'sort_order' => 'nullable|integer'
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        WhyChooseItem::create($validated);

        return redirect()->route('admin.why-choose.index')->with('success', 'Item created successfully.');
    }

    public function edit(WhyChooseItem $whyChoose)
    {
        return view('admin.why-choose.edit', ['item' => $whyChoose]);
    }

    public function update(Request $request, WhyChooseItem $whyChoose)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string',
            'sort_order' => 'nullable|integer'
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $whyChoose->update($validated);

        return redirect()->route('admin.why-choose.index')->with('success', 'Item updated successfully.');
    }

    public function destroy(WhyChooseItem $whyChoose)
    {
        $whyChoose->delete();
        return redirect()->route('admin.why-choose.index')->with('success', 'Item deleted successfully.');
    }
}
