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
                <article class="blog-post" itemscope itemtype="https://schema.org/BlogPosting">
                    <!-- Schema.org metadata -->
                    <meta itemprop="headline" content="{{ $post->title }}">
                    <meta itemprop="datePublished" content="{{ $post->published_at->toIso8601String() }}">
                    <meta itemprop="dateModified" content="{{ $post->updated_at->toIso8601String() }}">
                    <meta itemprop="author" content="{{ $post->user->name ?? 'IEBC' }}">
                    @if($post->image)
                        <meta itemprop="image" content="{{ image_url($post->image) }}">
                    @endif

                    @if($post->image)
                        <img src="{{ image_url($post->image) }}" class="img-fluid rounded mb-4" alt="{{ $post->title }}" itemprop="image">
                    @endif

                    <div class="post-meta mb-4">
                        @if($post->category)
                            <span class="badge bg-primary me-2">{{ $post->category }}</span>
                        @endif
                        <span class="text-muted">
                            <i class="fas fa-calendar me-1"></i>
                            <time itemprop="datePublished" datetime="{{ $post->published_at->toIso8601String() }}">
                                {{ $post->published_at->format('d F Y') }}
                            </time>
                        </span>
                        <span class="text-muted ms-3">
                            <i class="fas fa-user me-1"></i>
                            <span itemprop="author">{{ $post->user->name ?? 'Admin' }}</span>
                        </span>
                    </div>

                    @if($post->excerpt)
                        <div class="lead mb-4" itemprop="description">{{ $post->excerpt }}</div>
                    @endif

                    <div class="post-content" itemprop="articleBody">
                        {!! $post->content !!}
                    </div>

                    <!-- Share Buttons -->
                    <div class="share-buttons my-5">
                        <h5 class="mb-3">Partager cet article</h5>
                        <div class="d-flex gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post->slug)) }}"
                               target="_blank" class="btn btn-primary btn-sm">
                                <i class="fab fa-facebook-f me-1"></i>Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.show', $post->slug)) }}&text={{ urlencode($post->title) }}"
                               target="_blank" class="btn btn-info btn-sm text-white">
                                <i class="fab fa-twitter me-1"></i>Twitter
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('blog.show', $post->slug)) }}&title={{ urlencode($post->title) }}"
                               target="_blank" class="btn btn-primary btn-sm">
                                <i class="fab fa-linkedin-in me-1"></i>LinkedIn
                            </a>
                            <a href="whatsapp://send?text={{ urlencode($post->title . ' ' . route('blog.show', $post->slug)) }}"
                               class="btn btn-success btn-sm">
                                <i class="fab fa-whatsapp me-1"></i>WhatsApp
                            </a>
                        </div>
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
                                    <div class="card border-0 shadow-sm h-100 hover-lift">
                                        @if($related->image)
                                            <img src="{{ image_url($related->image) }}" class="card-img-top" alt="{{ $related->title }}" style="height: 150px; object-fit: cover;">
                                        @else
                                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 150px;">
                                                <i class="fas fa-newspaper fa-3x text-muted"></i>
                                            </div>
                                        @endif
                                        <div class="card-body">
                                            <h6 class="card-title">{{ Str::limit($related->title, 50) }}</h6>
                                            <p class="card-text small text-muted">
                                                <i class="fas fa-calendar me-1"></i>
                                                {{ $related->published_at->format('d/m/Y') }}
                                            </p>
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

    .post-content h1, .post-content h2, .post-content h3, .post-content h4, .post-content h5, .post-content h6 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-weight: 600;
    }

    .post-content p {
        margin-bottom: 1.5rem;
    }

    .post-content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        margin: 1.5rem 0;
    }

    .post-content ul, .post-content ol {
        margin-bottom: 1.5rem;
        padding-left: 2rem;
    }

    .post-content blockquote {
        border-left: 4px solid var(--primary-color);
        padding-left: 1.5rem;
        margin: 2rem 0;
        font-style: italic;
        color: #666;
    }

    .post-content a {
        color: var(--primary-color);
        text-decoration: underline;
    }

    .post-content a:hover {
        color: var(--accent-color);
    }

    .post-content table {
        width: 100%;
        margin: 2rem 0;
        border-collapse: collapse;
    }

    .post-content table th,
    .post-content table td {
        padding: 0.75rem;
        border: 1px solid #dee2e6;
    }

    .post-content table th {
        background-color: #f8f9fa;
        font-weight: 600;
    }

    .post-content code {
        background-color: #f8f9fa;
        padding: 0.2rem 0.4rem;
        border-radius: 0.25rem;
        font-family: 'Courier New', monospace;
        color: #d63384;
    }

    .post-content pre {
        background-color: #f8f9fa;
        padding: 1rem;
        border-radius: 0.5rem;
        overflow-x: auto;
        margin: 1.5rem 0;
    }

    .post-meta {
        font-size: 0.9rem;
    }

    .share-buttons .btn {
        transition: all 0.3s ease;
    }

    .share-buttons .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .hover-lift {
        transition: all 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
    }
</style>
@endpush

@push('scripts')
<!-- JSON-LD Structured Data for SEO -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BlogPosting",
  "headline": "{{ $post->title }}",
  "description": "{{ Str::limit($post->excerpt ?? strip_tags($post->content), 160) }}",
  "image": "{{ $post->image ? image_url($post->image) : image_url(\App\Models\Setting::get('logo')) }}",
  "datePublished": "{{ $post->published_at->toIso8601String() }}",
  "dateModified": "{{ $post->updated_at->toIso8601String() }}",
  "author": {
    "@type": "Person",
    "name": "{{ $post->user->name ?? 'IEBC' }}"
  },
  "publisher": {
    "@type": "Organization",
    "name": "{{ \App\Models\Setting::get('site_name', 'IEBC SARL') }}",
    "logo": {
      "@type": "ImageObject",
      "url": "{{ image_url(\App\Models\Setting::get('logo')) }}"
    }
  },
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "{{ route('blog.show', $post->slug) }}"
  }
}
</script>
@endpush
@endsection
