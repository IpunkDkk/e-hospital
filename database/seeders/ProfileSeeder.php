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
    }
}
