<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Places extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function($table) {
            $table->increments('id')->unsigned();

            $table->integer('user_id')->unsigned();
            $table->enum('type', array('shop', 'parking','workshop')); //Se agrego al array el tipo taller en la tabla lugares
            $table->string('nombre', 100);
            $table->string('direccion', 100);
            $table->string('lat', 50);
            $table->string('lon', 50);

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('places', function(Blueprint $table) {
            $table->dropForeign('places_user_id_foreign');
        });

        Schema::drop('places');
    }

}