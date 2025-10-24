<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $themes = [
            // 1. IEBC Classic - Default theme based on company logo
            [
                'name' => 'iebc-classic',
                'display_name' => 'IEBC Classic',
                'description' => 'Thème officiel IEBC avec les couleurs du logo - Bleu Marine & Or',
                'category' => 'professional',
                'thumbnail' => null,
                'primary_color' => '#1e3a5f', // Navy blue from logo
                'secondary_color' => '#6c757d',
                'accent_color' => '#c9a961', // Gold from logo
                'success_color' => '#198754',
                'warning_color' => '#ffc107',
                'danger_color' => '#dc3545',
                'info_color' => '#0dcaf0',
                'light_color' => '#f8fafc',
                'dark_color' => '#1e293b',
                'font_family' => 'system-ui',
                'heading_font_family' => null,
                'border_radius' => '0.375rem',
                'box_shadow' => '0 2px 10px rgba(0,0,0,0.1)',
                'button_style' => 'rounded',
                'navbar_style' => 'solid',
                'card_style' => 'shadow',
                'is_active' => true,
                'is_default' => true,
                'is_premium' => false,
                'sort_order' => 1,
            ],

            // 2. Golden Elegance - Luxurious gold theme
            [
                'name' => 'golden-elegance',
                'display_name' => 'Élégance Dorée',
                'description' => 'Palette luxueuse or et crème inspirée du logo IEBC',
                'category' => 'elegant',
                'thumbnail' => null,
                'primary_color' => '#c9a961', // Gold from logo
                'secondary_color' => '#8b7355',
                'accent_color' => '#1e3a5f', // Navy as accent
                'success_color' => '#52796f',
                'warning_color' => '#d4a574',
                'danger_color' => '#c1666b',
                'info_color' => '#4a7c9a',
                'light_color' => '#faf8f3',
                'dark_color' => '#2c2416',
                'font_family' => "'Playfair Display', serif",
                'heading_font_family' => "'Playfair Display', serif",
                'border_radius' => '0.5rem',
                'box_shadow' => '0 4px 15px rgba(201,169,97,0.2)',
                'button_style' => 'rounded',
                'navbar_style' => 'gradient',
                'card_style' => 'elevated',
                'is_active' => false,
                'is_default' => false,
                'is_premium' => false,
                'sort_order' => 2,
            ],

            // 3. Ocean Corporate - Professional blue
            [
                'name' => 'ocean-corporate',
                'display_name' => 'Corporate Océan',
                'description' => 'Tons de bleu professionnels avec accents dorés',
                'category' => 'professional',
                'thumbnail' => null,
                'primary_color' => '#1e3a5f', // Navy from logo
                'secondary_color' => '#2c5f8d',
                'accent_color' => '#c9a961', // Gold accent
                'success_color' => '#1d8348',
                'warning_color' => '#d68910',
                'danger_color' => '#b03a2e',
                'info_color' => '#2874a6',
                'light_color' => '#ecf0f5',
                'dark_color' => '#0b1929',
                'font_family' => "'Roboto', sans-serif",
                'heading_font_family' => "'Montserrat', sans-serif",
                'border_radius' => '0.25rem',
                'box_shadow' => '0 3px 12px rgba(30,58,95,0.15)',
                'button_style' => 'sharp',
                'navbar_style' => 'solid',
                'card_style' => 'border',
                'is_active' => false,
                'is_default' => false,
                'is_premium' => false,
                'sort_order' => 3,
            ],

            // 4. Modern Minimal - Clean and minimalist
            [
                'name' => 'modern-minimal',
                'display_name' => 'Moderne Minimaliste',
                'description' => 'Design épuré et minimal avec touches d\'or subtiles',
                'category' => 'minimal',
                'thumbnail' => null,
                'primary_color' => '#2c3e50',
                'secondary_color' => '#95a5a6',
                'accent_color' => '#c9a961', // Gold from logo
                'success_color' => '#27ae60',
                'warning_color' => '#f39c12',
                'danger_color' => '#e74c3c',
                'info_color' => '#3498db',
                'light_color' => '#ffffff',
                'dark_color' => '#1a1a1a',
                'font_family' => "'Inter', sans-serif",
                'heading_font_family' => "'Inter', sans-serif",
                'border_radius' => '0.5rem',
                'box_shadow' => '0 1px 3px rgba(0,0,0,0.1)',
                'button_style' => 'pill',
                'navbar_style' => 'transparent',
                'card_style' => 'flat',
                'is_active' => false,
                'is_default' => false,
                'is_premium' => false,
                'sort_order' => 4,
            ],

            // 5. Royal Prestige - Premium dark theme
            [
                'name' => 'royal-prestige',
                'display_name' => 'Prestige Royal',
                'description' => 'Marine profond avec or riche - look corporate premium',
                'category' => 'elegant',
                'thumbnail' => null,
                'primary_color' => '#0a1929', // Darker navy
                'secondary_color' => '#1e3a5f', // Logo navy
                'accent_color' => '#d4af37', // Richer gold
                'success_color' => '#2e7d32',
                'warning_color' => '#e65100',
                'danger_color' => '#c62828',
                'info_color' => '#01579b',
                'light_color' => '#f5f5f5',
                'dark_color' => '#000000',
                'font_family' => "'Lora', serif",
                'heading_font_family' => "'Merriweather', serif",
                'border_radius' => '0.375rem',
                'box_shadow' => '0 6px 20px rgba(10,25,41,0.25)',
                'button_style' => 'rounded',
                'navbar_style' => 'solid',
                'card_style' => 'elevated',
                'is_active' => false,
                'is_default' => false,
                'is_premium' => true,
                'sort_order' => 5,
            ],

            // 6. NEW: Fresh Green - Eco-friendly business theme
            [
                'name' => 'fresh-green',
                'display_name' => 'Vert Frais',
                'description' => 'Thème écologique avec tons verts naturels et accents dorés',
                'category' => 'vibrant',
                'thumbnail' => null,
                'primary_color' => '#2d6a4f', // Forest green
                'secondary_color' => '#40916c',
                'accent_color' => '#c9a961', // Gold accent
                'success_color' => '#52b788',
                'warning_color' => '#f4a261',
                'danger_color' => '#e76f51',
                'info_color' => '#457b9d',
                'light_color' => '#f1faee',
                'dark_color' => '#1b4332',
                'font_family' => "'Poppins', sans-serif",
                'heading_font_family' => "'Poppins', sans-serif",
                'border_radius' => '0.75rem',
                'box_shadow' => '0 4px 14px rgba(45,106,79,0.15)',
                'button_style' => 'pill',
                'navbar_style' => 'gradient',
                'card_style' => 'shadow',
                'is_active' => false,
                'is_default' => false,
                'is_premium' => false,
                'sort_order' => 6,
            ],

            // 7. NEW: Crimson Professional - Bold and confident
            [
                'name' => 'crimson-professional',
                'display_name' => 'Professionnel Cramoisi',
                'description' => 'Rouge professionnel audacieux avec tons neutres élégants',
                'category' => 'professional',
                'thumbnail' => null,
                'primary_color' => '#991b1b', // Deep red
                'secondary_color' => '#6b7280',
                'accent_color' => '#c9a961', // Gold accent
                'success_color' => '#047857',
                'warning_color' => '#d97706',
                'danger_color' => '#dc2626',
                'info_color' => '#0369a1',
                'light_color' => '#f9fafb',
                'dark_color' => '#111827',
                'font_family' => "'Lato', sans-serif",
                'heading_font_family' => "'Montserrat', sans-serif",
                'border_radius' => '0.375rem',
                'box_shadow' => '0 4px 16px rgba(153,27,27,0.12)',
                'button_style' => 'sharp',
                'navbar_style' => 'solid',
                'card_style' => 'border',
                'is_active' => false,
                'is_default' => false,
                'is_premium' => false,
                'sort_order' => 7,
            ],

            // 8. NEW: Midnight Blue - Modern dark professional
            [
                'name' => 'midnight-blue',
                'display_name' => 'Bleu Minuit',
                'description' => 'Thème sombre élégant avec bleus profonds et accents lumineux',
                'category' => 'modern',
                'thumbnail' => null,
                'primary_color' => '#1e40af', // Royal blue
                'secondary_color' => '#475569',
                'accent_color' => '#fbbf24', // Bright gold
                'success_color' => '#10b981',
                'warning_color' => '#f59e0b',
                'danger_color' => '#ef4444',
                'info_color' => '#06b6d4',
                'light_color' => '#f8fafc',
                'dark_color' => '#0f172a',
                'font_family' => "'Open Sans', sans-serif",
                'heading_font_family' => "'Raleway', sans-serif",
                'border_radius' => '0.5rem',
                'box_shadow' => '0 10px 25px rgba(30,64,175,0.15)',
                'button_style' => 'rounded',
                'navbar_style' => 'gradient',
                'card_style' => 'elevated',
                'is_active' => false,
                'is_default' => false,
                'is_premium' => true,
                'sort_order' => 8,
            ],
        ];

        foreach ($themes as $theme) {
            Theme::updateOrCreate(
                ['name' => $theme['name']],
                $theme
            );
        }

        $this->command->info('✓ 8 professional themes seeded successfully!');
        $this->command->info('  - 5 Existing themes updated');
        $this->command->info('  - 3 New themes added (Fresh Green, Crimson Professional, Midnight Blue)');
    }
}
