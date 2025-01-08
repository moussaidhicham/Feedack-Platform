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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique(); // Un titre unique pour éviter les doublons
            $table->text('description')->nullable(); // Description du cours
            $table->string('instructor')->nullable(); // Nom de l'instructeur du cours
            $table->string('category')->nullable(); // Catégorie du cours, ex: 'Programmation', 'Marketing'
            $table->string('thumbnail')->nullable(); // URL ou chemin vers l'image miniature
            $table->timestamps(); // Colonnes created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
