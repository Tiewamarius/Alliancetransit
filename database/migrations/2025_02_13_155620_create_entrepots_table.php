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
        Schema::create('entrepots', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 100);
            $table->string('adresse', 255);
            $table->string('ville', 100);
            $table->string('code_postal', 20);
            $table->string('pays', 50);
            $table->decimal('superficie', 8, 2); // En mètres carrés
            $table->enum('type', ['principal', 'secondaire']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrepots');
    }
};
