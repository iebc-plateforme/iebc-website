<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'site_name',
                'value' => 'IEBC SARL',
                'type' => 'text',
            ],
            [
                'key' => 'site_description',
                'value' => 'International Economics and Business Corporation - Votre partenaire de confiance pour les solutions économiques et commerciales internationales',
                'type' => 'text',
            ],
            [
                'key' => 'seo_keywords',
                'value' => 'IEBC, économie internationale, commerce, business, solutions commerciales, partenariat, services professionnels',
                'type' => 'text',
            ],
            [
                'key' => 'meta_title',
                'value' => 'IEBC SARL - International Economics and Business Corporation',
                'type' => 'text',
            ],
            [
                'key' => 'contact_email',
                'value' => 'contact@iebc-sarl.com',
                'type' => 'text',
            ],
            [
                'key' => 'contact_phone',
                'value' => '+237 XXX XXX XXX',
                'type' => 'text',
            ],
            [
                'key' => 'contact_address',
                'value' => 'Yaoundé, Cameroun',
                'type' => 'text',
            ],
            [
                'key' => 'facebook_url',
                'value' => '',
                'type' => 'text',
            ],
            [
                'key' => 'twitter_url',
                'value' => '',
                'type' => 'text',
            ],
            [
                'key' => 'linkedin_url',
                'value' => '',
                'type' => 'text',
            ],
            [
                'key' => 'instagram_url',
                'value' => '',
                'type' => 'text',
            ],
            [
                'key' => 'google_analytics_id',
                'value' => '',
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
