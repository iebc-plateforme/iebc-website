@extends('admin.layouts.app')

@section('title', 'Ajouter un Membre d\'Équipe')
@section('page-title', 'Ajouter un Membre d\'Équipe')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Nouveau Membre d'Équipe</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.teams.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nom Complet <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                       id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="position" class="form-label">Poste / Fonction <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('position') is-invalid @enderror"
                       id="position" name="position" value="{{ old('position') }}" required>
                @error('position')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="bio" class="form-label">Biographie Courte</label>
                <textarea class="form-control @error('bio') is-invalid @enderror"
                          id="bio" name="bio" rows="3">{{ old('bio') }}</textarea>
                @error('bio')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="photo" class="form-label">Photo du Membre</label>
                <input type="file" class="form-control @error('photo') is-invalid @enderror"
                       id="photo" name="photo" accept="image/*">
                @error('photo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text text-muted">Format acceptés : JPG, PNG (Max : 2MB)</small>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="order" class="form-label">Ordre d'affichage</label>
                        <input type="number" class="form-control @error('order') is-invalid @enderror"
                               id="order" name="order" value="{{ old('order', 0) }}" min="0">
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
                            <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Actif</option>
                            <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactif</option>
                        </select>
                        @error('is_active')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.teams.index') }}" class="btn btn-secondary">
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