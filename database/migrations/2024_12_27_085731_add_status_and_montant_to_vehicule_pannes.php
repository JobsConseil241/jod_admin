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
        Schema::table('vehicule_pannes', function (Blueprint $table) {
            $table->enum('status', ['EN COURS', 'TERMINE'])->default('EN COURS')->after('panne_id');
            $table->integer('montant')->default(0)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicule_pannes', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('montant');
        });
    }
};
