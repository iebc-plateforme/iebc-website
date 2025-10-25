# XAMPP Configuration Guide for Laravel

## Project Structure Cleanup - COMPLETED ✅

The following changes have been made to align your project with Laravel 9+ best practices:

### Files Removed:
- ✅ `index.php` (root - duplicate)
- ✅ `.htaccess` (root - duplicate)
- ✅ `css/`, `js/`, `img/` (root - duplicates of `public/` versions)
- ✅ `assets/` (root - duplicate of `public/vendor/`)

### Backups Created:
- `index.php.backup`
- `.htaccess.backup`

### Correct Structure:
```
iebc/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/           ← Web server should point HERE
│   ├── index.php     ← The ONLY entry point
│   ├── .htaccess     ← The ONLY .htaccess for routing
│   ├── css/
│   ├── js/
│   ├── img/
│   └── vendor/
├── resources/
├── routes/
├── storage/
├── vendor/
├── artisan
└── server.php
```

---

## XAMPP Configuration Options

You have **3 options** to configure XAMPP to work with the proper Laravel structure:

### **Option 1: Virtual Host (RECOMMENDED for Development)**

1. **Edit `C:\xampp\apache\conf\extra\httpd-vhosts.conf`**

   Add this configuration at the end:

   ```apache
   <VirtualHost *:80>
       ServerName iebc.local
       ServerAlias www.iebc.local
       DocumentRoot "C:/xampp/htdocs/iebc/public"

       <Directory "C:/xampp/htdocs/iebc/public">
           Options Indexes FollowSymLinks
           AllowOverride All
           Require all granted
       </Directory>

       ErrorLog "logs/iebc-error.log"
       CustomLog "logs/iebc-access.log" common
   </VirtualHost>
   ```

2. **Edit your hosts file: `C:\Windows\System32\drivers\etc\hosts`**

   Add this line:
   ```
   127.0.0.1    iebc.local
   ```

3. **Enable Virtual Hosts in Apache**

   Edit `C:\xampp\apache\conf\httpd.conf` and uncomment this line:
   ```apache
   Include conf/extra/httpd-vhosts.conf
   ```

4. **Restart Apache** from XAMPP Control Panel

5. **Access your site**: `http://iebc.local`

---

### **Option 2: Change DocumentRoot (Simple but affects all XAMPP projects)**

1. **Edit `C:\xampp\apache\conf\httpd.conf`**

   Find and change:
   ```apache
   DocumentRoot "C:/xampp/htdocs"
   <Directory "C:/xampp/htdocs">
   ```

   To:
   ```apache
   DocumentRoot "C:/xampp/htdocs/iebc/public"
   <Directory "C:/xampp/htdocs/iebc/public">
   ```

2. **Find the Directory directive** and ensure it has:
   ```apache
   <Directory "C:/xampp/htdocs/iebc/public">
       Options Indexes FollowSymLinks
       AllowOverride All
       Require all granted
   </Directory>
   ```

3. **Restart Apache**

4. **Access your site**: `http://localhost`

---

### **Option 3: Symlink (Quick workaround - NOT RECOMMENDED)**

Create a symbolic link from htdocs to your public folder:

```cmd
cd C:\xampp\htdocs
mklink /D iebc-public "C:\xampp\htdocs\iebc\public"
```

Then access: `http://localhost/iebc-public`

---

## Verify Configuration

After applying any option above:

1. **Check Apache is running** in XAMPP Control Panel

2. **Test the application**:
   - Visit your configured URL
   - You should see the Laravel welcome page
   - Check browser console for any 404 errors on assets

3. **Verify .htaccess is working**:
   ```bash
   # Visit a route like:
   http://iebc.local/back-end-iebc/dashboard
   ```
   If you see a 404 page styled by Laravel (not Apache), it's working!

4. **Check file permissions** (important for production):
   ```bash
   # In Git Bash or WSL
   chmod -R 755 storage bootstrap/cache
   ```

---

## Common Issues & Solutions

### Issue 1: "Forbidden - You don't have permission to access"
**Solution**: Check Directory directive has `AllowOverride All` and `Require all granted`

### Issue 2: Assets (CSS/JS) not loading
**Solution**:
- Clear browser cache
- Check browser console for 404 errors
- Verify files exist in `public/css`, `public/js`, etc.
- Run: `php artisan storage:link`

### Issue 3: Routes show 404 (Apache default page)
**Solution**:
- Verify `.htaccess` exists in `public/` folder
- Ensure `mod_rewrite` is enabled in Apache
- Check `httpd.conf` has `LoadModule rewrite_module modules/mod_rewrite.so` uncommented

### Issue 4: "Class not found" errors
**Solution**:
```bash
composer dump-autoload
php artisan config:clear
php artisan cache:clear
```

---

## Production Deployment (Hostinger)

For production on Hostinger, ensure:

1. ✅ **Point domain to `public_html` which should be symlinked to your `public/` folder**
2. ✅ **Or upload project and configure DocumentRoot to `/home/username/iebc/public`**
3. ✅ **Set proper permissions**: 755 for directories, 644 for files
4. ✅ **Storage and cache writable**: `chmod -R 775 storage bootstrap/cache`
5. ✅ **Environment**: Copy `.env.example` to `.env` and configure
6. ✅ **Run**: `php artisan key:generate`
7. ✅ **Optimize**: `php artisan config:cache` and `php artisan route:cache`

---

## Your Project Status

### ✅ Structure: CORRECT
- All files in proper Laravel 9+ locations
- Public directory as the only web-accessible folder
- Proper path references in index.php

### ⚠️ Server Config: NEEDS CONFIGURATION
- Choose one of the 3 options above
- Restart Apache after changes

### 🎯 Next Steps:
1. Choose configuration option (Option 1 recommended)
2. Edit Apache config files
3. Restart Apache
4. Test your application
5. Celebrate! 🎉

---

**Need help?** Check Laravel docs: https://laravel.com/docs/12.x/installation#web-server-configuration
