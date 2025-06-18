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
        Schema::create('decisions_levels', function (Blueprint $table) {
            $table->id();
            $table->integer('level');
            $table->string('description');
            $table->float('cout');
            $table->foreignId('id_choix_decision')->constrained('choix_decisions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('decisions_levels');
    }
};
