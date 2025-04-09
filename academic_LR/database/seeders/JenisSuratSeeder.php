<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisSurat;

class JenisSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jeniss = [
            [
                'id' => '1',
                'nama' => 'Surat Keterangan Mahasiswa Aktif',
            ],
            [
                'id' => '2',
                'nama' => 'Surat Pengantar Tugas Mata Kuliah',
            ],
            [
                'id' => '3',
                'nama' => 'Surat Keterangan Lulus',
            ],
            [
                'id' => '4',
                'nama' => 'Surat Laporan Hasil Studi',
            ],
            
        ];

        foreach ($jeniss as $jenis) {
            JenisSurat::create($jenis);
        }
    }
}
