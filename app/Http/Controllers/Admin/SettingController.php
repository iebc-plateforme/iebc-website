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
            'favicon' => 'nullable|image|mimes:ico,png|max:512',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $oldLogo = Setting::get('logo');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }
            $validated['logo'] = $request->file('logo')->store('settings', 'public');
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            $oldFavicon = Setting::get('favicon');
            if ($oldFavicon && Storage::disk('public')->exists($oldFavicon)) {
                Storage::disk('public')->delete($oldFavicon);
            }
            $faviconPath = $request->file('favicon')->store('settings', 'public');
            $validated['favicon'] = $faviconPath;

            // Copy to public root as favicon.ico
            $faviconFullPath = storage_path('app/public/' . $faviconPath);
            if (file_exists($faviconFullPath)) {
                copy($faviconFullPath, public_path('favicon.ico'));
            }
        }

        // Save all settings
        foreach ($validated as $key => $value) {
            if ($value !== null) {
                Setting::set($key, $value, in_array($key, ['logo', 'favicon']) ? 'file' : 'text');
            }
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Paramètres mis à jour avec succès.');
    }
}
