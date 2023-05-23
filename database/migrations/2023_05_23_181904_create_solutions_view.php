<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('CREATE VIEW view_solutions AS SELECT solutions.id AS "solution_number", solutions.title,  solutions.solution_text, solutions.created_at, solutions.updated_at
        ,categories.id AS "category_number", categories.name AS "category_name" FROM solutions 
        INNER JOIN category_solution ON category_solution.solution_id = solutions.id
        INNER JOIN categories ON categories.id = category_solution.category_id');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW view_solutions");
    }
};
