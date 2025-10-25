#!/bin/bash

# Complete Hostinger Deployment Script
# Run this script after uploading files to Hostinger via SSH

echo "===================================="
echo "Laravel Hostinger Deployment Script"
echo "===================================="
echo ""

# Check if we're in a Laravel directory
if [ ! -f "artisan" ]; then
    echo "Error: This doesn't appear to be a Laravel directory."
    echo "Please run this script from your Laravel root directory."
    exit 1
fi

# Step 1: Set file permissions
echo "Step 1: Setting file permissions..."
bash fix-permissions.sh

# Step 2: Setup environment file
echo ""
echo "Step 2: Setting up environment file..."
if [ ! -f ".env" ]; then
    if [ -f ".env.example" ]; then
        cp .env.example .env
        echo "✓ .env file created from .env.example"
        echo "⚠ IMPORTANT: Edit .env file with your database credentials!"
    else
        echo "⚠ Warning: .env.example not found"
    fi
else
    echo "✓ .env file already exists"
fi

# Step 3: Install/Update Composer dependencies
echo ""
echo "Step 3: Installing Composer dependencies..."
if command -v composer &> /dev/null; then
    composer install --no-dev --optimize-autoloader
    echo "✓ Composer dependencies installed"
else
    echo "⚠ Warning: Composer not found. You may need to install dependencies manually."
fi

# Step 4: Generate application key
echo ""
echo "Step 4: Generating application key..."
if grep -q "APP_KEY=$" .env; then
    php artisan key:generate --force
    echo "✓ Application key generated"
else
    echo "✓ Application key already exists"
fi

# Step 5: Clear and cache configuration
echo ""
echo "Step 5: Clearing and optimizing cache..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache
echo "✓ Cache cleared and optimized"

# Step 6: Storage link
echo ""
echo "Step 6: Creating storage symlink..."
if [ -d "public/storage" ]; then
    echo "✓ Storage link already exists"
else
    php artisan storage:link
    echo "✓ Storage symlink created"
fi

# Step 7: Database migration (optional - commented out for safety)
echo ""
echo "Step 7: Database migrations..."
read -p "Do you want to run database migrations? (y/n): " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    php artisan migrate --force
    echo "✓ Database migrations completed"
else
    echo "⊘ Skipped database migrations"
fi

# Final summary
echo ""
echo "===================================="
echo "Deployment Summary"
echo "===================================="
echo "✓ File permissions set"
echo "✓ Environment configured"
echo "✓ Dependencies installed"
echo "✓ Application key generated"
echo "✓ Cache optimized"
echo "✓ Storage linked"
echo ""
echo "Next Steps:"
echo "1. Edit .env file with your database credentials"
echo "2. Configure document root in Hostinger to point to 'public' folder"
echo "3. Verify PHP version is 8.0 or higher in Hostinger panel"
echo "4. Visit your website to verify it works"
echo ""
echo "If you get 403 errors:"
echo "- Ensure document root points to the 'public' folder"
echo "- Check that .htaccess files exist in root and public directories"
echo "- Verify mod_rewrite is enabled (contact Hostinger support)"
echo ""
echo "Deployment complete!"
