<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Create admin role if it doesn't exist
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin2@admin.com',
            'password' => Hash::make('password'),
        ]);

        // Assign admin role
        $admin->assignRole('admin');
    }
}
