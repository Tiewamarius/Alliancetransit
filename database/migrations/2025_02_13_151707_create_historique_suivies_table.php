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
        Schema::create('historique_suivies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('colis_id')->constrained('colis')->onDelete('cascade');
            $table->enum('evenement', ['enleve', 'en_transit', 'arrive', 'livre', 'retour', 'incident']);
            $table->timestamp('date_evenement')->useCurrent();
            $table->text('description')->nullable();
            $table->foreignId('utilisateur_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historique_suivies');
    }
};
