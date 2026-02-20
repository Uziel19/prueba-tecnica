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
        Schema::create('consent_logs', function (Blueprint $table) {

         $table->id();

         $table->foreignId('user_id')
          ->constrained()
          ->onDelete('cascade');


        $table->unsignedTinyInteger('consent_type');

        $table->text('consent_id');
        $table->string('consent_id_hash',64)->unique();
        $table->boolean('status');


        $table->string('action_type', 15);

        $table->string('privacy_policy_version', 10)->default('v1.0');
        $table->string('presented_language', 5)->default('ES');

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
        Schema::dropIfExists('consent_logs');
    }
};
