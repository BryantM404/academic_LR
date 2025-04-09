<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mahasiswas = [
            [
                'id' => 'M-00001',
                'nrp' => '2372001',
                'nama' => 'John Doe',
                'email' => 'JohnDoe@gmail.com',
                'alamat' => 'Jl. Pelajar No. 25',
                'noTelp' => '081672345179',
                'tanggalLahir' => '2005-04-03',
                'prodi_id' => 'P-00001',
                'user_id' => 'U-00006'
            ],
            [
                'id' => 'M-00002',
                'nrp' => '2373001',
                'nama' => 'Jane Doe',
                'email' => 'JaneDoe@gmail.com',
                'alamat' => 'Jl. Pejuang No. 37',
                'noTelp' => '08956789322',
                'tanggalLahir' => '2005-07-07',
                'prodi_id' => 'P-00002',
                'user_id' => 'U-00007'
            ],
        ];

        foreach ($mahasiswas as $mahasiswa) {
            Mahasiswa::create($mahasiswa);
        }
    }
}
