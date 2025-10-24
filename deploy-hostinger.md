# 🚀 Guide de Déploiement sur Hostinger

## 📋 Problème des Logos/Images Manquants

### Causes Principales
1. ❌ Lien symbolique `storage` non créé
2. ❌ Variable `APP_URL` incorrecte
3. ❌ Permissions de fichiers incorrectes
4. ❌ Configuration FILESYSTEM_DISK incorrecte

---

## ✅ Solutions Étape par Étape

### 📌 Étape 1: Configuration du Fichier .env sur Hostinger

Connectez-vous à votre panneau Hostinger et modifiez le fichier `.env`:

```env
# Application
APP_NAME="IEBC SARL"
APP_ENV=production
APP_KEY=votre_app_key_ici
APP_DEBUG=false
APP_URL=https://votre-domaine.com

# Base de données (Hostinger)
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=nom_base_hostinger
DB_USERNAME=utilisateur_hostinger
DB_PASSWORD=mot_de_passe_hostinger

# Filesystem
FILESYSTEM_DISK=public

# Cache & Session
CACHE_STORE=file
SESSION_DRIVER=file
```

⚠️ **IMPORTANT**: Remplacez `https://votre-domaine.com` par votre vrai nom de domaine!

---

### 📌 Étape 2: Créer le Lien Symbolique Storage

#### Option A: Via SSH (Recommandé)
Si vous avez accès SSH sur Hostinger:

```bash
cd /home/votre_username/public_html
php artisan storage:link
```

#### Option B: Via File Manager (Sans SSH)
Si vous n'avez pas SSH, créez manuellement le lien:

1. Allez dans le File Manager de Hostinger
2. Créez un dossier `storage` dans `public_html/`
3. Créez un fichier `.htaccess` dans `public_html/storage/`:

```apache
# public_html/storage/.htaccess
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ ../storage/app/public/$1 [L]
</IfModule>
```

#### Option C: Script PHP Personnalisé
Créez un fichier `create-storage-link.php` à la racine:

```php
<?php
// create-storage-link.php
$targetFolder = $_SERVER['DOCUMENT_ROOT'].'/storage/app/public';
$linkFolder = $_SERVER['DOCUMENT_ROOT'].'/storage';

if (!file_exists($linkFolder)) {
    symlink($targetFolder, $linkFolder);
    echo "✅ Lien symbolique créé avec succès!";
} else {
    echo "ℹ️ Le lien existe déjà.";
}
?>
```

Accédez à `https://votre-domaine.com/create-storage-link.php` puis supprimez le fichier.

---

### 📌 Étape 3: Vérifier les Permissions

Via SSH ou File Manager, définissez les permissions correctes:

```bash
# Via SSH
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chmod -R 775 storage/app/public
chmod -R 775 storage/logs
```

Via File Manager Hostinger:
- Clic droit sur `storage` → Permissions → `755`
- Clic droit sur `bootstrap/cache` → Permissions → `755`

---

### 📌 Étape 4: Corriger le Seeder du Logo

Le problème avec `asset()` dans le seeder est qu'il génère l'URL avec `localhost`.

#### Solution: Modifier le SettingsSeeder

Ouvrez `database/seeders/SettingsSeeder.php` et modifiez:

**Avant:**
```php
[
    'key' => 'company_logo',
    'value' => asset('img/logo.png'),
    'type' => 'text',
],
```

**Après:**
```php
[
    'key' => 'company_logo',
    'value' => '/img/logo.png',  // Chemin relatif
    'type' => 'text',
],
```

Puis ré-exécutez le seeder:
```bash
php artisan db:seed --class=SettingsSeeder --force
```

---

### 📌 Étape 5: Vérifier le Logo dans la Vue

Modifiez `resources/views/auth/login.blade.php`:

**Avant:**
```blade
@php
    $logo = \App\Models\Setting::get('company_logo', asset('img/logo.png'));
@endphp
@if($logo)
    <img src="{{ $logo }}" alt="Company Logo">
@endif
```

**Après:**
```blade
@php
    $logo = \App\Models\Setting::get('company_logo', '/img/logo.png');
    // Si le logo ne commence pas par http, ajouter l'URL de base
    if ($logo && !str_starts_with($logo, 'http')) {
        $logo = asset($logo);
    }
@endphp
@if($logo)
    <img src="{{ $logo }}" alt="Company Logo">
@endif
```

---

### 📌 Étape 6: Upload des Fichiers Statiques

Assurez-vous que le dossier `public/img/` et tous les fichiers statiques sont bien uploadés sur Hostinger:

```
public/
├── img/
│   ├── logo.png
│   └── favicon.png
├── css/
│   └── auth-modern.css
└── storage/ (lien symbolique)
```

---

### 📌 Étape 7: Vérifier les Chemins Storage pour les Uploads

Pour les fichiers uploadés (photos équipe, posts, etc.), utilisez toujours:

```blade
<!-- Pour les fichiers dans storage/app/public -->
<img src="{{ asset('storage/' . $team->photo) }}" alt="{{ $team->name }}">

<!-- OU avec Storage facade -->
<img src="{{ Storage::url($team->photo) }}" alt="{{ $team->name }}">
```

---

## 🔧 Commandes Utiles sur Hostinger

### Via SSH:
```bash
# Aller dans le répertoire
cd /home/votre_username/public_html

# Créer le lien storage
php artisan storage:link

# Vider les caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimiser pour production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Vérifier les permissions
ls -la storage
ls -la bootstrap/cache
```

---

## 🐛 Debugging - Si les Images ne S'affichent Toujours Pas

### 1. Vérifier que le fichier existe
Créez un fichier `test-storage.php` à la racine:

```php
<?php
echo "<h2>Test de Storage</h2>";

// Test 1: Vérifier si le lien symbolique existe
$storageLink = __DIR__ . '/storage';
echo "Lien storage existe: " . (file_exists($storageLink) ? '✅ Oui' : '❌ Non') . "<br>";

// Test 2: Vérifier le chemin réel
if (is_link($storageLink)) {
    echo "Cible du lien: " . readlink($storageLink) . "<br>";
}

// Test 3: Lister les fichiers
$storagePath = __DIR__ . '/../storage/app/public';
if (is_dir($storagePath)) {
    echo "<h3>Fichiers dans storage/app/public:</h3>";
    $files = scandir($storagePath);
    echo "<pre>" . print_r($files, true) . "</pre>";
}

// Test 4: Vérifier APP_URL
echo "<h3>Configuration:</h3>";
echo "APP_URL: " . env('APP_URL') . "<br>";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "<br>";
?>
```

Accédez à `https://votre-domaine.com/test-storage.php`

### 2. Vérifier dans la Console Développeur

Ouvrez la console du navigateur (F12) et vérifiez:
- Onglet "Network": Cherchez les requêtes d'images qui échouent (404)
- Notez l'URL complète de l'image qui ne charge pas
- Vérifiez si l'URL est correcte

### 3. Problème de Permissions

Si les images sont uploadées mais ne s'affichent pas:
```bash
chmod -R 755 storage/app/public/*
```

---

## 📝 Structure Correcte sur Hostinger

```
/home/votre_username/
├── public_html/              # Votre dossier Laravel "public"
│   ├── .htaccess
│   ├── index.php
│   ├── img/
│   │   └── logo.png          # Fichiers statiques
│   ├── css/
│   ├── js/
│   └── storage/              # LIEN SYMBOLIQUE vers ../storage/app/public
├── app/
├── bootstrap/
├── config/
├── database/
├── resources/
├── routes/
├── storage/
│   ├── app/
│   │   └── public/           # Fichiers uploadés (teams, posts, etc.)
│   │       ├── teams/
│   │       ├── posts/
│   │       ├── galleries/
│   │       └── partners/
│   ├── framework/
│   └── logs/
└── vendor/
```

---

## ✅ Checklist de Déploiement

- [ ] Fichier `.env` configuré avec `APP_URL` correct
- [ ] `FILESYSTEM_DISK=public` dans `.env`
- [ ] Lien symbolique `storage` créé
- [ ] Permissions `755` sur `storage` et `bootstrap/cache`
- [ ] Fichiers statiques (`img/logo.png`) uploadés dans `public/img/`
- [ ] Seeder modifié pour utiliser chemins relatifs
- [ ] Cache Laravel vidé (`php artisan cache:clear`)
- [ ] Configuration optimisée (`php artisan config:cache`)
- [ ] Test de l'URL des images dans le navigateur

---

## 🆘 Problèmes Courants

### Images Uploadées (Storage) ne Fonctionnent Pas
**Solution**: Vérifiez que le lien symbolique existe et pointe vers le bon endroit.

### Images Statiques (public/img) ne Fonctionnent Pas
**Solution**: Vérifiez que les fichiers ont été uploadés et que l'`APP_URL` est correct.

### Erreur 500 après Déploiement
**Solution**:
```bash
php artisan config:clear
chmod -R 755 storage bootstrap/cache
```

### Logo de la Page de Connexion ne S'affiche Pas
**Solution**: Le seeder utilise `asset()` avec localhost. Modifiez manuellement dans la base de données:
```sql
UPDATE settings SET value = '/img/logo.png' WHERE key = 'company_logo';
```

---

## 📧 Support

Si vous rencontrez toujours des problèmes:
1. Vérifiez les logs Laravel: `storage/logs/laravel.log`
2. Vérifiez les logs d'erreur Hostinger
3. Contactez le support Hostinger si le problème persiste

---

**Dernière mise à jour**: 24 Octobre 2025
