@extends('admin.layouts.app')

@section('title', 'Créer un Article')
@section('page-title', 'Créer un Article')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Nouvel Article / Actualité</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Titre de l'Article <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror"
                       id="title" name="title" value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Contenu <span class="text-danger">*</span></label>
                {{-- Utiliser un éditeur riche comme CKEditor ou TinyMCE ici serait idéal, mais pour le moment, utilisons un textarea simple --}}
                <textarea class="form-control @error('content') is-invalid @enderror"
                          id="content" name="content" rows="10" required>{{ old('content') }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image de Couverture</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror"
                       id="image" name="image" accept="image/*">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text text-muted">Format acceptés : JPG, PNG (Max : 2MB)</small>
            </div>

            <div class="row">
                {{-- Vous pouvez ajouter ici la sélection de la catégorie si le modèle le supporte --}}
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="is_active" class="form-label">Statut de Publication</label>
                        <select class="form-select @error('is_active') is-invalid @enderror"
                                id="is_active" name="is_active">
                            <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Publié (Actif)</option>
                            <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Brouillon (Inactif)</option>
                        </select>
                        @error('is_active')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection