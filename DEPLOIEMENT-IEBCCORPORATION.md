# 🚀 Guide de Déploiement - iebccorporation.com

## 🎯 Configuration Spécifique pour iebccorporation.com

---

## ⚡ SOLUTION RAPIDE - Résoudre le Problème des Logos

### 📌 Étape 1: Connexion à Hostinger

1. Connectez-vous à [hpanel.hostinger.com](https://hpanel.hostinger.com)
2. Sélectionnez votre site **iebccorporation.com**
3. Cliquez sur **File Manager**

---

### 📌 Étape 2: Modifier le Fichier .env

1. Dans File Manager, allez à la racine de votre projet
2. Trouvez et éditez le fichier `.env`
3. Modifiez les lignes suivantes:

```env
APP_NAME="IEBC SARL"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://iebccorporation.com

FILESYSTEM_DISK=public
```

⚠️ **IMPORTANT**: Remplacez `http://localhost` par `https://iebccorporation.com`

4. Sauvegardez le fichier

---

### 📌 Étape 3: Créer le Lien Symbolique Storage

#### Option A: Via Terminal SSH (Recommandé)

1. Dans Hostinger, allez à **Advanced** → **SSH Access**
2. Activez l'accès SSH si ce n'est pas fait
3. Connectez-vous via SSH:

```bash
ssh u123456789@iebccorporation.com
# Entrez votre mot de passe

cd domains/iebccorporation.com/public_html
php artisan storage:link
```

Si ça fonctionne, vous verrez:
```
The [public/storage] link has been connected to [storage/app/public].
The links have been created.
```

#### Option B: Sans SSH - Script Automatique

1. Créez un nouveau fichier `fix-storage.php` dans `public_html/`
2. Collez ce code:

```php
<?php
// fix-storage.php - Script pour créer le lien storage
$target = __DIR__ . '/../storage/app/public';
$link = __DIR__ . '/storage';

// Supprimer l'ancien lien s'il existe
if (file_exists($link)) {
    if (is_link($link)) {
        unlink($link);
        echo "✅ Ancien lien supprimé<br>";
    } elseif (is_dir($link)) {
        echo "⚠️ 'storage' existe déjà comme dossier. Supprimez-le manuellement d'abord.<br>";
        exit;
    }
}

// Créer le nouveau lien
if (symlink($target, $link)) {
    echo "✅ Lien symbolique créé avec succès!<br>";
    echo "Target: $target<br>";
    echo "Link: $link<br>";

    // Vérifier que le lien fonctionne
    if (is_link($link) && file_exists($link)) {
        echo "<br>✅ SUCCÈS! Le lien fonctionne correctement.<br>";
        echo "<br>🔥 <strong>Supprimez ce fichier maintenant pour des raisons de sécurité!</strong>";
    } else {
        echo "<br>❌ Le lien a été créé mais ne semble pas fonctionner.";
    }
} else {
    echo "❌ Erreur lors de la création du lien symbolique.<br>";
    echo "Essayez via SSH ou contactez Hostinger.";
}
?>
```

3. Accédez à `https://iebccorporation.com/fix-storage.php`
4. Si vous voyez "✅ SUCCÈS!", supprimez immédiatement `fix-storage.php`

---

### 📌 Étape 4: Mettre à Jour le Logo dans la Base de Données

1. Dans Hostinger, allez à **Databases** → **phpMyAdmin**
2. Sélectionnez votre base de données IEBC
3. Cliquez sur l'onglet **SQL**
4. Exécutez cette requête:

```sql
UPDATE settings
SET value = '/img/logo.png'
WHERE `key` = 'company_logo';
```

5. Cliquez sur **Go** (Exécuter)

---

### 📌 Étape 5: Vider les Caches

#### Via SSH:
```bash
cd domains/iebccorporation.com/public_html
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
```

#### Sans SSH - Créez `clear-cache.php`:
```php
<?php
// clear-cache.php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->make('Illuminate\Contracts\Console\Kernel')->call('cache:clear');
$app->make('Illuminate\Contracts\Console\Kernel')->call('config:clear');
$app->make('Illuminate\Contracts\Console\Kernel')->call('route:clear');
$app->make('Illuminate\Contracts\Console\Kernel')->call('view:clear');

echo "✅ Caches vidés avec succès!<br>";
echo "🔥 Supprimez ce fichier maintenant!";
?>
```

Accédez à `https://iebccorporation.com/clear-cache.php` puis supprimez le fichier.

---

### 📌 Étape 6: Vérifier les Permissions

Via File Manager ou SSH:

```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chmod -R 775 storage/app/public
chmod -R 775 storage/logs
chmod -R 775 storage/framework
```

---

### 📌 Étape 7: Ajouter le Logo IEBC

⚠️ **IMPORTANT**: Le fichier `logo.png` n'existe pas dans le projet par défaut.

#### Ajouter Votre Logo:

1. Via **File Manager Hostinger**:
   - Naviguez vers `public_html/img/`
   - Cliquez sur **Upload**
   - Uploadez votre fichier `logo.png`
   - Format recommandé: PNG transparent, 300x100px

2. Mettre à jour la base de données:
```sql
UPDATE settings SET value = '/img/logo.png' WHERE `key` = 'company_logo';
```

**Note**: En attendant le vrai logo, le système utilise `favicon.png` temporairement.

### 📌 Étape 8: Tester

1. Ouvrez `https://iebccorporation.com/login` dans votre navigateur
2. Le logo devrait maintenant s'afficher correctement
3. Testez également les autres pages

---

## 🔍 Vérification - Script de Test

Créez `test-images.php` dans `public_html/`:

```php
<?php
echo "<h1>🔍 Test de Configuration - iebccorporation.com</h1>";

// Test 1: APP_URL
$dotenv = file_get_contents(__DIR__ . '/../.env');
preg_match('/APP_URL=(.*)/', $dotenv, $matches);
$appUrl = trim($matches[1] ?? 'NON TROUVÉ');
echo "<h3>1. APP_URL</h3>";
echo "Valeur: <strong>$appUrl</strong><br>";
echo $appUrl === 'https://iebccorporation.com' ? '✅ Correct' : '❌ Doit être: https://iebccorporation.com';
echo "<br><br>";

// Test 2: Lien Storage
$storageLink = __DIR__ . '/storage';
echo "<h3>2. Lien Symbolique Storage</h3>";
echo "Existe: " . (file_exists($storageLink) ? '✅ Oui' : '❌ Non') . "<br>";
echo "Est un lien: " . (is_link($storageLink) ? '✅ Oui' : '❌ Non') . "<br>";
if (is_link($storageLink)) {
    echo "Pointe vers: " . readlink($storageLink) . "<br>";
}
echo "<br>";

// Test 3: Logo existe
$logoPath = __DIR__ . '/img/logo.png';
echo "<h3>3. Logo Statique</h3>";
echo "Fichier existe: " . (file_exists($logoPath) ? '✅ Oui' : '❌ Non') . "<br>";
if (file_exists($logoPath)) {
    echo "Taille: " . filesize($logoPath) . " bytes<br>";
    echo "URL: <a href='/img/logo.png' target='_blank'>https://iebccorporation.com/img/logo.png</a><br>";
}
echo "<br>";

// Test 4: Permissions Storage
$storagePath = __DIR__ . '/../storage';
echo "<h3>4. Permissions</h3>";
echo "Storage: " . substr(sprintf('%o', fileperms($storagePath)), -4) . "<br>";
echo "Storage/app/public: " . (is_dir($storagePath . '/app/public') ? '✅ Existe' : '❌ N\'existe pas') . "<br>";
echo "<br>";

// Test 5: Base de données
echo "<h3>5. Test de Base de Données</h3>";
try {
    require __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    $kernel = $app->make('Illuminate\Contracts\Console\Kernel');
    $kernel->bootstrap();

    $logo = DB::table('settings')->where('key', 'company_logo')->value('value');
    echo "Logo dans DB: <strong>$logo</strong><br>";
    echo $logo === '/img/logo.png' ? '✅ Correct' : '⚠️ Devrait être: /img/logo.png';
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage();
}

echo "<br><br><hr>";
echo "<p><strong>🔥 N'oubliez pas de supprimer ce fichier après le test!</strong></p>";
?>
```

Accédez à `https://iebccorporation.com/test-images.php`

---

## 📋 Checklist Complète

- [ ] `.env` modifié avec `APP_URL=https://iebccorporation.com`
- [ ] `FILESYSTEM_DISK=public` dans `.env`
- [ ] Lien symbolique `storage` créé
- [ ] Base de données mise à jour (logo = `/img/logo.png`)
- [ ] Caches Laravel vidés
- [ ] Permissions `755` sur storage
- [ ] Test de la page de login: logo s'affiche ✅
- [ ] Fichiers de test supprimés (fix-storage.php, test-images.php, clear-cache.php)

---

## 🐛 Problèmes Courants

### Le logo ne s'affiche toujours pas

**1. Vérifiez l'URL exacte du logo:**
- Ouvrez https://iebccorporation.com/login
- F12 → Onglet "Console" ou "Network"
- Cherchez les erreurs 404 pour les images
- Notez l'URL complète du logo

**2. Vérifiez que le fichier existe:**
- Via File Manager: `public_html/img/logo.png` doit exister
- Accédez directement: https://iebccorporation.com/img/logo.png

**3. Vérifiez la base de données:**
```sql
SELECT * FROM settings WHERE `key` = 'company_logo';
```
La valeur doit être `/img/logo.png` et NON `http://localhost/img/logo.png`

**4. Videz le cache du navigateur:**
- Ctrl + F5 (Windows)
- Cmd + Shift + R (Mac)

---

## 🔧 Commandes SSH Utiles

```bash
# Se connecter
ssh votre_username@iebccorporation.com

# Aller dans le dossier
cd domains/iebccorporation.com/public_html

# Créer le lien storage
php artisan storage:link

# Vider les caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Optimiser pour production
php artisan config:cache
php artisan route:cache

# Vérifier les permissions
ls -la storage
ls -la public/storage

# Voir les logs d'erreur
tail -f storage/logs/laravel.log
```

---

## 📧 Support

### Logs à Vérifier
1. **Laravel logs**: `storage/logs/laravel.log`
2. **Apache logs**: Via Hostinger → Error Logs
3. **Console navigateur**: F12 → Console

### Contact
- **Email**: contact@iebc-cemac.com
- **Hostinger Support**: Si problème de permissions ou symlink

---

## ✅ Vérification Finale

Une fois tout fait, ces URLs doivent fonctionner:

- ✅ https://iebccorporation.com (Page d'accueil)
- ✅ https://iebccorporation.com/login (Avec logo visible)
- ✅ https://iebccorporation.com/img/logo.png (Logo accessible directement)
- ✅ https://iebccorporation.com/services
- ✅ https://iebccorporation.com/blog
- ✅ https://iebccorporation.com/team
- ✅ https://iebccorporation.com/contact

---

**Date de création**: 24 Octobre 2025
**Domaine**: https://iebccorporation.com
**Hébergeur**: Hostinger
