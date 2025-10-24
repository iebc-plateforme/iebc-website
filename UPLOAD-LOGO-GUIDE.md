# 📸 Guide d'Upload du Logo - iebccorporation.com

## ✅ Nouveau Système de Gestion des Logos

Le système a été mis à jour pour utiliser **Laravel Storage** correctement. Les logos sont maintenant stockés dans `storage/app/public/settings/` et accessibles via l'URL `https://iebccorporation.com/storage/settings/`.

---

## 🚀 Comment Uploader le Logo (Méthode Recommandée)

### Via l'Interface Admin

1. **Connectez-vous** à l'administration:
   - URL: `https://iebccorporation.com/login`
   - Email: `admin@iebc-cemac.com`
   - Mot de passe: *(votre mot de passe)*

2. **Allez dans Paramètres**:
   - Cliquez sur **"Paramètres"** dans le menu latéral
   - Ou accédez directement: `https://iebccorporation.com/admin/settings`

3. **Uploadez le Logo**:
   - Section **"Informations générales"**
   - Champ **"Logo du site"**
   - Cliquez sur **"Parcourir"** ou **"Choose File"**
   - Sélectionnez votre fichier logo (PNG recommandé)
   - ✅ **Format**: PNG avec fond transparent
   - ✅ **Dimensions**: 300x100 px (ratio 3:1)
   - ✅ **Taille max**: 2 MB

4. **Uploadez le Favicon (optionnel)**:
   - Même page, champ **"Favicon du site"**
   - Format: ICO ou PNG (32x32 ou 16x16 px)
   - Taille max: 512 KB

5. **Enregistrez**:
   - Cliquez sur **"Enregistrer les paramètres"**
   - ✅ Le logo est automatiquement:
     - Sauvegardé dans `storage/app/public/settings/`
     - Accessible via `https://iebccorporation.com/storage/settings/votre-logo.png`
     - Enregistré dans la base de données (table `settings`, clé `company_logo`)

6. **Testez**:
   - Ouvrez `https://iebccorporation.com/login`
   - Le logo doit s'afficher correctement! ✅

---

## 🔧 Vérifications Importantes

### 1. Lien Symbolique Storage

Le lien symbolique doit exister pour que les images soient accessibles:

**Via SSH:**
```bash
cd domains/iebccorporation.com/public_html
php artisan storage:link
```

**Sans SSH**, créez `create-storage-link.php`:
```php
<?php
$target = __DIR__ . '/../storage/app/public';
$link = __DIR__ . '/storage';

if (!file_exists($link)) {
    symlink($target, $link);
    echo "✅ Lien créé!";
} else {
    echo "ℹ️ Le lien existe déjà.";
}
?>
```

Accédez à `https://iebccorporation.com/create-storage-link.php` puis supprimez le fichier.

### 2. Permissions

```bash
chmod -R 775 storage/app/public
chmod -R 775 storage/app/public/settings
```

### 3. Vérifier que le Logo est Sauvegardé

**Via phpMyAdmin:**
```sql
SELECT `key`, `value`, `type`
FROM settings
WHERE `key` = 'company_logo';
```

Vous devriez voir:
- `key`: `company_logo`
- `value`: `settings/xxxxxxxxx.png` (chemin relatif dans storage)
- `type`: `file`

---

## 📊 Structure des Fichiers

### Après Upload via l'Interface Admin:

```
storage/
└── app/
    └── public/
        └── settings/          ← Logos uploadés ici
            ├── xK3mD9pQ.png  (company_logo)
            └── yL4nE8qR.ico  (site_favicon)

public/
└── storage/                   ← Lien symbolique vers storage/app/public
    └── settings/
        ├── xK3mD9pQ.png
        └── yL4nE8qR.ico
```

### URLs Accessibles:

- Logo: `https://iebccorporation.com/storage/settings/xK3mD9pQ.png`
- Favicon: `https://iebccorporation.com/storage/settings/yL4nE8qR.ico`

---

## 🎯 Comment ça Fonctionne

### 1. Upload

Quand vous uploadez via l'interface admin:
```php
// SettingController.php
$logoPath = $request->file('logo')->store('settings', 'public');
// Résultat: 'settings/xK3mD9pQ.png'

Setting::set('company_logo', $logoPath, 'file');
// Sauvegardé dans BD: company_logo = 'settings/xK3mD9pQ.png'
```

### 2. Affichage

Le composant `<x-site-logo>` détecte automatiquement le type de chemin:
```php
// Si 'settings/xxx.png' → asset('storage/settings/xxx.png')
// Si '/img/favicon.png' → asset('img/favicon.png')
// Si 'http://...' → URL directe
```

### 3. Fallback

Si aucun logo n'est uploadé, le système utilise `public/img/favicon.png` par défaut.

---

## ⚠️ Résolution de Problèmes

### Le Logo ne S'affiche Pas (404)

**1. Vérifiez le lien symbolique:**
```bash
ls -la public_html/storage
# Doit pointer vers ../storage/app/public
```

**2. Vérifiez que le fichier existe:**
```bash
ls -la storage/app/public/settings/
```

**3. Vérifiez la base de données:**
```sql
SELECT * FROM settings WHERE `key` = 'company_logo';
```

**4. Vérifiez les permissions:**
```bash
chmod -R 775 storage/app/public
```

### Le Logo S'affiche en Admin Mais Pas sur le Site Public

- Videz le cache: `php artisan view:clear`
- Rechargez avec Ctrl+F5
- Vérifiez la console navigateur (F12) pour voir l'URL exacte demandée

### Erreur "Call to undefined method"

Si vous voyez une erreur avec le composant `<x-site-logo>`:
- Vérifiez que le fichier `app/View/Components/SiteLogo.php` existe
- Exécutez: `php artisan view:clear`
- Exécutez: `composer dump-autoload`

---

## 📝 Migration des Anciennes Données

Si vous aviez déjà un logo avec l'ancien système (`/img/logo.png`):

```sql
-- Supprimer l'ancienne valeur
DELETE FROM settings WHERE `key` = 'company_logo' AND value LIKE '/img%';

-- Le nouveau logo sera uploadé via l'interface admin
```

---

## ✅ Checklist Post-Déploiement

- [ ] Lien symbolique `storage` créé
- [ ] Permissions `775` sur `storage/app/public`
- [ ] Logo uploadé via interface admin `/admin/settings`
- [ ] Logo visible sur `/login`
- [ ] Logo visible sur page d'accueil
- [ ] Base de données contient `company_logo` avec chemin `settings/xxx.png`
- [ ] URL `https://iebccorporation.com/storage/settings/xxx.png` accessible
- [ ] Favicon uploadé (optionnel)
- [ ] Anciennes entrées nettoyées

---

## 🆘 Support

### Fichiers Clés Modifiés

- `app/Http/Controllers/Admin/SettingController.php` - Upload logic
- `app/View/Components/SiteLogo.php` - Composant d'affichage
- `resources/views/components/site-logo.blade.php` - Template
- `resources/views/auth/login.blade.php` - Page de connexion
- `resources/views/admin/settings/index.blade.php` - Interface admin
- `database/seeders/SettingsSeeder.php` - Valeurs par défaut

### Commandes Utiles

```bash
# Créer le lien storage
php artisan storage:link

# Vider les caches
php artisan cache:clear
php artisan view:clear
php artisan config:clear

# Voir les logs
tail -f storage/logs/laravel.log
```

---

**Date**: 24 Octobre 2025
**Site**: https://iebccorporation.com
**Version**: 2.1.0
