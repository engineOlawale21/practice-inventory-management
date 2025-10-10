<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the user data in a single array
        $users = [
            [
                'name' => 'Test User',
                'email' => 'testuser@example.com',
                'password' => 'password123', // Raw password
            ],
            [
                'name' => 'Olawale',
                'email' => 'rolawale95@gmail.com',
                'password' => 'pass123', // Raw password
            ],
            // Add more users here
        ];

        // Loop through the array and create each user
        foreach ($users as $userData) {
            User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                // Hash the password before creating the record
                'password' => Hash::make($userData['password']),
            ]);
        }
    }
}
