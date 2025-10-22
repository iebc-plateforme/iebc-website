<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call all seeders in order
        $this->call([
            UserSeeder::class,
            SettingsSeeder::class,
            IEBCServicesSeeder::class,
            PartnersSeeder::class,
            TeamsSeeder::class,
            PostsSeeder::class,
            GallerySeeder::class,
        ]);

        $this->command->info('All seeders executed successfully!');
    }
}
