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
        Schema::create('livraisons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('colis_id')->constrained('colis')->onDelete('cascade');
            $table->enum('mode_livraison', ['domicile', 'gare routière']);
            $table->dateTime('date_livraison');
            $table->enum('etat_livraison', ['livré', 'non livré']);
            $table->text('commentaire')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livraisons');
    }
};
