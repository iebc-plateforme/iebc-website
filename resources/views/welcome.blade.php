<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ \App\Models\Setting::get('site_name', 'IEBC SARL') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- SEO Meta Tags -->
    <meta name="description" content="{{ \App\Models\Setting::get('site_description', 'International Economics and Business Corporation') }}">
    <meta name="keywords" content="{{ \App\Models\Setting::get('seo_keywords', 'IEBC, économie internationale, commerce, business') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .coming-soon-container {
            text-align: center;
            color: white;
            padding: 2rem;
            max-width: 600px;
        }

        .logo-container {
            margin-bottom: 2rem;
            animation: fadeInDown 1s ease-in-out;
        }

        .logo-container img {
            max-width: 200px;
            max-height: 200px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        .logo-placeholder {
            width: 150px;
            height: 150px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
            backdrop-filter: blur(10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        .logo-placeholder i {
            font-size: 4rem;
            color: white;
        }

        h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            animation: fadeInUp 1s ease-in-out;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .subtitle {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            animation: fadeInUp 1s ease-in-out 0.2s;
            animation-fill-mode: both;
        }

        .description {
            font-size: 1.1rem;
            margin-bottom: 3rem;
            opacity: 0.8;
            animation: fadeInUp 1s ease-in-out 0.4s;
            animation-fill-mode: both;
        }

        .spinner-container {
            margin-top: 3rem;
            animation: fadeInUp 1s ease-in-out 0.6s;
            animation-fill-mode: both;
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
            border-width: 0.3rem;
            border-color: rgba(255,255,255,0.3);
            border-top-color: white;
        }

        .contact-info {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255,255,255,0.2);
            animation: fadeInUp 1s ease-in-out 0.8s;
            animation-fill-mode: both;
        }

        .contact-info a {
            color: white;
            text-decoration: none;
            margin: 0 1rem;
            transition: opacity 0.3s;
        }

        .contact-info a:hover {
            opacity: 0.7;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }
            .subtitle {
                font-size: 1.2rem;
            }
            .description {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="coming-soon-container">
        <div class="logo-container">
            @php
                $logo = \App\Models\Setting::get('logo');
            @endphp

            @if($logo)
                <img src="{{ asset('storage/' . $logo) }}" alt="{{ \App\Models\Setting::get('site_name', 'IEBC SARL') }}" class="mx-auto">
            @else
                <div class="logo-placeholder">
                    <i class="fas fa-globe"></i>
                </div>
            @endif
        </div>

        <h1>{{ \App\Models\Setting::get('site_name', 'IEBC SARL') }}</h1>

        <p class="subtitle">Site Web en Construction</p>

        <p class="description">
            {{ \App\Models\Setting::get('site_description', 'International Economics and Business Corporation - Votre partenaire de confiance pour les solutions économiques et commerciales internationales') }}
        </p>

        <div class="spinner-container">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Chargement...</span>
            </div>
            <p class="mt-3">Nous travaillons dur pour vous offrir une expérience exceptionnelle</p>
        </div>

        <div class="contact-info">
            @php
                $email = \App\Models\Setting::get('contact_email');
                $phone = \App\Models\Setting::get('contact_phone');
            @endphp

            @if($email)
                <a href="mailto:{{ $email }}">
                    <i class="fas fa-envelope"></i> {{ $email }}
                </a>
            @endif

            @if($phone)
                <a href="tel:{{ $phone }}">
                    <i class="fas fa-phone"></i> {{ $phone }}
                </a>
            @endif

            @auth
                @if(Auth::user()->isAdmin())
                    <div class="mt-3">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-lock"></i> Accéder au Dashboard Admin
                        </a>
                    </div>
                @endif
            @endauth
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
