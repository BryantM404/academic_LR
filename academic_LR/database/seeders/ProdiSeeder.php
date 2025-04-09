<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prodi;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prodis = [
            [
                'id' => 'P-00001',
                'nama' => 'Teknik Informatika',
            ],
            [
                'id' => 'P-00002',
                'nama' => 'Sistem Informasi',
            ],    
        ];

        foreach ($prodis as $prodi) {
            Prodi::create($prodi);
        }
    }
}
