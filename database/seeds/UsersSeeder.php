<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::create(['email' => "admin@hsh.com",'email_verified_at' => now(),'password' => bcrypt('admin'),'remember_token' => Str::random(10),'tipo_de_usuario' => 0]);
      User::create(['name' => 'Usuario Premium','email' => "user@hsh.com",'email_verified_at' => now(),'dni' => '12345678','password' => bcrypt('user'),'fecha_nac'=> '1990-04-25','direccion' => '8687 Schmidt Mall Suite 302v chneiderside, AK 98411-4359','telefono' =>'(626) 255-7313 x8563','semanas_disp' => 2,'pago_tipo' =>'Visa','pago_numero' => '2720656886308687','pago_cvv' => '658','pago_vencimiento' => '11/20','remember_token' => Str::random(10),'tipo_de_usuario' => 3]);
      factory(User::class)->times(15)->create();
    }
}
