<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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
            "email" => "sysadmin@email.com",
            "password" => Hash::make('admin')
        ]);

        $administrasi = User::create([
            'email' => 'admin@email.com',
            'password' => Hash::make('admin')
        ]);

        $pasien = User::create([
            'email' => 'pasien@email.com',
            'kode' => '1bb91921',
            'password' => Hash::make('pasien')
        ]);

        $dokter = User::create([
            'email' => 'dokter@email.com',
            'kode' => Str::random(8),
            'password' => Hash::make('dokter')
        ]);

        $sysadmin = Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Administrasi Medik']);
        $pasienrole = Role::create(['name' => 'Pasien']);
        $dokterrole = Role::create(['name' => 'Dokter']);

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

        Permission::create(['name' => 'read rekam-medis']);
        Permission::create(['name' => 'read rekam-medis/pasien']);
        Permission::create(['name' => 'update rekam-medis/pasien']);
        Permission::create(['name' => 'create rekam-medis/pasien']);
        Permission::create(['name' => 'delete rekam-medis/pasien']);

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
        $admin->givePermissionTo([
            'read rekam-medis',
            'read rekam-medis/pasien',
            'create rekam-medis/pasien',
            'update rekam-medis/pasien',
            'delete rekam-medis/pasien',
        ]);
        $dokterrole->givePermissionTo([
            'read rekam-medis',
            'read rekam-medis/pasien',
        ]);
        $administrator->assignRole('Super Admin');
        $administrasi->assignRole('Administrasi Medik');
        $pasien->assignRole('Pasien');
        $dokter->assignRole('Dokter');
    }
}
