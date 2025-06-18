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
        Schema::create('parametre_session_joueurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_joueur_id')->constrained('session_joueur')->onDelete('cascade');
            $table->foreignId('id_parametre')->constrained('parametres')->onDelete('cascade');
            $table->float('valeur');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parametre_session_joueurs');
    }
};
