# Admin Role System Documentation

## Overview

This document describes the comprehensive administrator role structure implemented in the IEBC website. The system provides a **Super Admin** role with full privileges and the ability to manage other administrators.

## Key Features

1. **Super Admin Role**: Has complete access to all system features
2. **Regular Admin Role**: Has access to content management but cannot manage other administrators
3. **Granular Permissions**: 35 permissions organized by resource groups
4. **Role-Based Access Control**: Middleware and model-level permission checking
5. **Secure User Management**: Only Super Admin can add, edit, or remove administrators

## Database Structure

### Tables Created

1. **roles** - Stores role definitions
   - `id`: Primary key
   - `name`: Role display name
   - `slug`: URL-friendly identifier
   - `description`: Role description
   - `is_super_admin`: Boolean flag for super admin role
   - `created_at`, `updated_at`: Timestamps

2. **permissions** - Stores permission definitions
   - `id`: Primary key
   - `name`: Permission display name
   - `slug`: URL-friendly identifier (e.g., `users.create`)
   - `description`: Permission description
   - `group`: Resource group (e.g., `users`, `posts`, `settings`)
   - `created_at`, `updated_at`: Timestamps

3. **permission_role** - Pivot table linking roles to permissions
   - `id`: Primary key
   - `role_id`: Foreign key to roles
   - `permission_id`: Foreign key to permissions
   - `created_at`, `updated_at`: Timestamps

4. **users** table updated with:
   - `role_id`: Foreign key to roles table

## Models

### Role Model (`App\Models\Role`)

**Location**: `app/Models/Role.php`

**Key Methods**:
- `users()`: Get all users with this role
- `permissions()`: Get all permissions for this role
- `hasPermission($permissionSlug)`: Check if role has a specific permission
- `givePermission($permission)`: Assign a permission to the role
- `revokePermission($permission)`: Remove a permission from the role
- `syncPermissions($permissionIds)`: Sync all permissions for the role

### Permission Model (`App\Models\Permission`)

**Location**: `app/Models/Permission.php`

**Key Methods**:
- `roles()`: Get all roles that have this permission

### User Model (`App\Models\User`)

**Location**: `app/Models/User.php`

**Enhanced Methods**:
- `userRole()`: Get the user's role relationship
- `hasPermission($permissionSlug)`: Check if user has a specific permission
- `hasAnyPermission($permissions)`: Check if user has any of the given permissions
- `hasAllPermissions($permissions)`: Check if user has all of the given permissions
- `getAllPermissions()`: Get all permissions for the user through their role
- `isSuperAdmin()`: Check if user is a super admin
- `isAdmin()`: Check if user is any type of admin

## Permissions List

### User Management (Super Admin Only)
- `users.view` - View list of users
- `users.create` - Create new users
- `users.edit` - Edit existing users
- `users.delete` - Delete users
- `roles.manage` - Assign and manage user roles

### Content Management (All Admins)
- **Posts**: `posts.view`, `posts.create`, `posts.edit`, `posts.delete`
- **Services**: `services.view`, `services.create`, `services.edit`, `services.delete`
- **Teams**: `teams.view`, `teams.create`, `teams.edit`, `teams.delete`
- **Gallery**: `gallery.view`, `gallery.create`, `gallery.edit`, `gallery.delete`
- **Partners**: `partners.view`, `partners.create`, `partners.edit`, `partners.delete`
- **Contacts**: `contacts.view`, `contacts.edit`, `contacts.delete`
- **Themes**: `themes.view`, `themes.create`, `themes.edit`, `themes.delete`, `themes.activate`
- **Settings**: `settings.view`, `settings.edit`

## Middleware

### SuperAdminMiddleware

**Location**: `app/Http/Middleware/SuperAdminMiddleware.php`

Protects routes that only super admins can access. Returns 403 error if user is not a super admin.

### CheckPermission Middleware

**Location**: `app/Http/Middleware/CheckPermission.php`

**Alias**: `permission`

Checks if a user has a specific permission before allowing access to a route.

**Usage**:
```php
Route::middleware(['permission:posts.create'])->group(function () {
    // Routes that require posts.create permission
});
```

**Registered in Kernel**:
```php
protected $middlewareAliases = [
    // ... other middleware
    'permission' => \App\Http\Middleware\CheckPermission::class,
];
```

## Controllers

### UserController

**Location**: `app/Http/Controllers/Admin/UserController.php`

**Protected Routes**: All routes are protected by `superadmin` middleware

**Key Features**:
- Only Super Admin can access user management
- Prevents users from editing/deleting themselves
- Prevents deleting the last Super Admin
- Validates role assignments
- Enforces single Super Admin policy (can be adjusted)

**Methods**:
- `index()`: List all users with their roles
- `create()`: Show user creation form
- `store()`: Create a new user with role assignment
- `edit($user)`: Show user edit form
- `update($user)`: Update user information and role
- `destroy($user)`: Delete a user

## Routes

User management routes are protected and only accessible by Super Admin:

```php
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // ... other admin routes

    // User Management (Super Admin Only)
    Route::middleware(['superadmin'])->group(function () {
        Route::resource('users', App\Http\Controllers\Admin\UserController::class)
            ->except(['show']);
    });
});
```

## Views

### User Management Views

1. **Index** (`resources/views/admin/users/index.blade.php`)
   - Lists all users with their roles
   - Shows role badges
   - Provides edit/delete actions
   - Prevents self-modification

2. **Create** (`resources/views/admin/users/create.blade.php`)
   - Form to create new users
   - Role selection dropdown
   - Password requirements
   - Helpful information sidebar

3. **Edit** (`resources/views/admin/users/edit.blade.php`)
   - Form to edit existing users
   - Role modification
   - Optional password change
   - User information display

## Seeder

### RolesAndPermissionsSeeder

**Location**: `database/seeders/RolesAndPermissionsSeeder.php`

**What it does**:
1. Creates 35 permissions organized by resource groups
2. Creates two roles:
   - **Super Administrator**: Has `is_super_admin = true`, gets ALL permissions automatically
   - **Administrator**: Has `is_super_admin = false`, gets all permissions except user/role management
3. Updates existing users to link them to their roles based on their current `role` field

**Run the seeder**:
```bash
php artisan db:seed --class=RolesAndPermissionsSeeder
```

## Installation & Setup

### 1. Run the Migration

```bash
php artisan migrate
```

This creates the `roles`, `permissions`, and `permission_role` tables, and adds `role_id` to the users table.

### 2. Seed the Database

```bash
php artisan db:seed --class=RolesAndPermissionsSeeder
```

This creates the roles, permissions, and links existing users to their appropriate roles.

### 3. Update Autoloader

```bash
composer dump-autoload
```

## Usage Examples

### Checking Permissions in Controllers

```php
// Check if user has a specific permission
if (auth()->user()->hasPermission('posts.create')) {
    // Allow post creation
}

// Check if user has any of multiple permissions
if (auth()->user()->hasAnyPermission(['posts.edit', 'posts.delete'])) {
    // Allow post management
}

// Check if user has all permissions
if (auth()->user()->hasAllPermissions(['posts.create', 'posts.edit'])) {
    // Allow full post management
}
```

### Checking Permissions in Blade Views

```blade
@if(auth()->user()->hasPermission('users.create'))
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
        Add New User
    </a>
@endif

@if(auth()->user()->isSuperAdmin())
    <div class="super-admin-panel">
        <!-- Super admin only content -->
    </div>
@endif
```

### Using Permission Middleware in Routes

```php
// Single permission
Route::middleware(['permission:posts.create'])->group(function () {
    Route::get('/admin/posts/create', [PostController::class, 'create']);
});

// Multiple permissions (user needs any one)
Route::get('/admin/content/manage', [ContentController::class, 'index'])
    ->middleware(['auth', 'admin']);
```

## Security Features

1. **Super Admin Protection**
   - Only Super Admin can access user management
   - Cannot delete the last Super Admin
   - Cannot modify own account through the user management interface

2. **Role Assignment Validation**
   - Validates role exists before assignment
   - Prevents multiple Super Admins (can be adjusted)
   - Maintains referential integrity with foreign keys

3. **Middleware Protection**
   - All admin routes protected by authentication
   - User management routes protected by Super Admin middleware
   - Permission-based access control available

4. **Audit Trail**
   - Timestamps on all role and permission changes
   - User relationships tracked through foreign keys

## Extending the System

### Adding New Permissions

1. Add permission definition in `RolesAndPermissionsSeeder`:

```php
[
    'name' => 'Manage Products',
    'slug' => 'products.manage',
    'description' => 'Full product management access',
    'group' => 'products'
]
```

2. Re-run the seeder or manually insert into the `permissions` table

3. Assign to roles as needed

### Creating New Roles

```php
use App\Models\Role;
use App\Models\Permission;

// Create a new role
$role = Role::create([
    'name' => 'Content Editor',
    'slug' => 'content-editor',
    'description' => 'Can edit content but not publish',
    'is_super_admin' => false,
]);

// Assign permissions
$permissions = Permission::whereIn('slug', [
    'posts.view',
    'posts.edit',
    'services.view',
    'services.edit',
])->get();

$role->syncPermissions($permissions->pluck('id')->toArray());
```

### Assigning Roles to Users

```php
use App\Models\User;
use App\Models\Role;

$user = User::find(1);
$role = Role::where('slug', 'admin')->first();

$user->role_id = $role->id;
$user->role = $role->is_super_admin ? 'superadmin' : 'admin';
$user->save();
```

## Best Practices

1. **Always check permissions** in controllers before performing sensitive operations
2. **Use middleware** for route-level protection
3. **Don't bypass Super Admin checks** - they exist for security
4. **Keep the permission list organized** by resource groups
5. **Document new permissions** when adding features
6. **Test permission changes** thoroughly before deployment
7. **Backup database** before modifying roles/permissions

## Troubleshooting

### User can't access admin panel
- Check if user has `role` field set to 'admin' or 'superadmin'
- Verify `role_id` is set correctly
- Run seeder to sync existing users: `php artisan db:seed --class=RolesAndPermissionsSeeder`

### Permission checks not working
- Clear application cache: `php artisan cache:clear`
- Regenerate autoload: `composer dump-autoload`
- Verify middleware is registered in `app/Http/Kernel.php`

### Migration errors
- Check if tables already exist
- Verify database connection
- Look for foreign key constraint issues

## Files Modified/Created

### New Files
- `database/migrations/2025_10_30_140401_create_roles_and_permissions_tables.php`
- `app/Models/Role.php`
- `app/Models/Permission.php`
- `app/Http/Middleware/CheckPermission.php`
- `database/seeders/RolesAndPermissionsSeeder.php`

### Modified Files
- `app/Models/User.php` - Added permission checking methods
- `app/Http/Controllers/Admin/UserController.php` - Enhanced with role support
- `app/Http/Kernel.php` - Registered permission middleware
- `resources/views/admin/users/index.blade.php` - Updated to show roles
- `resources/views/admin/users/create.blade.php` - Added role selection
- `resources/views/admin/users/edit.blade.php` - Added role modification

## Summary

This implementation provides a robust, scalable role and permission system for the IEBC website. The Super Admin has complete control over user management and can assign appropriate roles to other administrators, while regular admins can manage content without access to user administration.

The system is designed to be:
- **Secure**: Multiple layers of protection
- **Flexible**: Easy to add new roles and permissions
- **Maintainable**: Well-organized code with clear separation of concerns
- **User-friendly**: Intuitive interface for role management

For questions or issues, please refer to this documentation or contact the development team.
