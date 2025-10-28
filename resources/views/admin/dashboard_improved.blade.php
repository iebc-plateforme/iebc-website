@extends('admin.layouts.app')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')

@push('styles')
<style>
    .stat-card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        transition: all 0.3s;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    }

    .stat-card .card-body {
        padding: 1.5rem;
    }

    .stat-card .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
    }

    .stat-card .stat-value {
        font-size: 2rem;
        font-weight: 700;
        margin: 0.5rem 0;
    }

    .stat-card .stat-label {
        color: #6c757d;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }

    .stat-card .stat-footer {
        background: #f8f9fa;
        padding: 0.75rem 1.5rem;
        margin: -1.5rem -1.5rem 0;
        margin-top: 1rem;
    }

    .stat-card .stat-footer a {
        text-decoration: none;
        color: inherit;
        font-weight: 500;
        transition: all 0.3s;
    }

    .stat-card .stat-footer a:hover {
        color: var(--secondary-color);
    }

    .welcome-card {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .welcome-card h2 {
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .welcome-card p {
        opacity: 0.9;
        margin-bottom: 0;
    }

    .activity-card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }

    .activity-item {
        padding: 1rem;
        border-bottom: 1px solid #f0f0f0;
        transition: background 0.2s;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-item:hover {
        background: #f8f9fa;
    }

    .activity-item .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
    }

    .quick-action-btn {
        border-radius: 12px;
        padding: 1rem;
        border: 2px dashed #dee2e6;
        background: white;
        transition: all 0.3s;
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .quick-action-btn:hover {
        border-color: var(--secondary-color);
        background: #f8f9fa;
        transform: translateY(-3px);
    }

    .quick-action-btn i {
        font-size: 1.5rem;
        color: var(--secondary-color);
    }
</style>
@endpush

@section('content')
<!-- Welcome Banner -->
<div class="welcome-card">
    <h2>Bonjour, {{ Auth::user()->name }} 👋</h2>
    <p>Voici un aperçu de votre plateforme</p>
</div>

<!-- Stats Overview -->
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="stat-icon" style="background: rgba(52, 152, 219, 0.1); color: #3498db;">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="ms-3 flex-grow-1">
                        <div class="stat-label">Services</div>
                        <div class="stat-value">{{ $stats['services'] }}</div>
                    </div>
                </div>
                <div class="stat-footer">
                    <a href="{{ route('admin.services.index') }}" class="d-flex align-items-center justify-content-between">
                        <span>Gérer les services</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="stat-icon" style="background: rgba(46, 204, 113, 0.1); color: #2ecc71;">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <div class="ms-3 flex-grow-1">
                        <div class="stat-label">Partenaires</div>
                        <div class="stat-value">{{ $stats['partners'] }}</div>
                    </div>
                </div>
                <div class="stat-footer">
                    <a href="{{ route('admin.partners.index') }}" class="d-flex align-items-center justify-content-between">
                        <span>Voir les partenaires</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="stat-icon" style="background: rgba(230, 126, 34, 0.1); color: #e67e22;">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="ms-3 flex-grow-1">
                        <div class="stat-label">Équipe</div>
                        <div class="stat-value">{{ $stats['team_members'] }}</div>
                    </div>
                </div>
                <div class="stat-footer">
                    <a href="{{ route('admin.teams.index') }}" class="d-flex align-items-center justify-content-between">
                        <span>Gérer l'équipe</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="stat-icon" style="background: rgba(231, 76, 60, 0.1); color: #e74c3c;">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="ms-3 flex-grow-1">
                        <div class="stat-label">Messages</div>
                        <div class="stat-value">{{ $stats['contacts'] }}</div>
                    </div>
                </div>
                <div class="stat-footer">
                    <a href="{{ route('admin.contacts.index') }}" class="d-flex align-items-center justify-content-between">
                        <span>Lire les messages</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Secondary Stats -->
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="stat-icon" style="background: rgba(155, 89, 182, 0.1); color: #9b59b6;">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <div class="ms-3 flex-grow-1">
                        <div class="stat-label">Actualités</div>
                        <div class="stat-value">{{ $stats['posts'] }}</div>
                    </div>
                </div>
                <div class="stat-footer">
                    <a href="{{ route('admin.posts.index') }}" class="d-flex align-items-center justify-content-between">
                        <span>Gérer les posts</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="stat-icon" style="background: rgba(52, 73, 94, 0.1); color: #34495e;">
                        <i class="fas fa-images"></i>
                    </div>
                    <div class="ms-3 flex-grow-1">
                        <div class="stat-label">Galerie</div>
                        <div class="stat-value">{{ $stats['gallery_items'] }}</div>
                    </div>
                </div>
                <div class="stat-footer">
                    <a href="{{ route('admin.galleries.index') }}" class="d-flex align-items-center justify-content-between">
                        <span>Gérer la galerie</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-xl-6">
        <div class="card activity-card h-100">
            <div class="card-header d-flex align-items-center">
                <i class="fas fa-bolt me-2"></i>
                <strong>Actions Rapides</strong>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-6">
                        <a href="{{ route('admin.services.create') }}" class="quick-action-btn text-center">
                            <i class="fas fa-plus-circle d-block mb-2"></i>
                            <small>Nouveau service</small>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.posts.create') }}" class="quick-action-btn text-center">
                            <i class="fas fa-pen d-block mb-2"></i>
                            <small>Nouvelle actualité</small>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.teams.create') }}" class="quick-action-btn text-center">
                            <i class="fas fa-user-plus d-block mb-2"></i>
                            <small>Nouveau membre</small>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.galleries.create') }}" class="quick-action-btn text-center">
                            <i class="fas fa-image d-block mb-2"></i>
                            <small>Nouveau média</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Activity Feed -->
<div class="row g-4">
    <div class="col-lg-6">
        <div class="card activity-card">
            <div class="card-header d-flex align-items-center">
                <i class="fas fa-bell me-2"></i>
                <strong>Activités Récentes</strong>
            </div>
            <div class="card-body p-0">
                @if($stats['recent_contacts']->count() > 0)
                    @foreach($stats['recent_contacts']->take(5) as $contact)
                        <a href="{{ route('admin.contacts.show', $contact) }}" class="activity-item d-flex align-items-start text-decoration-none">
                            <div class="activity-icon" style="background: rgba(231, 76, 60, 0.1); color: #e74c3c;">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="flex-grow-1">
                                <strong class="d-block">{{ $contact->name }}</strong>
                                <small class="text-muted">{{ Str::limit($contact->message, 60) }}</small>
                                <div class="text-muted small mt-1">
                                    <i class="fas fa-clock"></i> {{ $contact->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <div class="p-4 text-center text-muted">
                        <i class="fas fa-inbox fa-2x mb-2"></i>
                        <p class="mb-0">Aucune activité récente</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card activity-card">
            <div class="card-header d-flex align-items-center">
                <i class="fas fa-newspaper me-2"></i>
                <strong>Dernières Actualités</strong>
            </div>
            <div class="card-body p-0">
                @if($stats['recent_posts']->count() > 0)
                    @foreach($stats['recent_posts']->take(5) as $post)
                        <a href="{{ route('admin.posts.edit', $post) }}" class="activity-item d-flex align-items-start text-decoration-none">
                            <div class="activity-icon" style="background: rgba(155, 89, 182, 0.1); color: #9b59b6;">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div class="flex-grow-1">
                                <strong class="d-block">{{ $post->title }}</strong>
                                <small class="text-muted">{{ Str::limit($post->excerpt ?? $post->content, 60) }}</small>
                                <div class="d-flex align-items-center mt-1">
                                    @if(isset($post->is_published))
                                        <span class="badge {{ $post->is_published ? 'bg-success' : 'bg-warning' }} me-2">
                                            {{ $post->is_published ? 'Publié' : 'Brouillon' }}
                                        </span>
                                    @endif
                                    <small class="text-muted">
                                        <i class="fas fa-clock"></i> {{ $post->created_at->diffForHumans() }}
                                    </small>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <div class="p-4 text-center text-muted">
                        <i class="fas fa-newspaper fa-2x mb-2"></i>
                        <p class="mb-0">Aucune actualité récente</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
