@extends('layouts.auth')

@section('main-content')
<div class="login-container">
    <div class="login-card">
        <!-- Left Side - Branding -->
        <div class="login-brand">
            <div class="brand-content">
                @php
                    $logo = \App\Models\Setting::get('company_logo', '/img/logo.png');
                    $siteName = \App\Models\Setting::get('site_name', 'IEBC SARL');
                    $siteDescription = \App\Models\Setting::get('site_description', 'Finance Islamique & Conseil Économique');

                    // Gérer les chemins relatifs et absolus
                    if ($logo && !str_starts_with($logo, 'http')) {
                        $logo = asset(ltrim($logo, '/'));
                    }
                @endphp

                <div class="logo-wrapper">
                    @if($logo)
                        <img src="{{ $logo }}" alt="{{ $siteName }}" class="brand-logo">
                    @endif
                </div>

                <h1 class="brand-title">{{ $siteName }}</h1>
                <p class="brand-subtitle">{{ Str::limit($siteDescription, 100) }}</p>

                <div class="brand-decoration">
                    <div class="decoration-circle circle-1"></div>
                    <div class="decoration-circle circle-2"></div>
                    <div class="decoration-circle circle-3"></div>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="login-form-wrapper">
            <div class="login-form-content">
                <div class="form-header">
                    <h2 class="form-title">Bienvenue</h2>
                    <p class="form-subtitle">Connectez-vous à votre compte</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <div class="alert-icon">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <div class="alert-content">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="login-form">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope"></i>
                            Adresse email
                        </label>
                        <div class="input-wrapper">
                            <input
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                id="email"
                                name="email"
                                placeholder="votre@email.com"
                                value="{{ old('email') }}"
                                required
                                autofocus
                            >
                            <span class="input-icon">
                                <i class="fas fa-envelope"></i>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock"></i>
                            Mot de passe
                        </label>
                        <div class="input-wrapper">
                            <input
                                type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                id="password"
                                name="password"
                                placeholder="••••••••"
                                required
                            >
                            <span class="input-icon">
                                <i class="fas fa-lock"></i>
                            </span>
                            <button type="button" class="toggle-password" onclick="togglePassword()">
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-options">
                        <div class="custom-checkbox">
                            <input
                                type="checkbox"
                                class="checkbox-input"
                                name="remember"
                                id="remember"
                                {{ old('remember') ? 'checked' : '' }}
                            >
                            <label class="checkbox-label" for="remember">
                                Se souvenir de moi
                            </label>
                        </div>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot-password">
                                Mot de passe oublié ?
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="btn-login">
                        <span class="btn-text">Se connecter</span>
                        <span class="btn-icon">
                            <i class="fas fa-arrow-right"></i>
                        </span>
                    </button>
                </form>

                <div class="form-footer">
                    <p class="copyright">
                        &copy; {{ date('Y') }} {{ $siteName }}. Tous droits réservés.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}
</script>
@endsection
