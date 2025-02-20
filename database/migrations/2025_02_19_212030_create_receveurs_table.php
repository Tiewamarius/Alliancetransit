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
        Schema::create('receveurs', function (Blueprint $table) {
            $table->id();
            $table->string('code_unique')->unique();
            $table->string('nom');
            $table->string('prenom');
            $table->string('numero');
            $table->string('email')->unique();
            $table->string('adresse');
            // $table->string('mot_de_passe');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receveurs');
    }
};
