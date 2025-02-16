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
        Schema::create('enlevements', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_enlevement');
            $table->string('lieu_enlevement');
            $table->foreignId('colis_id')->constrained('colis')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enlevements');
    }
};
