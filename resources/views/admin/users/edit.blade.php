@extends('admin.layouts.app')

@section('title', 'Modifier un administrateur')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Modifier un administrateur</h1>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('admin.users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nom complet <span class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="name"
                                   name="name"
                                   value="{{ old('name', $user->name) }}"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   id="email"
                                   name="email"
                                   value="{{ old('email', $user->email) }}"
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">L'email sert d'identifiant de connexion</small>
                        </div>

                        <hr class="my-4">

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            <strong>Changement de mot de passe:</strong> Laissez les champs vides si vous ne souhaitez pas modifier le mot de passe.
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Nouveau mot de passe</label>
                            <input type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   id="password"
                                   name="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Minimum 8 caractères (optionnel)</small>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmer le nouveau mot de passe</label>
                            <input type="password"
                                   class="form-control"
                                   id="password_confirmation"
                                   name="password_confirmation">
                        </div>

                        <hr class="my-4">

                        <div class="mb-3">
                            <label for="role" class="form-label">Rôle <span class="text-danger">*</span></label>
                            <select class="form-select @error('role') is-invalid @enderror"
                                    id="role"
                                    name="role"
                                    required>
                                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Administrateur</option>
                                <option value="superadmin" {{ old('role', $user->role) === 'superadmin' ? 'selected' : '' }}>Super Administrateur</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">
                                <strong>Admin:</strong> Peut gérer le contenu du site<br>
                                <strong>Super Admin:</strong> Peut gérer le contenu + ajouter/supprimer des admins
                            </small>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Mettre à jour
                            </button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <i class="fas fa-user"></i> Informations utilisateur
                </div>
                <div class="card-body">
                    <p class="mb-2"><strong>Nom:</strong> {{ $user->name }}</p>
                    <p class="mb-2"><strong>Email:</strong> {{ $user->email }}</p>
                    <p class="mb-2">
                        <strong>Rôle actuel:</strong>
                        @if($user->role === 'superadmin')
                            <span class="badge bg-danger">Super Administrateur</span>
                        @else
                            <span class="badge bg-primary">Administrateur</span>
                        @endif
                    </p>
                    <p class="mb-0"><strong>Créé le:</strong> {{ $user->created_at->format('d/m/Y à H:i') }}</p>
                </div>
            </div>

            <div class="card shadow-sm mt-3">
                <div class="card-header bg-warning text-dark">
                    <i class="fas fa-exclamation-triangle"></i> Avertissement
                </div>
                <div class="card-body">
                    <ul class="small mb-0">
                        <li>Le changement d'email nécessitera une nouvelle connexion de l'utilisateur</li>
                        <li>Le changement de rôle prendra effet immédiatement</li>
                        <li>Si vous changez le mot de passe, l'utilisateur devra se reconnecter</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
