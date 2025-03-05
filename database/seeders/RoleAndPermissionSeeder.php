<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'view_users',
            'create_users',
            'edit_users',
            'delete_users',
            'view_roles',
            'create_roles',
            'edit_roles',
            'delete_roles',
            'view_permissions',
            'create_permissions',
            'edit_permissions',
            'delete_permissions'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $roles = [
            'super_admin' => $permissions,
            'admin' => [
                'view_users',
                'create_users',
                'edit_users',
                'view_roles',
                'view_permissions'
            ],
            'user' => [
                'view_users'
            ]
        ];

        foreach ($roles as $role => $permissions) {
            $createdRole = Role::create(['name' => $role]);
            $createdRole->givePermissionTo($permissions);
        }
    }
}
