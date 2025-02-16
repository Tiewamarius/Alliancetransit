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
        Schema::create('colis', function (Blueprint $table) {
            $table->id();            $table->text('description');
            $table->float('poids');
            $table->float('volume');
            $table->float('valeur');
            $table->enum('statut', ['enlevé', 'en transit', 'arrivé', 'livré']);
            $table->foreignId('expediteur_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('destinataire_id')->constrained('clients')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colis');
    }
};
