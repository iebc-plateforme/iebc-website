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
        try {
            // Base validation
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'type' => 'required|in:image,video',
                'category' => 'nullable|string|max:255',
                'is_featured' => 'boolean',
                'order' => 'nullable|integer|min:0',
            ]);

            // Type-specific file validation
            if ($request->type === 'image') {
                $request->validate([
                    'file_path' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // Max 5MB for images
                ]);
            } else {
                $request->validate([
                    'file_path' => 'required|file|mimes:mp4,avi,mov,wmv,flv|max:20480', // Max 20MB for videos
                ]);
            }

            $validated = $request->all();
            $validated['is_featured'] = $request->has('is_featured');

            if ($request->hasFile('file_path')) {
                $validated['file_path'] = $request->file('file_path')->store('galleries', 'public');
            }

            Gallery::create($validated);

            return redirect()->route('admin.galleries.index')
                ->with('success', 'Élément de galerie créé avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de la création: ' . $e->getMessage());
        }
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
        try {
            // Base validation
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'type' => 'required|in:image,video',
                'category' => 'nullable|string|max:255',
                'is_featured' => 'boolean',
                'order' => 'nullable|integer|min:0',
            ]);

            // Type-specific file validation if uploading new file
            if ($request->hasFile('file_path')) {
                if ($request->type === 'image') {
                    $request->validate([
                        'file_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
                    ]);
                } else {
                    $request->validate([
                        'file_path' => 'nullable|file|mimes:mp4,avi,mov,wmv,flv|max:20480',
                    ]);
                }
            }

            $validated = $request->all();
            $validated['is_featured'] = $request->has('is_featured');

            if ($request->hasFile('file_path')) {
                if ($gallery->file_path && Storage::disk('public')->exists($gallery->file_path)) {
                    Storage::disk('public')->delete($gallery->file_path);
                }
                $validated['file_path'] = $request->file('file_path')->store('galleries', 'public');
            }

            $gallery->update($validated);

            return redirect()->route('admin.galleries.index')
                ->with('success', 'Élément de galerie mis à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de la mise à jour: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        try {
            if ($gallery->file_path && Storage::disk('public')->exists($gallery->file_path)) {
                Storage::disk('public')->delete($gallery->file_path);
            }

            $gallery->delete();

            return redirect()->route('admin.galleries.index')
                ->with('success', 'Élément de galerie supprimé avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur lors de la suppression: ' . $e->getMessage());
        }
    }
}