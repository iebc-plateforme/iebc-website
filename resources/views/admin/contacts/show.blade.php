@extends('admin.layouts.app')

@section('title', 'Détail du Message')
@section('page-title', 'Détail du Message')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Message de: {{ $contact->name }}</h5>
        <span class="badge {{ $contact->is_read ? 'bg-secondary' : 'bg-primary' }}">
            {{ $contact->is_read ? 'Lu' : 'Nouveau' }}
        </span>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Email:</strong> {{ $contact->email }}
            </div>
            <div class="col-md-6">
                <strong>Téléphone:</strong> {{ $contact->phone ?? 'Non fourni' }}
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <strong>Sujet:</strong> {{ $contact->subject }}
            </div>
        </div>
        <div class="mb-3">
            <strong>Message:</strong>
            <p class="alert alert-light mt-2">{{ $contact->message }}</p>
        </div>
        <p class="text-right text-muted small">Reçu le: {{ $contact->created_at->format('d/m/Y à H:i') }}</p>
    </div>
    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Retour à la liste
        </a>
        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST"
              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce message ?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash"></i> Supprimer
            </button>
        </form>
    </div>
</div>
@endsection