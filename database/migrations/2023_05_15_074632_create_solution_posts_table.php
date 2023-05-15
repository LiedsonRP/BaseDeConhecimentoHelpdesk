<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('solutions', function (Blueprint $table) {
            $table->id();
            $table->string("title")->unique();
            $table->longText("SolutionText");
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique();                        
        });

        Schema::create('categorie_solution', function (Blueprint $table) {
            $table->id();            
            $table->foreignId("categories_id")->constrained("categories");
            $table->foreignId("solutions_id")->constrained("solutions");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorie_solution');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('solutions');
    }
};
