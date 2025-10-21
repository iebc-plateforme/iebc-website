@extends('admin.layouts.app')

@section('title', 'Modifier un Partenaire')
@section('page-title', 'Modifier un Partenaire')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Modifier le Partenaire: {{ $partner->name }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.partners.update', $partner) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nom du Partenaire <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                       id="name" name="name" value="{{ old('name', $partner->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="website" class="form-label">Lien Web (URL)</label>
                <input type="url" class="form-control @error('website') is-invalid @enderror"
                       id="website" name="website" value="{{ old('website', $partner->website) }}">
                @error('website')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="logo" class="form-label">Logo / Image</label>
                @if($partner->logo)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}"
                             style="max-width: 100px; max-height: 100px; object-fit: contain;">
                    </div>
                @endif
                <input type="file" class="form-control @error('logo') is-invalid @enderror"
                       id="logo" name="logo" accept="image/*">
                @error('logo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text text-muted">Format acceptés : JPG, PNG, SVG (Max : 2MB). Laissez vide pour ne pas changer.</small>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="order" class="form-label">Ordre d'affichage</label>
                        <input type="number" class="form-control @error('order') is-invalid @enderror"
                               id="order" name="order" value="{{ old('order', $partner->order ?? 0) }}" min="0">
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
                            <option value="1" {{ old('is_active', $partner->is_active ?? 1) == '1' ? 'selected' : '' }}>Actif</option>
                            <option value="0" {{ old('is_active', $partner->is_active ?? 1) == '0' ? 'selected' : '' }}>Inactif</option>
                        </select>
                        @error('is_active')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary">
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