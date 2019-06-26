<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotsalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotsales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('residencia_id')->unsigned();
            $table->foreign('residencia_id')->references('id')->on('residencias');
            $table->date('fecha_reserva'); //la fecha de inicio es 6 meses y 3 días antes
            $table->unique(['residencia_id','fecha_reserva']);
            $table->integer('monto')->unsigned();
            $table->boolean('finalizada')->default(false);
            $table->boolean('activa')->default(false);
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
        Schema::dropIfExists('hotsales');
    }
}
