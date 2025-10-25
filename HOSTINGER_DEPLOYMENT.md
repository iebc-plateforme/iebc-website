# Hostinger Deployment Guide - Fix 403 Forbidden Error

## Step 1: Upload Files to Hostinger

Upload all Laravel files to your Hostinger account via FTP/SFTP or File Manager.
Recommended path: `/home/username/public_html/iebc` or `/home/username/domains/yourdomain.com`

## Step 2: Configure Document Root

### Option A: Change Document Root (Recommended)
1. Log in to Hostinger hPanel
2. Go to **Website** → **Manage**
3. Find **Advanced** → **Document Root** or **PHP Configuration**
4. Change document root from:
   - OLD: `/public_html/iebc`
   - NEW: `/public_html/iebc/public`
5. Save changes

### Option B: If Document Root Cannot Be Changed
The root `.htaccess` file has been created to redirect to the public folder automatically.

## Step 3: Set File Permissions via SSH

Connect to your Hostinger account via SSH and run:

```bash
# Navigate to your Laravel directory
cd /home/username/public_html/iebc

# Set correct permissions for all files
find . -type f -exec chmod 644 {} \;

# Set correct permissions for all directories
find . -type d -exec chmod 755 {} \;

# Set write permissions for storage and cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# If 775 doesn't work, try 777 (less secure but may be needed)
# chmod -R 777 storage
# chmod -R 777 bootstrap/cache
```

Or use the provided script: `bash fix-permissions.sh`

## Step 4: Configure Environment File

1. Rename `.env.example` to `.env`:
   ```bash
   cp .env.example .env
   ```

2. Edit `.env` with your Hostinger database credentials:
   ```
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://yourdomain.com

   DB_CONNECTION=mysql
   DB_HOST=localhost
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_user
   DB_PASSWORD=your_database_password
   ```

3. Generate application key:
   ```bash
   php artisan key:generate
   ```

## Step 5: Clear Cache and Optimize

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache
```

## Step 6: Verify PHP Version

1. In Hostinger hPanel, go to **PHP Configuration**
2. Ensure PHP version is **8.0** or higher
3. Enable required extensions:
   - OpenSSL
   - PDO
   - Mbstring
   - Tokenizer
   - XML
   - Ctype
   - JSON
   - BCMath

## Step 7: Database Setup

```bash
php artisan migrate --force
php artisan db:seed --force
```

## Troubleshooting

### Still Getting 403?

1. **Check .htaccess files exist:**
   - Root: `/iebc/.htaccess`
   - Public: `/iebc/public/.htaccess`

2. **Verify file ownership:**
   ```bash
   chown -R username:username /home/username/public_html/iebc
   ```

3. **Check Apache modules (contact Hostinger support if needed):**
   - mod_rewrite must be enabled
   - mod_negotiation must be enabled

4. **Check error logs:**
   - Hostinger: hPanel → **Files** → **Error Logs**
   - Laravel: `storage/logs/laravel.log`

### Getting 500 Error Instead?

This usually means permissions are set but other issues exist:
- Check storage/bootstrap/cache permissions (775 or 777)
- Run `composer install --no-dev --optimize-autoloader`
- Verify `.env` file exists and has correct values
- Check Laravel logs in `storage/logs/laravel.log`

### White Page / Blank Screen?

- Enable debug mode temporarily: `APP_DEBUG=true` in `.env`
- Check PHP error logs
- Verify all Composer dependencies are installed

## Quick Fix Checklist

- [ ] Document root points to `/public` folder
- [ ] Both `.htaccess` files exist (root and public)
- [ ] File permissions: 644 for files, 755 for directories
- [ ] Storage and bootstrap/cache: 775 or 777
- [ ] `.env` file configured with correct database credentials
- [ ] PHP version 8.0+
- [ ] Composer dependencies installed
- [ ] Application key generated
- [ ] Caches cleared
- [ ] Database migrated

## Support

If issues persist:
1. Check Hostinger's Laravel deployment documentation
2. Contact Hostinger support with error logs
3. Review Laravel logs: `storage/logs/laravel.log`
