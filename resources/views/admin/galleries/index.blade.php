@extends('admin.layouts.app')

@section('title', 'Gestion de la Galerie')
@section('page-title', 'Gestion de la Galerie')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Liste des Éléments de Galerie</h5>
        <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nouvel Élément
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        @if($galleries->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Aperçu</th>
                            <th>Titre</th>
                            <th>Type</th>
                            <th>Ordre</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($galleries as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    @if($item->file_path && $item->type === 'image')
                                        <img src="{{ image_url($item->file_path) }}" alt="{{ $item->title }}"
                                             style="width: 50px; height: 50px; object-fit: cover;">
                                    @elseif($item->file_path && $item->type === 'video')
                                        <i class="fas fa-video fa-2x text-primary"></i>
                                    @else
                                        <i class="fas fa-question-circle fa-2x text-muted"></i>
                                    @endif
                                </td>
                                <td>{{ $item->title }}</td>
                                <td>
                                    <span class="badge bg-info">{{ ucfirst($item->type) }}</span>
                                </td>
                                <td>{{ $item->order ?? 0 }}</td>
                                <td>
                                    <span class="badge {{ $item->is_active ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $item->is_active ? 'Actif' : 'Inactif' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.galleries.edit', $item) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.galleries.destroy', $item) }}" method="POST"
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet élément ?');">
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
                {{ $galleries->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-images fa-3x text-muted mb-3"></i>
                <p class="text-muted">Aucun élément de galerie trouvé</p>
                <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Ajouter un nouvel élément
                </a>
            </div>
        @endif
    </div>
</div>
@endsection