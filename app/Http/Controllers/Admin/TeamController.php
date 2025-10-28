<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\ImageHelper;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::orderBy('order')->paginate(15);
        return view('admin.teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.teams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'position' => 'required|string|max:255',
                'bio' => 'nullable|string',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'linkedin_url' => 'nullable|url|max:255',
                'twitter_url' => 'nullable|url|max:255',
                'facebook_url' => 'nullable|url|max:255',
                'instagram_url' => 'nullable|url|max:255',
                'github_url' => 'nullable|url|max:255',
                'website_url' => 'nullable|url|max:255',
                'is_active' => 'boolean',
                'order' => 'nullable|integer|min:0',
            ]);

            $slug = Str::slug($validated['name']);

            // Ensure slug uniqueness
            $originalSlug = $slug;
            $count = 1;
            while (Team::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }

            $validated['slug'] = $slug;
            $validated['is_active'] = $request->has('is_active');

            if ($request->hasFile('photo')) {
                $validated['photo'] = ImageHelper::storePublic($request->file('photo'), 'teams');
            }

            Team::create($validated);

            return redirect()->route('admin.teams.index')
                ->with('success', 'Membre d\'équipe créé avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de la création du membre: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        return view('admin.teams.show', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        return view('admin.teams.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'position' => 'required|string|max:255',
                'bio' => 'nullable|string',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'linkedin_url' => 'nullable|url|max:255',
                'twitter_url' => 'nullable|url|max:255',
                'facebook_url' => 'nullable|url|max:255',
                'instagram_url' => 'nullable|url|max:255',
                'github_url' => 'nullable|url|max:255',
                'website_url' => 'nullable|url|max:255',
                'is_active' => 'boolean',
                'order' => 'nullable|integer|min:0',
            ]);

            $slug = Str::slug($validated['name']);

            // Ensure slug uniqueness (excluding current team)
            $originalSlug = $slug;
            $count = 1;
            while (Team::where('slug', $slug)->where('id', '!=', $team->id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }

            $validated['slug'] = $slug;
            $validated['is_active'] = $request->has('is_active');

            if ($request->hasFile('photo')) {
                if ($team->photo) {
                    ImageHelper::deletePublic($team->photo);
                }
                $validated['photo'] = ImageHelper::storePublic($request->file('photo'), 'teams');
            }

            $team->update($validated);

            return redirect()->route('admin.teams.index')
                ->with('success', 'Membre d\'équipe mis à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de la mise à jour du membre: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        try {
            if ($team->photo) {
                ImageHelper::deletePublic($team->photo);
            }

            $team->delete();

            return redirect()->route('admin.teams.index')
                ->with('success', 'Membre d\'équipe supprimé avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur lors de la suppression du membre: ' . $e->getMessage());
        }
    }
}