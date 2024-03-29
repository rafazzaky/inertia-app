<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Article;
use App\Models\Topic;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'rafiazzakymc@gmail.com',
            'password' => '12345678'
        ]);
        Article::factory()->count(10)->create();
    }

    public function down(): void
    {
        Article::truncate();
        Topic::truncate();
    }
}
