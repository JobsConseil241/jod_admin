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
        Schema::table('vehicules', function (Blueprint $table) {
            $table->boolean('statut_location')->default(true)->after('latitude');
            $table->boolean('statut')->default(true)->after('statut_location');
            $table->unsignedBigInteger('fournisseur_id')->nullable()->after('statut');
            $table->foreign('fournisseur_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicules', function (Blueprint $table) {
            $table->dropForeign('fournisseur_id');
            $table->dropColumn('fournisseur_id');
            $table->dropColumn('statut');
            $table->dropColumn('statut_location');
        });
    }
};
