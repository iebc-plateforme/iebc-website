@extends('admin.layouts.app')

@section('title', 'Paramètres du site')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Paramètres du site</h1>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Informations générales -->
                        <h5 class="card-title mb-3">Informations générales</h5>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="site_name" class="form-label">Nom du site</label>
                                <input type="text" class="form-control @error('site_name') is-invalid @enderror"
                                       id="site_name" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? '') }}">
                                @error('site_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="logo" class="form-label">Logo du site</label>
                                <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                       id="logo" name="logo" accept="image/*">
                                @error('logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if(isset($settings['logo']) && $settings['logo'])
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $settings['logo']) }}" alt="Logo" class="img-thumbnail" style="max-height: 100px;">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="favicon" class="form-label">Favicon du site (icône)</label>
                                <input type="file" class="form-control @error('favicon') is-invalid @enderror"
                                       id="favicon" name="favicon" accept="image/x-icon,image/png">
                                @error('favicon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if(isset($settings['favicon']) && $settings['favicon'])
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $settings['favicon']) }}" alt="Favicon" class="img-thumbnail" style="max-height: 50px;">
                                    </div>
                                @endif
                                <small class="text-muted">Format: .ico ou .png (max 512 Ko)</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="site_description" class="form-label">Description du site</label>
                            <textarea class="form-control @error('site_description') is-invalid @enderror"
                                      id="site_description" name="site_description" rows="3">{{ old('site_description', $settings['site_description'] ?? '') }}</textarea>
                            @error('site_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- SEO -->
                        <h5 class="card-title mb-3 mt-4">SEO & Référencement</h5>

                        <div class="mb-3">
                            <label for="meta_title" class="form-label">Titre Meta (pour Google)</label>
                            <input type="text" class="form-control @error('meta_title') is-invalid @enderror"
                                   id="meta_title" name="meta_title" value="{{ old('meta_title', $settings['meta_title'] ?? '') }}">
                            @error('meta_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="seo_keywords" class="form-label">Mots-clés SEO (séparés par des virgules)</label>
                            <input type="text" class="form-control @error('seo_keywords') is-invalid @enderror"
                                   id="seo_keywords" name="seo_keywords" value="{{ old('seo_keywords', $settings['seo_keywords'] ?? '') }}"
                                   placeholder="exemple: économie, commerce, business, IEBC">
                            @error('seo_keywords')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Ces mots-clés aident Google à mieux référencer votre site web</small>
                        </div>

                        <div class="mb-3">
                            <label for="google_analytics_id" class="form-label">ID Google Analytics</label>
                            <input type="text" class="form-control @error('google_analytics_id') is-invalid @enderror"
                                   id="google_analytics_id" name="google_analytics_id"
                                   value="{{ old('google_analytics_id', $settings['google_analytics_id'] ?? '') }}"
                                   placeholder="G-XXXXXXXXXX">
                            @error('google_analytics_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Contact -->
                        <h5 class="card-title mb-3 mt-4">Informations de contact</h5>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="contact_email" class="form-label">Email de contact</label>
                                <input type="email" class="form-control @error('contact_email') is-invalid @enderror"
                                       id="contact_email" name="contact_email" value="{{ old('contact_email', $settings['contact_email'] ?? '') }}">
                                @error('contact_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="contact_phone" class="form-label">Téléphone</label>
                                <input type="text" class="form-control @error('contact_phone') is-invalid @enderror"
                                       id="contact_phone" name="contact_phone" value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}">
                                @error('contact_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="contact_address" class="form-label">Adresse</label>
                            <input type="text" class="form-control @error('contact_address') is-invalid @enderror"
                                   id="contact_address" name="contact_address" value="{{ old('contact_address', $settings['contact_address'] ?? '') }}">
                            @error('contact_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Réseaux sociaux -->
                        <h5 class="card-title mb-3 mt-4">Réseaux sociaux</h5>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="facebook_url" class="form-label">
                                    <i class="fab fa-facebook"></i> Facebook
                                </label>
                                <input type="url" class="form-control @error('facebook_url') is-invalid @enderror"
                                       id="facebook_url" name="facebook_url" value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}"
                                       placeholder="https://facebook.com/votre-page">
                                @error('facebook_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="twitter_url" class="form-label">
                                    <i class="fab fa-twitter"></i> Twitter
                                </label>
                                <input type="url" class="form-control @error('twitter_url') is-invalid @enderror"
                                       id="twitter_url" name="twitter_url" value="{{ old('twitter_url', $settings['twitter_url'] ?? '') }}"
                                       placeholder="https://twitter.com/votre-compte">
                                @error('twitter_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="linkedin_url" class="form-label">
                                    <i class="fab fa-linkedin"></i> LinkedIn
                                </label>
                                <input type="url" class="form-control @error('linkedin_url') is-invalid @enderror"
                                       id="linkedin_url" name="linkedin_url" value="{{ old('linkedin_url', $settings['linkedin_url'] ?? '') }}"
                                       placeholder="https://linkedin.com/company/votre-entreprise">
                                @error('linkedin_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="instagram_url" class="form-label">
                                    <i class="fab fa-instagram"></i> Instagram
                                </label>
                                <input type="url" class="form-control @error('instagram_url') is-invalid @enderror"
                                       id="instagram_url" name="instagram_url" value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}"
                                       placeholder="https://instagram.com/votre-compte">
                                @error('instagram_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Enregistrer les paramètres
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
