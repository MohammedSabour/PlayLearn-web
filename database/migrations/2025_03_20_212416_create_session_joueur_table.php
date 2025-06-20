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
        Schema::create('session_joueur', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_session')->constrained('game_sessions')->onDelete('cascade');
            $table->foreignId('id_player')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('player_name');
            $table->boolean('is_guest')->default(false);
            $table->timestamp('joined_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_joueur');
    }
};
