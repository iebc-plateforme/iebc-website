<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::orderBy('order')->paginate(15);
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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('icon')) {
            $validated['icon'] = $request->file('icon')->store('services', 'public');
        }

        Service::create($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('icon')) {
            $validated['icon'] = $request->file('icon')->store('services', 'public');
        }

        $service->update($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service supprimé avec succès.');
    }
}
