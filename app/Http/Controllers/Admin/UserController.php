<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)],
            'role' => 'required|in:admin,superadmin',
        ]);

        // Vérifier qu'un seul Super Admin peut exister
        if ($validated['role'] === 'superadmin') {
            $superAdminExists = User::where('role', 'superadmin')->exists();
            if ($superAdminExists) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Un Super Admin existe déjà dans le système. Un seul Super Admin est autorisé.');
            }
        }

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Ne pas permettre la modification du Super Admin principal
        if ($user->email === 'ismailahamadou5@gmail.com') {
            return redirect()->route('admin.users.index')
                ->with('error', 'Impossible de modifier le Super Admin principal.');
        }

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Ne pas permettre la modification du Super Admin principal
        if ($user->email === 'ismailahamadou5@gmail.com') {
            return redirect()->route('admin.users.index')
                ->with('error', 'Impossible de modifier le Super Admin principal.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => ['nullable', 'confirmed', Password::min(8)],
            'role' => 'required|in:admin,superadmin',
        ]);

        // Empêcher de promouvoir quelqu'un en Super Admin si un existe déjà
        if ($validated['role'] === 'superadmin' && $user->role !== 'superadmin') {
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

        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Ne pas permettre la suppression du Super Admin principal
        if ($user->email === 'ismailahamadou5@gmail.com') {
            return redirect()->route('admin.users.index')
                ->with('error', 'Impossible de supprimer le Super Admin principal.');
        }

        // Ne pas permettre de se supprimer soi-même
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur supprimé avec succès.');
    }
}
