<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubastasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subastas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('residencia_id')->unsigned();
            $table->foreign('residencia_id')->references('id')->on('residencias');
            $table->date('fecha_reserva'); //la fecha de inicio es 6 meses antes
            $table->unique(['residencia_id','fecha_reserva']);
            $table->double('monto_minimo');
            $table->boolean('ganada')->default(false);
            $table->boolean('finalizada')->default(false);
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
        Schema::dropIfExists('subastas');
    }
}
