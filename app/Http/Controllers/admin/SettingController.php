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
                'mission_vision'=>'',
                'purpose'=>'',
                'about_digital_library'=>'',
                'logo' => ''
            ]);
        }

        return view('admin.settings.edit', compact('setting'));
    }

    // Update settings
    public function update(Request $request)
    {
       
        $request->validate([
            'hero_title_en' => 'required|string',
            'hero_title_ps' => 'required|string',
            'hero_description_en' => 'nullable|string',
            'hero_description_ps' => 'nullable|string',
            'footer_text_en' => 'nullable|string',
            'footer_text_ps' => 'nullable|string',
            'mission_vision_en'=> "nullable|string",
            'mission_vision_ps'=> "nullable|string",
            'purpose_en'=> "nullable|string",
            'purpose_ps'=> "nullable|string",
            'about_digital_library_en'=>'nullable|string',
            'about_digital_library_ps'=>'nullable|string',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg',
            'email'=>'nullable|string',
            'email1'=>'nullable|string',
            'phone'=>'nullable',
            'phone1'=>'nullable',
            'address'=>'nullable|string',
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
        $setting->hero_title_en = $request->hero_title_en;
        $setting->hero_title_ps = $request->hero_title_ps;
        $setting->hero_description_en = $request->hero_description_en;
        $setting->hero_description_ps = $request->hero_description_ps;
        $setting->footer_text_en = $request->footer_text_en;
        $setting->footer_text_ps=$request->footer_text_ps;
        $setting->mission_vision_en = $request->mission_vision_en;
        $setting->mission_vision_ps = $request->mission_vision_ps;
        $setting->purpose_en = $request->purpose_en;
        $setting->purpose_ps = $request->purpose_ps;
        $setting->about_digital_library_en = $request->about_digital_library_en;
        $setting->about_digital_library_ps = $request->about_digital_library_ps;
        $setting->email= $request->email;
        $setting->email1= $request->email1;
        $setting->phone= $request->phone;
        $setting->phone1= $request->phone1;
        $setting->address= $request->address;
        $setting->save();

        return redirect()->back()->with('success', 'Settings updated successfully!');
    }
}