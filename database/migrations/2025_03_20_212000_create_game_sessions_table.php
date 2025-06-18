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
        Schema::create('game_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_jeu')->constrained('jeux')->onDelete('cascade');
            $table->foreignId('id_master')->constrained('users')->onDelete('cascade');
            $table->string('code_adhesion')->unique();
            $table->enum('status', ['pending', 'waiting', 'active', 'finished'])->default('pending');
            $table->string('mode')->default('solo');
            $table->integer('nb_rounds')->default(3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_sessions');
    }
};
