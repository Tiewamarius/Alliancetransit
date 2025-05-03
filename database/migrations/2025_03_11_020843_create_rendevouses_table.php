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
        Schema::create('rendevouses', function (Blueprint $table) {
            $table->id();
            $table->string('rdv_id');
            $table->enum('type', ['enlevement-colis', 'depot-colis'])->default('enlevement-colis'); // Ajout du champ status
            $table->string('nom');
            $table->string('telephone');
            $table->string('code_postal');
            $table->date('date_retrait');
            $table->enum('heure_retrait', ['matin_9-12', 'soir_14-17']);
            $table->text('designation');
            $table->enum('status', ['encour','non traite', 'traite'])->default('non traite'); // Ajout du champ status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rendevouses');
    }
};
