<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class IEBCServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Finance Islamique',
                'slug' => 'finance-islamique',
                'description' => 'Déploiement et accompagnement dans la mise en place de solutions de finance islamique conforme aux principes de la Charia en zone CEMAC. Nous offrons une expertise locale et internationale pour structurer vos opérations financières selon les standards islamiques.',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Conseil Économique et Financier',
                'slug' => 'conseil-economique-et-financier',
                'description' => 'Expertise en stratégie économique, analyse financière et intermédiation économique. Solutions personnalisées pour les entreprises, institutions et investisseurs cherchant à optimiser leur performance économique et financière.',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Transformation Digitale',
                'slug' => 'transformation-digitale',
                'description' => 'Accompagnement des entreprises dans leur processus de transformation digitale. Audit, stratégie digitale, mise en œuvre de solutions innovantes pour améliorer votre compétitivité à l\'ère du numérique.',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Gestion de Projet et Intermédiation',
                'slug' => 'gestion-de-projet-et-intermediation',
                'description' => 'Gestion professionnelle de vos projets de développement et services d\'intermédiation économique. Nous facilitons les relations d\'affaires et assurons le succès de vos initiatives stratégiques.',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Import-Export et Commerce Général',
                'slug' => 'import-export-et-commerce-general',
                'description' => 'Services complets d\'import-export et de commerce général. Nous facilitons vos transactions internationales et vous accompagnons dans le développement de vos activités commerciales transfrontalières.',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'BTP et Construction',
                'slug' => 'btp-et-construction',
                'description' => 'Conseil et intermédiation dans le secteur du BTP (Bâtiment et Travaux Publics). Accompagnement de projets de construction et mise en relation avec des partenaires qualifiés du secteur.',
                'order' => 6,
                'is_active' => true,
            ],
            [
                'title' => 'Informatique et Solutions Digitales',
                'slug' => 'informatique-et-solutions-digitales',
                'description' => 'Conseil en systèmes d\'information, développement de solutions digitales sur-mesure et intégration de technologies innovantes pour moderniser votre infrastructure informatique.',
                'order' => 7,
                'is_active' => true,
            ],
            [
                'title' => 'Communication et Marketing',
                'slug' => 'communication-et-marketing',
                'description' => 'Stratégies de communication corporate, marketing digital et développement de votre image de marque. Accompagnement complet pour renforcer votre présence et votre impact sur le marché.',
                'order' => 8,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
