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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_session')->constrained('game_sessions')->onDelete('cascade');
            $table->foreignId('id_user')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('id_question')->constrained('questions')->onDelete('cascade');
            $table->foreignId('id_selected_choice')->constrained('choices')->onDelete('cascade');
            $table->boolean('is_correct');
            $table->timestamp('submitted_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
