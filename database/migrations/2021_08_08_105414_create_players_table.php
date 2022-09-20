<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('family_name');
            $table->string('player_name');
            $table->foreignId('user_id')->nullable();
            $table->string('rank_name');
            $table->string('shooter_one')->nullable();
            $table->string('shooter_two')->nullable();
            $table->string('shooter_three')->nullable();
            $table->string('found')->nullable();
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('players');
    }
}
