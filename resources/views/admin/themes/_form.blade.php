<div class="row">
    <!-- Basic Information -->
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Informations de base</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom du thème (slug) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           id="name" name="name" value="{{ old('name', $theme->name ?? '') }}"
                           placeholder="ex: my-custom-theme" required>
                    <small class="form-text text-muted">Utilisez des lettres minuscules et tirets uniquement</small>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="display_name" class="form-label">Nom d'affichage <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('display_name') is-invalid @enderror"
                           id="display_name" name="display_name" value="{{ old('display_name', $theme->display_name ?? '') }}"
                           placeholder="Mon Thème Personnalisé" required>
                    @error('display_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror"
                              id="description" name="description" rows="3"
                              placeholder="Description du thème...">{{ old('description', $theme->description ?? '') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="sort_order" class="form-label">Ordre de tri</label>
                    <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                           id="sort_order" name="sort_order" value="{{ old('sort_order', $theme->sort_order ?? 0) }}">
                    @error('sort_order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Typography -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Typographie</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="font_family" class="form-label">Police principale <span class="text-danger">*</span></label>
                    <select class="form-select @error('font_family') is-invalid @enderror"
                            id="font_family" name="font_family" required>
                        <option value="system-ui" {{ old('font_family', $theme->font_family ?? 'system-ui') == 'system-ui' ? 'selected' : '' }}>System UI</option>
                        <option value="'Roboto', sans-serif" {{ old('font_family', $theme->font_family ?? '') == "'Roboto', sans-serif" ? 'selected' : '' }}>Roboto</option>
                        <option value="'Open Sans', sans-serif" {{ old('font_family', $theme->font_family ?? '') == "'Open Sans', sans-serif" ? 'selected' : '' }}>Open Sans</option>
                        <option value="'Lato', sans-serif" {{ old('font_family', $theme->font_family ?? '') == "'Lato', sans-serif" ? 'selected' : '' }}>Lato</option>
                        <option value="'Montserrat', sans-serif" {{ old('font_family', $theme->font_family ?? '') == "'Montserrat', sans-serif" ? 'selected' : '' }}>Montserrat</option>
                        <option value="'Poppins', sans-serif" {{ old('font_family', $theme->font_family ?? '') == "'Poppins', sans-serif" ? 'selected' : '' }}>Poppins</option>
                        <option value="'Inter', sans-serif" {{ old('font_family', $theme->font_family ?? '') == "'Inter', sans-serif" ? 'selected' : '' }}>Inter</option>
                        <option value="'Playfair Display', serif" {{ old('font_family', $theme->font_family ?? '') == "'Playfair Display', serif" ? 'selected' : '' }}>Playfair Display</option>
                        <option value="'Merriweather', serif" {{ old('font_family', $theme->font_family ?? '') == "'Merriweather', serif" ? 'selected' : '' }}>Merriweather</option>
                        <option value="'Lora', serif" {{ old('font_family', $theme->font_family ?? '') == "'Lora', serif" ? 'selected' : '' }}>Lora</option>
                    </select>
                    @error('font_family')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="heading_font_family" class="form-label">Police des titres</label>
                    <select class="form-select @error('heading_font_family') is-invalid @enderror"
                            id="heading_font_family" name="heading_font_family">
                        <option value="">Utiliser la police principale</option>
                        <option value="'Roboto', sans-serif" {{ old('heading_font_family', $theme->heading_font_family ?? '') == "'Roboto', sans-serif" ? 'selected' : '' }}>Roboto</option>
                        <option value="'Montserrat', sans-serif" {{ old('heading_font_family', $theme->heading_font_family ?? '') == "'Montserrat', sans-serif" ? 'selected' : '' }}>Montserrat</option>
                        <option value="'Poppins', sans-serif" {{ old('heading_font_family', $theme->heading_font_family ?? '') == "'Poppins', sans-serif" ? 'selected' : '' }}>Poppins</option>
                        <option value="'Playfair Display', serif" {{ old('heading_font_family', $theme->heading_font_family ?? '') == "'Playfair Display', serif" ? 'selected' : '' }}>Playfair Display</option>
                        <option value="'Merriweather', serif" {{ old('heading_font_family', $theme->heading_font_family ?? '') == "'Merriweather', serif" ? 'selected' : '' }}>Merriweather</option>
                    </select>
                    @error('heading_font_family')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Additional Settings -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Paramètres additionnels</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="border_radius" class="form-label">Rayon des bordures <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('border_radius') is-invalid @enderror"
                           id="border_radius" name="border_radius" value="{{ old('border_radius', $theme->border_radius ?? '0.375rem') }}"
                           placeholder="0.375rem" required>
                    @error('border_radius')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="box_shadow" class="form-label">Ombre des cartes <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('box_shadow') is-invalid @enderror"
                           id="box_shadow" name="box_shadow" value="{{ old('box_shadow', $theme->box_shadow ?? '0 2px 10px rgba(0,0,0,0.1)') }}"
                           placeholder="0 2px 10px rgba(0,0,0,0.1)" required>
                    @error('box_shadow')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Color Palette -->
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Palette de couleurs</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="primary_color" class="form-label">Couleur primaire <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="color" class="form-control form-control-color"
                                   id="primary_color" name="primary_color" value="{{ old('primary_color', $theme->primary_color ?? '#1e3a5f') }}" required>
                            <input type="text" class="form-control" value="{{ old('primary_color', $theme->primary_color ?? '#1e3a5f') }}" readonly>
                        </div>
                        @error('primary_color')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="secondary_color" class="form-label">Couleur secondaire <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="color" class="form-control form-control-color"
                                   id="secondary_color" name="secondary_color" value="{{ old('secondary_color', $theme->secondary_color ?? '#6c757d') }}" required>
                            <input type="text" class="form-control" value="{{ old('secondary_color', $theme->secondary_color ?? '#6c757d') }}" readonly>
                        </div>
                        @error('secondary_color')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="accent_color" class="form-label">Couleur accent <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="color" class="form-control form-control-color"
                                   id="accent_color" name="accent_color" value="{{ old('accent_color', $theme->accent_color ?? '#c9a961') }}" required>
                            <input type="text" class="form-control" value="{{ old('accent_color', $theme->accent_color ?? '#c9a961') }}" readonly>
                        </div>
                        @error('accent_color')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="success_color" class="form-label">Couleur succès <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="color" class="form-control form-control-color"
                                   id="success_color" name="success_color" value="{{ old('success_color', $theme->success_color ?? '#198754') }}" required>
                            <input type="text" class="form-control" value="{{ old('success_color', $theme->success_color ?? '#198754') }}" readonly>
                        </div>
                        @error('success_color')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="warning_color" class="form-label">Couleur avertissement <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="color" class="form-control form-control-color"
                                   id="warning_color" name="warning_color" value="{{ old('warning_color', $theme->warning_color ?? '#ffc107') }}" required>
                            <input type="text" class="form-control" value="{{ old('warning_color', $theme->warning_color ?? '#ffc107') }}" readonly>
                        </div>
                        @error('warning_color')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="danger_color" class="form-label">Couleur danger <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="color" class="form-control form-control-color"
                                   id="danger_color" name="danger_color" value="{{ old('danger_color', $theme->danger_color ?? '#dc3545') }}" required>
                            <input type="text" class="form-control" value="{{ old('danger_color', $theme->danger_color ?? '#dc3545') }}" readonly>
                        </div>
                        @error('danger_color')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="info_color" class="form-label">Couleur info <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="color" class="form-control form-control-color"
                                   id="info_color" name="info_color" value="{{ old('info_color', $theme->info_color ?? '#0dcaf0') }}" required>
                            <input type="text" class="form-control" value="{{ old('info_color', $theme->info_color ?? '#0dcaf0') }}" readonly>
                        </div>
                        @error('info_color')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="light_color" class="form-label">Couleur claire <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="color" class="form-control form-control-color"
                                   id="light_color" name="light_color" value="{{ old('light_color', $theme->light_color ?? '#f8fafc') }}" required>
                            <input type="text" class="form-control" value="{{ old('light_color', $theme->light_color ?? '#f8fafc') }}" readonly>
                        </div>
                        @error('light_color')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="dark_color" class="form-label">Couleur sombre <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="color" class="form-control form-control-color"
                                   id="dark_color" name="dark_color" value="{{ old('dark_color', $theme->dark_color ?? '#1e293b') }}" required>
                            <input type="text" class="form-control" value="{{ old('dark_color', $theme->dark_color ?? '#1e293b') }}" readonly>
                        </div>
                        @error('dark_color')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Sync color picker with text input
document.querySelectorAll('input[type="color"]').forEach(colorInput => {
    const textInput = colorInput.nextElementSibling;

    colorInput.addEventListener('input', function() {
        textInput.value = this.value;
    });
});
</script>
