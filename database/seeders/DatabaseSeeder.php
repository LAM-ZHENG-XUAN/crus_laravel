<?php

namespace Database\Seeders;

use App\Project;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        
        $this->call([
            ProjectSeeder::class,
            UserSeeder::class,
        ]);
    }
}
