<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    // Show edit form
    public function edit()
    {
        $setting = Setting::first();

        // if no row exists, create one
        if (!$setting) {
            $setting = Setting::create([
                'hero_title' => '',
                'hero_description' => '',
                'footer_text' => '',
                'logo' => ''
            ]);
        }

        return view('admin.settings.edit', compact('setting'));
    }

    // Update settings
    public function update(Request $request)
    {
        $request->validate([
            'hero_title' => 'required|string',
            'hero_description' => 'nullable|string',
            'footer_text' => 'nullable|string',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg'
        ]);

        $setting = Setting::first();

        if (!$setting) {
            $setting = new Setting();
        }

        // Upload logo if exists
        if ($request->hasFile('logo')) {
               
        
            $file = $request->file('logo');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads'), $filename);

            $setting->logo = $filename;
        }

        // Save text fields
        $setting->hero_title = $request->hero_title;
        $setting->hero_description = $request->hero_description;
        $setting->footer_text = $request->footer_text;

        $setting->save();

        return redirect()->back()->with('success', 'Settings updated successfully!');
    }
}