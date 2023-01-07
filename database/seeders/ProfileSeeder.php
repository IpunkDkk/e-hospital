<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = Profile::create([
            'user_id' => 1,
            'name' => 'Agung',
            'no_hp' => '20200220',
            'alamat' => 'dempo',
            'no_kk' => '3373737',
            'photo' => 'avatar1.png'
        ]);

        $rekamMedik = Profile::create([
            'user_id' => 2,
            'name' => 'Trio Agung Purwanto',
            'no_hp' => '20832032083',
            'alamat' => 'dempo',
            'no_kk' => '545645656',
            'photo' => 'avatar1.png'
        ]);
        $pasien = Profile::create([
            'user_id' => 3,
            'name' => 'Siful Bahri',
            'no_hp' => '20832032083',
            'alamat' => 'dempo',
            'no_kk' => '02389229',
            'photo' => 'avatar1.png'
        ]);
        $dokter = Profile::create([
            'user_id' => 4,
            'name' => 'dr. Mahardika',
            'no_hp' => '373932937',
            'alamat' => 'Pamekasan',
            'no_kk' => '832829238',
            'photo' => 'avatar1.png'
        ]);
    }
}
