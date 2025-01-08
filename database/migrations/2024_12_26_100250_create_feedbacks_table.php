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
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id'); // ID du cours
            $table->unsignedBigInteger('user_id');  // ID de l'utilisateur
            $table->text('content'); // Contenu du feedback
            $table->integer('likes')->default(0); // Nombre de likes
            $table->integer('dislikes')->default(0); // Nombre de dislikes
            $table->timestamps();

            // Définition des clés étrangères avec les contraintes
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('feedbacks', function (Blueprint $table) {
            // Supprimer les clés étrangères avant de supprimer la table
            $table->dropForeign(['course_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('feedbacks');
    }
};
