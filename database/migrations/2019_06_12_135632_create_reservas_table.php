<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('usr_id')->unsigned();
            $table->foreign('usr_id')->references('id')->on('users');
            $table->integer('residencia_id')->unsigned();
            $table->foreign('residencia_id')->references('id')->on('residencias');
            $table->date('fecha');
            $table->boolean('hotsale');
            $table->integer('monto')->unsigned()->nullable();
            $table->timestamps();
            $table->unique(['residencia_id','fecha']);
            $table->unique(['fecha','usr_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservas');
    }
}
