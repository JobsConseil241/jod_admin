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
        Schema::table('paiements', function (Blueprint $table) {
            $table->string('reference')->after('id');
            $table->string('montant_paye')->after('montant_total');
            $table->string('montant_restant')->after('montant_paye');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paiements', function (Blueprint $table) {
            $table->dropColumn('reference');
            $table->dropColumn('montant_paye');
            $table->dropColumn('montant_restant');
        });
    }
};
