@extends('admin.layouts.app')

@section('title', 'Gestion des Membres d\'Équipe')
@section('page-title', 'Gestion des Membres d\'Équipe')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Liste des Membres d'Équipe</h5>
        <a href="{{ route('admin.teams.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nouveau Membre
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($teams->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Photo</th>
                            <th>Nom</th>
                            <th>Poste</th>
                            <th>Réseaux Sociaux</th>
                            <th>Ordre</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teams as $member)
                            <tr>
                                <td>{{ $member->id }}</td>
                                <td>
                                    @if($member->photo)
                                        <img src="{{ image_url($member->photo) }}" alt="{{ $member->name }}"
                                             style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                                    @else
                                        <i class="fas fa-user-circle fa-2x text-muted"></i>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $member->name }}</strong>
                                </td>
                                <td>{{ $member->position }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        @if(!empty($member->linkedin_url))
                                            <a href="{{ $member->linkedin_url }}" target="_blank" class="btn btn-sm btn-outline-primary" title="LinkedIn">
                                                <i class="fab fa-linkedin"></i>
                                            </a>
                                        @endif
                                        @if(!empty($member->twitter_url))
                                            <a href="{{ $member->twitter_url }}" target="_blank" class="btn btn-sm btn-outline-info" title="Twitter">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        @endif
                                        @if(!empty($member->facebook_url))
                                            <a href="{{ $member->facebook_url }}" target="_blank" class="btn btn-sm btn-outline-primary" title="Facebook">
                                                <i class="fab fa-facebook"></i>
                                            </a>
                                        @endif
                                        @if(!empty($member->instagram_url))
                                            <a href="{{ $member->instagram_url }}" target="_blank" class="btn btn-sm btn-outline-danger" title="Instagram">
                                                <i class="fab fa-instagram"></i>
                                            </a>
                                        @endif
                                        @if(!empty($member->github_url))
                                            <a href="{{ $member->github_url }}" target="_blank" class="btn btn-sm btn-outline-dark" title="GitHub">
                                                <i class="fab fa-github"></i>
                                            </a>
                                        @endif
                                        @if(!empty($member->website_url))
                                            <a href="{{ $member->website_url }}" target="_blank" class="btn btn-sm btn-outline-success" title="Site Web">
                                                <i class="fas fa-globe"></i>
                                            </a>
                                        @endif
                                        @if(empty($member->linkedin_url) && empty($member->twitter_url) && empty($member->facebook_url) && empty($member->instagram_url) && empty($member->github_url) && empty($member->website_url))
                                            <span class="text-muted small">Aucun</span>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $member->order ?? 0 }}</td>
                                <td>
                                    <span class="badge {{ $member->is_active ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $member->is_active ? 'Actif' : 'Inactif' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.teams.edit', $member) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.teams.destroy', $member) }}" method="POST"
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce membre ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $teams->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                <p class="text-muted">Aucun membre d'équipe trouvé</p>
                <a href="{{ route('admin.teams.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Ajouter le premier membre
                </a>
            </div>
        @endif
    </div>
</div>
@endsection