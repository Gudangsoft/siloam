<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'app_name'         => 'required|string|max:255',
            'tagline'          => 'nullable|string|max:255',
            'address'          => 'nullable|string',
            'phone'            => 'nullable|string|max:30',
            'email'            => 'nullable|email|max:100',
            'facebook'         => 'nullable|url|max:255',
            'instagram'        => 'nullable|url|max:255',
            'youtube'          => 'nullable|url|max:255',
            'whatsapp'         => 'nullable|string|max:20',
            'maps_embed'       => 'nullable|string',
            'welcome_message'  => 'nullable|string',
            'rector_name'          => 'nullable|string|max:255',
            'rector_title'         => 'nullable|string|max:100',
            'rector_message'       => 'nullable|string',
            'meta_description'     => 'nullable|string|max:300',
            'footer_text'          => 'nullable|string|max:255',
            'admin_panel_subtitle' => 'nullable|string|max:255',
            'total_students'   => 'nullable|integer',
            'total_alumni'     => 'nullable|integer',
            'total_lecturers'  => 'nullable|integer',
            // Tema & Tampilan
            'primary_color'    => ['nullable', 'regex:/^#[0-9a-fA-F]{6}$/'],
            'primary_light'    => ['nullable', 'regex:/^#[0-9a-fA-F]{6}$/'],
            'accent_color'     => ['nullable', 'regex:/^#[0-9a-fA-F]{6}$/'],
            'sidebar_color'    => ['nullable', 'regex:/^#[0-9a-fA-F]{6}$/'],
            'font_family'      => 'nullable|string|in:Inter,Poppins,Roboto,Nunito,Open Sans',
            'custom_css'       => 'nullable|string|max:20000',
            'logo'             => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'favicon'          => 'nullable|mimes:ico,png,jpg,jpeg,svg|max:512',
            'rector_photo'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $textKeys = [
            'app_name', 'tagline', 'address', 'phone', 'email',
            'facebook', 'instagram', 'youtube', 'whatsapp', 'maps_embed',
            'welcome_message', 'rector_name', 'rector_title', 'rector_message',
            'meta_description', 'footer_text', 'admin_panel_subtitle',
            'total_students', 'total_alumni', 'total_lecturers',
            'primary_color', 'primary_light', 'accent_color', 'sidebar_color',
            'font_family', 'custom_css',
        ];

        foreach ($textKeys as $key) {
            if ($request->has($key)) {
                Setting::set($key, $request->$key);
            }
        }

        if ($request->hasFile('logo')) {
            $old = Setting::get('logo');
            if ($old) Storage::disk('public')->delete($old);
            Setting::set('logo', $request->file('logo')->store('settings', 'public'));
        }

        if ($request->hasFile('favicon')) {
            $old = Setting::get('favicon');
            if ($old) Storage::disk('public')->delete($old);
            Setting::set('favicon', $request->file('favicon')->store('settings', 'public'));
        }

        if ($request->hasFile('rector_photo')) {
            $old = Setting::get('rector_photo');
            if ($old) Storage::disk('public')->delete($old);
            Setting::set('rector_photo', $request->file('rector_photo')->store('settings', 'public'));
        }

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil disimpan!');
    }
}
