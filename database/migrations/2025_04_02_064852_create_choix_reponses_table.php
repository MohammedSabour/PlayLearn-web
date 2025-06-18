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
        Schema::create('choix_reponses', function (Blueprint $table) {
            $table->id();
            $table->string('choice_text');
            $table->boolean('is_correct')->default(false);
            $table->float('variation')->default(0);
            $table->foreignId('id_question')->constrained('questions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('choix_reponses');
    }
};
