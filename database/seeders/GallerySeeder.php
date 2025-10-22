<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleries = [
            // Images
            [
                'title' => 'Siège IEBC - Yaoundé',
                'description' => 'Vue du siège social d\'IEBC à Yaoundé, Cameroun. Un espace moderne dédié à l\'excellence et à l\'innovation.',
                'type' => 'image',
                'file_path' => 'gallery/placeholder-office.jpg',
                'category' => 'Bureau',
                'is_featured' => true,
                'order' => 1,
            ],
            [
                'title' => 'Atelier Finance Islamique',
                'description' => 'Atelier de formation sur les principes de la finance islamique organisé par IEBC pour les professionnels du secteur bancaire.',
                'type' => 'image',
                'file_path' => 'gallery/placeholder-workshop.jpg',
                'category' => 'Événements',
                'is_featured' => true,
                'order' => 2,
            ],
            [
                'title' => 'Équipe IEBC en Réunion',
                'description' => 'Notre équipe d\'experts lors d\'une séance de brainstorming pour un projet client en transformation digitale.',
                'type' => 'image',
                'file_path' => 'gallery/placeholder-team.jpg',
                'category' => 'Équipe',
                'is_featured' => true,
                'order' => 3,
            ],
            [
                'title' => 'Conférence CEMAC 2024',
                'description' => 'Participation d\'IEBC à la conférence économique de la CEMAC sur le développement des infrastructures.',
                'type' => 'image',
                'file_path' => 'gallery/placeholder-conference.jpg',
                'category' => 'Événements',
                'is_featured' => false,
                'order' => 4,
            ],
            [
                'title' => 'Projet BTP - Pont Wouri',
                'description' => 'Consultation et accompagnement technique pour le projet de réhabilitation du pont Wouri à Douala.',
                'type' => 'image',
                'file_path' => 'gallery/placeholder-bridge.jpg',
                'category' => 'Projets',
                'is_featured' => false,
                'order' => 5,
            ],
            [
                'title' => 'Formation Transformation Digitale',
                'description' => 'Session de formation sur les outils digitaux pour les PME de la zone CEMAC.',
                'type' => 'image',
                'file_path' => 'gallery/placeholder-training.jpg',
                'category' => 'Formation',
                'is_featured' => false,
                'order' => 6,
            ],
            [
                'title' => 'Partenariat Banque Islamique',
                'description' => 'Signature d\'un accord de partenariat avec une institution bancaire islamique pour le déploiement de produits Sharia-compliant.',
                'type' => 'image',
                'file_path' => 'gallery/placeholder-partnership.jpg',
                'category' => 'Partenariats',
                'is_featured' => false,
                'order' => 7,
            ],
            [
                'title' => 'Mission Terrain - Gabon',
                'description' => 'Mission d\'évaluation de projets d\'infrastructure au Gabon pour le compte de nos clients investisseurs.',
                'type' => 'image',
                'file_path' => 'gallery/placeholder-mission.jpg',
                'category' => 'Projets',
                'is_featured' => false,
                'order' => 8,
            ],

            // Videos
            [
                'title' => 'Présentation IEBC - Finance Islamique',
                'description' => 'Vidéo de présentation de notre expertise en finance islamique et nos solutions pour la zone CEMAC.',
                'type' => 'video',
                'file_path' => 'gallery/placeholder-video1.mp4',
                'category' => 'Présentation',
                'is_featured' => true,
                'order' => 9,
            ],
            [
                'title' => 'Témoignage Client - Import-Export',
                'description' => 'Témoignage d\'un client satisfait sur notre accompagnement dans ses opérations d\'import-export.',
                'type' => 'video',
                'file_path' => 'gallery/placeholder-video2.mp4',
                'category' => 'Témoignages',
                'is_featured' => false,
                'order' => 10,
            ],

            // Documents
            [
                'title' => 'Brochure IEBC 2025',
                'description' => 'Brochure complète présentant nos services, notre expertise et nos réalisations.',
                'type' => 'document',
                'file_path' => 'gallery/placeholder-brochure.pdf',
                'category' => 'Documents',
                'is_featured' => false,
                'order' => 11,
            ],
            [
                'title' => 'Guide Finance Islamique CEMAC',
                'description' => 'Guide pratique sur l\'application des principes de finance islamique dans le contexte de la zone CEMAC.',
                'type' => 'document',
                'file_path' => 'gallery/placeholder-guide.pdf',
                'category' => 'Documents',
                'is_featured' => false,
                'order' => 12,
            ],
        ];

        foreach ($galleries as $item) {
            Gallery::create($item);
        }
    }
}
