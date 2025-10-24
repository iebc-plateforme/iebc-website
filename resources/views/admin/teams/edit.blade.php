@extends('admin.layouts.app')

@section('title', 'Modifier un Membre d\'Équipe')
@section('page-title', 'Modifier un Membre d\'Équipe')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Modifier le Membre: {{ $team->name }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.teams.update', $team) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nom Complet <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                       id="name" name="name" value="{{ old('name', $team->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="position" class="form-label">Poste / Fonction <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('position') is-invalid @enderror"
                       id="position" name="position" value="{{ old('position', $team->position) }}" required>
                @error('position')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="bio" class="form-label">Biographie Courte</label>
                <textarea class="form-control @error('bio') is-invalid @enderror"
                          id="bio" name="bio" rows="3">{{ old('bio', $team->bio) }}</textarea>
                @error('bio')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="photo" class="form-label">Photo du Membre</label>
                @if($team->photo)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $team->photo) }}" alt="{{ $team->name }}"
                             style="max-width: 100px; max-height: 100px; object-fit: cover; border-radius: 50%;">
                    </div>
                @endif
                <input type="file" class="form-control @error('photo') is-invalid @enderror"
                       id="photo" name="photo" accept="image/*">
                @error('photo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text text-muted">Format acceptés : JPG, PNG (Max : 2MB). Laissez vide pour ne pas changer.</small>
            </div>

            <hr class="my-4">
            <h6 class="mb-3"><i class="fas fa-share-alt me-2"></i>Réseaux Sociaux & Liens Professionnels</h6>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="linkedin_url" class="form-label">
                            <i class="fab fa-linkedin text-primary me-2"></i>LinkedIn
                        </label>
                        <input type="url" class="form-control @error('linkedin_url') is-invalid @enderror"
                               id="linkedin_url" name="linkedin_url" value="{{ old('linkedin_url', $team->linkedin_url) }}"
                               placeholder="https://www.linkedin.com/in/username">
                        @error('linkedin_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="twitter_url" class="form-label">
                            <i class="fab fa-twitter text-info me-2"></i>Twitter
                        </label>
                        <input type="url" class="form-control @error('twitter_url') is-invalid @enderror"
                               id="twitter_url" name="twitter_url" value="{{ old('twitter_url', $team->twitter_url) }}"
                               placeholder="https://twitter.com/username">
                        @error('twitter_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="facebook_url" class="form-label">
                            <i class="fab fa-facebook text-primary me-2"></i>Facebook
                        </label>
                        <input type="url" class="form-control @error('facebook_url') is-invalid @enderror"
                               id="facebook_url" name="facebook_url" value="{{ old('facebook_url', $team->facebook_url) }}"
                               placeholder="https://www.facebook.com/username">
                        @error('facebook_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="instagram_url" class="form-label">
                            <i class="fab fa-instagram text-danger me-2"></i>Instagram
                        </label>
                        <input type="url" class="form-control @error('instagram_url') is-invalid @enderror"
                               id="instagram_url" name="instagram_url" value="{{ old('instagram_url', $team->instagram_url) }}"
                               placeholder="https://www.instagram.com/username">
                        @error('instagram_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="github_url" class="form-label">
                            <i class="fab fa-github text-dark me-2"></i>GitHub
                        </label>
                        <input type="url" class="form-control @error('github_url') is-invalid @enderror"
                               id="github_url" name="github_url" value="{{ old('github_url', $team->github_url) }}"
                               placeholder="https://github.com/username">
                        @error('github_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="website_url" class="form-label">
                            <i class="fas fa-globe text-success me-2"></i>Site Web Personnel
                        </label>
                        <input type="url" class="form-control @error('website_url') is-invalid @enderror"
                               id="website_url" name="website_url" value="{{ old('website_url', $team->website_url) }}"
                               placeholder="https://www.example.com">
                        @error('website_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="order" class="form-label">Ordre d'affichage</label>
                        <input type="number" class="form-control @error('order') is-invalid @enderror"
                               id="order" name="order" value="{{ old('order', $team->order ?? 0) }}" min="0">
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
                            <option value="1" {{ old('is_active', $team->is_active ?? 1) == '1' ? 'selected' : '' }}>Actif</option>
                            <option value="0" {{ old('is_active', $team->is_active ?? 1) == '0' ? 'selected' : '' }}>Inactif</option>
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
                    <i class="fas fa-save"></i> Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection