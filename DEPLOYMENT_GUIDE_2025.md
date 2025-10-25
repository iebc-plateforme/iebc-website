# 🚀 IEBC Laravel Deployment Guide - Hostinger 2025

**Project**: IEBC SARL Website
**Framework**: Laravel 12.3.0
**Domain**: https://iebccorporation.com
**Last Updated**: October 25, 2025
**Status**: ✅ Structure Cleaned & Production-Ready

---

## 📋 Table of Contents

1. [Pre-Deployment Checklist](#pre-deployment-checklist)
2. [Project Structure Verification](#project-structure-verification)
3. [Hostinger Setup](#hostinger-setup)
4. [File Upload Methods](#file-upload-methods)
5. [Server Configuration](#server-configuration)
6. [Database Setup](#database-setup)
7. [Post-Deployment Steps](#post-deployment-steps)
8. [Troubleshooting](#troubleshooting)
9. [Optimization](#optimization)

---

## ✅ Pre-Deployment Checklist

### Local Environment Verification

- [x] **Project Structure**: Cleaned (Oct 25, 2025)
  - [x] No `index.php` in root
  - [x] No `.htaccess` in root
  - [x] No duplicate `css/`, `js/`, `img/` in root
  - [x] All static assets in `public/` folder
  - [x] `public/index.php` is the only entry point

- [ ] **Environment Configuration**
  - [ ] `.env.example` updated with production settings
  - [ ] `.env` contains local development settings
  - [ ] Database credentials are correct locally
  - [ ] `APP_KEY` is generated

- [ ] **Dependencies**
  - [ ] Run `composer install --no-dev --optimize-autoloader`
  - [ ] All packages are up to date
  - [ ] No development dependencies in production

- [ ] **Database**
  - [ ] All migrations tested locally
  - [ ] Seeders work without errors
  - [ ] Database backup created

- [ ] **Assets**
  - [ ] Logo file exists: `public/img/logo.png`
  - [ ] Favicon exists: `public/favicon.ico`
  - [ ] All CSS/JS files are in `public/` folder

- [ ] **Git**
  - [ ] All changes committed
  - [ ] `.gitignore` includes `.env`
  - [ ] Repository is clean

---

## 🔍 Project Structure Verification

Your project now has the **CORRECT** Laravel 9+ structure:

```
iebc/
├── app/                          # Application logic
├── bootstrap/
│   ├── app.php                   # Application bootstrap
│   └── cache/                    # Bootstrap cache
├── config/                       # Configuration files
├── database/
│   ├── migrations/               # Database migrations
│   ├── seeders/                  # Database seeders
│   └── factories/                # Model factories
├── public/                       # ⭐ WEB ROOT - ONLY PUBLICLY ACCESSIBLE FOLDER
│   ├── .htaccess                 # Apache rewrite rules
│   ├── index.php                 # ⭐ Application entry point
│   ├── favicon.ico               # Site favicon
│   ├── robots.txt                # SEO robots file
│   ├── css/                      # Compiled CSS
│   ├── js/                       # Compiled JavaScript
│   ├── img/                      # Static images
│   │   └── logo.png              # Company logo
│   ├── vendor/                   # Frontend vendor libraries
│   └── storage/                  # ⚠️ SYMLINK to ../storage/app/public
├── resources/
│   ├── views/                    # Blade templates
│   ├── css/                      # Source CSS (if using)
│   └── js/                       # Source JS (if using)
├── routes/
│   ├── web.php                   # Web routes
│   ├── api.php                   # API routes
│   └── console.php               # Console routes
├── storage/
│   ├── app/
│   │   └── public/               # User uploaded files (target of symlink)
│   │       ├── teams/
│   │       ├── posts/
│   │       ├── galleries/
│   │       └── partners/
│   ├── framework/
│   │   ├── cache/
│   │   ├── sessions/
│   │   └── views/                # Compiled Blade views
│   └── logs/
│       └── laravel.log           # Application logs
├── vendor/                       # Composer dependencies
├── .env                          # Environment configuration (NOT in git)
├── .env.example                  # Example environment file
├── .env.hostinger.example        # Hostinger-specific example
├── artisan                       # CLI tool
├── composer.json                 # Composer dependencies
├── composer.lock                 # Locked dependency versions
└── server.php                    # PHP built-in server router
```

---

## 🌐 Hostinger Setup

### Step 1: Access Hostinger Control Panel

1. Go to [hpanel.hostinger.com](https://hpanel.hostinger.com)
2. Log in with your credentials
3. Select your hosting plan
4. Find **iebccorporation.com** domain

### Step 2: Prepare Hosting Environment

#### Enable SSH Access (HIGHLY RECOMMENDED)

1. In hPanel, go to **Advanced** → **SSH Access**
2. Enable SSH if not already enabled
3. Note your SSH credentials:
   - **Host**: iebccorporation.com (or IP address)
   - **Port**: 22 (usually)
   - **Username**: `u123456789` (example)
   - **Password**: Your hosting password

#### Check PHP Version

1. Go to **Advanced** → **PHP Configuration**
2. Ensure PHP version is **8.2** or higher
3. Enable required extensions:
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

## 📤 File Upload Methods

### Method 1: Git Deployment (RECOMMENDED)

#### A. Setup Git on Hostinger

```bash
# Connect via SSH
ssh u123456789@iebccorporation.com

# Navigate to home directory
cd ~

# Clone your repository
git clone https://github.com/your-username/iebc.git iebc-laravel

# Create symbolic link from public_html to public folder
rm -rf domains/iebccorporation.com/public_html
ln -s ~/iebc-laravel/public ~/domains/iebccorporation.com/public_html
```

#### B. Update Deployment Script

Create `deploy.sh` in your project:

```bash
#!/bin/bash
# deploy.sh - Automatic deployment script

echo "🚀 Starting deployment..."

# Pull latest changes
git pull origin main

# Install/update dependencies
composer install --no-dev --optimize-autoloader --no-interaction

# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Run migrations
php artisan migrate --force

# Create storage link if doesn't exist
php artisan storage:link

# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set permissions
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage/app/public

echo "✅ Deployment complete!"
```

Make executable: `chmod +x deploy.sh`

### Method 2: FTP/File Manager Upload

#### Using FileZilla or Hostinger File Manager

1. **Connect via FTP**:
   - Host: ftp.iebccorporation.com
   - Username: Your Hostinger FTP username
   - Password: Your FTP password
   - Port: 21

2. **Upload Structure**:
   ```
   /domains/iebccorporation.com/
   ├── iebc/                    # Upload entire Laravel project here
   │   ├── app/
   │   ├── bootstrap/
   │   ├── config/
   │   ├── database/
   │   ├── public/              # This will be linked
   │   ├── resources/
   │   ├── routes/
   │   ├── storage/
   │   ├── vendor/              # Upload or run composer install
   │   ├── .env                 # Create from .env.hostinger.example
   │   └── artisan
   └── public_html -> iebc/public  # Symlink or copy contents
   ```

3. **Option A: Symbolic Link** (Preferred - via SSH)
   ```bash
   cd ~/domains/iebccorporation.com
   rm -rf public_html
   ln -s ~/iebc/public public_html
   ```

4. **Option B: Copy Contents** (If no SSH)
   - Copy ALL contents from `iebc/public/` to `public_html/`
   - **Important**: Keep the rest of Laravel files OUTSIDE `public_html/`

### Method 3: Compressed Archive Upload

```bash
# On local machine
tar -czf iebc-deploy.tar.gz --exclude='.git' --exclude='node_modules' --exclude='.env' .

# Upload to Hostinger via File Manager or FTP

# On Hostinger (SSH)
cd ~/
tar -xzf iebc-deploy.tar.gz -C iebc/
cd iebc
```

---

## ⚙️ Server Configuration

### Step 1: Environment Configuration

Create `.env` file in project root (NOT in public_html):

```env
# Copy from .env.hostinger.example and update:

APP_NAME="IEBC SARL"
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_TIMEZONE=Africa/Douala
APP_URL=https://iebccorporation.com

APP_LOCALE=fr
APP_FALLBACK_LOCALE=fr

LOG_CHANNEL=stack
LOG_STACK=single
LOG_LEVEL=error

# Hostinger Database Credentials
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=u123456789_iebc
DB_USERNAME=u123456789_iebc
DB_PASSWORD=YOUR_DB_PASSWORD_HERE

SESSION_DRIVER=file
SESSION_LIFETIME=120

# ⭐ CRITICAL FOR UPLOADS
FILESYSTEM_DISK=public

CACHE_STORE=file
QUEUE_CONNECTION=database

# Mail Configuration (Optional - configure later)
MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_USERNAME=noreply@iebccorporation.com
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@iebccorporation.com
MAIL_FROM_NAME="${APP_NAME}"
```

### Step 2: Generate Application Key

```bash
cd ~/iebc
php artisan key:generate
```

This will update your `.env` file with a new `APP_KEY`.

### Step 3: Verify .htaccess in public/

Ensure `public/.htaccess` contains:

```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

### Step 4: Set File Permissions

```bash
# On Hostinger via SSH
cd ~/iebc

# Set directory permissions
find . -type d -exec chmod 755 {} \;

# Set file permissions
find . -type f -exec chmod 644 {} \;

# Make storage and cache writable
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Ensure storage/app/public is accessible
chmod -R 775 storage/app/public
```

---

## 🗄️ Database Setup

### Step 1: Create Database on Hostinger

1. In hPanel, go to **Databases** → **MySQL Databases**
2. Click **Create New Database**
3. Database name: `u123456789_iebc` (Hostinger adds prefix automatically)
4. Create database user with same credentials
5. Grant ALL privileges to the user
6. Note down:
   - Database name
   - Username
   - Password
   - Host (usually `localhost`)

### Step 2: Import Database (If Migrating)

#### Option A: Via phpMyAdmin

1. In hPanel, go to **Databases** → **phpMyAdmin**
2. Select your database
3. Click **Import** tab
4. Choose your SQL dump file
5. Click **Go**

#### Option B: Via SSH (Recommended for large databases)

```bash
# Upload your dump file via FTP first
cd ~/
mysql -u u123456789_iebc -p u123456789_iebc < database_backup.sql
```

### Step 3: Run Migrations (Fresh Installation)

```bash
cd ~/iebc
php artisan migrate --force
```

### Step 4: Run Seeders

```bash
# Seed initial data
php artisan db:seed --force

# Or specific seeder
php artisan db:seed --class=SettingsSeeder --force
php artisan db:seed --class=UserSeeder --force
```

---

## 🔗 Post-Deployment Steps

### Step 1: Create Storage Symbolic Link

```bash
cd ~/iebc
php artisan storage:link
```

Expected output:
```
The [public/storage] link has been connected to [storage/app/public].
The links have been created.
```

### Step 2: Verify Symbolic Link

```bash
ls -la public/
# Should show: storage -> /path/to/iebc/storage/app/public
```

### Step 3: Clear and Cache Configuration

```bash
# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Cache for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Step 4: Optimize Autoloader

```bash
composer dump-autoload --optimize
php artisan optimize
```

### Step 5: Test the Website

Visit these URLs to verify:

1. ✅ **Homepage**: https://iebccorporation.com
2. ✅ **Login Page**: https://iebccorporation.com/login
3. ✅ **Logo Loading**: Check if logo displays
4. ✅ **Admin Dashboard**: https://iebccorporation.com/back-end-iebc/dashboard
5. ✅ **Static Asset**: https://iebccorporation.com/img/logo.png
6. ✅ **Storage Asset**: Upload a test image and verify it displays

### Step 6: Check for Errors

```bash
# View Laravel logs
tail -f ~/iebc/storage/logs/laravel.log

# Check Apache error logs (in hPanel)
# Go to Advanced → Error Logs
```

---

## 🐛 Troubleshooting

### Issue 1: 500 Internal Server Error

**Symptoms**: White page or generic 500 error

**Solutions**:

1. **Check file permissions**:
   ```bash
   chmod -R 755 storage bootstrap/cache
   ```

2. **Clear config cache**:
   ```bash
   php artisan config:clear
   ```

3. **Check .env file**:
   - Verify `APP_KEY` is set
   - Verify database credentials
   - Ensure no syntax errors

4. **Check logs**:
   ```bash
   tail -50 storage/logs/laravel.log
   ```

### Issue 2: 404 Not Found on Routes

**Symptoms**: Homepage loads but other routes show 404

**Solutions**:

1. **Verify .htaccess exists** in `public/` folder

2. **Check mod_rewrite is enabled**:
   - Contact Hostinger support if needed
   - Usually enabled by default

3. **Clear route cache**:
   ```bash
   php artisan route:clear
   ```

### Issue 3: CSS/JS/Images Not Loading

**Symptoms**: Page loads but no styles, broken images

**Solutions**:

1. **Check APP_URL in .env**:
   ```env
   APP_URL=https://iebccorporation.com
   ```

2. **Verify files exist**:
   ```bash
   ls -la public/css/
   ls -la public/js/
   ls -la public/img/
   ```

3. **Clear browser cache**: Ctrl+F5 or Cmd+Shift+R

4. **Check browser console** (F12) for 404 errors

### Issue 4: Uploaded Images Not Displaying

**Symptoms**: Static images work, but uploaded images don't

**Solutions**:

1. **Verify storage link exists**:
   ```bash
   ls -la public/storage
   # Should show symlink to ../storage/app/public
   ```

2. **Recreate storage link**:
   ```bash
   php artisan storage:link
   ```

3. **Check FILESYSTEM_DISK in .env**:
   ```env
   FILESYSTEM_DISK=public
   ```

4. **Verify permissions**:
   ```bash
   chmod -R 775 storage/app/public
   ```

### Issue 5: Database Connection Error

**Symptoms**: "SQLSTATE[HY000]" or "Access denied for user"

**Solutions**:

1. **Verify database credentials in .env**
2. **Check database exists** in phpMyAdmin
3. **Test connection**:
   ```bash
   php artisan tinker
   DB::connection()->getPdo();
   ```

### Issue 6: Logo Shows "localhost" URL

**Symptoms**: Logo path contains `http://localhost`

**Solutions**:

1. **Update database**:
   ```sql
   UPDATE settings
   SET value = '/img/logo.png'
   WHERE `key` = 'company_logo';
   ```

2. **Clear config cache**:
   ```bash
   php artisan config:clear
   php artisan config:cache
   ```

---

## ⚡ Optimization for Production

### 1. Composer Optimization

```bash
composer install --no-dev --optimize-autoloader
composer dump-autoload --optimize --classmap-authoritative
```

### 2. Laravel Optimization

```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Optimize overall
php artisan optimize
```

### 3. OPcache Configuration

Ask Hostinger support to enable OPcache in PHP configuration.

### 4. Disable Debug Mode

Ensure in `.env`:
```env
APP_DEBUG=false
APP_ENV=production
LOG_LEVEL=error
```

### 5. Enable Gzip Compression

Add to `public/.htaccess`:

```apache
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/html text/plain text/xml text/css text/javascript application/javascript application/json
</IfModule>
```

### 6. Browser Caching

Add to `public/.htaccess`:

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

## 📝 Deployment Checklist

Use this checklist for each deployment:

### Pre-Deployment
- [ ] All code changes committed to Git
- [ ] Tests passing locally
- [ ] Database backup created
- [ ] `.env.hostinger.example` updated if needed

### Deployment
- [ ] Files uploaded/pulled via Git
- [ ] `.env` file configured
- [ ] `composer install --no-dev --optimize-autoloader`
- [ ] Database migrated: `php artisan migrate --force`
- [ ] Seeders run (if needed)
- [ ] Storage link created: `php artisan storage:link`
- [ ] Permissions set: `chmod -R 755 storage bootstrap/cache`

### Post-Deployment
- [ ] Caches cleared: `php artisan config:clear`
- [ ] Optimizations run: `php artisan optimize`
- [ ] Website loads: https://iebccorporation.com
- [ ] Login works with correct logo
- [ ] Admin dashboard accessible
- [ ] Images upload and display correctly
- [ ] No errors in logs: `storage/logs/laravel.log`
- [ ] Browser console has no 404 errors

### Monitoring
- [ ] Setup monitoring/alerts
- [ ] Regular backup schedule
- [ ] SSL certificate valid
- [ ] Performance baseline established

---

## 🔒 Security Best Practices

1. **Never commit `.env` file** to Git
2. **Use strong APP_KEY** (32+ characters)
3. **Use strong database passwords**
4. **Keep Laravel and dependencies updated**
5. **Disable directory listing** (already in `.htaccess`)
6. **Use HTTPS only** (Hostinger provides free SSL)
7. **Regular backups** of database and files
8. **Monitor logs** for suspicious activity

---

## 📞 Support & Resources

### Hostinger Support
- **Website**: https://www.hostinger.com/support
- **Live Chat**: Available 24/7 in hPanel
- **Knowledge Base**: https://support.hostinger.com

### Laravel Resources
- **Documentation**: https://laravel.com/docs/12.x
- **Deployment Guide**: https://laravel.com/docs/12.x/deployment

### IEBC Project
- **Repository**: (Your Git repository URL)
- **Contact**: contact@iebc-cemac.com

---

## ✅ Quick Reference Commands

```bash
# Connect to server
ssh u123456789@iebccorporation.com

# Navigate to project
cd ~/iebc

# Pull latest code
git pull origin main

# Install dependencies
composer install --no-dev --optimize-autoloader

# Run migrations
php artisan migrate --force

# Clear caches
php artisan optimize:clear

# Cache for production
php artisan optimize

# View logs
tail -f storage/logs/laravel.log

# Set permissions
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage/app/public

# Create storage link
php artisan storage:link
```

---

**Last Updated**: October 25, 2025
**Version**: 2.0 (Post Structure Cleanup)
**Status**: ✅ Ready for Production Deployment

---

Good luck with your deployment! 🚀
