<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Only super admin can access user management
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Accès refusé. Seuls les Super Administrateurs peuvent gérer les utilisateurs.');
        }

        $users = User::with('userRole')->latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Only super admin can create users
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Accès refusé. Seuls les Super Administrateurs peuvent créer des utilisateurs.');
        }

        $roles = Role::orderBy('name')->get();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Only super admin can create users
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Accès refusé. Seuls les Super Administrateurs peuvent créer des utilisateurs.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)],
            'role_id' => 'required|exists:roles,id',
        ]);

        // Get the role to set the legacy role field
        $role = Role::findOrFail($validated['role_id']);

        // Prevent creating multiple super admins
        if ($role->is_super_admin) {
            $superAdminExists = User::where('role', 'superadmin')->exists();
            if ($superAdminExists) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Un Super Admin existe déjà dans le système. Un seul Super Admin est autorisé.');
            }
        }

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = $role->is_super_admin ? 'superadmin' : 'admin';

        User::create($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Only super admin can edit users
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Accès refusé. Seuls les Super Administrateurs peuvent modifier des utilisateurs.');
        }

        // Prevent editing yourself
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Vous ne pouvez pas modifier votre propre compte via cette interface.');
        }

        $roles = Role::orderBy('name')->get();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Only super admin can update users
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Accès refusé. Seuls les Super Administrateurs peuvent modifier des utilisateurs.');
        }

        // Prevent editing yourself
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Vous ne pouvez pas modifier votre propre compte via cette interface.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => ['nullable', 'confirmed', Password::min(8)],
            'role_id' => 'required|exists:roles,id',
        ]);

        // Get the new role
        $role = Role::findOrFail($validated['role_id']);

        // Prevent promoting to super admin if one already exists
        if ($role->is_super_admin && !$user->isSuperAdmin()) {
            $superAdminExists = User::where('role', 'superadmin')->where('id', '!=', $user->id)->exists();
            if ($superAdminExists) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Un Super Admin existe déjà. Impossible de promouvoir cet utilisateur.');
            }
        }

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $validated['role'] = $role->is_super_admin ? 'superadmin' : 'admin';
        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Only super admin can delete users
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Accès refusé. Seuls les Super Administrateurs peuvent supprimer des utilisateurs.');
        }

        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        // Prevent deleting the only super admin
        if ($user->isSuperAdmin()) {
            $superAdminCount = User::where('role', 'superadmin')->count();
            if ($superAdminCount <= 1) {
                return redirect()->route('admin.users.index')
                    ->with('error', 'Impossible de supprimer le dernier Super Admin du système.');
            }
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur supprimé avec succès.');
    }
}
