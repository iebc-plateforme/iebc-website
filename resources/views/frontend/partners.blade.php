@extends('layouts.frontend')

@section('title', 'Nos Partenaires - ' . \App\Models\Setting::get('site_name', 'IEBC SARL'))
@section('description', 'Découvrez nos partenaires de confiance')

@section('content')
<div class="page-header">
    <div class="container">
        <h1><i class="fas fa-handshake me-3"></i>Nos Partenaires</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Accueil</a></li>
                <li class="breadcrumb-item active">Partenaires</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        @if($partners->isEmpty())
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle me-2"></i>
                Aucun partenaire à afficher pour le moment.
            </div>
        @else
            <div class="row g-4 justify-content-center">
                @foreach($partners as $partner)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="partner-card text-center">
                            <a href="{{ $partner->website }}" target="_blank" rel="noopener" class="partner-link">
                                @if($partner->logo)
                                    <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}" class="img-fluid partner-logo">
                                @else
                                    <div class="partner-placeholder">
                                        <i class="fas fa-building fa-3x text-muted"></i>
                                    </div>
                                @endif
                                <h6 class="mt-3">{{ $partner->name }}</h6>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="mb-4">Devenez notre partenaire</h2>
        <p class="lead mb-4">Intéressé par un partenariat ? Contactez-nous dès maintenant</p>
        <a href="{{ route('contact') }}" class="btn btn-primary btn-lg">
            <i class="fas fa-envelope me-2"></i>Nous contacter
        </a>
    </div>
</section>

@push('styles')
<style>
    .partner-card {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        height: 100%;
    }
    .partner-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    }
    .partner-logo {
        max-height: 100px;
        object-fit: contain;
    }
    .partner-placeholder {
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .partner-link {
        text-decoration: none;
        color: inherit;
    }
</style>
@endpush
@endsection
