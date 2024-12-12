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
        Schema::table('vehicule_media', function (Blueprint $table) {
            $table->string('photo_dashboard')->nullable()->after('photo_droite');
            $table->string('photo_interieur')->nullable()->after('photo_dashboard');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicule_media', function (Blueprint $table) {
            $table->dropColumn('photo_dashboard');
            $table->dropColumn('photo_interieur');
        });
    }
};
