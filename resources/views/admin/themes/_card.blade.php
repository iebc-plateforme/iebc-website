<div class="col-md-6 col-lg-4">
    <div class="card theme-card {{ $theme->is_active ? 'active-theme' : '' }} h-100 shadow-sm">
        <!-- Theme Header -->
        <div class="card-header d-flex justify-content-between align-items-start">
            <div>
                <h5 class="mb-1 fw-bold">
                    {{ $theme->display_name }}
                    @if($theme->is_premium)
                        <span class="premium-badge ms-2">
                            <i class="fas fa-crown"></i>Premium
                        </span>
                    @endif
                </h5>
                <span class="category-badge badge bg-secondary">
                    {{ $theme->category_display }}
                </span>
            </div>
            <div>
                @if($theme->is_active)
                    <span class="badge bg-success">
                        <i class="fas fa-check-circle"></i> Actif
                    </span>
                @endif
                @if($theme->is_default)
                    <span class="badge bg-info ms-1">
                        <i class="fas fa-star"></i> Défaut
                    </span>
                @endif
            </div>
        </div>

        <!-- Theme Preview -->
        <div class="card-body">
            <p class="text-muted small mb-3">{{ $theme->description }}</p>

            <!-- Color Palette Preview -->
            <div class="mb-3">
                <label class="form-label small fw-bold mb-2">
                    <i class="fas fa-palette me-1"></i>Palette de couleurs
                </label>
                <div class="d-flex flex-wrap gap-2">
                    <div class="text-center">
                        <div class="color-swatch"
                             style="background-color: {{ $theme->primary_color }};"
                             title="Primaire: {{ $theme->primary_color }}"></div>
                        <small class="d-block mt-1" style="font-size: 0.7rem;">Primaire</small>
                    </div>
                    <div class="text-center">
                        <div class="color-swatch"
                             style="background-color: {{ $theme->secondary_color }};"
                             title="Secondaire: {{ $theme->secondary_color }}"></div>
                        <small class="d-block mt-1" style="font-size: 0.7rem;">Secondaire</small>
                    </div>
                    <div class="text-center">
                        <div class="color-swatch"
                             style="background-color: {{ $theme->accent_color }};"
                             title="Accent: {{ $theme->accent_color }}"></div>
                        <small class="d-block mt-1" style="font-size: 0.7rem;">Accent</small>
                    </div>
                    <div class="text-center">
                        <div class="color-swatch"
                             style="background-color: {{ $theme->success_color }};"
                             title="Succès: {{ $theme->success_color }}"></div>
                        <small class="d-block mt-1" style="font-size: 0.7rem;">Succès</small>
                    </div>
                </div>
            </div>

            <!-- Typography Preview -->
            <div class="mb-3">
                <label class="form-label small fw-bold mb-2">
                    <i class="fas fa-font me-1"></i>Typographie
                </label>
                <div class="p-3 bg-light rounded" style="font-family: {{ $theme->font_family }};">
                    <div style="font-family: {{ $theme->heading_font_family ?? $theme->font_family }}; font-weight: 600; margin-bottom: 0.5rem;">
                        Titre de démonstration
                    </div>
                    <div style="font-size: 0.9rem; color: #6c757d;">
                        Corps de texte d'exemple
                    </div>
                </div>
            </div>

            <!-- Style Info -->
            <div class="d-flex flex-wrap gap-2 mb-2">
                <span class="badge bg-light text-dark">
                    <i class="fas fa-border-style me-1"></i>{{ ucfirst($theme->button_style ?? 'Standard') }}
                </span>
                <span class="badge bg-light text-dark">
                    <i class="fas fa-layer-group me-1"></i>{{ ucfirst($theme->card_style ?? 'Shadow') }}
                </span>
            </div>
        </div>

        <!-- Theme Actions -->
        <div class="card-footer bg-transparent border-top">
            <div class="theme-actions d-flex gap-2">
                @if(!$theme->is_active)
                    <form action="{{ route('admin.themes.activate', $theme) }}" method="POST" class="flex-fill">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm w-100">
                            <i class="fas fa-check-circle"></i> Activer
                        </button>
                    </form>
                @else
                    <button class="btn btn-success btn-sm flex-fill" disabled>
                        <i class="fas fa-check-circle"></i> Thème Actif
                    </button>
                @endif

                <a href="{{ route('admin.themes.edit', $theme) }}"
                   class="btn btn-primary btn-sm flex-fill"
                   title="Modifier">
                    <i class="fas fa-edit"></i> Modifier
                </a>

                @if(!$theme->is_active && !$theme->is_default)
                    <form action="{{ route('admin.themes.destroy', $theme) }}"
                          method="POST"
                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce thème ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" title="Supprimer">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
