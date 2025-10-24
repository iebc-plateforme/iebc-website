@extends('layouts.frontend')

@section('title', \App\Models\Setting::get('site_name', 'IEBC SARL') . ' - ' . \App\Models\Setting::get('meta_title', 'Accueil'))
@section('description', \App\Models\Setting::get('site_description', 'International Economics and Business Corporation - Solutions économiques et commerciales internationales'))

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="row align-items-center min-vh-100 py-5">
            <div class="col-lg-7">
                <div class="badge-custom mb-3 animate-fade-in">
                    <i class="fas fa-star me-2"></i>Votre Partenaire de Confiance
                </div>
                <h1 class="display-3 fw-bold text-white mb-4 animate-fade-in">
                    {{ \App\Models\Setting::get('site_name', 'IEBC SARL') }}
                </h1>
                <p class="lead text-white mb-4 animate-fade-in-delay-1" style="font-size: 1.25rem;">
                    {{ \App\Models\Setting::get('site_description', 'International Economics and Business Corporation - Votre partenaire de confiance pour les solutions économiques et commerciales internationales') }}
                </p>
                <div class="animate-fade-in-delay-2">
                    <a href="{{ route('services') }}" class="btn btn-light btn-lg me-3 mb-3 btn-hover-lift">
                        <i class="fas fa-briefcase me-2"></i>Découvrir Nos Services
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg mb-3 btn-hover-lift">
                        <i class="fas fa-envelope me-2"></i>Contactez-nous
                    </a>
                </div>
                <div class="mt-4 animate-fade-in-delay-3">
                    <div class="d-flex align-items-center text-white">
                        <div class="me-4">
                            <i class="fas fa-check-circle me-2 text-success"></i>
                            <span>Solutions Professionnelles</span>
                        </div>
                        <div class="me-4">
                            <i class="fas fa-check-circle me-2 text-success"></i>
                            <span>Expertise Internationale</span>
                        </div>
                        <div>
                            <i class="fas fa-check-circle me-2 text-success"></i>
                            <span>Service de Qualité</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 text-center animate-fade-in-delay-3">
                @php
                    $logo = \App\Models\Setting::get('logo');
                @endphp
                @if($logo)
                    <img src="{{ asset('storage/' . $logo) }}" alt="{{ \App\Models\Setting::get('site_name') }}" class="img-fluid hero-logo">
                @else
                    <div class="hero-logo-placeholder">
                        <i class="fas fa-building fa-10x text-white opacity-75"></i>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Scroll Indicator -->
    <div class="scroll-indicator">
        <i class="fas fa-chevron-down"></i>
    </div>
</section>

<!-- Stats Section -->
<section class="py-5 bg-white stats-section">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-md-3 col-6">
                <div class="stat-item">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-briefcase fa-3x"></i>
                    </div>
                    <h3 class="display-4 fw-bold counter">{{ \App\Models\Service::where('is_active', true)->count() }}</h3>
                    <p class="lead text-muted">Services</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-item">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-users fa-3x"></i>
                    </div>
                    <h3 class="display-4 fw-bold counter">{{ \App\Models\Team::where('is_active', true)->count() }}</h3>
                    <p class="lead text-muted">Experts</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-item">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-handshake fa-3x"></i>
                    </div>
                    <h3 class="display-4 fw-bold counter">{{ \App\Models\Partner::where('is_active', true)->count() }}</h3>
                    <p class="lead text-muted">Partenaires</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-item">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-newspaper fa-3x"></i>
                    </div>
                    <h3 class="display-4 fw-bold counter">{{ \App\Models\Post::where('is_published', true)->count() }}</h3>
                    <p class="lead text-muted">Articles</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Finance Islamique - Service Phare -->
@php
    $financeIslamique = \App\Models\Service::where('slug', 'finance-islamique')->where('is_active', true)->first();
@endphp
@if($financeIslamique)
<section class="py-5 bg-gradient-islamic text-white position-relative overflow-hidden">
    <div class="islamic-pattern"></div>
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="islamic-badge mb-3">
                    <i class="fas fa-star me-2"></i>Service Phare
                </div>
                <h2 class="display-4 fw-bold mb-4">{{ $financeIslamique->title }}</h2>
                <p class="lead mb-4">{{ $financeIslamique->description }}</p>
                <div class="d-flex align-items-center mb-4">
                    <div class="feature-check me-4">
                        <i class="fas fa-check-circle me-2"></i>Conforme à la Charia
                    </div>
                    <div class="feature-check">
                        <i class="fas fa-check-circle me-2"></i>Solutions Éthiques
                    </div>
                </div>
                <a href="{{ route('services') }}" class="btn btn-light btn-lg btn-hover-lift">
                    <i class="fas fa-info-circle me-2"></i>En savoir plus
                </a>
            </div>
            <div class="col-lg-6 text-center">
                <div class="islamic-icon-container">
                    <i class="fas fa-mosque fa-10x text-white opacity-75"></i>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Services Section -->
@php
    $services = \App\Models\Service::where('is_active', true)->where('slug', '!=', 'finance-islamique')->orderBy('order')->limit(6)->get();
@endphp
@if($services->isNotEmpty())
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-badge">Nos Services</span>
            <h2 class="display-5 fw-bold mb-3 mt-3">Solutions Professionnelles</h2>
            <p class="lead text-muted">Découvrez notre gamme complète de services adaptés à vos besoins</p>
        </div>
        <div class="row g-4">
            @foreach($services as $service)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm service-card">
                        @if($service->icon)
                            <div class="card-img-top text-center p-4 bg-gradient-light">
                                <img src="{{ asset('storage/' . $service->icon) }}" alt="{{ $service->title }}" class="img-fluid service-icon" style="max-height: 80px;">
                            </div>
                        @else
                            <div class="card-img-top text-center p-4 bg-gradient-light">
                                <i class="fas fa-cog fa-4x text-primary service-icon"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3">{{ $service->title }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($service->description, 100) }}</p>
                        </div>
                        <div class="card-footer bg-transparent border-0 pb-4">
                            <a href="{{ route('services') }}" class="text-primary fw-semibold text-decoration-none">
                                En savoir plus <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('services') }}" class="btn btn-primary btn-lg btn-hover-lift">
                Voir tous nos services <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Latest Blog Posts -->
@php
    $posts = \App\Models\Post::where('is_published', true)
        ->whereNotNull('published_at')
        ->where('published_at', '<=', now())
        ->latest('published_at')
        ->limit(3)
        ->get();
@endphp
@if($posts->isNotEmpty())
<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-badge">Actualités</span>
            <h2 class="display-5 fw-bold mb-3 mt-3">Dernières Nouvelles</h2>
            <p class="lead text-muted">Restez informé de nos dernières actualités et articles</p>
        </div>
        <div class="row g-4">
            @foreach($posts as $post)
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm blog-card">
                        @if($post->image)
                            <div class="blog-img-wrapper">
                                <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                                <div class="blog-overlay"></div>
                            </div>
                        @else
                            <div class="card-img-top bg-gradient-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                <i class="fas fa-image fa-3x text-muted"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            @if($post->category)
                                <span class="badge bg-primary mb-2">{{ $post->category }}</span>
                            @endif
                            <h5 class="card-title fw-bold">{{ Str::limit($post->title, 60) }}</h5>
                            <p class="card-text text-muted small">{{ Str::limit($post->excerpt ?? strip_tags($post->content), 100) }}</p>
                        </div>
                        <div class="card-footer bg-transparent border-0 d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>
                                {{ $post->published_at->format('d/m/Y') }}
                            </small>
                            <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-sm btn-outline-primary">
                                Lire plus <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('blog') }}" class="btn btn-primary btn-lg btn-hover-lift">
                Voir tous les articles <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Team Section -->
@php
    $teams = \App\Models\Team::where('is_active', true)->orderBy('order')->limit(4)->get();
@endphp
@if($teams->isNotEmpty())
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-badge">Notre Équipe</span>
            <h2 class="display-5 fw-bold mb-3 mt-3">Rencontrez Nos Experts</h2>
            <p class="lead text-muted">Des professionnels dévoués à votre réussite</p>
        </div>
        <div class="row g-4">
            @foreach($teams as $member)
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm text-center team-card">
                        <div class="team-img-wrapper">
                            @if($member->photo)
                                <img src="{{ asset('storage/' . $member->photo) }}" class="card-img-top" alt="{{ $member->name }}">
                            @else
                                <div class="card-img-top bg-gradient-light d-flex align-items-center justify-content-center" style="height: 250px;">
                                    <i class="fas fa-user fa-4x text-muted"></i>
                                </div>
                            @endif
                            <div class="team-overlay">
                                <a href="{{ route('team') }}" class="btn btn-light btn-sm">
                                    <i class="fas fa-eye me-1"></i>Voir le profil
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-2">{{ $member->name }}</h5>
                            <p class="text-primary fw-semibold mb-0">{{ $member->position ?? $member->role }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('team') }}" class="btn btn-primary btn-lg btn-hover-lift">
                Voir toute l'équipe <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Call to Action -->
<section class="py-5 bg-gradient-cta text-white position-relative overflow-hidden">
    <div class="cta-pattern"></div>
    <div class="container text-center position-relative">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="display-5 fw-bold mb-4">Prêt à Démarrer Votre Projet ?</h2>
                <p class="lead mb-5">Contactez-nous dès aujourd'hui pour discuter de vos besoins et découvrir comment nous pouvons vous aider à atteindre vos objectifs</p>
                <a href="{{ route('contact') }}" class="btn btn-light btn-lg btn-hover-lift me-3">
                    <i class="fas fa-envelope me-2"></i>Contactez-nous Maintenant
                </a>
                <a href="{{ route('services') }}" class="btn btn-outline-light btn-lg btn-hover-lift">
                    <i class="fas fa-info-circle me-2"></i>Nos Services
                </a>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #7e22ce 100%);
        position: relative;
        overflow: hidden;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.1)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,138.7C1248,117,1344,75,1392,53.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
        background-size: cover;
        animation: wave 15s ease-in-out infinite;
    }

    @keyframes wave {
        0%, 100% { transform: translateX(0); }
        50% { transform: translateX(30px); }
    }

    .badge-custom {
        display: inline-block;
        background: rgba(255,255,255,0.2);
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        backdrop-filter: blur(10px);
        color: white;
    }

    .hero-logo {
        max-width: 400px;
        filter: drop-shadow(0 20px 40px rgba(0,0,0,0.3));
        animation: float 3s ease-in-out infinite;
    }

    .hero-logo-placeholder {
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }

    .scroll-indicator {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        color: white;
        font-size: 2rem;
        animation: bounce 2s infinite;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateX(-50%) translateY(0); }
        40% { transform: translateX(-50%) translateY(-10px); }
        60% { transform: translateX(-50%) translateY(-5px); }
    }

    /* Animations */
    .animate-fade-in {
        animation: fadeIn 1s ease-in-out;
    }

    .animate-fade-in-delay-1 {
        animation: fadeIn 1s ease-in-out 0.3s both;
    }

    .animate-fade-in-delay-2 {
        animation: fadeIn 1s ease-in-out 0.6s both;
    }

    .animate-fade-in-delay-3 {
        animation: fadeIn 1s ease-in-out 0.9s both;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Section Badge */
    .section-badge {
        display: inline-block;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Stats Section */
    .stats-section {
        box-shadow: 0 -5px 15px rgba(0,0,0,0.05);
    }

    .stat-item {
        transition: all 0.3s ease;
        padding: 1.5rem;
    }

    .stat-item:hover {
        transform: translateY(-10px);
    }

    .stat-icon {
        color: var(--primary-color);
        transition: all 0.3s ease;
    }

    .stat-item:hover .stat-icon {
        transform: scale(1.1);
        color: var(--accent-color);
    }

    /* Cards Hover Effects */
    .service-card, .blog-card, .team-card {
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .service-card:hover, .blog-card:hover, .team-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(0,0,0,0.2) !important;
    }

    .service-icon {
        transition: all 0.3s ease;
    }

    .service-card:hover .service-icon {
        transform: scale(1.1) rotate(5deg);
    }

    /* Blog Card */
    .blog-img-wrapper {
        position: relative;
        overflow: hidden;
        height: 200px;
    }

    .blog-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.5s ease;
    }

    .blog-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.5), transparent);
        opacity: 0;
        transition: all 0.3s ease;
    }

    .blog-card:hover .blog-img-wrapper img {
        transform: scale(1.1);
    }

    .blog-card:hover .blog-overlay {
        opacity: 1;
    }

    /* Team Card */
    .team-img-wrapper {
        position: relative;
        overflow: hidden;
        height: 250px;
    }

    .team-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.5s ease;
    }

    .team-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.3s ease;
    }

    .team-card:hover .team-img-wrapper img {
        transform: scale(1.1);
    }

    .team-card:hover .team-overlay {
        opacity: 1;
    }

    /* Finance Islamique Section */
    .bg-gradient-islamic {
        background: linear-gradient(135deg, #0f766e 0%, #115e59 50%, #134e4a 100%);
    }

    .islamic-pattern {
        position: absolute;
        top: -50%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .islamic-badge {
        display: inline-block;
        background: rgba(255,255,255,0.2);
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        backdrop-filter: blur(10px);
    }

    .islamic-icon-container {
        animation: float 3s ease-in-out infinite;
    }

    .feature-check {
        font-weight: 500;
    }

    /* CTA Section */
    .bg-gradient-cta {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .cta-pattern {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.05)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,138.7C1248,117,1344,75,1392,53.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat center;
        background-size: cover;
    }

    /* Button Hover Effect */
    .btn-hover-lift {
        transition: all 0.3s ease;
    }

    .btn-hover-lift:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }

    /* Gradient Backgrounds */
    .bg-gradient-light {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-section h1 {
            font-size: 2.5rem;
        }

        .display-4 {
            font-size: 2rem;
        }

        .stat-item h3 {
            font-size: 2rem;
        }

        .scroll-indicator {
            display: none;
        }
    }
</style>
@endpush
@endsection
