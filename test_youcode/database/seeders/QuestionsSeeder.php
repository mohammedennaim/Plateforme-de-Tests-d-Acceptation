<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Questions for Quiz 1: Test d'admission YouCode
        $questions = [
            // Quiz 1 questions
            [
                'quiz_id' => 1,
                'content' => 'Quelle est la sortie du code PHP suivant : echo 2 + "3" + "4";',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 1,
                'content' => 'Dans HTML5, quelle balise est utilisée pour jouer des fichiers vidéo?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 1,
                'content' => 'Quelle méthode JavaScript est utilisée pour supprimer le dernier élément d\'un tableau?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 1,
                'content' => 'Comment déclarer une variable en JavaScript qui ne peut pas être réaffectée?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 1,
                'content' => 'Quelle propriété CSS est utilisée pour changer la couleur d\'arrière-plan?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Quiz 2 questions
            [
                'quiz_id' => 2,
                'content' => 'Quelle balise HTML est utilisée pour créer un lien hypertexte?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 2,
                'content' => 'Quelle propriété CSS est utilisée pour changer la taille du texte?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 2,
                'content' => 'Quelle fonction JavaScript est utilisée pour sélectionner un élément par son ID?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Quiz 3 questions
            [
                'quiz_id' => 3,
                'content' => 'Quelle commande Artisan est utilisée pour créer un nouveau contrôleur dans Laravel?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 3,
                'content' => 'Dans Laravel, quelle méthode est utilisée pour définir les routes GET?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('questions')->insert($questions);
    }
}
