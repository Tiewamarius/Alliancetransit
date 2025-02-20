<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('conteneurs', function (Blueprint $table) {
            $table->id();
            $table->string('container_number')->unique();
            $table->enum('type', [
                'Conteneur standard',
                'Conteneur Réfrigéré',
                'Conteneur Open Top',
                'Conteneur High Cube',
                'Conteneur Flat Rack',
                'Conteneur Citerne',
                'Le conteneur- stockage',
            ]);
            $table->string('location');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conteneurs');
    }
};
