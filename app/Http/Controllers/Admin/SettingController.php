<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', 'logo_file', 'favicon_file', 'poster_file', 'video_file', 'remove_poster', 'remove_logo', 'remove_favicon']);
        
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // Ensure upload directory exists
        $uploadPath = public_path('uploads/settings');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        // Handle Direct Video Upload
        if ($request->hasFile('video_file')) {
            $request->validate([
                'video_file' => 'required|mimes:mp4,webm,ogg,quicktime,mov|max:102400' // max 100MB
            ]);
            $file = $request->file('video_file');
            $filename = 'video_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            Setting::updateOrCreate(['key' => 'video_url'], ['value' => 'uploads/settings/' . $filename]);
        }

        // Handle Logo Upload & Removal
        if ($request->has('remove_logo')) {
            Setting::where('key', 'site_logo')->delete();
        } elseif ($request->hasFile('logo_file')) {
            $file = $request->file('logo_file');
            $filename = 'logo_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            Setting::updateOrCreate(['key' => 'site_logo'], ['value' => 'uploads/settings/' . $filename]);
        }

        // Handle Favicon Upload & Removal
        if ($request->has('remove_favicon')) {
            Setting::where('key', 'site_favicon')->delete();
        } elseif ($request->hasFile('favicon_file')) {
            $file = $request->file('favicon_file');
            $filename = 'favicon_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            Setting::updateOrCreate(['key' => 'site_favicon'], ['value' => 'uploads/settings/' . $filename]);
        }
        
        // Handle Poster / Thumbnail Image Upload & Removal
        if ($request->has('remove_poster')) {
            Setting::where('key', 'video_poster')->delete();
        } elseif ($request->hasFile('poster_file')) {
            $file = $request->file('poster_file');
            $filename = 'poster_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            Setting::updateOrCreate(['key' => 'video_poster'], ['value' => 'uploads/settings/' . $filename]);
        }

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
    }
}
