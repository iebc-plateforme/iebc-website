# 🏢 IEBC SARL - Site Web Officiel

[![Laravel](https://img.shields.io/badge/Laravel-11.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

> **International Economics and Business Corporation (IEBC)** - Cabinet économique et financier spécialisé dans le déploiement de la finance islamique en zone CEMAC et l'accompagnement des entreprises vers la performance et la transformation digitale.

## 📋 Table des Matières

- [À Propos](#-à-propos)
- [Fonctionnalités](#-fonctionnalités)
- [Technologies](#-technologies)
- [Prérequis](#-prérequis)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Utilisation](#-utilisation)
- [Structure du Projet](#-structure-du-projet)
- [Documentation](#-documentation)
- [Contributions](#-contributions)
- [Licence](#-licence)

## 🎯 À Propos

IEBC SARL est une plateforme web moderne développée pour présenter les services d'un cabinet économique et financier spécialisé dans la finance islamique en zone CEMAC. Le site offre une interface élégante pour les clients et un système de gestion complet pour les administrateurs.

### 🌍 Zone d'Activité
- **Région**: Zone CEMAC (Afrique Centrale)
- **Pays**: Cameroun, Gabon, Congo, Tchad, RCA, Guinée Équatoriale
- **Spécialité**: Finance Islamique & Conseil Économique

## ✨ Fonctionnalités

### 🎨 Frontend Public
- ✅ Page d'accueil moderne avec animations
- ✅ Présentation des services
- ✅ Galerie photos/vidéos
- ✅ Blog avec articles et actualités
- ✅ Page équipe avec profils détaillés
- ✅ Section partenaires
- ✅ Formulaire de contact
- ✅ Design responsive (mobile, tablette, desktop)
- ✅ Support multilingue (Français)
- ✅ SEO optimisé

### 🔐 Espace Administrateur
- ✅ **Dashboard**: Vue d'ensemble avec statistiques
- ✅ **Gestion des Services**: CRUD complet avec validation
- ✅ **Gestion de l'Équipe**: Profils avec réseaux sociaux
- ✅ **Gestion des Articles**: Éditeur riche, catégories, publication
- ✅ **Galerie**: Upload images/vidéos avec catégorisation
- ✅ **Partenaires**: Gestion logos et liens
- ✅ **Messages Contact**: Lecture et gestion
- ✅ **Thèmes**: Personnalisation couleurs et styles
- ✅ **Paramètres**: Configuration du site

### 🎨 Système de Thèmes
- ✅ Gestion de thèmes personnalisables
- ✅ Palette de couleurs complète
- ✅ Sélection de polices
- ✅ Styles de boutons et cartes
- ✅ Prévisualisation en temps réel
- ✅ Activation/désactivation facile
- ✅ 6 thèmes pré-configurés

### 🔒 Authentification Moderne
- ✅ Page de connexion redesignée avec UX/UI moderne
- ✅ Design split-screen professionnel
- ✅ Animations CSS fluides
- ✅ Bouton afficher/masquer mot de passe
- ✅ Logo dynamique depuis la base de données
- ✅ Récupération de mot de passe
- ✅ Protection CSRF

## 🛠 Technologies

### Backend
- **Framework**: Laravel 11.x
- **PHP**: 8.2+
- **Database**: MySQL / MariaDB
- **Authentication**: Laravel Breeze
- **File Storage**: Laravel Storage (local/public)

### Frontend
- **Template**: SB Admin 2 (Customisé)
- **CSS Framework**: Bootstrap 5
- **JavaScript**: Vanilla JS, jQuery
- **Icons**: FontAwesome 6
- **Fonts**: Poppins (Google Fonts)
- **Animations**: CSS Keyframes, Transitions

### Outils de Développement
- **Package Manager**: Composer, NPM
- **Version Control**: Git
- **Task Runner**: Laravel Mix / Vite
- **Code Quality**: PHP CS Fixer

## 📦 Prérequis

Avant de commencer, assurez-vous d'avoir installé:

- **PHP** >= 8.2
- **Composer** >= 2.0
- **MySQL** >= 8.0 ou **MariaDB** >= 10.3
- **Node.js** >= 18.x
- **NPM** >= 9.x

### Extensions PHP Requises
```
- php-ctype
- php-curl
- php-dom
- php-fileinfo
- php-filter
- php-hash
- php-mbstring
- php-openssl
- php-pcre
- php-pdo
- php-pdo_mysql
- php-session
- php-tokenizer
- php-xml
- php-gd (pour manipulation d'images)
```

## 🚀 Installation

### 1. Cloner le Repository
```bash
git clone https://github.com/votre-username/iebc.git
cd iebc
```

### 2. Installer les Dépendances
```bash
# Dépendances PHP
composer install

# Dépendances JavaScript
npm install
```

### 3. Configuration de l'Environnement
```bash
# Copier le fichier d'environnement
copy .env.example .env  # Windows
# ou
cp .env.example .env    # Linux/Mac

# Générer la clé d'application
php artisan key:generate
```

### 4. Configuration de la Base de Données
Modifiez le fichier `.env` avec vos informations de base de données:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=iebc_db
DB_USERNAME=root
DB_PASSWORD=votre_mot_de_passe
```

### 5. Création de la Base de Données
```bash
# Créer la base de données
mysql -u root -p
CREATE DATABASE iebc_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;

# Exécuter les migrations
php artisan migrate

# Peupler la base de données avec les données de démonstration
php artisan db:seed
```

### 6. Créer les Liens Symboliques
```bash
php artisan storage:link
```

### 7. Compiler les Assets
```bash
# Développement
npm run dev

# Production
npm run build
```

### 8. Démarrer le Serveur
```bash
php artisan serve
```

Le site sera accessible à l'adresse: `http://localhost:8000`

## ⚙️ Configuration

### Compte Administrateur par Défaut
Après l'installation, utilisez ces identifiants pour vous connecter:
- **Email**: `admin@iebc-cemac.com`
- **Mot de passe**: `password`

⚠️ **IMPORTANT**: Changez immédiatement le mot de passe après la première connexion!

### Configuration du Mail
Pour activer l'envoi d'emails (formulaire de contact), configurez dans `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=votre_email@gmail.com
MAIL_PASSWORD=votre_mot_de_passe_app
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@iebc-cemac.com
MAIL_FROM_NAME="IEBC SARL"
```

### Configuration des Uploads
Les tailles maximales sont configurables dans les contrôleurs:
- **Images**: 5 MB (services, équipe, posts)
- **Logos**: 2 MB (partenaires)
- **Galerie Images**: 5 MB
- **Galerie Vidéos**: 20 MB

## 📖 Utilisation

### Accès Frontend
- **Page d'accueil**: `http://localhost:8000`
- **Services**: `http://localhost:8000/services`
- **Blog**: `http://localhost:8000/blog`
- **Équipe**: `http://localhost:8000/team`
- **Contact**: `http://localhost:8000/contact`

### Accès Dashboard Admin
- **URL**: `http://localhost:8000/login`
- **Dashboard**: `http://localhost:8000/admin`

### Commandes Artisan Utiles
```bash
# Vider le cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Réexécuter les seeders
php artisan db:seed --class=SettingsSeeder
php artisan db:seed --class=ThemeSeeder

# Créer un nouvel utilisateur admin
php artisan tinker
>>> \App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@example.com',
    'password' => bcrypt('password'),
    'role' => 'admin'
]);
```

## 📁 Structure du Projet

```
iebc/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Contrôleurs admin CRUD
│   │   │   │   ├── GalleryController.php
│   │   │   │   ├── PartnerController.php
│   │   │   │   ├── PostController.php
│   │   │   │   ├── ServiceController.php
│   │   │   │   ├── TeamController.php
│   │   │   │   └── ThemeController.php
│   │   │   ├── ContactController.php
│   │   │   └── SitemapController.php
│   │   └── Middleware/
│   └── Models/
│       ├── Contact.php
│       ├── Gallery.php
│       ├── Partner.php
│       ├── Post.php
│       ├── Service.php
│       ├── Setting.php
│       ├── Team.php
│       ├── Theme.php
│       └── User.php
├── database/
│   ├── migrations/              # Migrations de base de données
│   └── seeders/                 # Seeders avec données de démonstration
│       ├── DatabaseSeeder.php
│       ├── GallerySeeder.php
│       ├── PartnersSeeder.php
│       ├── PostsSeeder.php
│       ├── SettingsSeeder.php
│       ├── TeamsSeeder.php
│       ├── ThemeSeeder.php
│       └── UserSeeder.php
├── public/
│   ├── css/
│   │   └── auth-modern.css     # Styles page de connexion
│   ├── img/                    # Images statiques
│   └── storage/                # Lien symbolique vers storage
├── resources/
│   └── views/
│       ├── admin/              # Vues dashboard admin
│       │   ├── galleries/
│       │   ├── partners/
│       │   ├── posts/
│       │   ├── services/
│       │   ├── teams/
│       │   └── themes/
│       ├── auth/               # Pages d'authentification
│       │   └── login.blade.php # Page de connexion moderne
│       ├── frontend/           # Pages publiques
│       │   ├── blog.blade.php
│       │   ├── contact.blade.php
│       │   ├── services.blade.php
│       │   ├── team.blade.php
│       │   └── gallery.blade.php
│       ├── layouts/
│       │   ├── auth.blade.php  # Layout authentification
│       │   ├── frontend.blade.php
│       │   └── admin/app.blade.php
│       └── welcome.blade.php   # Page d'accueil
├── routes/
│   └── web.php                 # Routes de l'application
├── storage/
│   └── app/
│       └── public/             # Fichiers uploadés
│           ├── galleries/
│           ├── icons/
│           ├── partners/
│           ├── posts/
│           └── teams/
├── .env.example
├── composer.json
├── package.json
└── README.md
```

## 📚 Documentation

### Documentation Technique
- [ENHANCEMENTS_DOCUMENTATION.md](ENHANCEMENTS_DOCUMENTATION.md) - Améliorations générales
- [THEME_MANAGEMENT_DOCUMENTATION.md](THEME_MANAGEMENT_DOCUMENTATION.md) - Système de thèmes
- [TEAM_SOCIAL_MEDIA_FEATURE.md](TEAM_SOCIAL_MEDIA_FEATURE.md) - Réseaux sociaux équipe
- [DASHBOARD_CRUD_TEST_REPORT.md](DASHBOARD_CRUD_TEST_REPORT.md) - Tests CRUD
- [UX_UI_IMPROVEMENT_PROPOSAL.md](UX_UI_IMPROVEMENT_PROPOSAL.md) - Améliorations UX/UI

### Fonctionnalités par Module

#### Gestion des Services
- CRUD complet avec validation
- Upload d'icônes personnalisées
- Génération automatique de slug
- Ordre d'affichage personnalisable
- Activation/désactivation

#### Gestion de l'Équipe
- Profils détaillés avec biographie
- Support de 6 réseaux sociaux (LinkedIn, Twitter, Facebook, Instagram, GitHub, Website)
- Upload de photos professionnelles
- Ordre d'affichage personnalisable

#### Blog & Articles
- Éditeur de contenu riche
- Catégorisation des articles
- Images à la une
- Gestion de la publication
- Système de slug SEO-friendly
- Extraits personnalisables

#### Galerie Multimédia
- Support images et vidéos
- Catégorisation personnalisable
- Images/vidéos en vedette
- Validation des types de fichiers
- Compression automatique

## 🤝 Contributions

Les contributions sont les bienvenues! Pour contribuer:

1. Forkez le projet
2. Créez une branche pour votre fonctionnalité (`git checkout -b feature/AmazingFeature`)
3. Committez vos changements (`git commit -m 'Add some AmazingFeature'`)
4. Poussez vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrez une Pull Request

### Guidelines de Contribution
- Respectez les conventions de code Laravel
- Ajoutez des tests pour les nouvelles fonctionnalités
- Documentez les changements importants
- Utilisez des messages de commit descriptifs

## 🔒 Sécurité

### Bonnes Pratiques Implémentées
- ✅ Protection CSRF sur tous les formulaires
- ✅ Validation côté serveur
- ✅ Hachage sécurisé des mots de passe (bcrypt)
- ✅ Protection contre les injections SQL (Eloquent ORM)
- ✅ Sanitization des uploads de fichiers
- ✅ Middleware d'authentification
- ✅ Gestion d'erreurs avec try-catch

### Signaler une Vulnérabilité
Si vous découvrez une faille de sécurité, veuillez envoyer un email à `security@iebc-cemac.com` plutôt que d'utiliser le système de tickets publics.

## 📝 Changelog

### Version 2.0.0 (24 Octobre 2025)
- ✨ Refonte complète de la page de connexion
- ✨ Système de gestion de thèmes
- ✨ Support réseaux sociaux pour l'équipe
- 🐛 Corrections CRUD avec gestion d'erreurs
- 📚 Documentation technique complète
- 🎨 Animations CSS modernes
- 📱 Amélioration responsive design

### Version 1.0.0 (Précédente)
- 🎉 Lancement initial du site
- ✨ Dashboard administrateur complet
- ✨ Frontend avec toutes les pages
- ✨ Système de blog
- ✨ Galerie multimédia
- ✨ Formulaire de contact

## 📄 Licence

Ce projet est sous licence MIT. Voir le fichier [LICENSE](LICENSE) pour plus de détails.

## 👥 Équipe & Support

### Développé par
**IEBC SARL Development Team**

### Contact
- **Email**: contact@iebc-cemac.com
- **Téléphone**: +237 6 XX XX XX XX
- **Adresse**: Yaoundé, Cameroun - Zone CEMAC
- **Site Web**: [www.iebc-cemac.com](https://www.iebc-cemac.com)

### Réseaux Sociaux
- [Facebook](https://facebook.com/iebc.cemac)
- [Twitter](https://twitter.com/iebc_cemac)
- [LinkedIn](https://linkedin.com/company/iebc-cemac)
- [Instagram](https://instagram.com/iebc.cemac)

---

<div align="center">

**🌟 Si ce projet vous a été utile, n'oubliez pas de lui donner une étoile! 🌟**

Made with ❤️ by IEBC SARL Team

© 2025 IEBC SARL. Tous droits réservés.

</div>
