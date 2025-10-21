@extends('admin.layouts.app')

@section('title', 'Modifier l\'Article')
@section('page-title', 'Modifier l\'Article')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Modifier l'Article: {{ $post->title }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Titre de l'Article <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror"
                       id="title" name="title" value="{{ old('title', $post->title) }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Contenu <span class="text-danger">*</span></label>
                <textarea class="form-control @error('content') is-invalid @enderror"
                          id="content" name="content" rows="10" required>{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image de Couverture</label>
                @if($post->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                             style="max-width: 150px; max-height: 100px; object-fit: cover;">
                    </div>
                @endif
                <input type="file" class="form-control @error('image') is-invalid @enderror"
                       id="image" name="image" accept="image/*">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text text-muted">Laissez vide pour ne pas changer l'image.</small>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="is_active" class="form-label">Statut de Publication</label>
                        <select class="form-select @error('is_active') is-invalid @enderror"
                                id="is_active" name="is_active">
                            <option value="1" {{ old('is_active', $post->is_active ?? 1) == '1' ? 'selected' : '' }}>Publié (Actif)</option>
                            <option value="0" {{ old('is_active', $post->is_active ?? 1) == '0' ? 'selected' : '' }}>Brouillon (Inactif)</option>
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
                    <i class="fas fa-save"></i> Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection