<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SalesPopup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SalesPopupController extends Controller
{
    public function index()
    {
        $popups = SalesPopup::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.sales-popups.index', compact('popups'));
    }

    public function create()
    {
        return view('admin.sales-popups.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'time_ago' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active' => 'boolean',
        ]);

        $data = $request->except('image_file');
        
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/popups'), $filename);
            $data['image'] = 'uploads/popups/' . $filename;
        }

        $data['is_active'] = $request->has('is_active');

        SalesPopup::create($data);

        return redirect()->route('admin.sales-popups.index')->with('success', 'Sales popup created successfully.');
    }

    public function edit(SalesPopup $salesPopup)
    {
        return view('admin.sales-popups.edit', compact('salesPopup'));
    }

    public function update(Request $request, SalesPopup $salesPopup)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'time_ago' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active' => 'boolean',
        ]);

        $data = $request->except('image_file');

        if ($request->hasFile('image_file')) {
            if ($salesPopup->image && file_exists(public_path($salesPopup->image))) {
                unlink(public_path($salesPopup->image));
            }
            $file = $request->file('image_file');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/popups'), $filename);
            $data['image'] = 'uploads/popups/' . $filename;
        }

        $data['is_active'] = $request->has('is_active');

        $salesPopup->update($data);

        return redirect()->route('admin.sales-popups.index')->with('success', 'Sales popup updated successfully.');
    }

    public function destroy(SalesPopup $salesPopup)
    {
        if ($salesPopup->image && file_exists(public_path($salesPopup->image))) {
            unlink(public_path($salesPopup->image));
        }
        $salesPopup->delete();

        return redirect()->route('admin.sales-popups.index')->with('success', 'Sales popup deleted successfully.');
    }
}
