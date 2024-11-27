<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrivilegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('privileges', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(1000001);
            $table->string('name', 70); // create read update delete assign revoke
            $table->string('description', 100);
            $table->unsignedBigInteger('user_type_id');
            $table->timestamps();

            $table->foreign('user_type_id')->references('id')->on('user_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('privileges');
    }
}
