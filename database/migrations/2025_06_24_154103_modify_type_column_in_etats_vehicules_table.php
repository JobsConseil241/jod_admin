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
            $table->dateTime('date')->change();
            $table->string('carburant')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('etat_vehicules', function (Blueprint $table) {
            $table->date('date')->change();
            $table->integer('carburant')->change();
        });
    }
};
