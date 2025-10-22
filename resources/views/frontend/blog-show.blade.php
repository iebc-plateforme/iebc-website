@extends('layouts.frontend')

@section('title', $post->title . ' - ' . \App\Models\Setting::get('site_name', 'IEBC SARL'))
@section('description', Str::limit($post->excerpt ?? strip_tags($post->content), 160))

@section('content')
<div class="page-header">
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('blog') }}">Blog</a></li>
                <li class="breadcrumb-item active">{{ Str::limit($post->title, 50) }}</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <article class="blog-post">
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid rounded mb-4" alt="{{ $post->title }}">
                    @endif

                    <div class="post-meta mb-4">
                        @if($post->category)
                            <span class="badge bg-primary me-2">{{ $post->category }}</span>
                        @endif
                        <span class="text-muted">
                            <i class="fas fa-calendar me-1"></i>
                            {{ $post->published_at->format('d F Y') }}
                        </span>
                        <span class="text-muted ms-3">
                            <i class="fas fa-user me-1"></i>
                            {{ $post->user->name ?? 'Admin' }}
                        </span>
                    </div>

                    @if($post->excerpt)
                        <div class="lead mb-4">{{ $post->excerpt }}</div>
                    @endif

                    <div class="post-content">
                        {!! nl2br(e($post->content)) !!}
                    </div>

                    <hr class="my-5">

                    <div class="text-center">
                        <a href="{{ route('blog') }}" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-2"></i>Retour au blog
                        </a>
                    </div>
                </article>

                @if($relatedPosts->isNotEmpty())
                    <div class="related-posts mt-5">
                        <h3 class="mb-4">Articles similaires</h3>
                        <div class="row g-4">
                            @foreach($relatedPosts as $related)
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        @if($related->image)
                                            <img src="{{ asset('storage/' . $related->image) }}" class="card-img-top" alt="{{ $related->title }}" style="height: 150px; object-fit: cover;">
                                        @endif
                                        <div class="card-body">
                                            <h6 class="card-title">{{ Str::limit($related->title, 50) }}</h6>
                                            <a href="{{ route('blog.show', $related->slug) }}" class="btn btn-sm btn-outline-primary mt-2">
                                                Lire <i class="fas fa-arrow-right ms-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    .post-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #333;
    }
    .post-meta {
        font-size: 0.9rem;
    }
</style>
@endpush
@endsection
