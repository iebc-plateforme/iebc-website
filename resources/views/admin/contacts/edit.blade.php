@extends('admin.layouts.app')

@section('title', 'Modifier l\'Élément de Galerie')
@section('page-title', 'Modifier l\'Élément de Galerie')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Modifier l'Élément: {{ $gallery->title }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.galleries.update', $gallery) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Titre / Nom <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror"
                       id="title" name="title" value="{{ old('title', $gallery->title) }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description Courte</label>
                <textarea class="form-control @error('description') is-invalid @enderror"
                          id="description" name="description" rows="3">{{ old('description', $gallery->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="type" class="form-label">Type de Média <span class="text-danger">*</span></label>
                        <select class="form-select @error('type') is-invalid @enderror"
                                id="type" name="type" required>
                            <option value="image" {{ old('type', $gallery->type) == 'image' ? 'selected' : '' }}>Image</option>
                            <option value="video" {{ old('type', $gallery->type) == 'video' ? 'selected' : '' }}>Vidéo</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="file_path" class="form-label">Fichier Média (Nouveau)</label>
                        @if($gallery->file_path)
                            <p class="mb-2">Fichier actuel : 
                                @if($gallery->type === 'image')
                                    <img src="{{ asset('storage/' . $gallery->file_path) }}" style="max-width: 50px; max-height: 50px; object-fit: cover;">
                                @else
                                    <i class="fas fa-file-alt text-info"></i> {{ basename($gallery->file_path) }}
                                @endif
                            </p>
                        @endif
                        <input type="file" class="form-control @error('file_path') is-invalid @enderror"
                               id="file_path" name="file_path">
                        @error('file_path')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Laissez vide pour conserver le fichier actuel.</small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="order" class="form-label">Ordre d'affichage</label>
                        <input type="number" class="form-control @error('order') is-invalid @enderror"
                               id="order" name="order" value="{{ old('order', $gallery->order ?? 0) }}" min="0">
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
                            <option value="1" {{ old('is_active', $gallery->is_active ?? 1) == '1' ? 'selected' : '' }}>Actif</option>
                            <option value="0" {{ old('is_active', $gallery->is_active ?? 1) == '0' ? 'selected' : '' }}>Inactif</option>
                        </select>
                        @error('is_active')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">
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