@extends('layouts.frontend')

@section('title', 'Nos Services - ' . \App\Models\Setting::get('site_name', 'IEBC SARL'))
@section('description', 'Découvrez tous nos services professionnels')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1><i class="fas fa-briefcase me-3"></i>Nos Services</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Accueil</a></li>
                <li class="breadcrumb-item active">Services</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Services Section -->
<section class="py-5">
    <div class="container">
        @if($services->isEmpty())
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle me-2"></i>
                Aucun service disponible pour le moment.
            </div>
        @else
            <div class="row g-4">
                @foreach($services as $service)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm hover-card">
                            @if($service->icon)
                                <div class="card-img-top text-center p-4 bg-light">
                                    <img src="{{ image_url($service->icon) }}"
                                         alt="{{ $service->title }}"
                                         class="img-fluid"
                                         style="max-height: 150px; object-fit: contain;">
                                </div>
                            @else
                                <div class="card-img-top text-center p-5 bg-light">
                                    <i class="fas fa-cog fa-4x text-primary"></i>
                                </div>
                            @endif

                            <div class="card-body">
                                <h5 class="card-title fw-bold">{{ $service->title }}</h5>
                                <p class="card-text text-muted">{{ $service->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<!-- Call to Action -->
<section class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="mb-4">Besoin d'un service personnalisé ?</h2>
        <p class="lead mb-4">Contactez-nous pour discuter de vos besoins spécifiques</p>
        <a href="{{ route('contact') }}" class="btn btn-primary btn-lg">
            <i class="fas fa-envelope me-2"></i>Nous contacter
        </a>
    </div>
</section>

@push('styles')
<style>
    .hover-card {
        transition: all 0.3s ease;
    }

    .hover-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.15) !important;
    }
</style>
@endpush
@endsection
