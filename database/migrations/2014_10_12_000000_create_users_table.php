<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name')->nullable();
            $table->string('role', 64);
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('subscribed')->nullable();
            $table->timestamp('birth_date')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone', 64)->nullable();
            $table->string('coupon_code', 255)->nullable();
            $table->string('site', 255)->nullable();
            $table->string('how_did_you_hear', 500)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
