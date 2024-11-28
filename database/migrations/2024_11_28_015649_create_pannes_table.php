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
        Schema::create('category_pannes', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(1000001);
            $table->string('name', 70)->unique();
            $table->string('description', 100)->nullable();
            $table->boolean('active')->default(1);
            $table->boolean('deleted')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->timestamps();
        });

        Schema::create('pannes', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(1000001);
            $table->string('name');
            $table->string('description')->nullable();

            $table->unsignedBigInteger('category_panne_id')->nullable();
            $table->foreign('category_panne_id')->references('id')->on('category_pannes');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_pannes');
        Schema::dropIfExists('pannes');
    }
};
