<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\MoodType;
use App\Models\AiPrompt;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            MoodTypeSeeder::class,
            AiPromptSeeder::class,
        ]);
    }
}
