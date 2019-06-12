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
      factory(User::class)->times(15)->create();
    }
}
