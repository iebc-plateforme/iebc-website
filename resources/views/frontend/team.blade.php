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
</style>
@endpush
@endsection
