<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define all permissions grouped by resource
        $permissions = [
            // User Management
            [
                'name' => 'View Users',
                'slug' => 'users.view',
                'description' => 'View list of users',
                'group' => 'users'
            ],
            [
                'name' => 'Create Users',
                'slug' => 'users.create',
                'description' => 'Create new users',
                'group' => 'users'
            ],
            [
                'name' => 'Edit Users',
                'slug' => 'users.edit',
                'description' => 'Edit existing users',
                'group' => 'users'
            ],
            [
                'name' => 'Delete Users',
                'slug' => 'users.delete',
                'description' => 'Delete users',
                'group' => 'users'
            ],
            [
                'name' => 'Manage Roles',
                'slug' => 'roles.manage',
                'description' => 'Assign and manage user roles',
                'group' => 'users'
            ],

            // Post Management
            [
                'name' => 'View Posts',
                'slug' => 'posts.view',
                'description' => 'View list of posts',
                'group' => 'posts'
            ],
            [
                'name' => 'Create Posts',
                'slug' => 'posts.create',
                'description' => 'Create new posts',
                'group' => 'posts'
            ],
            [
                'name' => 'Edit Posts',
                'slug' => 'posts.edit',
                'description' => 'Edit existing posts',
                'group' => 'posts'
            ],
            [
                'name' => 'Delete Posts',
                'slug' => 'posts.delete',
                'description' => 'Delete posts',
                'group' => 'posts'
            ],

            // Service Management
            [
                'name' => 'View Services',
                'slug' => 'services.view',
                'description' => 'View list of services',
                'group' => 'services'
            ],
            [
                'name' => 'Create Services',
                'slug' => 'services.create',
                'description' => 'Create new services',
                'group' => 'services'
            ],
            [
                'name' => 'Edit Services',
                'slug' => 'services.edit',
                'description' => 'Edit existing services',
                'group' => 'services'
            ],
            [
                'name' => 'Delete Services',
                'slug' => 'services.delete',
                'description' => 'Delete services',
                'group' => 'services'
            ],

            // Team Management
            [
                'name' => 'View Teams',
                'slug' => 'teams.view',
                'description' => 'View team members',
                'group' => 'teams'
            ],
            [
                'name' => 'Create Teams',
                'slug' => 'teams.create',
                'description' => 'Create new team members',
                'group' => 'teams'
            ],
            [
                'name' => 'Edit Teams',
                'slug' => 'teams.edit',
                'description' => 'Edit team members',
                'group' => 'teams'
            ],
            [
                'name' => 'Delete Teams',
                'slug' => 'teams.delete',
                'description' => 'Delete team members',
                'group' => 'teams'
            ],

            // Gallery Management
            [
                'name' => 'View Gallery',
                'slug' => 'gallery.view',
                'description' => 'View gallery items',
                'group' => 'gallery'
            ],
            [
                'name' => 'Create Gallery',
                'slug' => 'gallery.create',
                'description' => 'Upload new gallery items',
                'group' => 'gallery'
            ],
            [
                'name' => 'Edit Gallery',
                'slug' => 'gallery.edit',
                'description' => 'Edit gallery items',
                'group' => 'gallery'
            ],
            [
                'name' => 'Delete Gallery',
                'slug' => 'gallery.delete',
                'description' => 'Delete gallery items',
                'group' => 'gallery'
            ],

            // Partner Management
            [
                'name' => 'View Partners',
                'slug' => 'partners.view',
                'description' => 'View partners',
                'group' => 'partners'
            ],
            [
                'name' => 'Create Partners',
                'slug' => 'partners.create',
                'description' => 'Create new partners',
                'group' => 'partners'
            ],
            [
                'name' => 'Edit Partners',
                'slug' => 'partners.edit',
                'description' => 'Edit partners',
                'group' => 'partners'
            ],
            [
                'name' => 'Delete Partners',
                'slug' => 'partners.delete',
                'description' => 'Delete partners',
                'group' => 'partners'
            ],

            // Contact Management
            [
                'name' => 'View Contacts',
                'slug' => 'contacts.view',
                'description' => 'View contact messages',
                'group' => 'contacts'
            ],
            [
                'name' => 'Edit Contacts',
                'slug' => 'contacts.edit',
                'description' => 'Edit contact messages',
                'group' => 'contacts'
            ],
            [
                'name' => 'Delete Contacts',
                'slug' => 'contacts.delete',
                'description' => 'Delete contact messages',
                'group' => 'contacts'
            ],

            // Theme Management
            [
                'name' => 'View Themes',
                'slug' => 'themes.view',
                'description' => 'View themes',
                'group' => 'themes'
            ],
            [
                'name' => 'Create Themes',
                'slug' => 'themes.create',
                'description' => 'Create new themes',
                'group' => 'themes'
            ],
            [
                'name' => 'Edit Themes',
                'slug' => 'themes.edit',
                'description' => 'Edit themes',
                'group' => 'themes'
            ],
            [
                'name' => 'Delete Themes',
                'slug' => 'themes.delete',
                'description' => 'Delete themes',
                'group' => 'themes'
            ],
            [
                'name' => 'Activate Themes',
                'slug' => 'themes.activate',
                'description' => 'Activate/switch themes',
                'group' => 'themes'
            ],

            // Settings Management
            [
                'name' => 'View Settings',
                'slug' => 'settings.view',
                'description' => 'View system settings',
                'group' => 'settings'
            ],
            [
                'name' => 'Edit Settings',
                'slug' => 'settings.edit',
                'description' => 'Edit system settings',
                'group' => 'settings'
            ],
        ];

        // Create all permissions
        $createdPermissions = [];
        foreach ($permissions as $permissionData) {
            $createdPermissions[$permissionData['slug']] = Permission::firstOrCreate(
                ['slug' => $permissionData['slug']],
                $permissionData
            );
        }

        // Create Super Admin Role
        $superAdminRole = Role::firstOrCreate(
            ['slug' => 'super-admin'],
            [
                'name' => 'Super Administrator',
                'description' => 'Has complete access to all system features and can manage other administrators',
                'is_super_admin' => true,
            ]
        );

        // Create Admin Role with limited permissions
        $adminRole = Role::firstOrCreate(
            ['slug' => 'admin'],
            [
                'name' => 'Administrator',
                'description' => 'Has access to most system features but cannot manage other administrators',
                'is_super_admin' => false,
            ]
        );

        // Assign permissions to Admin role (all except user and role management)
        $adminPermissions = [
            'posts.view', 'posts.create', 'posts.edit', 'posts.delete',
            'services.view', 'services.create', 'services.edit', 'services.delete',
            'teams.view', 'teams.create', 'teams.edit', 'teams.delete',
            'gallery.view', 'gallery.create', 'gallery.edit', 'gallery.delete',
            'partners.view', 'partners.create', 'partners.edit', 'partners.delete',
            'contacts.view', 'contacts.edit', 'contacts.delete',
            'themes.view', 'themes.create', 'themes.edit', 'themes.delete', 'themes.activate',
            'settings.view', 'settings.edit',
        ];

        $adminPermissionIds = collect($adminPermissions)->map(function ($slug) use ($createdPermissions) {
            return $createdPermissions[$slug]->id;
        })->toArray();

        $adminRole->syncPermissions($adminPermissionIds);

        // Update existing users to have role relationships
        $this->updateExistingUsers($superAdminRole, $adminRole);

        $this->command->info('Roles and permissions have been seeded successfully!');
        $this->command->info('Super Admin Role: ' . $superAdminRole->name);
        $this->command->info('Admin Role: ' . $adminRole->name);
        $this->command->info('Total Permissions: ' . count($createdPermissions));
    }

    /**
     * Update existing users to have role relationships
     */
    private function updateExistingUsers(Role $superAdminRole, Role $adminRole): void
    {
        // Assign role_id to existing users based on their role field
        User::where('role', 'superadmin')->update(['role_id' => $superAdminRole->id]);
        User::where('role', 'admin')->update(['role_id' => $adminRole->id]);

        $this->command->info('Existing users have been updated with role relationships.');
    }
}
