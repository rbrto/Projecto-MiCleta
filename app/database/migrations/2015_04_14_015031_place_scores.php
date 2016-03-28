<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PlaceScores extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('place_scores', function($table) {
            $table->increments('id')->unsigned();

            $table->integer('user_id')->unsigned();
            $table->integer('place_id')->unsigned();
            $table->integer('score')->unsigned();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('place_id')->references('id')->on('places');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('place_scores', function(Blueprint $table) {
            $table->dropForeign('place_scores_user_id_foreign');
            $table->dropForeign('place_scores_place_id_foreign');
        });

        Schema::drop('place_scores');
    }

}
