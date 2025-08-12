<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory(3)->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        // 👤 Utilisateur admin
        User::create([
    'name' => 'Sylvie',
    'email' => 'sosylvie1@gmail.com',
    'password' => Hash::make('password'),
    'role' => 1,
]);
// 👤 User 1
    User::factory()->create([
        'name' => 'Alice',
        'email' => 'alice@portfolio.fr',
        'password' => bcrypt('password'),
        'role' => 0,
    ]);
    }

    
}
