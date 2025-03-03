<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionsSeeder extends Seeder
{
    public function run()
    {
        $options = [
            // Options for Question 1
            [
                'question_id' => 1,
                'content' => '9',
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 1,
                'content' => '234',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 1,
                'content' => '7',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 1,
                'content' => '5',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Options for Question 2
            [
                'question_id' => 2,
                'content' => '<video>',
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 2,
                'content' => '<media>',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 2,
                'content' => '<play>',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 2,
                'content' => '<movie>',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Options for Question 3
            [
                'question_id' => 3,
                'content' => 'pop()',
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 3,
                'content' => 'push()',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 3,
                'content' => 'last()',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 3,
                'content' => 'remove()',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Options for Question 4
            [
                'question_id' => 4,
                'content' => 'const',
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 4,
                'content' => 'let',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 4,
                'content' => 'var',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 4,
                'content' => 'static',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Options for Question 5
            [
                'question_id' => 5,
                'content' => 'background-color',
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 5,
                'content' => 'color',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 5,
                'content' => 'bgcolor',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 5,
                'content' => 'background',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Options for Question 6
            [
                'question_id' => 6,
                'content' => '<a>',
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 6,
                'content' => '<href>',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 6,
                'content' => '<link>',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 6,
                'content' => '<hyperlink>',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Continue for the rest of the questions...
        ];

        DB::table('options')->insert($options);
    }
}