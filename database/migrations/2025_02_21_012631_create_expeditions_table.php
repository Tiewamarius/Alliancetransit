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
            $table->foreignId('client_id')->constrained();
            $table->foreignId('expediteur_id')->constrained();
            $table->foreignId('destinataire_id')->constrained();
            $table->foreignId('colis_id')->constrained();
            $table->string('numeroSuivi')->unique();
            $table->string('type_service')->nullable();
            $table->boolean('assurance')->default(false);
            $table->enum('statut', ['en préparation', 'en transit', 'arrivé', 'terminé']);
            $table->dateTime('date_depart')->nullable();
            $table->dateTime('date_arrivee_estimee')->nullable();
            $table->dateTime('date_arrivee_reelle')->nullable();
            $table->timestamps();
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
