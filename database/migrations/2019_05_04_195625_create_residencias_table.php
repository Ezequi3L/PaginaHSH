<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResidenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residencias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion');
            $table->integer('ubicacion_id')->unsigned();
            $table->foreign('ubicacion_id')->references('id')->on('ubicaciones')->nullable();
            $table->boolean('dada_de_baja')->default(false);
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
        Schema::dropIfExists('residencias');
    }
}
