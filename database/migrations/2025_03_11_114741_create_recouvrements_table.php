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
        Schema::create('recouvrements', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(1000001);
            $table->foreignId('location_id')->constrained();
            $table->foreignId('paiement_id')->nullable()->constrained();
            $table->integer('montant_du');
            $table->integer('montant_recouvre')->default(0);
            $table->date('date_echeance');
            $table->date('date_recouvrement')->nullable();
            $table->enum('statut', ['en_attente', 'partiellement_recouvre', 'recouvre', 'annule'])->default('en_attente');
            $table->text('commentaire')->nullable();
            $table->foreignId('user_id')->nullable()->constrained(); // Agent responsable du recouvrement
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recouvrements');
    }
};
