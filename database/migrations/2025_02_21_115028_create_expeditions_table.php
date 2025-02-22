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

            // Informations du client
            $table->string('code_unique')->nullable(); // Code unique de l'expédition
            $table->string('nom')->nullable(); // Nom du client ou de l'expéditeur/destinataire
            $table->unsignedBigInteger('client_id')->nullable(); // ID du client existant (relation)
            $table->string('numero')->nullable(); // Numéro de téléphone
            $table->string('email')->nullable(); // Adresse email
            $table->string('adresse')->nullable(); // Adresse

            // Informations de l'expéditeur (si différent du client)
            $table->unsignedBigInteger('expediteur_id')->nullable(); // ID de l'expéditeur existant (relation)

            // Informations du destinataire
            $table->unsignedBigInteger('destinataire_id')->nullable(); // ID du destinataire existant (relation)

            // Informations du colis
            $table->string('numeroSuivi')->nullable(); // Code de suivi
            $table->string('designation')->nullable(); // Désignation du colis
            $table->string('numeroConteneur')->nullable(); // Numéro de conteneur
            $table->string('typeService')->nullable(); // Type de service
            $table->dateTime('dateEnlev')->nullable(); // Date d'enlèvement
            $table->dateTime('dateLivr')->nullable(); // Date de livraison
            $table->string('statut')->nullable(); // Statut de l'expédition (en préparation, en transit, etc.)
            $table->string('paiement')->nullable(); // Statut du paiement

            $table->timestamps();

            // Relations (clés étrangères)
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('set null');
            $table->foreign('expediteur_id')->references('id')->on('expediteurs')->onDelete('set null');
            $table->foreign('destinataire_id')->references('id')->on('destinataires')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expeditions');
    }
};