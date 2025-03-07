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
        // Questions for multiple quizzes
        $questions = [
            // QUIZ 1: HTML & CSS FUNDAMENTALS (10 questions)
            [
                'quiz_id' => 1,
                'content' => 'Quelle propriété CSS est utilisée pour changer la couleur d\'arrière-plan?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 1,
                'content' => 'Quelle balise HTML est utilisée pour créer le titre principal d\'une page?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 1,
                'content' => 'Comment centrer horizontalement un élément div avec CSS?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 1,
                'content' => 'Quelle propriété CSS définit l\'espacement entre les lettres?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 1,
                'content' => 'Quelle balise HTML est utilisée pour créer une liste non ordonnée?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 1,
                'content' => 'Quelle propriété CSS est utilisée pour créer une ombre portée sur un texte?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 1,
                'content' => 'Comment définit-on une couleur avec transparence en CSS?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 1,
                'content' => 'Quelle balise HTML5 est utilisée pour définir un pied de page?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 1,
                'content' => 'Quelle propriété CSS permet de créer une grille flexible?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 1,
                'content' => 'Quelle unité CSS est relative à la taille de la police de l\'élément parent?',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // QUIZ 2: JAVASCRIPT & PHP BASICS (10 questions)
            [
                'quiz_id' => 2,
                'content' => 'Quelle est la sortie du code PHP suivant : echo 2 + "3" + "4";',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 2,
                'content' => 'Dans HTML5, quelle balise est utilisée pour jouer des fichiers vidéo?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 2,
                'content' => 'Quelle méthode JavaScript est utilisée pour supprimer le dernier élément d\'un tableau?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 2,
                'content' => 'Comment déclarer une variable en JavaScript qui ne peut pas être réaffectée?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 2,
                'content' => 'Quelle fonction PHP est utilisée pour vérifier si une variable est un tableau?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 2,
                'content' => 'Quelle méthode JavaScript convertit un objet JSON en chaîne de caractères?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 2,
                'content' => 'Comment accéder à un élément de formulaire par son ID en JavaScript?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 2,
                'content' => 'Quelle fonction PHP est utilisée pour inclure un fichier qui est requis pour l\'exécution du script?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 2,
                'content' => 'Quelle est la différence entre == et === en JavaScript?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 2,
                'content' => 'Comment définir une fonction anonyme en PHP?',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // QUIZ 3: LARAVEL FRAMEWORK (10 questions)
            [
                'quiz_id' => 3,
                'content' => 'Dans Laravel, quelle méthode est utilisée pour définir les routes GET?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 3,
                'content' => 'Quelle commande Artisan permet de créer un nouveau modèle avec sa migration?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 3,
                'content' => 'Comment accéder aux données de la requête dans un contrôleur Laravel?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 3,
                'content' => 'Quelle directive Blade est utilisée pour les structures conditionnelles?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 3,
                'content' => 'Comment définir une relation "un à plusieurs" dans un modèle Eloquent?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 3,
                'content' => 'Quelle méthode de validation dans Laravel vérifie qu\'un champ est requis?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 3,
                'content' => 'Comment utiliser les variables d\'environnement dans Laravel?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 3,
                'content' => 'Quelle est la fonction du middleware dans Laravel?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 3,
                'content' => 'Comment exécuter des requêtes SQL brutes dans Laravel?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 3,
                'content' => 'Quelle commande Artisan est utilisée pour vider le cache des routes?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('questions')->insert($questions);
    }
}
