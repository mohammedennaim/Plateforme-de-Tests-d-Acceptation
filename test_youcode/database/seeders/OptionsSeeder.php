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
                'question_id' => 81,
                'content' => '9',
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 81,
                'content' => '234',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 81,
                'content' => '7',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 81,
                'content' => '5',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Options for Question 2
            [
                'question_id' => 82,
                'content' => '<video>',
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 82,
                'content' => '<media>',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 82,
                'content' => '<play>',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 82,
                'content' => '<movie>',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Options for Question 3
            [
                'question_id' => 83,
                'content' => 'pop()',
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 83,
                'content' => 'push()',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 83,
                'content' => 'last()',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 83,
                'content' => 'remove()',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Options for Question 4
            [
                'question_id' => 84,
                'content' => 'const',
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 84,
                'content' => 'let',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 84,
                'content' => 'var',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 84,
                'content' => 'static',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Options for Question 5
            [
                'question_id' => 85,
                'content' => 'background-color',
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 85,
                'content' => 'color',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 85,
                'content' => 'bgcolor',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 85,
                'content' => 'background',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Options for Question 6
            [
                'question_id' => 86,
                'content' => '<a>',
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 86,
                'content' => '<href>',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 86,
                'content' => '<link>',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 86,
                'content' => '<hyperlink>',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Options for Question 7
            [
                'question_id' => 87,
                'content' => 'Cascading Style Sheets',
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 87,
                'content' => 'Computer Style Sheets',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 87,
                'content' => 'Creative Style System',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 87,
                'content' => 'Colorful Style Sheets',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Options for Question 8
            [
                'question_id' => 88,
                'content' => 'fopen()',
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 88,
                'content' => 'open_file()',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 88,
                'content' => 'file_open()',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 88,
                'content' => 'read_file()',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Options for Question 9
            [
                'question_id' => 89,
                'content' => 'git branch',
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 89,
                'content' => 'git checkout',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 89,
                'content' => 'git create',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 89,
                'content' => 'git new',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

             // Options for Question 1
             [
                'question_id' => 100,
                'content' => '9',
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 100,
                'content' => '234',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 100,
                'content' => '7',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 100,
                'content' => '5',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Options for Question 2
            [
                'question_id' => 101,
                'content' => '<video>',
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 101,
                'content' => '<media>',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 101,
                'content' => '<play>',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 101,
                'content' => '<movie>',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Options for Question 3
            [
                'question_id' => 102,
                'content' => 'pop()',
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 102,
                'content' => 'push()',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 102,
                'content' => 'last()',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 102,
                'content' => 'remove()',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Options for Question 4
            [
                'question_id' => 103,
                'content' => 'const',
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 103,
                'content' => 'let',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 103,
                'content' => 'var',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 103,
                'content' => 'static',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Options for Question 5
            [
                'question_id' => 104,
                'content' => 'background-color',
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 104,
                'content' => 'color',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 104,
                'content' => 'bgcolor',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 104,
                'content' => 'background',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Options for Question 6
            [
                'question_id' => 105,
                'content' => '<a>',
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 105,
                'content' => '<href>',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 105,
                'content' => '<link>',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 105,
                'content' => '<hyperlink>',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Options for Question 7
            [
                'question_id' => 106,
                'content' => 'Cascading Style Sheets',
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 106,
                'content' => 'Computer Style Sheets',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 106,
                'content' => 'Creative Style System',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 106,
                'content' => 'Colorful Style Sheets',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Options for Question 8
            [
                'question_id' => 107,
                'content' => 'fopen()',
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 107,
                'content' => 'open_file()',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 107,
                'content' => 'file_open()',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 107,
                'content' => 'read_file()',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Options for Question 9
            [
                'question_id' => 108,
                'content' => 'git branch',
                'is_correct' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 108,
                'content' => 'git checkout',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 108,
                'content' => 'git create',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => 108,
                'content' => 'git new',
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('options')->insert($options);
    }
}