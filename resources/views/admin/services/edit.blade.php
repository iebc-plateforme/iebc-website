@extends('admin.layouts.app')

@section('title', 'Modifier un Service')
@section('page-title', 'Modifier un Service')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Modifier le Service: {{ $service->title }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror"
                       id="title" name="title" value="{{ old('title', $service->title) }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                <textarea class="form-control @error('description') is-invalid @enderror"
                          id="description" name="description" rows="5" required>{{ old('description', $service->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="icon" class="form-label">Icône / Image</label>
                @if($service->icon)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $service->icon) }}" alt="{{ $service->title }}"
                             style="max-width: 100px; max-height: 100px; object-fit: cover;">
                    </div>
                @endif
                <input type="file" class="form-control @error('icon') is-invalid @enderror"
                       id="icon" name="icon" accept="image/*">
                @error('icon')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text text-muted">Format acceptés : JPG, PNG, SVG (Max : 2MB)</small>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="order" class="form-label">Ordre d'affichage</label>
                        <input type="number" class="form-control @error('order') is-invalid @enderror"
                               id="order" name="order" value="{{ old('order', $service->order ?? 0) }}" min="0">
                        @error('order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="is_active" class="form-label">Statut</label>
                        <select class="form-select @error('is_active') is-invalid @enderror"
                                id="is_active" name="is_active">
                            <option value="1" {{ old('is_active', $service->is_active ?? 1) == '1' ? 'selected' : '' }}>Actif</option>
                            <option value="0" {{ old('is_active', $service->is_active ?? 1) == '0' ? 'selected' : '' }}>Inactif</option>
                        </select>
                        @error('is_active')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
