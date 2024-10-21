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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->startingValue(1000001);
            $table->string('first_name', 255)->nullable();
            $table->string('last_name', 255);
            $table->string('email', 255)->unique();
            $table->string('phone', 255)->unique();
            $table->string('phone_code', 5);
            $table->string('password', 255);
            $table->timestamp('verified_at')->nullable();
            $table->string('source_ip_address', 40)->nullable();
            $table->text('source_server_info')->nullable();
            $table->unsignedBigInteger('user_type_id');
            $table->boolean('is_active')->default(1);
            $table->boolean('mfa_is_active')->default(0);
            $table->text('google2fa_secret')->nullable();
            $table->dateTime('last_login_date')->nullable();
            $table->rememberToken()->nullable();
            $table->boolean('deleted')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_type_id')->references('id')->on('user_types')->onDelete('cascade');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
