#!/bin/bash

# Laravel File Permissions Fix Script for Hostinger
# This script sets the correct file permissions for a Laravel application

echo "Setting Laravel file permissions for Hostinger..."

# Get the current directory
LARAVEL_DIR=$(pwd)

echo "Working in directory: $LARAVEL_DIR"

# Set general file permissions (644)
echo "Setting file permissions to 644..."
find . -type f -exec chmod 644 {} \;

# Set general directory permissions (755)
echo "Setting directory permissions to 755..."
find . -type d -exec chmod 755 {} \;

# Set storage directory permissions (775)
echo "Setting storage directory permissions to 775..."
if [ -d "storage" ]; then
    chmod -R 775 storage
    echo "✓ Storage directory permissions set"
else
    echo "⚠ Warning: storage directory not found"
fi

# Set bootstrap/cache directory permissions (775)
echo "Setting bootstrap/cache directory permissions to 775..."
if [ -d "bootstrap/cache" ]; then
    chmod -R 775 bootstrap/cache
    echo "✓ Bootstrap cache directory permissions set"
else
    echo "⚠ Warning: bootstrap/cache directory not found"
fi

# Make artisan executable
if [ -f "artisan" ]; then
    chmod +x artisan
    echo "✓ Artisan made executable"
fi

echo ""
echo "File permissions have been set successfully!"
echo ""
echo "Current permissions:"
echo "-------------------"
ls -la storage/ 2>/dev/null || echo "storage/ not found"
ls -la bootstrap/cache/ 2>/dev/null || echo "bootstrap/cache/ not found"
echo ""
echo "If you still have permission issues, try running:"
echo "  chmod -R 777 storage"
echo "  chmod -R 777 bootstrap/cache"
echo ""
echo "Note: 777 is less secure but may be required on some shared hosting environments."
