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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('lastname');
            $table->date('Fecha nacimiento');
            $table->integer('cedula')->unique();
            $table->integer('telefono');
            $table->string('email')->unique();
            $table->string('password');
            //$table->unsignedBigInteger('specialty_id')->unsigned();
            //$table->foreign('specialty_id')->references('id')->on('specialties')->onDelete('restrict');
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
