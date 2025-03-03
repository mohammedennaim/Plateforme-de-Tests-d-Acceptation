<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quizzes')->insert([
            [
                'id' => 1,
                'title' => 'Test d\'admission YouCode',
                'description' => 'Ce test évalue vos connaissances techniques pour l\'admission à YouCode.',
                'duration_minutes' => 60,
                'passing_score' => 70,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'title' => 'Test de développement web',
                'description' => 'Ce quiz évalue vos compétences en développement web (HTML, CSS, JavaScript).',
                'duration_minutes' => 45,
                'passing_score' => 65,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'title' => 'Test PHP et Laravel',
                'description' => 'Un test pour évaluer vos connaissances en PHP et Laravel.',
                'duration_minutes' => 30,
                'passing_score' => 60,
                'is_active' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    
    }
}
