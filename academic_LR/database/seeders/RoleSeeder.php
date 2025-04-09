<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'id' => '1',
                'nama' => 'Superadmin',
            ],
            [
                'id' => '2',
                'nama' => 'Kaprodi',
            ],
            [
                'id' => '3',
                'nama' => 'TU',
            ],
            [
                'id' => '4',
                'nama' => 'Mahasiswa',
            ],
            
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
