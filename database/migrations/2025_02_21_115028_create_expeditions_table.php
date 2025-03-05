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
        Schema::create('expeditions', function (Blueprint $table) {
            $table->id();
            $table->string('expediteur_id');
            $table->string('nom_expediteur')->nullable();
            $table->string('numero_expediteur')->nullable();
            $table->string('email_expediteur')->nullable();
            $table->string('adresse_expediteur')->nullable();
            $table->foreignId('destinataire_id')->nullable()->constrained('destinataires');
            $table->string('nom_destinataire')->nullable();
            $table->string('numero_destinataire')->nullable();
            $table->string('email_destinataire')->nullable();
            $table->string('adresse_destinataire')->nullable();
            $table->string('numeroSuivi')->nullable();
            $table->string('designation')->nullable();
            $table->string('numeroConteneur')->nullable();
            $table->string('typeService')->nullable();
            $table->dateTime('dateEnlev')->nullable();
            $table->dateTime('dateLivr')->nullable();
            $table->decimal('montant_total', 8, 2); // Définir l'ordre ici
            $table->decimal('montant_paye', 8, 2)->default(0); // Définir l'ordre ici
            $table->enum('status', ['encour', 'Non Livré', 'Livré']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
        Schema::table('expeditions', function (Blueprint $table) {
            $table->dropColumn(['montant_total', 'montant_paye']);
        });
        Schema::dropIfExists('expeditions');
    }
};