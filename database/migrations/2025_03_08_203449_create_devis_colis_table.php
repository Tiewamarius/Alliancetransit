<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up()
    {
        Schema::create('devis_colis', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('particulier');
            $table->string('paysDepart');
            $table->string('villeDepart');
            $table->string('paysArrivee');
            $table->string('villeArrivee');
            $table->text('designation');
            $table->decimal('montant_total', 8, 2)->default(0); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('devis_colis');
    }
};