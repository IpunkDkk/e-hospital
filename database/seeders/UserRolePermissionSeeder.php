<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = User::create([
            "email" => "admin@email.com",
            "password" => Hash::make('admin')
        ]);

        $sysadmin = Role::create(['name' => 'Super Admin']);
        Permission::create(['name' => 'read konfigurasi']);



        Permission::create(['name' => 'read konfigurasi/roles']);
        Permission::create(['name' => 'update konfigurasi/roles']);
        Permission::create(['name' => 'create konfigurasi/roles']);
        Permission::create(['name' => 'delete konfigurasi/roles']);

        Permission::create(['name' => 'read konfigurasi/permissions']);
        Permission::create(['name' => 'update konfigurasi/permissions']);
        Permission::create(['name' => 'create konfigurasi/permissions']);
        Permission::create(['name' => 'delete konfigurasi/permissions']);

        Permission::create(['name' => 'read konfigurasi/users']);
        Permission::create(['name' => 'update konfigurasi/users']);
        Permission::create(['name' => 'create konfigurasi/users']);
        Permission::create(['name' => 'delete konfigurasi/users']);

        $sysadmin->givePermissionTo([
            'read konfigurasi/roles',
            'create konfigurasi/roles',
            'update konfigurasi/roles',
            'delete konfigurasi/roles',

            'read konfigurasi/permissions',
            'create konfigurasi/permissions',
            'update konfigurasi/permissions',
            'delete konfigurasi/permissions',

            'read konfigurasi/users',
            'create konfigurasi/users',
            'update konfigurasi/users',
            'delete konfigurasi/users',

            'read konfigurasi',
        ]);
        $administrator->assignRole('Super Admin');
    }
}
