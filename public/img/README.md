# 📁 Dossier Images - IEBC SARL

## 🖼️ Logo Manquant

### ⚠️ Action Requise

Le fichier **`logo.png`** est manquant. C'est le logo principal de l'entreprise IEBC SARL qui s'affiche sur:
- Page de connexion
- Header du site
- Emails
- Documents PDF

### ✅ Comment Ajouter le Logo

#### En Local (Développement)
1. Placez votre fichier `logo.png` dans ce dossier: `public/img/`
2. Format recommandé: PNG avec fond transparent
3. Dimensions recommandées: 300x100 px (ratio 3:1)
4. Taille maximale: 500 KB

#### Sur Hostinger (Production)
1. Connectez-vous à **Hostinger File Manager**
2. Naviguez vers: `domains/iebccorporation.com/public_html/img/`
3. Cliquez sur **Upload**
4. Uploadez votre fichier `logo.png`

### 📐 Spécifications du Logo

```
Nom du fichier: logo.png
Format: PNG (recommandé) ou JPG
Fond: Transparent (pour PNG)
Largeur: 300-400 px
Hauteur: 80-120 px
Ratio: 3:1 ou 4:1
Poids: < 500 KB
```

### 🔄 Solution Temporaire Actuelle

En attendant le vrai logo, le système utilise **`favicon.png`** comme logo temporaire.

### 🎨 Où Obtenir le Logo

1. **Si vous avez le logo IEBC:**
   - Convertissez-le en PNG (si nécessaire)
   - Redimensionnez-le aux dimensions recommandées
   - Uploadez-le ici

2. **Si vous n'avez pas de logo:**
   - Contactez le département marketing/design
   - Ou utilisez un service comme Canva pour créer un logo simple
   - Format: Texte "IEBC SARL" avec une icône

### 🔧 Après Upload du Logo

1. **Localement:**
```bash
# Mettre à jour la base de données
php artisan tinker
>>> DB::table('settings')->where('key', 'company_logo')->update(['value' => '/img/logo.png']);
>>> exit
```

2. **Sur Hostinger:**
```sql
-- Via phpMyAdmin
UPDATE settings SET value = '/img/logo.png' WHERE `key` = 'company_logo';
```

3. **Vider les caches:**
```bash
php artisan cache:clear
php artisan view:clear
```

### 📋 Fichiers Images Actuels

- ✅ `favicon.png` - Icône du site (utilisé temporairement comme logo)
- ✅ `cover-login.png` - Image de fond page de connexion
- ✅ `cover-register.png` - Image de fond page d'inscription
- ✅ `cover-forgot-password.png` - Image de fond mot de passe oublié
- ❌ `logo.png` - **MANQUANT** - Logo principal de l'entreprise

### 🆘 Besoin d'Aide?

Contact: contact@iebc-cemac.com
