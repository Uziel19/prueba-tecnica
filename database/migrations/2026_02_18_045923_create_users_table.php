<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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


            $table->text('user');
            $table->string('user_hash', 64)->unique();
            $table->text('name');
            $table->text('phone');
            $table->text('password');


            $table->text('consent_id2');
            $table->string('consent_id2_hash', 64)->unique();
            $table->boolean('consent2_status');

            $table->text('consent_id3');
            $table->string('consent_id3_hash', 64)->unique();
            $table->boolean('consent3_status');

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
};
