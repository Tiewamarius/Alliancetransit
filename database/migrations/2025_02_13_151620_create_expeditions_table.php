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
            $table->string('numero')->unique();
            $table->enum('statut', ['en préparation', 'en transit', 'arrivé']);
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
