<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PartnersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partners = [
            [
                'name' => 'Banque Islamique du Cameroun',
                'slug' => 'banque-islamique-du-cameroun',
                'description' => 'Institution bancaire islamique leader en zone CEMAC, partenaire stratégique pour nos solutions de finance conforme à la Charia.',
                'website' => 'https://www.bicec.com',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Islamic Development Bank',
                'slug' => 'islamic-development-bank',
                'description' => 'Banque multilatérale de développement œuvrant pour le progrès économique et social des pays membres et des communautés musulmanes.',
                'website' => 'https://www.isdb.org',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'CEMAC - Commission',
                'slug' => 'cemac-commission',
                'description' => 'Communauté Économique et Monétaire de l\'Afrique Centrale - Institution d\'intégration régionale.',
                'website' => 'https://www.cemac.int',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'name' => 'BEAC - Banque des États de l\'Afrique Centrale',
                'slug' => 'beac',
                'description' => 'Banque centrale des États de la CEMAC, partenaire institutionnel pour les régulations financières.',
                'website' => 'https://www.beac.int',
                'is_active' => true,
                'order' => 4,
            ],
            [
                'name' => 'Afriland First Bank',
                'slug' => 'afriland-first-bank',
                'description' => 'Groupe bancaire panafricain partenaire pour les solutions d\'import-export et de commerce international.',
                'website' => 'https://www.afrilandfirstbank.com',
                'is_active' => true,
                'order' => 5,
            ],
            [
                'name' => 'Société Générale Cameroun',
                'slug' => 'societe-generale-cameroun',
                'description' => 'Institution bancaire internationale, partenaire pour les solutions de financement des entreprises.',
                'website' => 'https://www.societegenerale.cm',
                'is_active' => true,
                'order' => 6,
            ],
            [
                'name' => 'GICAM - Groupement Inter-patronal du Cameroun',
                'slug' => 'gicam',
                'description' => 'Organisation patronale camerounaise, partenaire pour l\'accompagnement des entreprises.',
                'website' => 'https://www.gicam.cm',
                'is_active' => true,
                'order' => 7,
            ],
            [
                'name' => 'Chambre de Commerce du Cameroun',
                'slug' => 'chambre-commerce-cameroun',
                'description' => 'Institution d\'appui au commerce et à l\'investissement au Cameroun.',
                'website' => 'https://www.ccima.cm',
                'is_active' => true,
                'order' => 8,
            ],
            [
                'name' => 'African Development Bank',
                'slug' => 'african-development-bank',
                'description' => 'Banque multilatérale de développement dédiée à la croissance économique et au progrès social en Afrique.',
                'website' => 'https://www.afdb.org',
                'is_active' => true,
                'order' => 9,
            ],
            [
                'name' => 'Microsoft Afrique Centrale',
                'slug' => 'microsoft-afrique-centrale',
                'description' => 'Partenaire technologique pour nos solutions de transformation digitale.',
                'website' => 'https://www.microsoft.com',
                'is_active' => true,
                'order' => 10,
            ],
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }
    }
}
