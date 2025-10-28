<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags -->
    <title>@yield('title', \App\Models\Setting::get('meta_title', \App\Models\Setting::get('site_name', 'IEBC SARL')))</title>
    <meta name="description" content="@yield('description', \App\Models\Setting::get('site_description', 'International Economics and Business Corporation'))">
    <meta name="keywords" content="{{ \App\Models\Setting::get('seo_keywords', 'IEBC, économie internationale, commerce, business, finance islamique, consulting, solutions économiques') }}">
    <meta name="author" content="{{ \App\Models\Setting::get('site_name', 'IEBC SARL') }}">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="googlebot" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @if(\App\Models\Setting::get('logo'))
    <link rel="apple-touch-icon" href="{{ image_url(\App\Models\Setting::get('logo')) }}">
    @endif

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', \App\Models\Setting::get('site_name', 'IEBC SARL'))">
    <meta property="og:description" content="@yield('description', \App\Models\Setting::get('site_description'))">
    <meta property="og:site_name" content="{{ \App\Models\Setting::get('site_name', 'IEBC SARL') }}">
    <meta property="og:locale" content="fr_FR">
    @if(\App\Models\Setting::get('logo'))
    <meta property="og:image" content="{{ image_url(\App\Models\Setting::get('logo')) }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ \App\Models\Setting::get('site_name', 'IEBC SARL') }} Logo">
    @endif

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', \App\Models\Setting::get('site_name', 'IEBC SARL'))">
    <meta name="twitter:description" content="@yield('description', \App\Models\Setting::get('site_description'))">
    @if(\App\Models\Setting::get('logo'))
    <meta name="twitter:image" content="{{ image_url(\App\Models\Setting::get('logo')) }}">
    @endif

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    @php
        $activeTheme = \App\Models\Theme::getActive();
        $fontFamily = $activeTheme ? $activeTheme->font_family : \App\Models\Setting::get('theme_font_family', 'system-ui');
        $headingFontFamily = $activeTheme ? ($activeTheme->heading_font_family ?? $fontFamily) : $fontFamily;

        $googleFonts = ["'Roboto', sans-serif", "'Open Sans', sans-serif", "'Lato', sans-serif", "'Montserrat', sans-serif", "'Poppins', sans-serif", "'Inter', sans-serif", "'Playfair Display', serif", "'Merriweather', serif", "'Lora', serif"];
        $fontsToLoad = array_unique(array_filter([$fontFamily, $headingFontFamily], function($font) use ($googleFonts) {
            return in_array($font, $googleFonts);
        }));

        foreach ($fontsToLoad as $font) {
            $fontName = str_replace(["'", ", sans-serif", ", serif"], '', $font);
            echo '<link href="https://fonts.googleapis.com/css2?family=' . str_replace(' ', '+', $fontName) . ':wght@300;400;500;600;700&display=swap" rel="stylesheet">';
        }
    @endphp

    <style>
        :root {
            @if($activeTheme)
                --primary-color: {{ $activeTheme->primary_color }};
                --secondary-color: {{ $activeTheme->secondary_color }};
                --accent-color: {{ $activeTheme->accent_color }};
                --success-color: {{ $activeTheme->success_color }};
                --warning-color: {{ $activeTheme->warning_color }};
                --danger-color: {{ $activeTheme->danger_color }};
                --info-color: {{ $activeTheme->info_color }};
                --light-color: {{ $activeTheme->light_color }};
                --dark-color: {{ $activeTheme->dark_color }};
                --font-family: {{ $activeTheme->font_family }};
                --heading-font-family: {{ $activeTheme->heading_font_family ?? $activeTheme->font_family }};
                --border-radius: {{ $activeTheme->border_radius }};
                --box-shadow: {{ $activeTheme->box_shadow }};
            @else
                --primary-color: {{ \App\Models\Setting::get('theme_primary_color', '#1e3a5f') }};
                --secondary-color: {{ \App\Models\Setting::get('theme_secondary_color', '#6c757d') }};
                --accent-color: {{ \App\Models\Setting::get('theme_accent_color', '#c9a961') }};
                --success-color: #198754;
                --warning-color: #ffc107;
                --danger-color: #dc3545;
                --info-color: #0dcaf0;
                --light-color: #f8fafc;
                --dark-color: #1e293b;
                --font-family: {{ \App\Models\Setting::get('theme_font_family', 'system-ui') }};
                --heading-font-family: {{ \App\Models\Setting::get('theme_font_family', 'system-ui') }};
                --border-radius: 0.375rem;
                --box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            @endif
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-family);
            color: var(--dark-color);
            line-height: 1.6;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: var(--heading-font-family);
        }

        /* Navbar */
        .navbar {
            background: white;
            box-shadow: var(--box-shadow);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color) !important;
        }

        .navbar-brand img {
            max-height: 50px;
            margin-right: 10px;
        }

        .nav-link {
            color: var(--dark-color) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            transition: color 0.3s;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary-color) !important;
        }

        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 4rem 0 3rem;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.1)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,138.7C1248,117,1344,75,1392,53.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
            background-size: cover;
        }

        .page-header h1 {
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            position: relative;
        }

        .page-header .breadcrumb {
            background: transparent;
            margin: 0;
            padding: 0;
        }

        .breadcrumb-item, .breadcrumb-item a {
            color: rgba(255,255,255,0.8);
        }

        .breadcrumb-item.active {
            color: white;
        }

        /* Footer */
        footer {
            background: var(--dark-color);
            color: white;
            padding: 3rem 0 1rem;
            margin-top: 4rem;
        }

        footer h5 {
            color: white;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        footer a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: color 0.3s;
        }

        footer a:hover {
            color: white;
        }

        footer .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            margin-right: 10px;
            transition: all 0.3s;
        }

        footer .social-links a:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-3px);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 1.5rem;
            margin-top: 2rem;
            text-align: center;
            color: rgba(255,255,255,0.6);
        }

        /* Alert Messages */
        .alert {
            border-radius: var(--border-radius);
            border: none;
        }

        /* Buttons */
        .btn-primary {
            background: var(--primary-color);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(37,99,235,0.3);
        }

        .btn-success {
            background: var(--success-color) !important;
            border-color: var(--success-color) !important;
        }

        .btn-warning {
            background: var(--warning-color) !important;
            border-color: var(--warning-color) !important;
        }

        .btn-danger {
            background: var(--danger-color) !important;
            border-color: var(--danger-color) !important;
        }

        .btn-info {
            background: var(--info-color) !important;
            border-color: var(--info-color) !important;
        }

        /* Cards */
        .card {
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            border: none;
        }

        /* Mobile Menu */
        @media (max-width: 991px) {
            .navbar-collapse {
                background: white;
                padding: 1rem;
                margin-top: 1rem;
                border-radius: var(--border-radius);
                box-shadow: var(--box-shadow);
            }

            .page-header h1 {
                font-size: 2rem;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('welcome') }}">
                @php
                    $logo = \App\Models\Setting::get('logo');
                    $siteName = \App\Models\Setting::get('site_name', 'IEBC SARL');
                @endphp

                @if($logo)
                    <img src="{{ image_url($logo) }}" alt="{{ $siteName }}">
                @endif
                {{ $siteName }}
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ route('welcome') }}">
                            <i class="fas fa-home"></i> Accueil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('services') ? 'active' : '' }}" href="{{ route('services') }}">
                            <i class="fas fa-briefcase"></i> Services
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('blog*') ? 'active' : '' }}" href="{{ route('blog') }}">
                            <i class="fas fa-newspaper"></i> Blog
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('equipe') ? 'active' : '' }}" href="{{ route('team') }}">
                            <i class="fas fa-users"></i> Équipe
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('galerie') ? 'active' : '' }}" href="{{ route('gallery') }}">
                            <i class="fas fa-images"></i> Galerie
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('partenaires') ? 'active' : '' }}" href="{{ route('partners') }}">
                            <i class="fas fa-handshake"></i> Partenaires
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('a-propos') ? 'active' : '' }}" href="{{ route('about') }}">
                            <i class="fas fa-info-circle"></i> À Propos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
                            <i class="fas fa-envelope"></i> Contact
                        </a>
                    </li>

                    @auth
                        @if(Auth::user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link text-success" href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-lock"></i> Admin
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    @yield('content')

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <!-- About Column -->
                <div class="col-lg-4 mb-4">
                    <h5>{{ \App\Models\Setting::get('site_name', 'IEBC SARL') }}</h5>
                    <p>{{ \App\Models\Setting::get('site_description', 'International Economics and Business Corporation') }}</p>
                </div>

                <!-- Quick Links Column -->
                <div class="col-lg-4 mb-4">
                    <h5>Liens Rapides</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('services') }}">Nos Services</a></li>
                        <li class="mb-2"><a href="{{ route('blog') }}">Blog</a></li>
                        <li class="mb-2"><a href="{{ route('team') }}">Notre Équipe</a></li>
                        <li class="mb-2"><a href="{{ route('about') }}">À Propos</a></li>
                        <li class="mb-2"><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>

                <!-- Contact Column -->
                <div class="col-lg-4 mb-4">
                    <h5>Contact</h5>
                    @php
                        $email = \App\Models\Setting::get('contact_email');
                        $phone = \App\Models\Setting::get('contact_phone');
                        $address = \App\Models\Setting::get('contact_address');
                    @endphp

                    @if($address)
                        <p><i class="fas fa-map-marker-alt me-2"></i> {{ $address }}</p>
                    @endif
                    @if($email)
                        <p><i class="fas fa-envelope me-2"></i> <a href="mailto:{{ $email }}">{{ $email }}</a></p>
                    @endif
                    @if($phone)
                        <p><i class="fas fa-phone me-2"></i> <a href="tel:{{ $phone }}">{{ $phone }}</a></p>
                    @endif

                    <!-- Social Links -->
                    <div class="social-links mt-3">
                        @php
                            $facebook = \App\Models\Setting::get('facebook_url');
                            $twitter = \App\Models\Setting::get('twitter_url');
                            $linkedin = \App\Models\Setting::get('linkedin_url');
                            $instagram = \App\Models\Setting::get('instagram_url');
                        @endphp

                        @if($facebook)
                            <a href="{{ $facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        @endif
                        @if($twitter)
                            <a href="{{ $twitter }}" target="_blank"><i class="fab fa-twitter"></i></a>
                        @endif
                        @if($linkedin)
                            <a href="{{ $linkedin }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                        @endif
                        @if($instagram)
                            <a href="{{ $instagram }}" target="_blank"><i class="fab fa-instagram"></i></a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p class="mb-0">© {{ date('Y') }} {{ \App\Models\Setting::get('site_name', 'IEBC SARL') }}. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @php
        $gaId = \App\Models\Setting::get('google_analytics_id');
    @endphp
    @if($gaId)
    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $gaId }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $gaId }}');
    </script>
    @endif

    <!-- JSON-LD Structured Data for Organization -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "{{ \App\Models\Setting::get('site_name', 'IEBC SARL') }}",
      "url": "{{ url('/') }}",
      "logo": "{{ \App\Models\Setting::get('logo') ? image_url(\App\Models\Setting::get('logo')) : '' }}",
      "description": "{{ \App\Models\Setting::get('site_description', 'International Economics and Business Corporation') }}",
      "address": {
        "@type": "PostalAddress",
        "addressLocality": "{{ \App\Models\Setting::get('contact_address', '') }}"
      },
      "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "{{ \App\Models\Setting::get('contact_phone', '') }}",
        "contactType": "customer service",
        "email": "{{ \App\Models\Setting::get('contact_email', '') }}"
      },
      "sameAs": [
        @if(\App\Models\Setting::get('facebook_url'))
        "{{ \App\Models\Setting::get('facebook_url') }}",
        @endif
        @if(\App\Models\Setting::get('twitter_url'))
        "{{ \App\Models\Setting::get('twitter_url') }}",
        @endif
        @if(\App\Models\Setting::get('linkedin_url'))
        "{{ \App\Models\Setting::get('linkedin_url') }}",
        @endif
        @if(\App\Models\Setting::get('instagram_url'))
        "{{ \App\Models\Setting::get('instagram_url') }}"
        @endif
      ]
    }
    </script>

    <!-- JSON-LD Breadcrumb for non-homepage -->
    @if(!Request::is('/'))
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [{
        "@type": "ListItem",
        "position": 1,
        "name": "Accueil",
        "item": "{{ route('welcome') }}"
      }]
    }
    </script>
    @endif

    @stack('scripts')
</body>
</html>
