# 🚀 Guide de Déploiement Laravel IEBC - Hostinger 2025

**Projet** : Site Web IEBC SARL  
**Framework** : Laravel 12.3.0  
**Domaine** : https://iebccorporation.com  
**Dernière mise à jour** : 25 octobre 2025  
**Statut** : ✅ Structure nettoyée et prête pour la production

---

## 📋 Table des matières

1. [Liste de vérification pré-déploiement](#liste-de-vérification-pré-déploiement)
2. [Vérification de la structure du projet](#vérification-de-la-structure-du-projet)
3. [Configuration Hostinger](#configuration-hostinger)
4. [Méthodes de téléchargement de fichiers](#méthodes-de-téléchargement-de-fichiers)
5. [Configuration du serveur](#configuration-du-serveur)
6. [Configuration de la base de données](#configuration-de-la-base-de-données)
7. [Étapes post-déploiement](#étapes-post-déploiement)
8. [Dépannage](#dépannage)
9. [Optimisation](#optimisation)

---

## ✅ Liste de vérification pré-déploiement

### Vérification de l'environnement local

- [x] **Structure du projet** : Nettoyée (25 oct. 2025)
  - [x] Pas d'`index.php` à la racine
  - [x] Pas de `.htaccess` à la racine
  - [x] Pas de dossiers `css/`, `js/`, `img/` dupliqués à la racine
  - [x] Tous les fichiers statiques dans le dossier `public/`
  - [x] `public/index.php` est le seul point d'entrée

- [ ] **Configuration de l'environnement**
  - [ ] `.env.example` mis à jour avec les paramètres de production
  - [ ] `.env` contient les paramètres de développement local
  - [ ] Les identifiants de la base de données sont corrects localement
  - [ ] `APP_KEY` est généré

- [ ] **Dépendances**
  - [ ] Exécuter `composer install --no-dev --optimize-autoloader`
  - [ ] Tous les packages sont à jour
  - [ ] Pas de dépendances de développement en production

- [ ] **Base de données**
  - [ ] Toutes les migrations testées localement
  - [ ] Les seeders fonctionnent sans erreurs
  - [ ] Sauvegarde de la base de données créée

- [ ] **Ressources**
  - [ ] Le fichier logo existe : `public/img/logo.png`
  - [ ] Le favicon existe : `public/favicon.ico`
  - [ ] Tous les fichiers CSS/JS sont dans le dossier `public/`

- [ ] **Git**
  - [ ] Tous les changements sont committés
  - [ ] `.gitignore` inclut `.env`
  - [ ] Le dépôt est propre

---

## 🔍 Vérification de la structure du projet

Votre projet a maintenant la structure **CORRECTE** de Laravel 9+ :

```
iebc/
├── app/                          # Logique applicative
├── bootstrap/
│   ├── app.php                   # Bootstrap de l'application
│   └── cache/                    # Cache de bootstrap
├── config/                       # Fichiers de configuration
├── database/
│   ├── migrations/               # Migrations de base de données
│   ├── seeders/                  # Seeders de base de données
│   └── factories/                # Factories de modèles
├── public/                       # ⭐ RACINE WEB - SEUL DOSSIER ACCESSIBLE PUBLIQUEMENT
│   ├── .htaccess                 # Règles de réécriture Apache
│   ├── index.php                 # ⭐ Point d'entrée de l'application
│   ├── favicon.ico               # Favicon du site
│   ├── robots.txt                # Fichier robots SEO
│   ├── css/                      # CSS compilé
│   ├── js/                       # JavaScript compilé
│   ├── img/                      # Images statiques
│   │   └── logo.png              # Logo de l'entreprise
│   ├── vendor/                   # Bibliothèques vendor frontend
│   └── storage/                  # ⚠️ LIEN SYMBOLIQUE vers ../storage/app/public
├── resources/
│   ├── views/                    # Templates Blade
│   ├── css/                      # CSS source (si utilisé)
│   └── js/                       # JS source (si utilisé)
├── routes/
│   ├── web.php                   # Routes web
│   ├── api.php                   # Routes API
│   └── console.php               # Routes console
├── storage/
│   ├── app/
│   │   └── public/               # Fichiers uploadés par les utilisateurs (cible du lien symbolique)
│   │       ├── teams/
│   │       ├── posts/
│   │       ├── galleries/
│   │       └── partners/
│   ├── framework/
│   │   ├── cache/
│   │   ├── sessions/
│   │   └── views/                # Vues Blade compilées
│   └── logs/
│       └── laravel.log           # Logs de l'application
├── vendor/                       # Dépendances Composer
├── .env                          # Configuration d'environnement (PAS dans git)
├── .env.example                  # Fichier d'environnement exemple
├── .env.hostinger.example        # Exemple spécifique Hostinger
├── artisan                       # Outil CLI
├── composer.json                 # Dépendances Composer
├── composer.lock                 # Versions de dépendances verrouillées
└── server.php                    # Routeur du serveur PHP intégré
```

---

## 🌐 Configuration Hostinger

### Étape 1 : Accéder au panneau de contrôle Hostinger

1. Allez sur [hpanel.hostinger.com](https://hpanel.hostinger.com)
2. Connectez-vous avec vos identifiants
3. Sélectionnez votre plan d'hébergement
4. Trouvez le domaine **iebccorporation.com**

### Étape 2 : Préparer l'environnement d'hébergement

#### Activer l'accès SSH (FORTEMENT RECOMMANDÉ)

1. Dans hPanel, allez dans **Avancé** → **Accès SSH**
2. Activez SSH s'il n'est pas déjà activé
3. Notez vos identifiants SSH :
   - **Hôte** : iebccorporation.com (ou adresse IP)
   - **Port** : 22 (habituellement)
   - **Nom d'utilisateur** : `u123456789` (exemple)
   - **Mot de passe** : Votre mot de passe d'hébergement

#### Vérifier la version PHP

1. Allez dans **Avancé** → **Configuration PHP**
2. Assurez-vous que la version PHP est **8.2** ou supérieure
3. Activez les extensions requises :
   - ✅ mysqli
   - ✅ pdo_mysql
   - ✅ mbstring
   - ✅ openssl
   - ✅ tokenizer
   - ✅ xml
   - ✅ ctype
   - ✅ json
   - ✅ fileinfo

---

## 📤 Méthodes de téléchargement de fichiers

### Méthode 1 : Déploiement Git (RECOMMANDÉ)

#### A. Configurer Git sur Hostinger

```bash
# Se connecter via SSH
ssh u123456789@iebccorporation.com

# Naviguer vers le répertoire personnel
cd ~

# Cloner votre dépôt
git clone https://github.com/votre-nom-utilisateur/iebc.git iebc-laravel

# Créer un lien symbolique de public_html vers le dossier public
rm -rf domains/iebccorporation.com/public_html
ln -s ~/iebc-laravel/public ~/domains/iebccorporation.com/public_html
```

#### B. Script de déploiement automatique

Créez `deploy.sh` dans votre projet :

```bash
#!/bin/bash
# deploy.sh - Script de déploiement automatique

echo "🚀 Démarrage du déploiement..."

# Récupérer les dernières modifications
git pull origin main

# Installer/mettre à jour les dépendances
composer install --no-dev --optimize-autoloader --no-interaction

# Vider les caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Exécuter les migrations
php artisan migrate --force

# Créer le lien storage s'il n'existe pas
php artisan storage:link

# Optimiser pour la production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Définir les permissions
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage/app/public

echo "✅ Déploiement terminé !"
```

Rendre exécutable : `chmod +x deploy.sh`

### Méthode 2 : Téléchargement FTP/Gestionnaire de fichiers

#### Utilisation de FileZilla ou du gestionnaire de fichiers Hostinger

1. **Se connecter via FTP** :
   - Hôte : ftp.iebccorporation.com
   - Nom d'utilisateur : Votre nom d'utilisateur FTP Hostinger
   - Mot de passe : Votre mot de passe FTP
   - Port : 21

2. **Structure de téléchargement** :
   ```
   /domains/iebccorporation.com/
   ├── iebc/                    # Télécharger tout le projet Laravel ici
   │   ├── app/
   │   ├── bootstrap/
   │   ├── config/
   │   ├── database/
   │   ├── public/              # Ceci sera lié
   │   ├── resources/
   │   ├── routes/
   │   ├── storage/
   │   ├── vendor/              # Télécharger ou exécuter composer install
   │   ├── .env                 # Créer à partir de .env.hostinger.example
   │   └── artisan
   └── public_html -> iebc/public  # Lien symbolique ou copier le contenu
   ```

3. **Option A : Lien symbolique** (Préféré - via SSH)
   ```bash
   cd ~/domains/iebccorporation.com
   rm -rf public_html
   ln -s ~/iebc/public public_html
   ```

4. **Option B : Copier le contenu** (Si pas de SSH)
   - Copier TOUT le contenu de `iebc/public/` vers `public_html/`
   - **Important** : Garder le reste des fichiers Laravel EN DEHORS de `public_html/`

### Méthode 3 : Téléchargement d'archive compressée

```bash
# Sur la machine locale
tar -czf iebc-deploy.tar.gz --exclude='.git' --exclude='node_modules' --exclude='.env' .

# Télécharger sur Hostinger via le gestionnaire de fichiers ou FTP

# Sur Hostinger (SSH)
cd ~/
tar -xzf iebc-deploy.tar.gz -C iebc/
cd iebc
```

---

## ⚙️ Configuration du serveur

### Étape 1 : Configuration de l'environnement

Créez le fichier `.env` à la racine du projet (PAS dans public_html) :

```env
# Copier depuis .env.hostinger.example et mettre à jour :

APP_NAME="IEBC SARL"
APP_ENV=production
APP_KEY=base64:VOTRE_CLE_APP_ICI
APP_DEBUG=false
APP_TIMEZONE=Africa/Douala
APP_URL=https://iebccorporation.com

APP_LOCALE=fr
APP_FALLBACK_LOCALE=fr

LOG_CHANNEL=stack
LOG_STACK=single
LOG_LEVEL=error

# Identifiants de base de données Hostinger
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=u123456789_iebc
DB_USERNAME=u123456789_iebc
DB_PASSWORD=VOTRE_MOT_DE_PASSE_BD_ICI

SESSION_DRIVER=file
SESSION_LIFETIME=120

# ⭐ CRITIQUE POUR LES UPLOADS
FILESYSTEM_DISK=public

CACHE_STORE=file
QUEUE_CONNECTION=database

# Configuration mail (Optionnel - configurer plus tard)
MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_USERNAME=noreply@iebccorporation.com
MAIL_PASSWORD=votre_mot_de_passe_email
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@iebccorporation.com
MAIL_FROM_NAME="${APP_NAME}"
```

### Étape 2 : Générer la clé d'application

```bash
cd ~/iebc
php artisan key:generate
```

Ceci mettra à jour votre fichier `.env` avec une nouvelle `APP_KEY`.

### Étape 3 : Vérifier .htaccess dans public/

Assurez-vous que `public/.htaccess` contient :

```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Gérer l'en-tête d'autorisation
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Rediriger les barres obliques finales si ce n'est pas un dossier...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Envoyer les requêtes au contrôleur frontal...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

### Étape 4 : Définir les permissions des fichiers

```bash
# Sur Hostinger via SSH
cd ~/iebc

# Définir les permissions des répertoires
find . -type d -exec chmod 755 {} \;

# Définir les permissions des fichiers
find . -type f -exec chmod 644 {} \;

# Rendre storage et cache accessibles en écriture
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Assurer que storage/app/public est accessible
chmod -R 775 storage/app/public
```

---

## 🗄️ Configuration de la base de données

### Étape 1 : Créer la base de données sur Hostinger

1. Dans hPanel, allez dans **Bases de données** → **Bases de données MySQL**
2. Cliquez sur **Créer une nouvelle base de données**
3. Nom de la base de données : `u123456789_iebc` (Hostinger ajoute automatiquement le préfixe)
4. Créez un utilisateur de base de données avec les mêmes identifiants
5. Accordez TOUS les privilèges à l'utilisateur
6. Notez :
   - Nom de la base de données
   - Nom d'utilisateur
   - Mot de passe
   - Hôte (généralement `localhost`)

### Étape 2 : Importer la base de données (si migration)

#### Option A : Via phpMyAdmin

1. Dans hPanel, allez dans **Bases de données** → **phpMyAdmin**
2. Sélectionnez votre base de données
3. Cliquez sur l'onglet **Importer**
4. Choisissez votre fichier de sauvegarde SQL
5. Cliquez sur **Exécuter**

#### Option B : Via SSH (Recommandé pour les grandes bases de données)

```bash
# Téléchargez d'abord votre fichier de sauvegarde via FTP
cd ~/
mysql -u u123456789_iebc -p u123456789_iebc < sauvegarde_base_de_donnees.sql
```

### Étape 3 : Exécuter les migrations (Installation fraîche)

```bash
cd ~/iebc
php artisan migrate --force
```

### Étape 4 : Exécuter les seeders

```bash
# Remplir les données initiales
php artisan db:seed --force

# Ou seeder spécifique
php artisan db:seed --class=SettingsSeeder --force
php artisan db:seed --class=UserSeeder --force
```

---

## 🔗 Étapes post-déploiement

### Étape 1 : Créer le lien symbolique storage

```bash
cd ~/iebc
php artisan storage:link
```

Sortie attendue :
```
The [public/storage] link has been connected to [storage/app/public].
The links have been created.
```

### Étape 2 : Vérifier le lien symbolique

```bash
ls -la public/
# Devrait afficher : storage -> /chemin/vers/iebc/storage/app/public
```

### Étape 3 : Vider et mettre en cache la configuration

```bash
# Vider tous les caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Mettre en cache pour la production
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Étape 4 : Optimiser l'autoloader

```bash
composer dump-autoload --optimize
php artisan optimize
```

### Étape 5 : Tester le site web

Visitez ces URL pour vérifier :

1. ✅ **Page d'accueil** : https://iebccorporation.com
2. ✅ **Page de connexion** : https://iebccorporation.com/login
3. ✅ **Chargement du logo** : Vérifiez si le logo s'affiche
4. ✅ **Tableau de bord admin** : https://iebccorporation.com/back-end-iebc/dashboard
5. ✅ **Ressource statique** : https://iebccorporation.com/img/logo.png
6. ✅ **Ressource storage** : Téléchargez une image de test et vérifiez qu'elle s'affiche

### Étape 6 : Vérifier les erreurs

```bash
# Voir les logs Laravel
tail -f ~/iebc/storage/logs/laravel.log

# Vérifier les logs d'erreur Apache (dans hPanel)
# Allez dans Avancé → Logs d'erreur
```

---

## 🐛 Dépannage

### Problème 1 : Erreur interne du serveur 500

**Symptômes** : Page blanche ou erreur 500 générique

**Solutions** :

1. **Vérifier les permissions des fichiers** :
   ```bash
   chmod -R 755 storage bootstrap/cache
   ```

2. **Vider le cache de configuration** :
   ```bash
   php artisan config:clear
   ```

3. **Vérifier le fichier .env** :
   - Vérifier que `APP_KEY` est défini
   - Vérifier les identifiants de la base de données
   - Assurer qu'il n'y a pas d'erreurs de syntaxe

4. **Vérifier les logs** :
   ```bash
   tail -50 storage/logs/laravel.log
   ```

### Problème 2 : 404 Not Found sur les routes

**Symptômes** : La page d'accueil se charge mais les autres routes affichent 404

**Solutions** :

1. **Vérifier que .htaccess existe** dans le dossier `public/`

2. **Vérifier que mod_rewrite est activé** :
   - Contactez le support Hostinger si nécessaire
   - Généralement activé par défaut

3. **Vider le cache des routes** :
   ```bash
   php artisan route:clear
   ```

### Problème 3 : CSS/JS/Images ne se chargent pas

**Symptômes** : La page se charge mais pas de styles, images cassées

**Solutions** :

1. **Vérifier APP_URL dans .env** :
   ```env
   APP_URL=https://iebccorporation.com
   ```

2. **Vérifier que les fichiers existent** :
   ```bash
   ls -la public/css/
   ls -la public/js/
   ls -la public/img/
   ```

3. **Vider le cache du navigateur** : Ctrl+F5 ou Cmd+Shift+R

4. **Vérifier la console du navigateur** (F12) pour les erreurs 404

### Problème 4 : Les images téléchargées ne s'affichent pas

**Symptômes** : Les images statiques fonctionnent, mais pas les images téléchargées

**Solutions** :

1. **Vérifier que le lien storage existe** :
   ```bash
   ls -la public/storage
   # Devrait afficher un lien symbolique vers ../storage/app/public
   ```

2. **Recréer le lien storage** :
   ```bash
   php artisan storage:link
   ```

3. **Vérifier FILESYSTEM_DISK dans .env** :
   ```env
   FILESYSTEM_DISK=public
   ```

4. **Vérifier les permissions** :
   ```bash
   chmod -R 775 storage/app/public
   ```

### Problème 5 : Erreur de connexion à la base de données

**Symptômes** : "SQLSTATE[HY000]" ou "Access denied for user"

**Solutions** :

1. **Vérifier les identifiants de la base de données dans .env**
2. **Vérifier que la base de données existe** dans phpMyAdmin
3. **Tester la connexion** :
   ```bash
   php artisan tinker
   DB::connection()->getPdo();
   ```

### Problème 6 : Le logo affiche l'URL "localhost"

**Symptômes** : Le chemin du logo contient `http://localhost`

**Solutions** :

1. **Mettre à jour la base de données** :
   ```sql
   UPDATE settings
   SET value = '/img/logo.png'
   WHERE `key` = 'company_logo';
   ```

2. **Vider le cache de configuration** :
   ```bash
   php artisan config:clear
   php artisan config:cache
   ```

---

## ⚡ Optimisation pour la production

### 1. Optimisation Composer

```bash
composer install --no-dev --optimize-autoloader
composer dump-autoload --optimize --classmap-authoritative
```

### 2. Optimisation Laravel

```bash
# Mettre en cache la configuration
php artisan config:cache

# Mettre en cache les routes
php artisan route:cache

# Mettre en cache les vues
php artisan view:cache

# Optimiser globalement
php artisan optimize
```

### 3. Configuration OPcache

Demandez au support Hostinger d'activer OPcache dans la configuration PHP.

### 4. Désactiver le mode debug

Assurez-vous dans `.env` :
```env
APP_DEBUG=false
APP_ENV=production
LOG_LEVEL=error
```

### 5. Activer la compression Gzip

Ajoutez à `public/.htaccess` :

```apache
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/html text/plain text/xml text/css text/javascript application/javascript application/json
</IfModule>
```

### 6. Mise en cache du navigateur

Ajoutez à `public/.htaccess` :

```apache
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType image/jpg "access plus 1 year"
    ExpiresByType image/jpeg "access plus 1 year"
    ExpiresByType image/gif "access plus 1 year"
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType text/css "access plus 1 month"
    ExpiresByType application/javascript "access plus 1 month"
</IfModule>
```

---

## 📝 Liste de contrôle de déploiement

Utilisez cette liste pour chaque déploiement :

### Pré-déploiement
- [ ] Tous les changements de code committés sur Git
- [ ] Tests réussis localement
- [ ] Sauvegarde de la base de données créée
- [ ] `.env.hostinger.example` mis à jour si nécessaire

### Déploiement
- [ ] Fichiers téléchargés/récupérés via Git
- [ ] Fichier `.env` configuré
- [ ] `composer install --no-dev --optimize-autoloader`
- [ ] Base de données migrée : `php artisan migrate --force`
- [ ] Seeders exécutés (si nécessaire)
- [ ] Lien storage créé : `php artisan storage:link`
- [ ] Permissions définies : `chmod -R 755 storage bootstrap/cache`

### Post-déploiement
- [ ] Caches vidés : `php artisan config:clear`
- [ ] Optimisations exécutées : `php artisan optimize`
- [ ] Site web se charge : https://iebccorporation.com
- [ ] Connexion fonctionne avec le bon logo
- [ ] Tableau de bord admin accessible
- [ ] Les images s'uploadent et s'affichent correctement
- [ ] Pas d'erreurs dans les logs : `storage/logs/laravel.log`
- [ ] La console du navigateur n'a pas d'erreurs 404

### Surveillance
- [ ] Configuration de la surveillance/alertes
- [ ] Planning de sauvegarde régulière
- [ ] Certificat SSL valide
- [ ] Base de référence de performance établie

---

## 🔒 Bonnes pratiques de sécurité

1. **Ne jamais committer le fichier `.env`** sur Git
2. **Utiliser une APP_KEY forte** (32+ caractères)
3. **Utiliser des mots de passe de base de données forts**
4. **Maintenir Laravel et les dépendances à jour**
5. **Désactiver le listage des répertoires** (déjà dans `.htaccess`)
6. **Utiliser HTTPS uniquement** (Hostinger fournit un SSL gratuit)
7. **Sauvegardes régulières** de la base de données et des fichiers
8. **Surveiller les logs** pour détecter les activités suspectes

---

## 📞 Support et ressources

### Support Hostinger
- **Site web** : https://www.hostinger.com/support
- **Chat en direct** : Disponible 24/7 dans hPanel
- **Base de connaissances** : https://support.hostinger.com

### Ressources Laravel
- **Documentation** : https://laravel.com/docs/12.x
- **Guide de déploiement** : https://laravel.com/docs/12.x/deployment

### Projet IEBC
- **Dépôt** : (URL de votre dépôt Git)
- **Contact** : contact@iebc-cemac.com

---

## ✅ Commandes de référence rapide

```bash
# Se connecter au serveur
ssh u123456789@iebccorporation.com

# Naviguer vers le projet
cd ~/iebc

# Récupérer le dernier code
git pull origin main

# Installer les dépendances
composer install --no-dev --optimize-autoloader

# Exécuter les migrations
php artisan migrate --force

# Vider les caches
php artisan optimize:clear

# Mettre en cache pour la production
php artisan optimize

# Voir les logs
tail -f storage/logs/laravel.log

# Définir les permissions
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage/app/public

# Créer le lien storage
php artisan storage:link
```

---

**Dernière mise à jour** : 25 octobre 2025  
**Version** : 2.0 (Après nettoyage de structure)  
**Statut** : ✅ Prêt pour le déploiement en production

---

Bonne chance avec votre déploiement ! 🚀