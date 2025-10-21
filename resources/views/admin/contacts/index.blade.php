@extends('admin.layouts.app')

@section('title', 'Gestion des Messages')
@section('page-title', 'Gestion des Messages de Contact')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Liste des Messages Reçus</h5>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        @if($contacts->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Statut</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Sujet</th>
                            <th>Reçu le</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contacts as $contact)
                            <tr class="{{ $contact->is_read ? 'text-muted' : 'font-weight-bold' }}">
                                <td>{{ $contact->id }}</td>
                                <td>
                                    <span class="badge {{ $contact->is_read ? 'bg-secondary' : 'bg-primary' }}">
                                        {{ $contact->is_read ? 'Lu' : 'Nouveau' }}
                                    </span>
                                </td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ Str::limit($contact->subject, 40) }}</td>
                                <td>{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.contacts.show', $contact) }}" class="btn btn-sm btn-info" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST"
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce message ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Supprimer">
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
                {{ $contacts->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-envelope fa-3x text-muted mb-3"></i>
                <p class="text-muted">Aucun message de contact trouvé.</p>
            </div>
        @endif
    </div>
</div>
@endsection