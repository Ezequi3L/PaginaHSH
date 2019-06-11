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
      User::create(['name' => "Ezequiel Dall'Aglio",'email' => "ezequieldall@live.com.ar",'email_verified_at' => now(),'password' => bcrypt('ezequiel98'),'remember_token' => Str::random(10),'tipo_de_usuario' => 0]);
      factory(User::class)->times(15)->create();
    }
}
