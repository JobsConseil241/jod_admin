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
        Schema::table('etat_vehicules', function (Blueprint $table) {
            $table->unsignedBigInteger('vehicule_id')->after('date');
            $table->foreign('vehicule_id')->references('id')->on('vehicules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('etat_vehicules', function (Blueprint $table) {
            $table->dropForeign('etat_vehicules_vehicule_id_foreign');
            $table->dropColumn('vehicule_id');
        });
    }
};
