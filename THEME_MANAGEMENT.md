# IEBC Theme Management System

## Overview
The IEBC website now features a comprehensive dynamic theme management system that allows you to switch between multiple color palettes and typography options directly from the admin panel. All themes are designed to harmonize with the IEBC company logo (Navy Blue #1e3a5f and Gold #c9a961).

## Features

### 1. Pre-configured Themes
Five professionally designed themes are included by default:

#### IEBC Classic (Default & Active)
- **Description**: Official IEBC theme matching the company logo
- **Primary Color**: #1e3a5f (Navy Blue from logo)
- **Accent Color**: #c9a961 (Gold from logo)
- **Font**: System UI
- **Best For**: Professional corporate look matching brand identity

#### Golden Elegance
- **Description**: Luxurious gold and cream palette
- **Primary Color**: #c9a961 (Gold)
- **Accent Color**: #1e3a5f (Navy as accent)
- **Font**: Playfair Display (serif)
- **Best For**: Premium, elegant presentations

#### Ocean Corporate
- **Description**: Professional blue tones with gold accents
- **Primary Color**: #1e3a5f (Navy)
- **Secondary Color**: #2c5f8d (Ocean blue)
- **Accent Color**: #c9a961 (Gold)
- **Font**: Roboto / Montserrat
- **Best For**: Corporate and business-focused content

#### Modern Minimal
- **Description**: Clean and minimal design with subtle gold highlights
- **Primary Color**: #2c3e50 (Dark gray-blue)
- **Accent Color**: #c9a961 (Gold)
- **Font**: Inter
- **Best For**: Contemporary, minimalist aesthetic

#### Royal Prestige
- **Description**: Deep navy with rich gold for premium corporate look
- **Primary Color**: #0a1929 (Darker navy)
- **Secondary Color**: #1e3a5f (Logo navy)
- **Accent Color**: #d4af37 (Richer gold)
- **Font**: Lora / Merriweather (serif)
- **Best For**: Premium, authoritative content

### 2. Theme Components
Each theme includes comprehensive color palette customization:

- **Primary Color**: Main brand color used for headers, navigation
- **Secondary Color**: Supporting color for gradients and accents
- **Accent Color**: Highlight color for special elements
- **Success Color**: For positive actions and messages
- **Warning Color**: For alerts and cautions
- **Danger Color**: For errors and destructive actions
- **Info Color**: For informational messages
- **Light Color**: Background and light elements
- **Dark Color**: Text and dark elements

### 3. Typography Settings
- **Primary Font Family**: Main body text font
- **Heading Font Family**: Optional separate font for headings
- **Supported Fonts**:
  - System fonts (System UI)
  - Google Fonts: Roboto, Open Sans, Lato, Montserrat, Poppins, Inter, Playfair Display, Merriweather, Lora

### 4. Design Settings
- **Border Radius**: Customizable roundness of cards and buttons
- **Box Shadow**: Customizable shadow effects for depth

## Usage

### Accessing Theme Management
1. Log in to the admin panel: `/back-end-iebc`
2. Navigate to **Thèmes** in the sidebar (palette icon)
3. View all available themes with color previews

### Activating a Theme
1. Browse the theme cards
2. Click **Activer** button on the desired theme
3. The theme will be applied immediately across the entire frontend
4. The previously active theme will be deactivated automatically

### Creating a Custom Theme
1. Click **Créer un nouveau thème** button
2. Fill in the form:
   - **Name (slug)**: URL-friendly name (e.g., `my-custom-theme`)
   - **Display Name**: User-friendly name shown in admin
   - **Description**: Brief description of the theme
   - **Color Palette**: Use color pickers to select all 9 colors
   - **Typography**: Select fonts for body and headings
   - **Design Settings**: Set border radius and box shadow
   - **Sort Order**: Numeric value for ordering (optional)
3. Click **Créer le thème**

### Editing an Existing Theme
1. Click **Modifier** on any theme card
2. Update any settings as needed
3. Click **Mettre à jour le thème**
4. Changes apply immediately if the theme is active

### Deleting a Theme
- Only inactive, non-default themes can be deleted
- Click the trash icon on a theme card
- Confirm the deletion

## Technical Details

### Database
- Table: `themes`
- Migration: `database/migrations/2025_10_23_091407_create_themes_table.php`
- Model: `App\Models\Theme`

### Model Methods
```php
// Get the currently active theme
$theme = Theme::getActive();

// Activate a theme
$theme->activate();

// Get CSS variables
$cssVars = $theme->getCssVariables();

// Get Bootstrap color mappings
$colors = $theme->getBootstrapColors();
```

### Frontend Integration
The active theme is automatically loaded in:
- `resources/views/layouts/frontend.blade.php`

CSS variables are injected into `:root`:
```css
:root {
    --primary-color: #1e3a5f;
    --secondary-color: #6c757d;
    --accent-color: #c9a961;
    /* ... and more */
}
```

### Caching
- Active theme is cached for 1 hour
- Cache is automatically cleared when:
  - A theme is saved
  - A theme is deleted
  - A theme is activated

### Routes
- **Index**: `/back-end-iebc/themes` - View all themes
- **Create**: `/back-end-iebc/themes/create` - Create new theme
- **Edit**: `/back-end-iebc/themes/{id}/edit` - Edit theme
- **Activate**: `/back-end-iebc/themes/{id}/activate` - Activate theme
- **Delete**: `/back-end-iebc/themes/{id}` - Delete theme (DELETE method)

## Best Practices

### Color Selection
1. **Maintain Contrast**: Ensure text is readable on backgrounds
2. **Brand Consistency**: Use colors that align with IEBC branding
3. **Accessibility**: Follow WCAG guidelines for color contrast ratios
4. **Test Multiple Pages**: Preview theme on different page types

### Typography
1. **Readability**: Choose legible fonts for body text
2. **Load Time**: Limit the number of Google Fonts to 2-3 maximum
3. **Hierarchy**: Use heading fonts that complement body fonts
4. **System Fonts**: Consider using system fonts for better performance

### Maintenance
1. **Backup Themes**: Export theme configurations before major changes
2. **Test First**: Create a test theme before modifying active theme
3. **Document Changes**: Note customizations in theme descriptions
4. **Performance**: Monitor page load times when using custom fonts

## Troubleshooting

### Theme Not Applying
- Clear browser cache (Ctrl+F5)
- Check if theme is marked as active in admin
- Clear application cache: `php artisan cache:clear`

### Colors Not Showing
- Verify color codes are valid hex values (e.g., #1e3a5f)
- Check browser developer tools for CSS variable values
- Ensure theme is properly saved in database

### Fonts Not Loading
- Verify Google Fonts are accessible
- Check network tab in browser dev tools
- Confirm font names match exactly (case-sensitive)

## Support & Extension

### Adding New Preset Themes
Edit `database/seeders/ThemeSeeder.php` and add new theme configurations to the `$themes` array.

### Custom CSS
For advanced customization beyond theme settings, add custom CSS in:
- Frontend: `resources/views/layouts/frontend.blade.php` in the `@stack('styles')` section
- Admin: Modify `resources/views/admin/layouts/app.blade.php`

### Future Enhancements
Potential improvements:
- Theme preview before activation
- Import/Export theme configurations
- Dark mode variants
- Per-page theme overrides
- Theme scheduling (auto-switch themes)

---

**Created**: October 23, 2025
**Version**: 1.0
**Author**: IEBC Development Team
