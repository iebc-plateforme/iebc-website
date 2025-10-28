@extends('layouts.frontend')

@section('title', 'Galerie - ' . \App\Models\Setting::get('site_name', 'IEBC SARL'))
@section('description', 'Découvrez notre galerie photos et vidéos')

@section('content')
<div class="page-header">
    <div class="container">
        <h1><i class="fas fa-images me-3"></i>Galerie</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Accueil</a></li>
                <li class="breadcrumb-item active">Galerie</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        @if($galleries->isEmpty())
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle me-2"></i>
                Aucun média disponible pour le moment.
            </div>
        @else
            <div class="row g-4">
                @foreach($galleries as $item)
                    <div class="col-md-6 col-lg-4">
                        <div class="gallery-item">
                            @if($item->type === 'image')
                                <img src="{{ image_url($item->file_path) }}" class="img-fluid rounded" alt="{{ $item->title }}">
                            @else
                                <div class="video-container">
                                    <video controls class="w-100 rounded">
                                        <source src="{{ image_url($item->file_path) }}" type="video/mp4">
                                        Votre navigateur ne supporte pas la vidéo.
                                    </video>
                                </div>
                            @endif
                            <div class="gallery-overlay">
                                <h5>{{ $item->title }}</h5>
                                @if($item->description)
                                    <p class="small">{{ Str::limit($item->description, 80) }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-5 d-flex justify-content-center">
                {{ $galleries->links() }}
            </div>
        @endif
    </div>
</section>

@push('styles')
<style>
    .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    .gallery-item:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.2);
    }
    .gallery-item img, .video-container {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }
    .gallery-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        color: white;
        padding: 20px;
        transform: translateY(100%);
        transition: transform 0.3s ease;
    }
    .gallery-item:hover .gallery-overlay {
        transform: translateY(0);
    }
</style>
@endpush
@endsection
