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
        Schema::table('users', function (Blueprint $table) {
            // Supprimer l'index unique existant
            $table->dropUnique('users_email_unique'); 

            // Modifier la colonne pour qu'elle soit nullable
            $table->string('email')->nullable()->change();

            // Réajouter la contrainte UNIQUE après modification
            $table->unique('email');
            
            // Rendre le mot de passe nullable
            $table->string('password')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Supprimer la contrainte UNIQUE avant rollback
            $table->dropUnique('users_email_unique');

            // Revenir à l'état précédent
            $table->string('email')->nullable(false)->unique()->change();
            $table->string('password')->nullable(false)->change();
        });
    }
};
