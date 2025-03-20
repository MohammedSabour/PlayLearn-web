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
        Schema::table('session_joueur', function (Blueprint $table) {
            $table->string('player_name')->nullable()->after('id_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('session_joueur', function (Blueprint $table) {
            $table->dropColumn('player_name');
        });
    }
};
