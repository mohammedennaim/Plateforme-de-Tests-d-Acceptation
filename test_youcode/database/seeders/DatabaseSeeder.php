<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RolesSeeder::class,
            QuizSeeder::class,
            QuestionsSeeder::class,
            OptionsSeeder::class,
        ]);
    }
}
