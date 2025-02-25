<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpediteursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expediteurs', function (Blueprint $table) {
            $table->id(); // Crée un UNSIGNED BIGINT auto-incrémenté (clé primaire)
            $table->string('nom_expediteur');
            $table->text('adresse_expediteur');
            $table->string('numero_expediteur');
            $table->string('email_expediteur')->nullable();
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
        Schema::dropIfExists('expediteurs');
    }
}