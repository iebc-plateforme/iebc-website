<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Helpers\ImageHelper;

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
            'theme_primary_color' => 'nullable|string|max:7',
            'theme_secondary_color' => 'nullable|string|max:7',
            'theme_accent_color' => 'nullable|string|max:7',
            'theme_font_family' => 'nullable|string|max:100',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $oldLogo = Setting::get('company_logo');
            if ($oldLogo) {
                ImageHelper::deletePublic($oldLogo);
            }
            $logoPath = ImageHelper::storePublic($request->file('logo'), 'settings');
            Setting::set('company_logo', $logoPath, 'file');
            unset($validated['logo']); // Remove from batch save
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            $oldFavicon = Setting::get('site_favicon');
            if ($oldFavicon) {
                ImageHelper::deletePublic($oldFavicon);
            }
            $faviconPath = ImageHelper::storePublic($request->file('favicon'), 'settings');
            Setting::set('site_favicon', $faviconPath, 'file');

            // Copy to public root as favicon.ico
            $faviconFullPath = public_path($faviconPath);
            if (file_exists($faviconFullPath)) {
                copy($faviconFullPath, public_path('favicon.ico'));
            }
            unset($validated['favicon']); // Remove from batch save
        }

        // Save all other settings
        foreach ($validated as $key => $value) {
            if ($value !== null) {
                Setting::set($key, $value, 'text');
            }
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Paramètres mis à jour avec succès.');
    }
}
