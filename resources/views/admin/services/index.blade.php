@extends('admin.layouts.app')

@section('title', 'Gestion des Services')
@section('page-title', 'Gestion des Services')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Liste des Services</h5>
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nouveau Service
        </a>
    </div>
    <div class="card-body">
        @if($services->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Titre</th>
                            <th>Icône</th>
                            <th>Ordre</th>
                            <th>Statut</th>
                            <th>Date création</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                            <tr>
                                <td>{{ $service->id }}</td>
                                <td>{{ $service->title }}</td>
                                <td>
                                    @if($service->icon)
                                        <img src="{{ asset('storage/' . $service->icon) }}" alt="{{ $service->title }}"
                                             style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                        <i class="fas fa-image text-muted"></i>
                                    @endif
                                </td>
                                <td>{{ $service->order ?? 0 }}</td>
                                <td>
                                    @if(isset($service->is_active))
                                        <span class="badge {{ $service->is_active ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $service->is_active ? 'Actif' : 'Inactif' }}
                                        </span>
                                    @else
                                        <span class="badge bg-success">Actif</span>
                                    @endif
                                </td>
                                <td>{{ $service->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.services.destroy', $service) }}" method="POST"
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce service ?');">
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
                {{ $services->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                <p class="text-muted">Aucun service trouvé</p>
                <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Créer le premier service
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
