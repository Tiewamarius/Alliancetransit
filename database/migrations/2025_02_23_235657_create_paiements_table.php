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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
                $table->foreignId('expedition_id')->constrained('expeditions');
                $table->decimal('montant');
                $table->timestamp('date_paiement');
                $table->string('methode_paiement');
                $table->foreignId('statut_paiement_id')->constrained('statuts_paiements');
               
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
