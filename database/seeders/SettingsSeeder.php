<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Site Information
            [
                'key' => 'site_name',
                'value' => 'IEBC SARL',
                'type' => 'text',
            ],
            [
                'key' => 'company_logo',
                'value' => asset('img/logo.png'),
                'type' => 'text',
            ],
            [
                'key' => 'site_description',
                'value' => 'International Economics and Business Corporation (IEBC) est un cabinet économique et financier spécialisé dans le déploiement de la finance islamique en zone CEMAC et l\'accompagnement des entreprises vers la performance et la transformation digitale.',
                'type' => 'text',
            ],
            [
                'key' => 'meta_title',
                'value' => 'IEBC SARL - Finance Islamique & Conseil Économique en Zone CEMAC',
                'type' => 'text',
            ],
            [
                'key' => 'seo_keywords',
                'value' => 'IEBC, finance islamique, CEMAC, conseil économique, conseil financier, transformation digitale, import-export, BTP, commerce international, économie Cameroun, finance éthique, charia, intermédiation économique',
                'type' => 'text',
            ],

            // Contact Information
            [
                'key' => 'contact_email',
                'value' => 'contact@iebc-cemac.com',
                'type' => 'text',
            ],
            [
                'key' => 'contact_phone',
                'value' => '+237 6 XX XX XX XX',
                'type' => 'text',
            ],
            [
                'key' => 'contact_address',
                'value' => 'Yaoundé, Cameroun - Zone CEMAC',
                'type' => 'text',
            ],

            // Social Media Links
            [
                'key' => 'facebook_url',
                'value' => 'https://facebook.com/iebc.cemac',
                'type' => 'text',
            ],
            [
                'key' => 'twitter_url',
                'value' => 'https://twitter.com/iebc_cemac',
                'type' => 'text',
            ],
            [
                'key' => 'linkedin_url',
                'value' => 'https://linkedin.com/company/iebc-cemac',
                'type' => 'text',
            ],
            [
                'key' => 'instagram_url',
                'value' => 'https://instagram.com/iebc.cemac',
                'type' => 'text',
            ],

            // Analytics
            [
                'key' => 'google_analytics_id',
                'value' => '',
                'type' => 'text',
            ],

            // Theme Customization - Islamic Finance Colors (Green/Teal theme)
            [
                'key' => 'theme_primary_color',
                'value' => '#0f766e', // Teal - Islamic finance color
                'type' => 'text',
            ],
            [
                'key' => 'theme_secondary_color',
                'value' => '#115e59', // Darker teal
                'type' => 'text',
            ],
            [
                'key' => 'theme_accent_color',
                'value' => '#f59e0b', // Amber - for highlights
                'type' => 'text',
            ],
            [
                'key' => 'theme_font_family',
                'value' => "'Poppins', sans-serif",
                'type' => 'text',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value'], 'type' => $setting['type']]
            );
        }
    }
}
