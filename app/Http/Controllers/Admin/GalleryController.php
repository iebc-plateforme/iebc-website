<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::orderBy('order')->paginate(15);
        return view('admin.galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file_path' => 'required|file|max:10240', // Max 10MB
            'type' => 'required|in:image,video',
            'category' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('galleries', 'public');
        }

        Gallery::create($validated);

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Élément de galerie créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        return view('admin.galleries.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file_path' => 'nullable|file|max:10240',
            'type' => 'required|in:image,video',
            'category' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('file_path')) {
            if ($gallery->file_path) {
                Storage::disk('public')->delete($gallery->file_path);
            }
            $validated['file_path'] = $request->file('file_path')->store('galleries', 'public');
        }

        $gallery->update($validated);

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Élément de galerie mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        if ($gallery->file_path) {
            Storage::disk('public')->delete($gallery->file_path);
        }

        $gallery->delete();

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Élément de galerie supprimé avec succès.');
    }
}