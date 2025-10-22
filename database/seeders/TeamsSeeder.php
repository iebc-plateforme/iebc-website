<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = [
            [
                'name' => 'Dr. Amadou Ibrahim',
                'slug' => 'dr-amadou-ibrahim',
                'role' => 'Expert Finance Islamique',
                'position' => 'Directeur Général',
                'bio' => 'Expert international en finance islamique avec plus de 15 ans d\'expérience dans le déploiement de solutions conformes à la Charia en Afrique. Titulaire d\'un doctorat en économie islamique, Dr. Ibrahim a conseillé plusieurs institutions bancaires et gouvernements de la zone CEMAC sur la mise en place de systèmes financiers éthiques.',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Fatima Ndiaye',
                'slug' => 'fatima-ndiaye',
                'role' => 'Consultante Senior',
                'position' => 'Directrice Conseil Économique',
                'bio' => 'Spécialiste en stratégie économique et développement des affaires avec 12 ans d\'expérience dans l\'accompagnement des PME et grandes entreprises en Afrique Centrale. Diplômée HEC Paris, Fatima pilote les missions de conseil économique et d\'intermédiation commerciale du cabinet.',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'Jean-Paul Essomba',
                'slug' => 'jean-paul-essomba',
                'role' => 'Expert BTP & Infrastructure',
                'position' => 'Directeur Projets & BTP',
                'bio' => 'Ingénieur civil avec 18 ans d\'expérience dans la gestion de grands projets d\'infrastructure en zone CEMAC. Jean-Paul coordonne nos activités dans le secteur du BTP et assure le suivi des projets de construction et travaux publics pour nos clients.',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'name' => 'Sarah Moussa',
                'slug' => 'sarah-moussa',
                'role' => 'Experte Transformation Digitale',
                'position' => 'Directrice Innovation & Digital',
                'bio' => 'Spécialiste en transformation digitale et systèmes d\'information avec 10 ans d\'expérience dans l\'accompagnement des entreprises africaines vers l\'ère numérique. Sarah dirige notre pôle digital et développe des solutions innovantes adaptées au contexte CEMAC.',
                'is_active' => true,
                'order' => 4,
            ],
            [
                'name' => 'Mohamed Abdoulaye',
                'slug' => 'mohamed-abdoulaye',
                'role' => 'Analyste Financier Senior',
                'position' => 'Responsable Études & Analyses',
                'bio' => 'Analyste financier certifié CFA avec une expertise pointue en évaluation de projets et analyse de risques. Mohamed coordonne les études économiques et financières du cabinet et accompagne nos clients dans leurs décisions d\'investissement.',
                'is_active' => true,
                'order' => 5,
            ],
            [
                'name' => 'Aïcha Mahamat',
                'slug' => 'aicha-mahamat',
                'role' => 'Consultante Import-Export',
                'position' => 'Responsable Commerce International',
                'bio' => 'Experte en commerce international et logistique avec 8 ans d\'expérience dans la facilitation des échanges commerciaux transfrontaliers. Aïcha accompagne nos clients dans leurs opérations d\'import-export et de commerce général.',
                'is_active' => true,
                'order' => 6,
            ],
            [
                'name' => 'Pierre Ngono',
                'slug' => 'pierre-ngono',
                'role' => 'Consultant Marketing',
                'position' => 'Responsable Communication & Marketing',
                'bio' => 'Spécialiste en communication corporate et marketing digital avec 7 ans d\'expérience. Pierre développe les stratégies de communication et de positionnement de marque pour nos clients souhaitant renforcer leur présence sur le marché CEMAC.',
                'is_active' => true,
                'order' => 7,
            ],
            [
                'name' => 'Mariam Touré',
                'slug' => 'mariam-toure',
                'role' => 'Juriste d\'Affaires',
                'position' => 'Conseillère Juridique',
                'bio' => 'Avocate spécialisée en droit des affaires et droit bancaire islamique. Mariam assure la conformité juridique de nos opérations et conseille nos clients sur les aspects réglementaires de la finance islamique et du commerce international.',
                'is_active' => true,
                'order' => 8,
            ],
        ];

        foreach ($teams as $member) {
            Team::create($member);
        }
    }
}
