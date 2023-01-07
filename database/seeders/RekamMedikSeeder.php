<?php

namespace Database\Seeders;

use App\Models\RekamMedik;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RekamMedikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RekamMedik::create([
            'user_id' => 3,
            'no-medik' => Str::random('10'),
            'masuk' => 'konsultasi',
            'status' => 'Keluar',
            'tgl-keluar' => null,
            'd-utama' => 'mag',
            'tindakan' => 'Memberi Obat Penghilang Nyeri',
            'k-krs' => 'Belum Sembuh',
            'c-krs' => 'DiPulangkan',
            'c-mrs' => 'admission',
            'd-merawat' => 4,
        ]);
    }
}
