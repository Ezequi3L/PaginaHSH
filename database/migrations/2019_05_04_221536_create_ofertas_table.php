<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ofertas', function (Blueprint $table) {
            $table->increments('id');
            $table->double('monto');
            $table->string('mail'); //mientras no tengamos usuarios, las ofertas se realizarán con una dirección de mail
           // $table->foreign('usr_id')->references('id')->on('users');
            $table->integer('subasta_id')->unsigned();
            $table->foreign('subasta_id')->references('id')->on('subastas');
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
        Schema::dropIfExists('ofertas');
    }
}
