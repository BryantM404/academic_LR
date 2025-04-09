<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TataUsaha;

class TUSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $TUs = [
            [
                'id' => 'T-00001',
                'nama' => 'Anita Anggraeni',
                'prodi_id' => 'P-00001',
                'user_id' => 'U-00004'
            ],
            [
                'id' => 'T-00002',
                'nama' => 'Aristia Ariyanti',
                'prodi_id' => 'P-00002',
                'user_id' => 'U-00005'
            ],

        ];

        foreach ($TUs as $TU) {
            TataUsaha::create($TU);
        }
    }
}
