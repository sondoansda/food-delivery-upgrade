<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 1000; $i++) {
            $user = User::create([
                'name' => 'Owner ' . $i,
                'email' => 'owner' . $i . '@example.com',
                'password' => bcrypt('password'),
                'role' => 'restaurant_owner',
                'created_at' => now(),
                'updated_at' => now(),

            ]);

            Restaurant::create([
                'user_id' => $user->id,
                'name' => 'Restaurant ' . $i,
                'address' => 'Address ' . $i,
                'phone' => '012345678' . ($i % 10),
                'image' => 'https://example.com/image' . $i . '.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
