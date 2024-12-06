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
            $table->text('description')->nullable();
            $table->boolean('active')->default(1);
            $table->boolean('deleted')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->timestamps();
        });

        Schema::create('marques', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(1000001);
            $table->string('name', 70)->unique();
            $table->text('description')->nullable();
            $table->boolean('active')->default(1);
            $table->boolean('deleted')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->timestamps();
        });

        Schema::create('vehicules', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(1000001);
            $table->string('modele');
            $table->string('couleur');
            $table->integer('annee')->nullable();
            $table->string('immatriculation')->unique();
            $table->string('type_carburant');
            $table->integer('prix_location');
            $table->integer('kilometrage');
            $table->integer('nombre_places');
            $table->integer('nombre_portes');
            $table->enum('transmission', ['automatique', 'manuelle',]);
            $table->string('assurance_nom');
            $table->string('assurance_date_expi');
            $table->float('longitude')->nullable();
            $table->float('latitude')->nullable();

            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('marque_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('marque_id')->references('id')->on('marques')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
        Schema::dropIfExists('marques');
        Schema::dropIfExists('vehicules');
    }
};
