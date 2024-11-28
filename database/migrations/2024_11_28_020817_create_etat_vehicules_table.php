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
        Schema::create('etat_vehicules', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(1000001);
            $table->integer('kilometrage');
            $table->integer('proprete_int');
            $table->integer('propreter_exte');
            $table->integer('carburant');
            $table->boolean('cle_vehicule');
            $table->boolean('carte_grise');
            $table->boolean('carte_assurance');
            $table->boolean('carte_viste_technique');
            $table->boolean('carte_extincteur');
            $table->boolean('triangle_signalisation');
            $table->boolean('extincteur');
            $table->boolean('trousse_secours');
            $table->boolean('gilet');
            $table->boolean('cric_manivelle');
            $table->boolean('cle_a_roue');
            $table->boolean('cales_metalliques');
            $table->boolean('cle_plate');
            $table->boolean('anneau_remorquage');
            $table->boolean('tournevis');
            $table->boolean('compresseur');
            $table->boolean('roue_secours');
            $table->boolean('etat_general');
            $table->boolean('date');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etat_vehicules');
    }
};
