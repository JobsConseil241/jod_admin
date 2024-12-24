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
        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(1000001);
            $table->string('code_contrat');
            $table->dateTime('date_heure_debut');
            $table->dateTime('date_heure_fin')->nullable();
            $table->unsignedBigInteger('vehicule_id');
            $table->string('type_location');
            $table->integer('jours');
            $table->tinyInteger('statut')->default(1);
            $table->boolean('comission')->default(0);
            $table->unsignedBigInteger('etat_livraison_id');
            $table->unsignedBigInteger('etat_restitution_id')->nullable();
            $table->boolean('livraison')->default(0);
            $table->unsignedBigInteger('paiement_id')->nullable();
            $table->unsignedBigInteger('client_id');

            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');

            $table->foreign('vehicule_id')->references('id')->on('vehicules')->onDelete('cascade');
            $table->foreign('etat_livraison_id')->references('id')->on('etat_vehicules')->onDelete('cascade');
            $table->foreign('etat_restitution_id')->references('id')->on('etat_vehicules')->onDelete('cascade');
            $table->foreign('paiement_id')->references('id')->on('paiements')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
