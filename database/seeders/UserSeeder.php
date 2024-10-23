<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => '12345678',
            'is_admin' => true,
        ]);

        User::create([
            'name' => 'Tuka',
            'email' => 'tuka@gmail.com',
            'password' => '12345678',
            'is_admin' => true,
        ]);

        User::create([
            'name' => 'User 1',
            'email' => 'user@gmail.com',
            'password' => '12345678',
            'is_admin' => false,
        ]);

        User::create([
            'name' => 'User 2',
            'email' => 'user2@gmail.com',
            'password' => '12345678',
            'is_admin' => false,
        ]);
    }
}
