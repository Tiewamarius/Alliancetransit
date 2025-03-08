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
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->string('numero_facture', 50)->unique(); 
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->date('date_facture');
            $table->date('date_echeance');
            $table->decimal('montant_ht', 10, 2);
            $table->decimal('tva', 5, 2);
            $table->decimal('montant_ttc', 10, 2);
            $table->enum('statut', ['emis', 'payé', 'impayé', 'annulé']);
            $table->string('mode_paiement', 50)->nullable();
            $table->string('reference_paiement', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
