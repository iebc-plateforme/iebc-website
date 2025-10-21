<div class="form-group">
    <label for="title">Titre du Service</label>
    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $service->title ?? '') }}" required>
    @error('title')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description', $service->description ?? '') }}</textarea>
    @error('description')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="icon">Icône (Image)</label>
    <input type="file" class="form-control-file" id="icon" name="icon">
    @error('icon')
        <div class="text-danger">{{ $message }}</div>
    @enderror
    @if(isset($service) && $service->icon)
        <div class="mt-2">
            <img src="{{ asset('storage/' . $service->icon) }}" alt="{{ $service->title }}" style="width: 100px; height: 100px; object-fit: cover;">
            <div class="form-check mt-2">
                <input type="checkbox" class="form-check-input" id="remove_icon" name="remove_icon" value="1">
                <label class="form-check-label" for="remove_icon">Supprimer l'icône existante</label>
            </div>
        </div>
    @endif
</div>

<div class="form-group">
    <label for="order">Ordre d'affichage</label>
    <input type="number" class="form-control" id="order" name="order" value="{{ old('order', $service->order ?? 0) }}">
    @error('order')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}>
    <label class="form-check-label" for="is_active">Actif</label>
    @error('is_active')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
