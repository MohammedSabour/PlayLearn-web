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
        Schema::create('parametre_impacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_level_choix')->constrained('decisions_levels')->onDelete('cascade');
            $table->foreignId('id_parametre')->constrained('parametres')->onDelete('cascade');
            $table->float('valeur_impact');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parametre_impacts');
    }
};
