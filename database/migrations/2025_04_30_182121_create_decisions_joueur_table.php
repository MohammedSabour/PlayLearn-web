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
        Schema::create('decisions_joueur', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_session_joueur')->constrained('session_joueur')->onDelete('cascade');
            $table->foreignId('id_choix_decision')->constrained('choix_decisions')->onDelete('cascade');
            $table->foreignId('id_level_choix')->constrained('decisions_levels')->onDelete('cascade');
            $table->timestamp('submitted_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('decisions_joueur');
    }
};
