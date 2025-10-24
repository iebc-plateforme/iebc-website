<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $themes = Theme::orderBy('sort_order')->get();
        return view('admin.themes.index', compact('themes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.themes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:themes',
            'display_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'primary_color' => 'required|string|max:7',
            'secondary_color' => 'required|string|max:7',
            'accent_color' => 'required|string|max:7',
            'success_color' => 'required|string|max:7',
            'warning_color' => 'required|string|max:7',
            'danger_color' => 'required|string|max:7',
            'info_color' => 'required|string|max:7',
            'light_color' => 'required|string|max:7',
            'dark_color' => 'required|string|max:7',
            'font_family' => 'required|string|max:255',
            'heading_font_family' => 'nullable|string|max:255',
            'border_radius' => 'required|string|max:50',
            'box_shadow' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        Theme::create($validated);

        return redirect()->route('admin.themes.index')
            ->with('success', 'Theme created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Theme $theme)
    {
        return view('admin.themes.edit', compact('theme'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Theme $theme)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:themes,name,' . $theme->id,
            'display_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'primary_color' => 'required|string|max:7',
            'secondary_color' => 'required|string|max:7',
            'accent_color' => 'required|string|max:7',
            'success_color' => 'required|string|max:7',
            'warning_color' => 'required|string|max:7',
            'danger_color' => 'required|string|max:7',
            'info_color' => 'required|string|max:7',
            'light_color' => 'required|string|max:7',
            'dark_color' => 'required|string|max:7',
            'font_family' => 'required|string|max:255',
            'heading_font_family' => 'nullable|string|max:255',
            'border_radius' => 'required|string|max:50',
            'box_shadow' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $theme->update($validated);

        return redirect()->route('admin.themes.index')
            ->with('success', 'Theme updated successfully!');
    }

    /**
     * Activate a theme
     */
    public function activate(Theme $theme)
    {
        $theme->activate();

        return redirect()->route('admin.themes.index')
            ->with('success', 'Theme activated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Theme $theme)
    {
        if ($theme->is_active) {
            return redirect()->route('admin.themes.index')
                ->with('error', 'Cannot delete active theme!');
        }

        if ($theme->is_default) {
            return redirect()->route('admin.themes.index')
                ->with('error', 'Cannot delete default theme!');
        }

        $theme->delete();

        return redirect()->route('admin.themes.index')
            ->with('success', 'Theme deleted successfully!');
    }
}
