<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::orderBy('order')->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $slug = Str::slug($request->title);

        // Ensure slug uniqueness
        $originalSlug = $slug;
        $count = 1;
        while (Service::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        $service = new Service($request->except(['icon']));
        $service->slug = $slug;

        if ($request->hasFile('icon')) {
            $service->icon = $request->file('icon')->store('icons', 'public');
        }

        $service->is_active = $request->has('is_active');
        $service->save();

        return redirect()->route('admin.services.index')->with('success', 'Service créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        // Not typically used for simple CRUD, but can be implemented if needed.
        return view('admin.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $slug = Str::slug($request->title);

        // Ensure slug uniqueness (excluding current service)
        $originalSlug = $slug;
        $count = 1;
        while (Service::where('slug', $slug)->where('id', '!=', $service->id)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        $service->fill($request->except(['icon']));
        $service->slug = $slug;

        if ($request->hasFile('icon')) {
            // Delete old icon if exists
            if ($service->icon) {
                Storage::disk('public')->delete($service->icon);
            }
            $service->icon = $request->file('icon')->store('icons', 'public');
        } elseif ($request->boolean('remove_icon')) {
            if ($service->icon) {
                Storage::disk('public')->delete($service->icon);
                $service->icon = null;
            }
        }

        $service->is_active = $request->has('is_active');
        $service->save();

        return redirect()->route('admin.services.index')->with('success', 'Service mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        if ($service->icon) {
            Storage::disk('public')->delete($service->icon);
        }
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service supprimé avec succès.');
    }
}