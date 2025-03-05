<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Define permission groups
        $permissions = [
            'Dashboard' => [
                'view_dashboard' => 'Access to view the main dashboard',
            ],
            
            'User Management' => [
                'view_users' => 'View list of users',
                'create_users' => 'Create new users',
                'edit_users' => 'Edit existing users',
                'delete_users' => 'Delete users',
            ],
            
            'Role Management' => [
                'view_roles' => 'View list of roles',
                'create_roles' => 'Create new roles',
                'edit_roles' => 'Edit existing roles',
                'delete_roles' => 'Delete roles',
                'assign_permissions' => 'Assign permissions to roles',
            ],
            
            'Settings' => [
                'view_settings' => 'View system settings',
                'manage_settings' => 'Modify system settings',
            ],
            
            'Properties' => [
                'view_properties' => 'View list of properties',
                'create_properties' => 'Create new properties',
                'edit_properties' => 'Edit existing properties',
                'delete_properties' => 'Delete properties',
                'manage_property_status' => 'Change property status (available/sold/rented)',
            ],
            
            'Inquiries' => [
                'view_inquiries' => 'View customer inquiries',
                'respond_inquiries' => 'Respond to customer inquiries',
                'delete_inquiries' => 'Delete customer inquiries',
            ],
            
            'Reports' => [
                'view_reports' => 'View system reports',
                'export_reports' => 'Export reports data',
            ],
        ];

        // Create permissions
        foreach ($permissions as $group => $groupPermissions) {
            foreach ($groupPermissions as $permission => $description) {
                Permission::create([
                    'name' => $permission,
                    'group' => $group,
                    'description' => $description,
                ]);
            }
        }
    }
}
