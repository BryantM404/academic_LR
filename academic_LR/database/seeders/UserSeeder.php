<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'id' => 'U-00001',
                'username' => '1111111',
                'password' => Hash::make('123456789'),
                'role_id' => '1',
            ],
            [
                'id' => 'U-00002',
                'username' => '7200001',
                'password' => Hash::make('123456789'),
                'role_id' => '2',
            ],
            [
                'id' => 'U-00003',
                'username' => '7300001',
                'password' => Hash::make('123456789'),
                'role_id' => '2',
            ],
            [
                'id' => 'U-00004',
                'username' => '7210001',
                'password' => Hash::make('123456789'),
                'role_id' => '3',
            ],
            [
                'id' => 'U-00005',
                'username' => '7310001',
                'password' => Hash::make('123456789'),
                'role_id' => '3',
            ],
            [
                'id' => 'U-00006',
                'username' => '2372001',
                'password' => Hash::make('123456789'),
                'role_id' => '4',
            ],
            [
                'id' => 'U-00007',
                'username' => '2373001',
                'password' => Hash::make('123456789'),
                'role_id' => '4',
            ],
            
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
