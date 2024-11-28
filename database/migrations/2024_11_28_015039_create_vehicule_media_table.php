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

        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(1000001);
            $table->string('name', 70)->unique();
            $table->string('description', 100)->nullable();
            $table->boolean('active')->default(1);
            $table->boolean('deleted')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->timestamps();
        });

        Schema::create('vehicule_media', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(1000001);
            $table->string('photo_avant')->nullable();
            $table->string('photo_arriere')->nullable();
            $table->string('photo_gauche')->nullable();
            $table->string('photo_droite')->nullable();

            $table->unsignedBigInteger('vehicule_id');
            $table->foreign('vehicule_id')->references('id')->on('vehicules')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicule_media');
    }
};
