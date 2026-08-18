<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // =======================
        // Roles
        // =======================
        $role = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        Role::firstOrCreate([
            'name' => 'supervisor',
            'guard_name' => 'web',
        ]);

        Role::firstOrCreate([
            'name' => 'editor',
            'guard_name' => 'web',
        ]);

        Role::firstOrCreate([
            'name' => 'customer',
            'guard_name' => 'web',
        ]);

        // =======================
        // Admin
        // =======================
        $admin = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'first_name' => 'Admin',
                'last_name' => 'System',
                'user_name' => 'admin',
                'email_verified_at' => now(),
                'phone' => '01000000000',
                'status' => 1,
                'password' => bcrypt('123123123'),
                'remember_token' => Str::random(10),
            ]
        );

        $admin->syncRoles('admin');

        $modules = [
            'category',
            'product',
            'tag',
            'role',
            'permission',
        ];

        $actions = [
            'view',
            'create',
            'edit',
            'delete',
        ];

        foreach ($modules as $module) {
            foreach ($actions as $action) {
                Permission::firstOrCreate([
                    'name' => "{$module}.{$action}",
                    'guard_name' => 'web',
                ]);
            }
        }

        $role->syncPermissions(Permission::all());
        // $admin->syncRoles('admin');
        // =======================
        // Supervisor
        // =======================
        $supervisor = User::firstOrCreate(
            ['email' => 'supervisor@admin.com'],
            [
                'first_name' => 'Supervisor',
                'last_name' => 'System',
                'user_name' => 'supervisor',
                'email_verified_at' => now(),
                'phone' => '01000000001',
                'status' => 1,
                'password' => bcrypt('123123123'),
                'remember_token' => Str::random(10),
            ]
        );

        $supervisor->syncRoles('supervisor');

        // =======================
        // Customer 1
        // =======================
        $customer = User::firstOrCreate(
            ['email' => 'customer1@admin.com'],
            [
                'first_name' => 'Customer',
                'last_name' => '1',
                'user_name' => 'customer1',
                'email_verified_at' => now(),
                'phone' => '01000000002',
                'status' => 1,
                'password' => bcrypt('123123123'),
                'remember_token' => Str::random(10),
            ]
        );

        $customer->syncRoles('customer');

        // =======================
        // Customers
        // =======================
        for ($i = 3; $i <= 20; $i++) {

            $firstName = fake()->firstName();

            $customer = User::firstOrCreate(
                ['email' => "customer{$i}@admin.com"],
                [
                    'first_name' => $firstName,
                    'last_name' => fake()->lastName(),
                    'user_name' => $firstName . $i,
                    'email_verified_at' => now(),
                    'phone' => '0100000000' .  $i,
                    'status' => 1,
                    'password' => bcrypt('123123123'),
                    'remember_token' => Str::random(10),
                ]
            );

            $customer->syncRoles('customer');
        }
    }
}