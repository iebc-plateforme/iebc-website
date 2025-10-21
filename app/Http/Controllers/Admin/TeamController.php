<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('teams', 'public');
        }

        Team::create($validated);

        return redirect()->route('admin.teams.index')
            ->with('success', 'Membre d\'équipe créé avec succès.');
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('photo')) {
            if ($team->photo) {
                Storage::disk('public')->delete($team->photo);
            }
            $validated['photo'] = $request->file('photo')->store('teams', 'public');
        }

        $team->update($validated);

        return redirect()->route('admin.teams.index')
            ->with('success', 'Membre d\'équipe mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        if ($team->photo) {
            Storage::disk('public')->delete($team->photo);
        }

        $team->delete();

        return redirect()->route('admin.teams.index')
            ->with('success', 'Membre d\'équipe supprimé avec succès.');
    }
}