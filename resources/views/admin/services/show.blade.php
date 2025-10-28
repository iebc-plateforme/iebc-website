@extends('admin.layouts.app')

@section('title', 'Détails du Service')
@section('page-title', 'Détails du Service')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Détails du Service: {{ $service->title }}</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                @if($service->icon)
                    <img src="{{ image_url($service->icon) }}" alt="{{ $service->title }}" class="img-fluid rounded">
                @else
                    <i class="fas fa-image fa-5x text-muted"></i>
                @endif
            </div>
            <div class="col-md-8">
                <p><strong>ID:</strong> {{ $service->id }}</p>
                <p><strong>Titre:</strong> {{ $service->title }}</p>
                <p><strong>Slug:</strong> {{ $service->slug }}</p>
                <p><strong>Description:</strong></p>
                <p>{{ $service->description }}</p>
                <p><strong>Ordre:</strong> {{ $service->order }}</p>
                <p><strong>Statut:</strong>
                    <span class="badge {{ $service->is_active ? 'bg-success' : 'bg-secondary' }}">
                        {{ $service->is_active ? 'Actif' : 'Inactif' }}
                    </span>
                </p>
                <p><strong>Date de création:</strong> {{ $service->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Dernière mise à jour:</strong> {{ $service->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
        <hr>
        <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-warning">Modifier</a>
        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Retour à la liste</a>
    </div>
</div>
@endsection
