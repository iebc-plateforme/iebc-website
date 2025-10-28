@props(['src', 'alt' => '', 'class' => '', 'fallback' => 'img/placeholder.png'])

<img src="{{ image_url($src, $fallback) }}" alt="{{ $alt }}" class="{{ $class }}" {{ $attributes }}>
