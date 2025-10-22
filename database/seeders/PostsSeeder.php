<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first admin user or create one
        $user = User::where('role', 'superadmin')->orWhere('role', 'admin')->first();

        if (!$user) {
            $this->command->warn('No admin user found. Please create an admin user first.');
            return;
        }

        $posts = [
            [
                'title' => 'La Finance Islamique en Zone CEMAC : Opportunités et Défis',
                'slug' => 'finance-islamique-cemac-opportunites-defis',
                'excerpt' => 'Analyse approfondie du potentiel de la finance islamique dans les six pays de la CEMAC et les stratégies de déploiement adaptées au contexte régional.',
                'content' => '<h2>Introduction</h2><p>La finance islamique connaît une croissance remarquable en Afrique, et la zone CEMAC ne fait pas exception. Avec une population musulmane importante et une demande croissante pour des solutions financières conformes à la Charia, la région présente un potentiel énorme pour le développement de la finance éthique.</p>

<h3>Le Marché de la Finance Islamique en CEMAC</h3><p>Les six pays de la CEMAC (Cameroun, Centrafrique, Congo, Gabon, Guinée équatoriale, Tchad) représentent un marché de plus de 50 millions d\'habitants, dont une proportion significative est musulmane. La demande pour des produits financiers halal est en constante augmentation, notamment dans les secteurs suivants :</p>

<ul>
<li><strong>Financement immobilier</strong> : La Mourabaha et l\'Ijara sont particulièrement adaptées</li>
<li><strong>Financement des PME</strong> : La Moucharaka permet un partage équitable des risques</li>
<li><strong>Investissements</strong> : Les Sukuk offrent des alternatives aux obligations conventionnelles</li>
<li><strong>Assurance Takaful</strong> : Une alternative éthique à l\'assurance conventionnelle</li>
</ul>

<h3>Les Défis à Surmonter</h3><p>Malgré le potentiel, plusieurs défis doivent être relevés pour permettre l\'essor de la finance islamique dans la région :</p>

<ol>
<li><strong>Cadre réglementaire</strong> : Nécessité d\'adapter les législations bancaires</li>
<li><strong>Formation</strong> : Manque de professionnels formés à la finance islamique</li>
<li><strong>Sensibilisation</strong> : Besoin d\'éduquer le public et les décideurs</li>
<li><strong>Infrastructure</strong> : Mise en place de Sharia Boards et d\'institutions de supervision</li>
</ol>

<h3>Nos Solutions IEBC</h3><p>Chez IEBC, nous accompagnons les institutions financières, les entreprises et les gouvernements dans le déploiement de solutions de finance islamique adaptées au contexte CEMAC. Notre expertise combine connaissance internationale et compréhension locale pour garantir le succès de vos projets.</p>',
                'category' => 'Finance Islamique',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(5),
            ],
            [
                'title' => 'Transformation Digitale : Un Impératif pour les Entreprises Africaines',
                'slug' => 'transformation-digitale-imperatif-entreprises-africaines',
                'excerpt' => 'Comment la transformation digitale peut propulser la compétitivité des entreprises en Afrique Centrale et les étapes clés pour réussir cette transition.',
                'content' => '<h2>L\'Ère Digitale en Afrique Centrale</h2><p>La transformation digitale n\'est plus une option mais une nécessité pour les entreprises qui souhaitent rester compétitives dans l\'économie moderne. En zone CEMAC, la digitalisation offre des opportunités exceptionnelles de croissance et d\'innovation.</p>

<h3>Les Piliers de la Transformation Digitale</h3><p>Une transformation digitale réussie repose sur quatre piliers essentiels :</p>

<ol>
<li><strong>Infrastructure Technologique</strong> : Cloud computing, cybersécurité, connectivité</li>
<li><strong>Processus Métier</strong> : Automatisation, optimisation, agilité</li>
<li><strong>Compétences Humaines</strong> : Formation, change management, culture digitale</li>
<li><strong>Expérience Client</strong> : Omnicanal, personnalisation, self-service</li>
</ol>

<h3>Cas d\'Usage en Zone CEMAC</h3><p>Nos interventions ont démontré l\'impact concret de la digitalisation :</p>

<ul>
<li><strong>Secteur Bancaire</strong> : Réduction de 40% des coûts opérationnels grâce au mobile banking</li>
<li><strong>Commerce</strong> : Augmentation de 60% du chiffre d\'affaires via l\'e-commerce</li>
<li><strong>Santé</strong> : Amélioration de l\'accès aux soins grâce à la télémédecine</li>
<li><strong>Agriculture</strong> : Optimisation des rendements avec l\'agriculture de précision</li>
</ul>

<h3>Notre Méthodologie</h3><p>IEBC accompagne les entreprises à travers une approche structurée en 5 étapes : audit digital, définition de la stratégie, développement de solutions, formation des équipes, et suivi de la performance.</p>',
                'category' => 'Transformation Digitale',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(12),
            ],
            [
                'title' => 'Import-Export en Zone CEMAC : Guide Pratique 2025',
                'slug' => 'import-export-cemac-guide-pratique-2025',
                'excerpt' => 'Tout ce que vous devez savoir pour réussir vos opérations d\'import-export dans les pays de la CEMAC : réglementations, procédures et opportunités.',
                'content' => '<h2>Le Commerce International en CEMAC</h2><p>La zone CEMAC offre d\'importantes opportunités commerciales grâce à son intégration économique et sa position stratégique en Afrique Centrale. Voici notre guide complet pour réussir vos opérations d\'import-export.</p>

<h3>Réglementations Douanières</h3><p>La CEMAC a harmonisé ses procédures douanières avec le Tarif Extérieur Commun (TEC) :</p>

<ul>
<li>Catégorie 1 (0%) : Biens sociaux essentiels</li>
<li>Catégorie 2 (5%) : Matières premières</li>
<li>Catégorie 3 (10%) : Biens intermédiaires</li>
<li>Catégorie 4 (20%) : Biens de consommation</li>
<li>Catégorie 5 (30%) : Biens spécifiques</li>
</ul>

<h3>Documents Requis</h3><p>Pour importer dans la zone CEMAC, vous aurez besoin de :</p>

<ol>
<li>Facture commerciale</li>
<li>Connaissement ou LTA</li>
<li>Certificat d\'origine</li>
<li>Liste de colisage</li>
<li>Attestation de vérification (selon le pays)</li>
<li>Licence d\'importation (produits réglementés)</li>
</ol>

<h3>Opportunités Sectorielles</h3><p>Les secteurs porteurs pour l\'import-export en CEMAC :</p>

<ul>
<li><strong>Agroalimentaire</strong> : Forte demande en produits transformés</li>
<li><strong>Équipements</strong> : Machines industrielles et matériels BTP</li>
<li><strong>Technologie</strong> : Matériel informatique et télécommunications</li>
<li><strong>Énergie</strong> : Équipements pour les projets d\'infrastructure</li>
</ul>

<h3>Services IEBC</h3><p>Nous facilitons vos opérations d\'import-export en vous accompagnant sur tous les aspects : sourcing fournisseurs, négociation commerciale, gestion documentaire, logistique et dédouanement.</p>',
                'category' => 'Commerce International',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(18),
            ],
            [
                'title' => 'BTP en Afrique Centrale : Boom des Infrastructures',
                'slug' => 'btp-afrique-centrale-boom-infrastructures',
                'excerpt' => 'Analyse du secteur du BTP en zone CEMAC et des opportunités d\'investissement dans les projets d\'infrastructure.',
                'content' => '<h2>Le Secteur du BTP en Pleine Expansion</h2><p>L\'Afrique Centrale connaît un boom sans précédent dans le secteur du BTP, porté par les investissements massifs dans les infrastructures routières, énergétiques et urbaines.</p>

<h3>Projets Majeurs en Cours</h3><p>Les grands projets qui transforment la région :</p>

<ul>
<li><strong>Route Yaoundé-Douala</strong> : Modernisation de l\'axe économique principal du Cameroun</li>
<li><strong>Barrage de Chollet</strong> : Projet hydroélectrique de 600 MW au Gabon</li>
<li><strong>Port en Eau Profonde de Kribi</strong> : Extension des capacités portuaires</li>
<li><strong>Aéroport de Kinshasa</strong> : Modernisation des infrastructures aéroportuaires</li>
</ul>

<h3>Opportunités d\'Investissement</h3><p>Le marché du BTP en CEMAC offre des opportunités dans plusieurs segments :</p>

<ol>
<li><strong>Logement Social</strong> : Déficit de 2 millions d\'unités dans la région</li>
<li><strong>Routes et Ponts</strong> : 15 000 km de routes à construire ou réhabiliter</li>
<li><strong>Énergie</strong> : Projets hydroélectriques et centrales solaires</li>
<li><strong>Eau et Assainissement</strong> : Infrastructures hydrauliques urbaines</li>
</ol>

<h3>Défis et Solutions</h3><p>Les principaux défis du secteur incluent le financement des projets, la disponibilité de main-d\'œuvre qualifiée, et la logistique des matériaux. IEBC apporte son expertise en montage financier, gestion de projet et coordination avec les parties prenantes.</p>',
                'category' => 'BTP & Infrastructure',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(25),
            ],
            [
                'title' => 'Investir en Zone CEMAC : Opportunités et Stratégies',
                'slug' => 'investir-zone-cemac-opportunites-strategies',
                'excerpt' => 'Guide complet pour les investisseurs souhaitant s\'implanter ou développer leurs activités dans les pays de la CEMAC.',
                'content' => '<h2>Pourquoi Investir en Zone CEMAC ?</h2><p>La zone CEMAC présente des atouts majeurs pour les investisseurs : stabilité monétaire avec le Franc CFA, richesse en ressources naturelles, croissance démographique, et position géographique stratégique.</p>

<h3>Environnement des Affaires</h3><p>Améliorations récentes dans les six pays membres :</p>

<ul>
<li>Simplification des procédures de création d\'entreprise</li>
<li>Guichets uniques pour les investisseurs</li>
<li>Zones économiques spéciales avec incitations fiscales</li>
<li>Protection renforcée de la propriété intellectuelle</li>
</ul>

<h3>Secteurs Porteurs</h3><p>Les opportunités d\'investissement les plus prometteuses :</p>

<ol>
<li><strong>Agriculture et Agro-industrie</strong> : Transformation locale des produits</li>
<li><strong>Énergie Renouvelable</strong> : Solaire et hydroélectricité</li>
<li><strong>Services Financiers</strong> : Fintech et microfinance</li>
<li><strong>Tourisme</strong> : Écotourisme et tourisme d\'affaires</li>
<li><strong>Éducation et Santé</strong> : Établissements privés de qualité</li>
</ol>

<h3>Incitations Fiscales</h3><p>Les gouvernements CEMAC offrent diverses incitations :</p>

<ul>
<li>Exonération de droits de douane sur équipements</li>
<li>Réduction d\'impôt sur les bénéfices (jusqu\'à 5 ans)</li>
<li>Crédit d\'impôt pour la formation</li>
<li>Zones franches avec régime fiscal préférentiel</li>
</ul>

<h3>Notre Accompagnement</h3><p>IEBC guide les investisseurs à travers toutes les étapes : étude de faisabilité, recherche de partenaires locaux, montage juridique et financier, et suivi post-installation.</p>',
                'category' => 'Investissement',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(30),
            ],
            [
                'title' => 'Les Principes de la Finance Éthique et Islamique',
                'slug' => 'principes-finance-ethique-islamique',
                'excerpt' => 'Découvrez les fondements de la finance islamique et comment elle promeut une économie plus juste et inclusive.',
                'content' => '<h2>Qu\'est-ce que la Finance Islamique ?</h2><p>La finance islamique est un système financier basé sur les principes de la Charia (loi islamique) qui promeut l\'équité, la transparence et le partage des risques. Elle interdit l\'intérêt (Riba), la spéculation excessive (Gharar) et les investissements dans des activités illicites (Haram).</p>

<h3>Les Cinq Principes Fondamentaux</h3>

<ol>
<li><strong>Interdiction du Riba (Intérêt)</strong> : L\'argent ne peut générer de l\'argent par lui-même</li>
<li><strong>Interdiction du Gharar (Incertitude)</strong> : Les contrats doivent être clairs et transparents</li>
<li><strong>Interdiction du Maysir (Spéculation)</strong> : Pas de jeux de hasard ou paris</li>
<li><strong>Partage des Profits et Pertes</strong> : Équité dans la répartition des résultats</li>
<li><strong>Adossement à l\'Actif Réel</strong> : Toute transaction doit être liée à un actif tangible</li>
</ol>

<h3>Instruments de Finance Islamique</h3>

<ul>
<li><strong>Mourabaha</strong> : Vente avec marge bénéficiaire connue</li>
<li><strong>Ijara</strong> : Crédit-bail islamique</li>
<li><strong>Moucharaka</strong> : Partenariat avec partage des profits</li>
<li><strong>Moudaraba</strong> : Contrat de participation</li>
<li><strong>Sukuk</strong> : Obligations islamiques adossées à des actifs</li>
<li><strong>Takaful</strong> : Assurance mutuelle islamique</li>
</ul>

<h3>Avantages pour l\'Économie</h3><p>La finance islamique contribue au développement durable en :</p>

<ul>
<li>Favorisant l\'économie réelle plutôt que la spéculation</li>
<li>Encourageant les investissements productifs</li>
<li>Promouvant l\'inclusion financière</li>
<li>Respectant les critères ESG (Environnement, Social, Gouvernance)</li>
</ul>',
                'category' => 'Finance Islamique',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(40),
            ],
        ];

        foreach ($posts as $post) {
            $post['user_id'] = $user->id;
            Post::create($post);
        }

        $this->command->info('Created ' . count($posts) . ' blog posts successfully!');
    }
}
