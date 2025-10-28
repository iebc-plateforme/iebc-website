@extends('layouts.frontend')

@section('title', 'À Propos - ' . \App\Models\Setting::get('site_name', 'IEBC SARL'))
@section('description', 'Découvrez qui nous sommes et notre mission')

@section('content')
<div class="page-header">
    <div class="container">
        <h1><i class="fas fa-info-circle me-3"></i>À Propos de Nous</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Accueil</a></li>
                <li class="breadcrumb-item active">À Propos</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6">
                @php
                    $logo = \App\Models\Setting::get('logo');
                @endphp
                @if($logo)
                    <img src="{{ image_url($logo) }}" alt="{{ \App\Models\Setting::get('site_name') }}" class="img-fluid rounded shadow-lg">
                @else
                    <div class="bg-light p-5 rounded text-center">
                        <i class="fas fa-building fa-10x text-primary"></i>
                    </div>
                @endif
            </div>
            <div class="col-lg-6">
                <h2 class="mb-4">{{ \App\Models\Setting::get('site_name', 'IEBC SARL') }}</h2>
                <p class="lead">{{ \App\Models\Setting::get('site_description', 'International Economics and Business Corporation - Votre partenaire de confiance pour les solutions économiques et commerciales internationales') }}</p>
            </div>
        </div>

        <div class="row g-4 my-5">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm text-center h-100 p-4">
                    <div class="mb-3">
                        <i class="fas fa-bullseye fa-3x text-primary"></i>
                    </div>
                    <h4>Notre Mission</h4>
                    <p>Fournir des solutions économiques et commerciales de qualité supérieure à nos clients internationaux.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm text-center h-100 p-4">
                    <div class="mb-3">
                        <i class="fas fa-eye fa-3x text-primary"></i>
                    </div>
                    <h4>Notre Vision</h4>
                    <p>Devenir le leader régional dans le domaine de l'économie internationale et du commerce.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm text-center h-100 p-4">
                    <div class="mb-3">
                        <i class="fas fa-heart fa-3x text-primary"></i>
                    </div>
                    <h4>Nos Valeurs</h4>
                    <p>Excellence, intégrité, innovation et engagement envers la satisfaction client.</p>
                </div>
            </div>
        </div>
    </div>
</section>

@if($teams->isNotEmpty())
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Notre Équipe</h2>
            <div class="row g-4">
                @foreach($teams as $member)
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm text-center team-card h-100">
                            @if($member->photo)
                                <img src="{{ image_url($member->photo) }}" class="card-img-top" alt="{{ $member->name }}" style="height: 250px; object-fit: cover;">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 250px;">
                                    <i class="fas fa-user fa-4x text-muted"></i>
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title fw-bold">{{ $member->name }}</h5>
                                <p class="text-primary fw-semibold">{{ $member->position ?? $member->role }}</p>
                                @if($member->bio)
                                    <p class="card-text text-muted small">{{ Str::limit($member->bio, 80) }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('team') }}" class="btn btn-outline-primary">
                    Voir toute l'équipe <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>
@endif

<section class="py-5">
    <div class="container text-center">
        <h2 class="mb-4">Prêt à Travailler Avec Nous ?</h2>
        <p class="lead mb-4">Contactez-nous dès aujourd'hui pour discuter de vos besoins</p>
        <a href="{{ route('contact') }}" class="btn btn-primary btn-lg">
            <i class="fas fa-envelope me-2"></i>Nous Contacter
        </a>
    </div>
</section>

@push('styles')
<style>
    .team-card {
        transition: all 0.3s ease;
    }
    .team-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.15) !important;
    }
</style>
@endpush
@endsection
