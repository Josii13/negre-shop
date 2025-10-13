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
        // Créer un utilisateur admin par défaut
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);

        // Appeler tous les seeders dans l'ordre
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            CarouselSlideSeeder::class,
            ActivitySeeder::class,
            SiteSettingSeeder::class,
        ]);
    }
}
