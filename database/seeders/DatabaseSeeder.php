<?php


namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 👤 Utilisateur admin
        User::firstOrCreate(
            ['email' => 'sosylvie1@gmail.com'], // Condition unique
            [
                'name' => 'Sylvie',
                'password' => Hash::make('password'),
                'role' => 1,
            ]
        );

        // 👤 User 1
        User::firstOrCreate(
            ['email' => 'alice@portfolio.fr'],
            [
                'name' => 'Alice',
                'password' => bcrypt('password'),
                'role' => 0,
            ]
        );

        // 📌 Appel du seeder voyages
        $this->call([
            VoyageSeeder::class,
        ]);
    }
}
