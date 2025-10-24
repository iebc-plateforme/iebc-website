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
                <label for="excerpt" class="form-label">Extrait / Résumé</label>
                <textarea class="form-control @error('excerpt') is-invalid @enderror"
                          id="excerpt" name="excerpt" rows="3" maxlength="500"
                          placeholder="Résumé court de l'article (max 500 caractères)">{{ old('excerpt') }}</textarea>
                @error('excerpt')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text text-muted">Utilisé pour l'aperçu de l'article (max 500 caractères)</small>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Contenu <span class="text-danger">*</span></label>
                <textarea class="form-control tinymce-editor @error('content') is-invalid @enderror"
                          id="content" name="content" rows="15" required>{{ old('content') }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="category" class="form-label">Catégorie</label>
                        <input type="text" class="form-control @error('category') is-invalid @enderror"
                               id="category" name="category" value="{{ old('category') }}"
                               placeholder="ex: Actualités, Finance Islamique, Économie">
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="published_at" class="form-label">Date de Publication</label>
                        <input type="datetime-local" class="form-control @error('published_at') is-invalid @enderror"
                               id="published_at" name="published_at" value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}">
                        @error('published_at')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Si vide, utilise la date actuelle</small>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image de Couverture</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror"
                       id="image" name="image" accept="image/*">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text text-muted">Format acceptés : JPG, PNG, WebP (Max : 2MB)</small>
            </div>

            <div class="mb-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="is_published" name="is_published" value="1"
                           {{ old('is_published', '1') == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_published">
                        Publier immédiatement
                    </label>
                </div>
                <small class="form-text text-muted">Si décoché, l'article sera sauvegardé comme brouillon</small>
            </div>

            <hr class="my-4">

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

@push('styles')
<style>
    .tox-tinymce {
        border-radius: 0.375rem;
    }
</style>
@endpush

@push('scripts')
<!-- TinyMCE -->
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '.tinymce-editor',
        height: 500,
        menubar: true,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | ' +
            'bold italic forecolor backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | link image media | code | help',
        content_style: 'body { font-family:system-ui,-apple-system,sans-serif; font-size:14px }',
        language: 'fr_FR',
        branding: false,
        promotion: false,
        relative_urls: false,
        remove_script_host: false,
        convert_urls: true,
        image_advtab: true,
        file_picker_types: 'image',
        automatic_uploads: false,
        images_upload_handler: function (blobInfo, success, failure) {
            // You can implement image upload here if needed
            failure('Image upload not configured');
        }
    });
</script>
@endpush
