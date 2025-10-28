@extends('admin.layouts.app')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')

@section('content')
<div class="row">
    <!-- Stats Cards -->
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0">{{ $stats['services'] }}</h3>
                        <p class="mb-0">Services</p>
                    </div>
                    <div>
                        <i class="fas fa-briefcase fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.services.index') }}" class="text-white text-decoration-none">
                    Voir tous <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card text-white bg-success">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0">{{ $stats['partners'] }}</h3>
                        <p class="mb-0">Partenaires</p>
                    </div>
                    <div>
                        <i class="fas fa-handshake fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.partners.index') }}" class="text-white text-decoration-none">
                    Voir tous <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0">{{ $stats['team_members'] }}</h3>
                        <p class="mb-0">Membres</p>
                    </div>
                    <div>
                        <i class="fas fa-users fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.teams.index') }}" class="text-white text-decoration-none">
                    Voir tous <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card text-white bg-info">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0">{{ $stats['posts'] }}</h3>
                        <p class="mb-0">Actualités</p>
                    </div>
                    <div>
                        <i class="fas fa-newspaper fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.posts.index') }}" class="text-white text-decoration-none">
                    Voir tous <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-secondary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0">{{ $stats['gallery_items'] }}</h3>
                        <p class="mb-0">Médias</p>
                    </div>
                    <div>
                        <i class="fas fa-images fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.galleries.index') }}" class="text-white text-decoration-none">
                    Voir tous <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card text-white bg-danger">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0">{{ $stats['contacts'] }}</h3>
                        <p class="mb-0">Messages</p>
                    </div>
                    <div>
                        <i class="fas fa-envelope fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.contacts.index') }}" class="text-white text-decoration-none">
                    Voir tous <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-envelope"></i> Messages récents
            </div>
            <div class="card-body">
                @if($stats['recent_contacts']->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($stats['recent_contacts'] as $contact)
                            <a href="{{ route('admin.contacts.show', $contact) }}" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">{{ $contact->name }}</h6>
                                    <small>{{ $contact->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="mb-1 text-muted">{{ Str::limit($contact->message, 80) }}</p>
                                <small class="text-muted">{{ $contact->email }}</small>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">Aucun message récent</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-newspaper"></i> Actualités récentes
            </div>
            <div class="card-body">
                @if($stats['recent_posts']->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($stats['recent_posts'] as $post)
                            <a href="{{ route('admin.posts.edit', $post) }}" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">{{ $post->title }}</h6>
                                    <small>{{ $post->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="mb-1 text-muted">{{ Str::limit($post->content, 80) }}</p>
                                @if(isset($post->is_published))
                                    <span class="badge {{ $post->is_published ? 'bg-success' : 'bg-warning' }}">
                                        {{ $post->is_published ? 'Publié' : 'Brouillon' }}
                                    </span>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">Aucune actualité récente</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-bolt"></i> Actions rapides
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.services.create') }}" class="btn btn-outline-primary w-100">
                            <i class="fas fa-plus"></i> Nouveau service
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.posts.create') }}" class="btn btn-outline-info w-100">
                            <i class="fas fa-plus"></i> Nouvelle actualité
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.teams.create') }}" class="btn btn-outline-warning w-100">
                            <i class="fas fa-plus"></i> Nouveau membre
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.galleries.create') }}" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-plus"></i> Nouveau média
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
