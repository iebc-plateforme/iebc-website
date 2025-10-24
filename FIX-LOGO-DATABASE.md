# 🔧 Fix Logo 404 - Mise à Jour Base de Données

## 🎯 Problème

Sur **iebccorporation.com**, le logo affiche une erreur 404 car la base de données contient une mauvaise valeur.

### Cause
La table `settings` contient probablement:
```
key: company_logo
value: http://localhost/img/logo.png  ❌
```

Ou le fichier logo.png n'existe pas du tout.

---

## ✅ Solution Immédiate

### Étape 1: Vérifier la Base de Données

1. Connectez-vous à **Hostinger → phpMyAdmin**
2. Sélectionnez votre base de données IEBC
3. Exécutez cette requête pour voir la valeur actuelle:

```sql
SELECT * FROM settings WHERE `key` = 'company_logo';
```

### Étape 2: Corriger la Valeur

#### Option A: Utiliser le Favicon Temporairement

Si vous n'avez pas encore de logo.png, utilisez le favicon:

```sql
UPDATE settings
SET value = '/img/favicon.png'
WHERE `key` = 'company_logo';
```

#### Option B: Utiliser logo.png (si vous l'avez uploadé)

Si vous avez uploadé logo.png dans `public_html/img/`:

```sql
UPDATE settings
SET value = '/img/logo.png'
WHERE `key` = 'company_logo';
```

### Étape 3: Vider le Cache Laravel

Via SSH:
```bash
cd domains/iebccorporation.com/public_html
php artisan cache:clear
php artisan view:clear
php artisan config:clear
```

Sans SSH, créez `fix-cache.php`:
```php
<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->call('cache:clear');
$kernel->call('view:clear');
echo "✅ Cache vidé! Supprimez ce fichier maintenant.";
?>
```

Accédez à `https://iebccorporation.com/fix-cache.php` puis supprimez le fichier.

---

## 🔍 Vérification Complète

### Script de Diagnostic Complet

Créez `check-logo.php` dans `public_html/`:

```php
<?php
echo "<h1>🔍 Diagnostic Logo - iebccorporation.com</h1>";
echo "<hr>";

// 1. Vérifier la base de données
echo "<h2>1. Valeur dans la Base de Données</h2>";
try {
    require __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    $kernel = $app->make('Illuminate\Contracts\Console\Kernel');
    $kernel->bootstrap();

    $logo = DB::table('settings')->where('key', 'company_logo')->first();

    if ($logo) {
        echo "✅ Enregistrement trouvé<br>";
        echo "<strong>Valeur actuelle:</strong> <code>{$logo->value}</code><br>";

        if (str_contains($logo->value, 'localhost')) {
            echo "❌ <strong>PROBLÈME:</strong> Contient 'localhost'<br>";
            echo "👉 <strong>Solution:</strong> Exécutez cette requête SQL:<br>";
            echo "<code>UPDATE settings SET value = '/img/favicon.png' WHERE `key` = 'company_logo';</code><br>";
        } elseif ($logo->value === '/img/logo.png') {
            echo "✅ Chemin correct (/img/logo.png)<br>";
        } elseif ($logo->value === '/img/favicon.png') {
            echo "ℹ️ Utilise favicon.png (temporaire)<br>";
        } else {
            echo "⚠️ Valeur inattendue: {$logo->value}<br>";
        }
    } else {
        echo "❌ Aucun enregistrement 'company_logo' trouvé<br>";
        echo "👉 <strong>Solution:</strong> Exécutez cette requête SQL:<br>";
        echo "<code>INSERT INTO settings (`key`, `value`, `type`) VALUES ('company_logo', '/img/favicon.png', 'text');</code><br>";
    }
} catch (Exception $e) {
    echo "❌ Erreur de connexion DB: " . $e->getMessage();
}

echo "<hr>";

// 2. Vérifier les fichiers
echo "<h2>2. Fichiers Images</h2>";

$files = [
    'logo.png' => __DIR__ . '/img/logo.png',
    'favicon.png' => __DIR__ . '/img/favicon.png',
];

foreach ($files as $name => $path) {
    echo "<strong>$name:</strong> ";
    if (file_exists($path)) {
        $size = round(filesize($path) / 1024, 2);
        echo "✅ Existe ($size KB) - ";
        echo "<a href='/img/$name' target='_blank'>Voir</a><br>";
    } else {
        echo "❌ Manquant<br>";
    }
}

echo "<hr>";

// 3. Vérifier APP_URL
echo "<h2>3. Configuration APP_URL</h2>";
$envPath = __DIR__ . '/../.env';
if (file_exists($envPath)) {
    $envContent = file_get_contents($envPath);
    preg_match('/APP_URL=(.*)/', $envContent, $matches);
    $appUrl = trim($matches[1] ?? 'NON TROUVÉ');
    echo "Valeur: <strong>$appUrl</strong><br>";
    if ($appUrl === 'https://iebccorporation.com') {
        echo "✅ Correct<br>";
    } else {
        echo "❌ Doit être: https://iebccorporation.com<br>";
    }
} else {
    echo "❌ Fichier .env introuvable<br>";
}

echo "<hr>";

// 4. Test URL finale
echo "<h2>4. Test URLs</h2>";
$baseUrl = 'https://iebccorporation.com';

try {
    $logo = DB::table('settings')->where('key', 'company_logo')->value('value');
    if ($logo && !str_starts_with($logo, 'http')) {
        $fullUrl = $baseUrl . $logo;
        echo "URL complète du logo: <a href='$fullUrl' target='_blank'>$fullUrl</a><br>";

        // Tester l'URL
        $headers = @get_headers($fullUrl);
        if ($headers && strpos($headers[0], '200')) {
            echo "✅ Logo accessible (200 OK)<br>";
        } else {
            echo "❌ Logo inaccessible (404)<br>";
        }
    }
} catch (Exception $e) {
    echo "⚠️ Impossible de tester l'URL<br>";
}

echo "<hr>";
echo "<h2>✅ Actions Recommandées</h2>";
echo "<ol>";
echo "<li>Si la valeur DB contient 'localhost': Exécutez la requête SQL ci-dessus</li>";
echo "<li>Si logo.png manque: Uploadez-le dans public_html/img/</li>";
echo "<li>Videz le cache: php artisan cache:clear</li>";
echo "<li>Testez: https://iebccorporation.com/login</li>";
echo "<li><strong>🔥 SUPPRIMEZ CE FICHIER après diagnostic!</strong></li>";
echo "</ol>";
?>
```

Accédez à `https://iebccorporation.com/check-logo.php`

---

## 📝 Récapitulatif des Commandes

### Sur phpMyAdmin (Hostinger):

```sql
-- 1. Voir la valeur actuelle
SELECT * FROM settings WHERE `key` = 'company_logo';

-- 2. Corriger avec favicon (temporaire)
UPDATE settings SET value = '/img/favicon.png' WHERE `key` = 'company_logo';

-- 3. OU corriger avec logo.png (si uploadé)
UPDATE settings SET value = '/img/logo.png' WHERE `key` = 'company_logo';

-- 4. Vérifier que c'est bien à jour
SELECT `key`, value FROM settings WHERE `key` = 'company_logo';
```

### Via SSH:

```bash
# Mise à jour via Artisan
php artisan tinker
>>> DB::table('settings')->where('key', 'company_logo')->update(['value' => '/img/favicon.png']);
>>> exit

# Vider les caches
php artisan cache:clear
php artisan view:clear
php artisan config:clear
```

---

## ⚡ Solution Ultra-Rapide (30 secondes)

1. Allez sur **Hostinger → phpMyAdmin**
2. Sélectionnez votre base IEBC
3. Collez et exécutez:
```sql
UPDATE settings SET value = '/img/favicon.png' WHERE `key` = 'company_logo';
```
4. Ouvrez: `https://iebccorporation.com/login`
5. Rechargez avec **Ctrl + F5**
6. ✅ Le logo (favicon) devrait s'afficher!

---

**Date**: 24 Octobre 2025
**Site**: https://iebccorporation.com
