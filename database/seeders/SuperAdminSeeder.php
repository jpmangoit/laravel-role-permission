<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        // Create super_admin role
        $superAdminRole = Role::create(['name' => 'super_admin']);

        // Get all permissions
        $permissions = Permission::all();

        // Assign all permissions to super_admin role
        $superAdminRole->syncPermissions($permissions);

        // Create super admin user
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        // Assign super_admin role to user
        $superAdmin->assignRole('super_admin');
    }
}
