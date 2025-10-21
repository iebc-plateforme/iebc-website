@extends('admin.layouts.app')

@section('title', 'Gestion des Partenaires')
@section('page-title', 'Gestion des Partenaires')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Liste des Partenaires</h5>
        <a href="{{ route('admin.partners.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nouveau Partenaire
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        @if($partners->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Logo</th>
                            <th>Ordre</th>
                            <th>Statut</th>
                            <th>Date création</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($partners as $partner)
                            <tr>
                                <td>{{ $partner->id }}</td>
                                <td>{{ $partner->name }}</td>
                                <td>
                                    @if($partner->logo)
                                        <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}"
                                             style="width: 40px; height: 40px; object-fit: contain;">
                                    @else
                                        <i class="fas fa-image text-muted"></i>
                                    @endif
                                </td>
                                <td>{{ $partner->order ?? 0 }}</td>
                                <td>
                                    <span class="badge {{ $partner->is_active ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $partner->is_active ? 'Actif' : 'Inactif' }}
                                    </span>
                                </td>
                                <td>{{ $partner->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.partners.edit', $partner) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST"
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce partenaire ?');">
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
                {{ $partners->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                <p class="text-muted">Aucun partenaire trouvé</p>
                <a href="{{ route('admin.partners.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Créer le premier partenaire
                </a>
            </div>
        @endif
    </div>
</div>
@endsection