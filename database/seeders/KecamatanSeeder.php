<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kecamatan::insert([
            'kecamatan_nama' => 'Tana Righu',
        ]);
        Kecamatan::insert([
            'kecamatan_nama' => 'Loli',
        ]);
        Kecamatan::insert([
            'kecamatan_nama' => 'Wanokaka',
        ]);
        Kecamatan::insert([
            'kecamatan_nama' => 'Lamboya',
        ]);
        Kecamatan::insert([
            'kecamatan_nama' => 'Kota Waikabubak',
        ]);
        Kecamatan::insert([
            'kecamatan_nama' => '	Laboya Barat',
        ]);
    }
}
