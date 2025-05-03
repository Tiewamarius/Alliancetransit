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
            $table->string('particulier')->nullable();
            $table->string('expediteur_id');
            $table->string('nom_expediteur')->nullable();
            $table->string('numero_expediteur')->nullable();
            $table->string('email_expediteur')->nullable();
            $table->string('adresse_expediteur')->nullable();
            $table->string('code_postal_exp')->nullable();
            $table->foreignId('destinataire_id')->nullable()->constrained('destinataires');
            $table->string('nom_destinataire')->nullable();
            $table->string('numero_destinataire')->nullable();
            $table->string('email_destinataire')->nullable();
            $table->string('adresse_destinataire')->nullable();
            $table->string('code_postal_dest')->nullable();
            $table->string('commune')->nullable();
            $table->string('numeroSuivi')->nullable();
            $table->string('designation')->nullable();
            $table->string('conteneur_id')->nullable(); // Clé étrangère vers la colonne 'nom' de la table conteneurs
            $table->foreign('conteneur_id')
                  ->references('nom')
                  ->on('conteneurs')
                  ->onDelete('SET NULL');
            $table->string('typeService')->nullable();
            $table->dateTime('dateEnlev')->nullable();
            $table->dateTime('dateCharg')->nullable();
            $table->dateTime('dateLivr')->nullable();
            $table->decimal('montant_total', 8, 2)->default(0);
            $table->decimal('montant_paye', 8, 2)->default(0);
            $table->decimal('montant_verse', 10, 2)->default(0);
            $table->enum('mode_paiement', ['chèque','espèce']);
            $table->enum('status', ['Non Traité','Encour','Arrivé', 'Depot','Non Livré', 'Livré']);
            $table->boolean('marque')->default(false);
            $table->string('image_colis')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('expeditions', function (Blueprint $table) {
            $table->dropForeign(['conteneur_id']); // Supprimer la clé étrangère avant la colonne
            $table->dropColumn('conteneur_id');
            $table->dropColumn('marque');
            $table->dropColumn('image_colis');
            $table->dropColumn(['montant_total', 'montant_paye', 'montant_verse']);
        });
        Schema::dropIfExists('expeditions');
    }
};