<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ \App\Models\Setting::get('site_name', 'IEBC SARL') }} - En Construction</title>

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
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #7e22ce 100%);
            position: relative;
            overflow: hidden;
        }

        /* Animated background */
        body::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.05) 50%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .construction-container {
            position: relative;
            z-index: 1;
            text-align: center;
            color: white;
            padding: 3rem 2rem;
            max-width: 800px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        /* Logo Section */
        .logo-container {
            margin-bottom: 2rem;
            animation: fadeInDown 1s ease-in-out;
        }

        .logo-container img {
            max-width: 180px;
            max-height: 180px;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.4);
            background: white;
            padding: 10px;
        }

        .logo-placeholder {
            width: 140px;
            height: 140px;
            background: rgba(255,255,255,0.15);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            backdrop-filter: blur(10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        .logo-placeholder i {
            font-size: 3.5rem;
            color: white;
        }

        /* Typography */
        h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            animation: fadeInUp 1s ease-in-out;
            text-shadow: 3px 3px 6px rgba(0,0,0,0.4);
            letter-spacing: 1px;
        }

        .construction-badge {
            display: inline-block;
            background: linear-gradient(135deg, #f59e0b, #ef4444);
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 2rem;
            animation: pulse 2s ease-in-out infinite;
            box-shadow: 0 10px 25px rgba(239, 68, 68, 0.3);
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .construction-icon {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            animation: bounce 2s ease-in-out infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .description {
            font-size: 1.2rem;
            line-height: 1.8;
            margin-bottom: 2.5rem;
            opacity: 0.95;
            animation: fadeInUp 1s ease-in-out 0.3s;
            animation-fill-mode: both;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin: 3rem 0;
            animation: fadeInUp 1s ease-in-out 0.5s;
            animation-fill-mode: both;
        }

        .feature-item {
            background: rgba(255, 255, 255, 0.1);
            padding: 1.5rem;
            border-radius: 15px;
            transition: transform 0.3s, background 0.3s;
        }

        .feature-item:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.15);
        }

        .feature-item i {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #fbbf24;
        }

        .feature-item h3 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        /* Progress Section */
        .progress-section {
            margin: 2rem 0;
            animation: fadeInUp 1s ease-in-out 0.7s;
            animation-fill-mode: both;
        }

        .progress {
            height: 8px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-bar {
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
            animation: progressAnimation 3s ease-in-out;
        }

        @keyframes progressAnimation {
            from { width: 0%; }
            to { width: 75%; }
        }

        /* Contact Section */
        .contact-section {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255,255,255,0.2);
            animation: fadeInUp 1s ease-in-out 0.9s;
            animation-fill-mode: both;
        }

        .contact-links {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .contact-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: white;
            text-decoration: none;
            background: rgba(255, 255, 255, 0.1);
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            transition: all 0.3s;
        }

        .contact-link:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            transform: translateY(-3px);
        }

        .admin-access {
            margin-top: 2rem;
        }

        .btn-admin {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
        }

        .btn-admin:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(16, 185, 129, 0.4);
            color: white;
        }

        /* Animations */
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

        /* Responsive */
        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem;
            }
            .construction-badge {
                font-size: 1.1rem;
                padding: 0.6rem 1.5rem;
            }
            .description {
                font-size: 1rem;
            }
            .construction-icon {
                font-size: 3rem;
            }
            .features {
                grid-template-columns: 1fr;
            }
            .contact-links {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="construction-container">
        <!-- Logo -->
        <div class="logo-container">
            @php
                $logo = \App\Models\Setting::get('logo');
            @endphp

            @if($logo)
                <img src="{{ asset('storage/' . $logo) }}" alt="{{ \App\Models\Setting::get('site_name', 'IEBC SARL') }}">
            @else
                <div class="logo-placeholder">
                    <i class="fas fa-building"></i>
                </div>
            @endif
        </div>

        <!-- Title -->
        <h1>{{ \App\Models\Setting::get('site_name', 'IEBC SARL') }}</h1>

        <!-- Construction Badge -->
        <div class="construction-badge">
            <i class="fas fa-tools"></i> Site en Construction
        </div>

        <!-- Construction Icon -->
        <div class="construction-icon">
            <i class="fas fa-hard-hat text-warning"></i>
        </div>

        <!-- Description -->
        <p class="description">
            {{ \App\Models\Setting::get('site_description', 'International Economics and Business Corporation - Votre partenaire de confiance pour les solutions économiques et commerciales internationales') }}
        </p>

        <!-- Progress Bar -->
        <div class="progress-section">
            <p class="mb-2"><strong>Avancement du projet</strong></p>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <p class="mt-2 small">75% complété</p>
        </div>

        <!-- Features -->
        <div class="features">
            <div class="feature-item">
                <i class="fas fa-rocket"></i>
                <h3>Bientôt en ligne</h3>
                <p class="small mb-0">Notre nouveau site arrive prochainement</p>
            </div>
            <div class="feature-item">
                <i class="fas fa-shield-alt"></i>
                <h3>Sécurisé</h3>
                <p class="small mb-0">Plateforme sécurisée et fiable</p>
            </div>
            <div class="feature-item">
                <i class="fas fa-star"></i>
                <h3>Professionnel</h3>
                <p class="small mb-0">Services de qualité supérieure</p>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="contact-section">
            <p class="mb-3"><strong>Restons en contact</strong></p>

            <div class="contact-links">
                @php
                    $email = \App\Models\Setting::get('contact_email');
                    $phone = \App\Models\Setting::get('contact_phone');
                @endphp

                @if($email)
                    <a href="mailto:{{ $email }}" class="contact-link">
                        <i class="fas fa-envelope"></i>
                        <span>{{ $email }}</span>
                    </a>
                @endif

                @if($phone)
                    <a href="tel:{{ $phone }}" class="contact-link">
                        <i class="fas fa-phone"></i>
                        <span>{{ $phone }}</span>
                    </a>
                @endif
            </div>

            @auth
                @if(Auth::user()->isAdmin())
                    <div class="admin-access">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-admin">
                            <i class="fas fa-lock"></i> Accéder au Dashboard Admin
                        </a>
                    </div>
                @endif
            @endauth
        </div>

        <!-- Footer -->
        <p class="mt-4 small opacity-75">
            © {{ date('Y') }} {{ \App\Models\Setting::get('site_name', 'IEBC SARL') }}. Tous droits réservés.
        </p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
