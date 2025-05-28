<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        Permission::create(['name' => 'manage content']);
        Permission::create(['name' => 'schedule appointments']);
        Permission::create(['name' => 'respond to appointments']);
        Permission::create(['name' => 'view appointments']);

        $adminRole = Role::create(['name' => 'admin']);
        $instructorRole = Role::create(['name' => 'instructor']);
        $customerRole = Role::create(['name' => 'customer']);

        $adminRole->givePermissionTo('manage content');
        $adminRole->givePermissionTo('view appointments');

        $instructorRole->givePermissionTo('respond to appointments');
        $instructorRole->givePermissionTo('view appointments');

        $customerRole->givePermissionTo('schedule appointments');

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@skisite.com',
            'password' => bcrypt('password'),
            'phone' => '1234567890',
        ]);
        $admin->assignRole('admin');

        $instructor = User::create([
            'name' => 'Instructor User',
            'email' => 'instructor@skisite.com',
            'password' => bcrypt('password'),
            'phone' => '1234567891',
        ]);
        $instructor->assignRole('instructor');

        $customer = User::create([
            'name' => 'Customer User',
            'email' => 'customer@skisite.com',
            'password' => bcrypt('password'),
            'phone' => '1234567892',
        ]);
        $customer->assignRole('customer');
    }
}