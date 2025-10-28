@extends('admin.layouts.app')

@section('title', 'Gestion des Articles')
@section('page-title', 'Gestion des Articles')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Liste des Articles</h5>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nouvel Article
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($posts->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Titre</th>
                            <th>Auteur</th>
                            <th>Image</th>
                            <th>Statut</th>
                            <th>Date publication</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->user->name ?? 'N/A' }}</td> {{-- Supposons une relation user --}}
                                <td>
                                    @if($post->image)
                                        <img src="{{ image_url($post->image) }}" alt="{{ $post->title }}"
                                             style="width: 60px; height: 40px; object-fit: cover;">
                                    @else
                                        <i class="fas fa-image text-muted"></i>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge {{ $post->is_active ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $post->is_active ? 'Publié' : 'Brouillon' }}
                                    </span>
                                </td>
                                <td>{{ $post->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST"
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');">
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
                {{ $posts->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                <p class="text-muted">Aucun article trouvé</p>
                <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Créer le premier article
                </a>
            </div>
        @endif
    </div>
</div>
@endsection