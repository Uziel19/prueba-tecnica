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
        Schema::create('user_cards', function (Blueprint $table) {

                $table->id();
                $table->foreignId('user_id')
                    ->constrained()
                    ->onDelete('cascade');

                $table->text('card_number');
                $table->string('card_number_hash', 64)->unique();

                $table->text('consent_id1');
                $table->string('consent_id1_hash', 64)->unique();


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
        Schema::dropIfExists('user_cards');
    }
};
