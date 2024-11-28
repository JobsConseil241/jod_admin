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
        Schema::create('languages', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(1000001);
            $table->string('key', 50);
            $table->enum('app', ['MOB', 'WEB']);
            $table->text('fr');
            $table->text('en');
            $table->timestamps();

            $table->unique(['key', 'app']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
};
