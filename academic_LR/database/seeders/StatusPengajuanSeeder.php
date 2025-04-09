<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StatusPengajuan;

class StatusPengajuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuss = [
            [
                'id' => '1',
                'nama' => 'Apply',
            ],
            [
                'id' => '2',
                'nama' => 'Approved',
            ],
            [
                'id' => '3',
                'nama' => 'Rejected',
            ],
            [
                'id' => '4',
                'nama' => 'Finished',
            ],
            
        ];

        foreach ($statuss as $status) {
            StatusPengajuan::create($status);
        }
    }
}
