@extends('admin.layouts.app')

@section('title', 'Mon profil')

@push('styles')
<style>
    .profile-header {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border-radius: 12px;
        padding: 2rem;
        color: white;
        margin-bottom: 2rem;
    }

    .profile-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: white;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--primary-color);
        border: 4px solid rgba(255,255,255,0.3);
    }

    .nav-tabs {
        border-bottom: 2px solid #e9ecef;
    }

    .nav-tabs .nav-link {
        border: none;
        color: #6c757d;
        padding: 1rem 1.5rem;
        font-weight: 500;
        transition: all 0.3s;
    }

    .nav-tabs .nav-link:hover {
        color: var(--secondary-color);
    }

    .nav-tabs .nav-link.active {
        color: var(--secondary-color);
        border-bottom: 2px solid var(--secondary-color);
        margin-bottom: -2px;
    }

    .profile-card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }

    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
    }

    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #dee2e6;
        padding: 0.75rem 1rem;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--secondary-color);
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
    }

    .info-item {
        display: flex;
        align-items-center;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-item i {
        width: 30px;
        color: var(--secondary-color);
    }

    .btn-primary {
        border-radius: 8px;
        padding: 0.75rem 2rem;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="row align-items-center">
            <div class="col-auto">
                <div class="profile-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </div>
            <div class="col">
                <h2 class="mb-1">{{ Auth::user()->name }}</h2>
                <p class="mb-2 opacity-75">{{ Auth::user()->email }}</p>
                <div>
                    @if(Auth::user()->isSuperAdmin())
                        <span class="badge bg-danger">Super Administrateur</span>
                    @else
                        <span class="badge bg-light text-dark">Administrateur</span>
                    @endif
                    <span class="badge bg-light text-dark ms-2">
                        <i class="fas fa-calendar-alt"></i> Membre depuis {{ Auth::user()->created_at->format('M Y') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-4" id="profileTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab">
                <i class="fas fa-user me-2"></i>Informations
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security" type="button" role="tab">
                <i class="fas fa-lock me-2"></i>Sécurité
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="preferences-tab" data-bs-toggle="tab" data-bs-target="#preferences" type="button" role="tab">
                <i class="fas fa-cog me-2"></i>Préférences
            </button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="profileTabContent">
        <!-- Information Tab -->
        <div class="tab-pane fade show active" id="info" role="tabpanel">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card profile-card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">
                                <i class="fas fa-user-edit text-primary me-2"></i>Modifier mes informations
                            </h5>
                            <form method="POST" action="{{ route('profile.update') }}">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">
                                            Prénom <span class="text-danger">*</span>
                                        </label>
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

                                <div class="mb-4">
                                    <label for="email" class="form-label">
                                        Email <span class="text-danger">*</span>
                                    </label>
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

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Enregistrer
                                    </button>
                                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                                        <i class="fas fa-times me-2"></i>Annuler
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card profile-card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Informations du compte</h5>
                            <div class="info-item">
                                <i class="fas fa-envelope"></i>
                                <div>
                                    <small class="text-muted d-block">Email</small>
                                    <strong>{{ Auth::user()->email }}</strong>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-calendar"></i>
                                <div>
                                    <small class="text-muted d-block">Date d'inscription</small>
                                    <strong>{{ Auth::user()->created_at->format('d/m/Y') }}</strong>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-shield-alt"></i>
                                <div>
                                    <small class="text-muted d-block">Rôle</small>
                                    <strong>{{ Auth::user()->isSuperAdmin() ? 'Super Admin' : 'Admin' }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Security Tab -->
        <div class="tab-pane fade" id="security" role="tabpanel">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card profile-card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">
                                <i class="fas fa-lock text-warning me-2"></i>Changer le mot de passe
                            </h5>

                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                Pour changer votre mot de passe, remplissez tous les champs ci-dessous.
                            </div>

                            <form method="POST" action="{{ route('profile.update') }}">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="current_password" class="form-label">
                                        Mot de passe actuel <span class="text-danger">*</span>
                                    </label>
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
                                        <label for="new_password" class="form-label">
                                            Nouveau mot de passe <span class="text-danger">*</span>
                                        </label>
                                        <input type="password"
                                               class="form-control @error('new_password') is-invalid @enderror"
                                               id="new_password"
                                               name="new_password">
                                        @error('new_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Minimum 8 caractères</small>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="password_confirmation" class="form-label">
                                            Confirmer le mot de passe <span class="text-danger">*</span>
                                        </label>
                                        <input type="password"
                                               class="form-control"
                                               id="password_confirmation"
                                               name="password_confirmation">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-key me-2"></i>Changer le mot de passe
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card profile-card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Conseils de sécurité</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Utilisez au moins 8 caractères
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Incluez des lettres et des chiffres
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Évitez les mots communs
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Ne réutilisez pas vos mots de passe
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Preferences Tab -->
        <div class="tab-pane fade" id="preferences" role="tabpanel">
            <div class="card profile-card">
                <div class="card-body">
                    <h5 class="card-title mb-4">
                        <i class="fas fa-sliders-h text-info me-2"></i>Préférences de l'interface
                    </h5>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Ces fonctionnalités seront bientôt disponibles !
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Thème de l'interface</label>
                            <select class="form-select" disabled>
                                <option>Clair (par défaut)</option>
                                <option>Sombre</option>
                                <option>Automatique</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Langue</label>
                            <select class="form-select" disabled>
                                <option>Français</option>
                                <option>English</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
