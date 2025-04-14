<?php

namespace Database\Seeders;

use App\Models\Kaprodi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KaprodiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kaprodis = [
            [
                'id' => 'K-00001',
                'nama' => 'Robby Tan',
                'email' => 'RobbyTan@gmail.com',
                'alamat' => 'Jl. Juanda No. 1',
                'noTelp' => '0819241012',
                'tanggalLahir' => '1989-10-23',
                'prodi_id' => 'P-00001',
                'user_id' => 'U-00002'
            ],
            [
                'id' => 'K-00002',
                'nama' => 'Sendy Ferdian Sujadi',
                'email' => 'SendyFS@gmail.com',
                'alamat' => 'Jl. Ramdhan No. 71',
                'noTelp' => '081256372457',
                'tanggalLahir' => '1989-05-19',
                'prodi_id' => 'P-00002',
                'user_id' => 'U-00003'
            ],
        ];

        foreach ($kaprodis as $kaprodi) {
            Kaprodi::create($kaprodi);
        }
    }
}
