@extends('layouts.frontend')

@section('title', 'Blog - ' . \App\Models\Setting::get('site_name', 'IEBC SARL'))
@section('description', 'Actualités et articles de notre blog')

@section('content')
<div class="page-header">
    <div class="container">
        <h1><i class="fas fa-newspaper me-3"></i>Notre Blog</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Accueil</a></li>
                <li class="breadcrumb-item active">Blog</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        @if($posts->isEmpty())
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle me-2"></i>
                Aucun article publié pour le moment.
            </div>
        @else
            <div class="row g-4">
                @foreach($posts as $post)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm hover-card">
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}" style="height: 200px; object-fit: cover;">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                            @endif
                            <div class="card-body">
                                @if($post->category)
                                    <span class="badge bg-primary mb-2">{{ $post->category }}</span>
                                @endif
                                <h5 class="card-title fw-bold">{{ $post->title }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($post->excerpt ?? $post->content, 120) }}</p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
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
                    </div>
                @endforeach
            </div>

            <div class="mt-5 d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        @endif
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
