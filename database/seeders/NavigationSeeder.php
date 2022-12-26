<?php

namespace Database\Seeders;

use App\Models\Navigation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NavigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $konfigurasi = Navigation::create([
            'name' => 'Konfigurasi',
            'url' => 'konfigurasi',
            'icon' => 'ti-settings',
            'main_menu' => null,
        ]);
        $konfigurasi->subMenus()->create([
            'name' => 'Role',
            'url' => 'konfigurasi/roles',
            'icon' => '',
        ]);
        $konfigurasi->subMenus()->create([
            'name' => 'Permission',
            'url' => 'konfigurasi/permissions',
            'icon' => '',
        ]);
        $konfigurasi->subMenus()->create([
            'name' => 'Users',
            'url' => 'konfigurasi/users',
            'icon' => '',
        ]);
    }
}
