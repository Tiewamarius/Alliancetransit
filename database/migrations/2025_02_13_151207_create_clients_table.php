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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('code_client')->unique();
            $table->string('nom_client')->nullable();
            $table->string('prenom_client')->nullable();
            $table->string('numero_client');
            $table->string('email_client')->unique();
            $table->string('adresse_client');
            // $table->string('mot_de_passe');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
