<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function($table) {
            $table->increments('id')->unsigned();

            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('alias', 100);
            $table->string('email', 100)->unique();
            $table->string('direccion', 100);
            $table->string('edad', 100);
            $table->string('password', 64);
            $table->boolean('activo')->default(0);
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
        Schema::drop('users');
    }
}