<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Emon',
                'email' => 'ishtiaqueferdous109@gmail.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'kousik',
                'email' => 'iftakharul183@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Himel',
                'email' => 'hashinurislam825@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Fahm',
                'email' => 'fahm@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Suvro',
                'email' => 'shuvroshariar8@gmail.com',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
