<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Theme extends Model
{
    protected $fillable = [
        'name',
        'display_name',
        'description',
        'category',
        'thumbnail',
        'primary_color',
        'secondary_color',
        'accent_color',
        'success_color',
        'warning_color',
        'danger_color',
        'info_color',
        'light_color',
        'dark_color',
        'font_family',
        'heading_font_family',
        'border_radius',
        'box_shadow',
        'button_style',
        'navbar_style',
        'card_style',
        'is_active',
        'is_default',
        'is_premium',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_default' => 'boolean',
        'is_premium' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get the active theme
     */
    public static function getActive()
    {
        return Cache::remember('active_theme', 3600, function () {
            return self::where('is_active', true)->first()
                ?? self::where('is_default', true)->first()
                ?? self::first();
        });
    }

    /**
     * Activate this theme
     */
    public function activate()
    {
        // Deactivate all themes
        self::where('is_active', true)->update(['is_active' => false]);

        // Activate this theme
        $this->is_active = true;
        $this->save();

        // Clear cache
        Cache::forget('active_theme');

        return $this;
    }

    /**
     * Get all color variables as CSS custom properties
     */
    public function getCssVariables()
    {
        return [
            '--primary-color' => $this->primary_color,
            '--secondary-color' => $this->secondary_color,
            '--accent-color' => $this->accent_color,
            '--success-color' => $this->success_color,
            '--warning-color' => $this->warning_color,
            '--danger-color' => $this->danger_color,
            '--info-color' => $this->info_color,
            '--light-color' => $this->light_color,
            '--dark-color' => $this->dark_color,
            '--font-family' => $this->font_family,
            '--heading-font-family' => $this->heading_font_family ?? $this->font_family,
            '--border-radius' => $this->border_radius,
            '--box-shadow' => $this->box_shadow,
        ];
    }

    /**
     * Get Bootstrap color mappings
     */
    public function getBootstrapColors()
    {
        return [
            'primary' => $this->primary_color,
            'secondary' => $this->secondary_color,
            'success' => $this->success_color,
            'danger' => $this->danger_color,
            'warning' => $this->warning_color,
            'info' => $this->info_color,
            'light' => $this->light_color,
            'dark' => $this->dark_color,
        ];
    }

    /**
     * Get theme preview as HTML
     */
    public function getPreviewHtml()
    {
        $colors = $this->getBootstrapColors();
        $html = '<div class="theme-preview" style="font-family: ' . $this->font_family . ';">';

        // Header preview
        $html .= '<div style="background: ' . $this->primary_color . '; color: white; padding: 1rem; border-radius: ' . $this->border_radius . ';">';
        $html .= '<h4 style="margin: 0; font-family: ' . ($this->heading_font_family ?? $this->font_family) . ';">Header</h4>';
        $html .= '</div>';

        // Color swatches
        $html .= '<div style="display: flex; gap: 0.5rem; margin-top: 1rem; flex-wrap: wrap;">';
        foreach (['primary', 'secondary', 'accent', 'success'] as $colorName) {
            $colorValue = $this->{$colorName . '_color'};
            $html .= '<div style="width: 50px; height: 50px; background: ' . $colorValue . '; border-radius: ' . $this->border_radius . '; box-shadow: ' . $this->box_shadow . ';" title="' . ucfirst($colorName) . '"></div>';
        }
        $html .= '</div>';

        // Button preview
        $html .= '<div style="margin-top: 1rem;">';
        $html .= '<button style="background: ' . $this->accent_color . '; color: white; border: none; padding: 0.5rem 1rem; border-radius: ' . $this->border_radius . '; box-shadow: ' . $this->box_shadow . '; font-family: ' . $this->font_family . ';">Sample Button</button>';
        $html .= '</div>';

        $html .= '</div>';

        return $html;
    }

    /**
     * Get theme category display name
     */
    public function getCategoryDisplayAttribute()
    {
        $categories = [
            'professional' => 'Professionnel',
            'elegant' => 'Élégant',
            'modern' => 'Moderne',
            'classic' => 'Classique',
            'vibrant' => 'Dynamique',
            'minimal' => 'Minimaliste',
        ];

        return $categories[$this->category] ?? ucfirst($this->category);
    }

    /**
     * Boot method
     */
    protected static function boot()
    {
        parent::boot();

        // Clear cache when theme is updated
        static::saved(function () {
            Cache::forget('active_theme');
        });

        static::deleted(function () {
            Cache::forget('active_theme');
        });
    }
}
