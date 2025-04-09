<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(ProdiSeeder::class);
        $this->call(StatusPengajuanSeeder::class);
        $this->call(JenisSuratSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(KaprodiSeeder::class);
        $this->call(TUSeeder::class);
        $this->call(MahasiswaSeeder::class);
    }
    // $2y$12$RKTjQ2pA2dNG0OZJB4CDZ.u4u9VPyoJKMFWp0cU3YcR2gK68HwEva
    //$2y$12$A8OI/p53QW5YG6zvAcP44e7U5UZpuUfmSRqM9FhJVc7lmu1/yNuIS

    // IMPPORTANT!
    // ALTER TABLE sessions MODIFY user_id VARCHAR(50); 
}
