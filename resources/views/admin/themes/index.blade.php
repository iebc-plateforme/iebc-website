@extends('admin.layouts.app')

@section('title', 'Gestion des Thèmes')
@section('page-title', 'Gestion des Thèmes')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-1">Personnalisez l'Apparence de Votre Site</h4>
                <p class="text-muted mb-0">Choisissez parmi {{ $themes->count() }} thèmes professionnels</p>
            </div>
            <a href="{{ route('admin.themes.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Créer un Thème Personnalisé
            </a>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- Category Tabs -->
<ul class="nav nav-pills mb-4" id="categoryTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="all-tab" data-bs-toggle="pill" data-bs-target="#all" type="button" role="tab">
            <i class="fas fa-th me-1"></i>Tous ({{ $themes->count() }})
        </button>
    </li>
    @php
        $categories = $themes->groupBy('category');
    @endphp
    @foreach($categories as $category => $categoryThemes)
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="{{ $category }}-tab" data-bs-toggle="pill" data-bs-target="#{{ $category }}" type="button" role="tab">
                @switch($category)
                    @case('professional')
                        <i class="fas fa-briefcase me-1"></i>Professionnel
                        @break
                    @case('elegant')
                        <i class="fas fa-crown me-1"></i>Élégant
                        @break
                    @case('modern')
                        <i class="fas fa-rocket me-1"></i>Moderne
                        @break
                    @case('minimal')
                        <i class="fas fa-minus me-1"></i>Minimaliste
                        @break
                    @case('vibrant')
                        <i class="fas fa-bolt me-1"></i>Dynamique
                        @break
                    @default
                        {{ ucfirst($category) }}
                @endswitch
                ({{ $categoryThemes->count() }})
            </button>
        </li>
    @endforeach
</ul>

<!-- Theme Grid -->
<div class="tab-content" id="categoryTabContent">
    <!-- All Themes -->
    <div class="tab-pane fade show active" id="all" role="tabpanel">
        <div class="row g-4">
            @foreach($themes as $theme)
                @include('admin.themes._card', ['theme' => $theme])
            @endforeach
        </div>
    </div>

    <!-- Category-specific tabs -->
    @foreach($categories as $category => $categoryThemes)
        <div class="tab-pane fade" id="{{ $category }}" role="tabpanel">
            <div class="row g-4">
                @foreach($categoryThemes as $theme)
                    @include('admin.themes._card', ['theme' => $theme])
                @endforeach
            </div>
        </div>
    @endforeach
</div>

@if($themes->isEmpty())
    <div class="alert alert-info text-center py-5">
        <i class="fas fa-info-circle fa-3x mb-3 d-block"></i>
        <h5>Aucun thème trouvé</h5>
        <p class="mb-3">Créez votre premier thème pour personnaliser l'apparence du site.</p>
        <a href="{{ route('admin.themes.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Créer un Thème
        </a>
    </div>
@endif

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewModalLabel">Aperçu du Thème</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="previewContent">
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Chargement...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .theme-card {
        transition: all 0.3s ease;
        height: 100%;
        border: 2px solid transparent;
    }

    .theme-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
    }

    .theme-card.active-theme {
        border-color: #198754 !important;
        box-shadow: 0 8px 25px rgba(25,135,84,0.25) !important;
    }

    .color-swatch {
        width: 45px;
        height: 45px;
        border-radius: 0.375rem;
        border: 2px solid #dee2e6;
        transition: transform 0.2s ease;
    }

    .color-swatch:hover {
        transform: scale(1.1);
    }

    .category-badge {
        font-size: 0.75rem;
        padding: 0.25rem 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .theme-actions .btn {
        transition: all 0.2s ease;
    }

    .theme-actions .btn:hover {
        transform: translateY(-2px);
    }

    .nav-pills .nav-link {
        border-radius: 50px;
        padding: 0.5rem 1.25rem;
        font-weight: 500;
    }

    .nav-pills .nav-link:not(.active):hover {
        background-color: rgba(13, 110, 253, 0.1);
    }

    .premium-badge {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
    }

    .premium-badge i {
        margin-right: 0.25rem;
    }
</style>
@endpush

@push('scripts')
<script>
    function previewTheme(themeId) {
        const modal = new bootstrap.Modal(document.getElementById('previewModal'));
        const content = document.getElementById('previewContent');

        // Show loading
        content.innerHTML = `
            <div class="text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Chargement...</span>
                </div>
            </div>
        `;

        modal.show();

        // Fetch preview (in a real scenario, you might fetch this via AJAX)
        setTimeout(() => {
            content.innerHTML = `
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    L'aperçu détaillé sera disponible dans une prochaine version.
                    Pour tester le thème, activez-le et consultez le site public.
                </div>
            `;
        }, 500);
    }
</script>
@endpush
@endsection
