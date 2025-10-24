<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = Partner::orderBy('order')->paginate(15);
        return view('admin.partners.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.partners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'website' => 'nullable|url|max:255',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'is_active' => 'boolean',
                'order' => 'nullable|integer|min:0',
            ]);

            $slug = Str::slug($validated['name']);

            // Ensure slug uniqueness
            $originalSlug = $slug;
            $count = 1;
            while (Partner::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }

            $validated['slug'] = $slug;
            $validated['is_active'] = $request->has('is_active');

            if ($request->hasFile('logo')) {
                $validated['logo'] = $request->file('logo')->store('partners', 'public');
            }

            Partner::create($validated);

            return redirect()->route('admin.partners.index')
                ->with('success', 'Partenaire créé avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de la création du partenaire: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Partner $partner)
    {
        return view('admin.partners.show', compact('partner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partner $partner)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'website' => 'nullable|url|max:255',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'is_active' => 'boolean',
                'order' => 'nullable|integer|min:0',
            ]);

            $slug = Str::slug($validated['name']);

            // Ensure slug uniqueness (excluding current partner)
            $originalSlug = $slug;
            $count = 1;
            while (Partner::where('slug', $slug)->where('id', '!=', $partner->id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }

            $validated['slug'] = $slug;
            $validated['is_active'] = $request->has('is_active');

            if ($request->hasFile('logo')) {
                // Suppression de l'ancien logo si un nouveau est téléchargé
                if ($partner->logo && Storage::disk('public')->exists($partner->logo)) {
                    Storage::disk('public')->delete($partner->logo);
                }
                $validated['logo'] = $request->file('logo')->store('partners', 'public');
            }

            $partner->update($validated);

            return redirect()->route('admin.partners.index')
                ->with('success', 'Partenaire mis à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de la mise à jour du partenaire: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner)
    {
        try {
            // Supprimer le logo associé
            if ($partner->logo && Storage::disk('public')->exists($partner->logo)) {
                Storage::disk('public')->delete($partner->logo);
            }

            $partner->delete();

            return redirect()->route('admin.partners.index')
                ->with('success', 'Partenaire supprimé avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur lors de la suppression du partenaire: ' . $e->getMessage());
        }
    }
}