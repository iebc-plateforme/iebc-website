@extends('layouts.frontend')

@section('title', 'Notre Équipe - ' . \App\Models\Setting::get('site_name', 'IEBC SARL'))
@section('description', 'Rencontrez les membres de notre équipe')

@section('content')
<div class="page-header">
    <div class="container">
        <h1><i class="fas fa-users me-3"></i>Notre Équipe</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Accueil</a></li>
                <li class="breadcrumb-item active">Équipe</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        @if($teams->isEmpty())
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle me-2"></i>
                Aucun membre d'équipe à afficher pour le moment.
            </div>
        @else
            <div class="row g-4">
                @foreach($teams as $member)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm text-center team-card">
                            @if($member->photo)
                                <img src="{{ asset('storage/' . $member->photo) }}" class="card-img-top" alt="{{ $member->name }}" style="height: 300px; object-fit: cover;">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                                    <i class="fas fa-user fa-5x text-muted"></i>
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title fw-bold">{{ $member->name }}</h5>
                                <p class="text-primary fw-semibold">{{ $member->position ?? $member->role }}</p>
                                @if($member->bio)
                                    <p class="card-text text-muted small">{{ Str::limit($member->bio, 100) }}</p>
                                @endif

                                {{-- Social Media Links - Only show if at least one link is not empty --}}
                                @php
                                    $hasSocialLinks = !empty($member->linkedin_url) || !empty($member->twitter_url) ||
                                                      !empty($member->facebook_url) || !empty($member->instagram_url) ||
                                                      !empty($member->github_url) || !empty($member->website_url);
                                @endphp
                                @if($hasSocialLinks)
                                    <div class="social-links mt-3">
                                        @if(!empty($member->linkedin_url))
                                            <a href="{{ $member->linkedin_url }}" target="_blank" rel="noopener noreferrer"
                                               class="btn btn-sm btn-outline-primary mx-1" title="LinkedIn">
                                                <i class="fab fa-linkedin"></i>
                                            </a>
                                        @endif
                                        @if(!empty($member->twitter_url))
                                            <a href="{{ $member->twitter_url }}" target="_blank" rel="noopener noreferrer"
                                               class="btn btn-sm btn-outline-info mx-1" title="Twitter">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        @endif
                                        @if(!empty($member->facebook_url))
                                            <a href="{{ $member->facebook_url }}" target="_blank" rel="noopener noreferrer"
                                               class="btn btn-sm btn-outline-primary mx-1" title="Facebook">
                                                <i class="fab fa-facebook"></i>
                                            </a>
                                        @endif
                                        @if(!empty($member->instagram_url))
                                            <a href="{{ $member->instagram_url }}" target="_blank" rel="noopener noreferrer"
                                               class="btn btn-sm btn-outline-danger mx-1" title="Instagram">
                                                <i class="fab fa-instagram"></i>
                                            </a>
                                        @endif
                                        @if(!empty($member->github_url))
                                            <a href="{{ $member->github_url }}" target="_blank" rel="noopener noreferrer"
                                               class="btn btn-sm btn-outline-dark mx-1" title="GitHub">
                                                <i class="fab fa-github"></i>
                                            </a>
                                        @endif
                                        @if(!empty($member->website_url))
                                            <a href="{{ $member->website_url }}" target="_blank" rel="noopener noreferrer"
                                               class="btn btn-sm btn-outline-success mx-1" title="Site Web">
                                                <i class="fas fa-globe"></i>
                                            </a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
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
    .social-links a {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    .social-links a:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    .social-links a.btn-outline-primary:hover {
        background: #0077b5;
        border-color: #0077b5;
        color: white;
    }
    .social-links a.btn-outline-info:hover {
        background: #1da1f2;
        border-color: #1da1f2;
        color: white;
    }
    .social-links a.btn-outline-danger:hover {
        background: #e4405f;
        border-color: #e4405f;
        color: white;
    }
    .social-links a.btn-outline-dark:hover {
        background: #333;
        border-color: #333;
        color: white;
    }
    .social-links a.btn-outline-success:hover {
        background: #10b981;
        border-color: #10b981;
        color: white;
    }
</style>
@endpush
@endsection
