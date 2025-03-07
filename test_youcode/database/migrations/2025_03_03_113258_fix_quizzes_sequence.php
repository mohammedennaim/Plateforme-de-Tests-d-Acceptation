<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class FixQuizzesSequence extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Get the maximum ID from the quizzes table
        $maxId = DB::table('quizzes')->max('id') ?? 0;
        
        // Reset the sequence to the max ID + 1
        DB::statement("ALTER SEQUENCE quizzes_id_seq RESTART WITH " . ($maxId + 1));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // No rollback needed
    }
}