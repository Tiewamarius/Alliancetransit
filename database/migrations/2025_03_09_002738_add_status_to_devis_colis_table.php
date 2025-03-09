<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToDevisColisTable extends Migration
{
    public function up()
    {
        Schema::table('devis_colis', function (Blueprint $table) {
            $table->enum('status', ['encour', 'nontraite', 'traite'])->default('nontraite')->after('designation');
        });
    }

    public function down()
    {
        Schema::table('devis_colis', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}