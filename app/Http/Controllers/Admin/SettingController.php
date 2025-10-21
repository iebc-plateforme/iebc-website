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
        $validated = $request->validate([
            'site_name' => 'nullable|string|max:255',
            'site_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string|max:50',
            'contact_address' => 'nullable|string',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'google_analytics_id' => 'nullable|string|max:50',
            'logo' => 'nullable|image|max:2048',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $oldLogo = Setting::get('logo');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }
            $validated['logo'] = $request->file('logo')->store('settings', 'public');
        }

        // Save all settings
        foreach ($validated as $key => $value) {
            if ($value !== null) {
                Setting::set($key, $value, $key === 'logo' ? 'file' : 'text');
            }
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Paramètres mis à jour avec succès.');
    }
}
