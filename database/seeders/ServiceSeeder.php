<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Conseil en Stratégie d\'Entreprise',
                'description' => 'Accompagnement stratégique pour optimiser votre développement commercial et économique à l\'international.',
                'icon' => null,
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'Commerce International',
                'description' => 'Solutions complètes pour faciliter vos échanges commerciaux à travers le monde avec expertise et efficacité.',
                'icon' => null,
                'is_active' => true,
                'order' => 2,
            ],
            [
                'title' => 'Analyse Économique',
                'description' => 'Études de marché approfondies et analyses économiques pour guider vos décisions d\'investissement.',
                'icon' => null,
                'is_active' => true,
                'order' => 3,
            ],
            [
                'title' => 'Gestion de Projets',
                'description' => 'Planification et gestion complète de vos projets internationaux avec suivi personnalisé.',
                'icon' => null,
                'is_active' => true,
                'order' => 4,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['slug' => Str::slug($service['title'])],
                array_merge($service, ['slug' => Str::slug($service['title'])])
            );
        }
    }
}
