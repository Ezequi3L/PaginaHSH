<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('dni')->nullable();
            $table->date('fecha_nac')->nullable();
            //tipo de usuario: 0:admin,1:sin verificar,2: verificado,3:premium
            $table->integer('tipo_de_usuario')->default(1);
            //reservas-ofertas-hotsales
            $table->integer('semanas_disp')->nullable()->default(null);
            //metodo de pago
            $table->string('pago_tipo')->nullable();
            $table->string('pago_numero')->nullable();
            $table->integer('pago_cvv')->nullable();
            $table->string('pago_vencimiento')->nullable();
            //
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
        Schema::dropIfExists('users');
    }
}
