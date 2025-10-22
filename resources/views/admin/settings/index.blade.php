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

                        <!-- Theme customization -->
                        <h5 class="card-title mb-3 mt-4">
                            <i class="fas fa-palette"></i> Personnalisation du Thème
                        </h5>
                        <p class="text-muted small mb-3">Personnalisez les couleurs de votre site web. Ces couleurs seront appliquées sur toutes les pages publiques.</p>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="theme_primary_color" class="form-label">Couleur Principale</label>
                                <div class="input-group">
                                    <input type="color" class="form-control form-control-color @error('theme_primary_color') is-invalid @enderror"
                                           id="theme_primary_color" name="theme_primary_color"
                                           value="{{ old('theme_primary_color', $settings['theme_primary_color'] ?? '#0d6efd') }}">
                                    <span class="input-group-text">{{ old('theme_primary_color', $settings['theme_primary_color'] ?? '#0d6efd') }}</span>
                                </div>
                                @error('theme_primary_color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Utilisée pour les boutons principaux et liens</small>
                            </div>

                            <div class="col-md-4">
                                <label for="theme_secondary_color" class="form-label">Couleur Secondaire</label>
                                <div class="input-group">
                                    <input type="color" class="form-control form-control-color @error('theme_secondary_color') is-invalid @enderror"
                                           id="theme_secondary_color" name="theme_secondary_color"
                                           value="{{ old('theme_secondary_color', $settings['theme_secondary_color'] ?? '#6c757d') }}">
                                    <span class="input-group-text">{{ old('theme_secondary_color', $settings['theme_secondary_color'] ?? '#6c757d') }}</span>
                                </div>
                                @error('theme_secondary_color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Couleur de fond et éléments secondaires</small>
                            </div>

                            <div class="col-md-4">
                                <label for="theme_accent_color" class="form-label">Couleur d'Accent</label>
                                <div class="input-group">
                                    <input type="color" class="form-control form-control-color @error('theme_accent_color') is-invalid @enderror"
                                           id="theme_accent_color" name="theme_accent_color"
                                           value="{{ old('theme_accent_color', $settings['theme_accent_color'] ?? '#198754') }}">
                                    <span class="input-group-text">{{ old('theme_accent_color', $settings['theme_accent_color'] ?? '#198754') }}</span>
                                </div>
                                @error('theme_accent_color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Utilisée pour les highlights et call-to-actions</small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="theme_font_family" class="form-label">Police de caractères</label>
                                <select class="form-select @error('theme_font_family') is-invalid @enderror"
                                        id="theme_font_family" name="theme_font_family">
                                    <option value="system-ui" {{ old('theme_font_family', $settings['theme_font_family'] ?? 'system-ui') == 'system-ui' ? 'selected' : '' }}>Système (Par défaut)</option>
                                    <option value="'Roboto', sans-serif" {{ old('theme_font_family', $settings['theme_font_family'] ?? '') == "'Roboto', sans-serif" ? 'selected' : '' }}>Roboto</option>
                                    <option value="'Open Sans', sans-serif" {{ old('theme_font_family', $settings['theme_font_family'] ?? '') == "'Open Sans', sans-serif" ? 'selected' : '' }}>Open Sans</option>
                                    <option value="'Lato', sans-serif" {{ old('theme_font_family', $settings['theme_font_family'] ?? '') == "'Lato', sans-serif" ? 'selected' : '' }}>Lato</option>
                                    <option value="'Montserrat', sans-serif" {{ old('theme_font_family', $settings['theme_font_family'] ?? '') == "'Montserrat', sans-serif" ? 'selected' : '' }}>Montserrat</option>
                                    <option value="'Poppins', sans-serif" {{ old('theme_font_family', $settings['theme_font_family'] ?? '') == "'Poppins', sans-serif" ? 'selected' : '' }}>Poppins</option>
                                    <option value="Georgia, serif" {{ old('theme_font_family', $settings['theme_font_family'] ?? '') == 'Georgia, serif' ? 'selected' : '' }}>Georgia (Serif)</option>
                                </select>
                                @error('theme_font_family')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Police utilisée sur tout le site web</small>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> <strong>Note:</strong> Les modifications de thème seront visibles immédiatement sur toutes les pages publiques du site après l'enregistrement.
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

@push('scripts')
<script>
    // Update color display text when color picker changes
    document.addEventListener('DOMContentLoaded', function() {
        const colorInputs = ['theme_primary_color', 'theme_secondary_color', 'theme_accent_color'];

        colorInputs.forEach(inputId => {
            const colorPicker = document.getElementById(inputId);
            const displaySpan = colorPicker.nextElementSibling;

            if (colorPicker && displaySpan) {
                colorPicker.addEventListener('input', function() {
                    displaySpan.textContent = this.value;
                });
            }
        });
    });
</script>
@endpush
