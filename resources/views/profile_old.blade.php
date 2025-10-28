@extends('admin.layouts.app')

@section('title', 'Mon profil')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Mon profil</h1>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="row">
        <!-- Informations utilisateur -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-4">
                        <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center"
                             style="width: 120px; height: 120px; font-size: 48px; font-weight: bold;">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </div>
                    <h4 class="mb-1">{{ Auth::user()->name }}</h4>
                    <p class="text-muted mb-2">{{ Auth::user()->email }}</p>
                    <p class="mb-3">
                        @if(Auth::user()->isSuperAdmin())
                            <span class="badge bg-danger">Super Administrateur</span>
                        @else
                            <span class="badge bg-primary">Administrateur</span>
                        @endif
                    </p>
                    <hr>
                    <p class="small text-muted mb-0">
                        <strong>Membre depuis:</strong><br>
                        {{ Auth::user()->created_at->format('d/m/Y') }}
                    </p>
                </div>
            </div>

            <div class="card shadow-sm mt-3">
                <div class="card-header bg-info text-white">
                    <i class="fas fa-info-circle"></i> Informations
                </div>
                <div class="card-body">
                    <p class="small mb-2"><i class="fas fa-shield-alt text-primary"></i> <strong>Sécurité:</strong></p>
                    <ul class="small">
                        <li>Le mot de passe doit contenir au minimum 8 caractères</li>
                        <li>Laissez les champs mot de passe vides si vous ne souhaitez pas le modifier</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Formulaire de modification -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <i class="fas fa-user-edit"></i> Modifier mes informations
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <h6 class="text-muted mb-3">Informations personnelles</h6>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Prénom <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       id="name"
                                       name="name"
                                       value="{{ old('name', Auth::user()->name) }}"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="last_name" class="form-label">Nom de famille</label>
                                <input type="text"
                                       class="form-control @error('last_name') is-invalid @enderror"
                                       id="last_name"
                                       name="last_name"
                                       value="{{ old('last_name', Auth::user()->last_name) }}">
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   id="email"
                                   name="email"
                                   value="{{ old('email', Auth::user()->email) }}"
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4">

                        <h6 class="text-muted mb-3">Changer le mot de passe</h6>

                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                            <strong>Note:</strong> Laissez ces champs vides si vous ne souhaitez pas modifier votre mot de passe.
                        </div>

                        <div class="mb-3">
                            <label for="current_password" class="form-label">Mot de passe actuel</label>
                            <input type="password"
                                   class="form-control @error('current_password') is-invalid @enderror"
                                   id="current_password"
                                   name="current_password">
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="new_password" class="form-label">Nouveau mot de passe</label>
                                <input type="password"
                                       class="form-control @error('new_password') is-invalid @enderror"
                                       id="new_password"
                                       name="new_password">
                                @error('new_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">8 à 12 caractères</small>
                            </div>

                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                                <input type="password"
                                       class="form-control @error('password_confirmation') is-invalid @enderror"
                                       id="password_confirmation"
                                       name="password_confirmation">
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Enregistrer les modifications
                            </button>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
