<?php

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'dni' => $faker->ssn,
        'fecha_nac'=> $faker->date,
        'direccion' =>$faker->address,
        'telefono' =>$faker->phoneNumber,
        'semanas_disp' => 2,
        'password' => bcrypt('contraseña'), // password
        'pago_tipo' => $faker->creditCardType,
        'pago_numero' => $faker->creditCardNumber,
        'pago_cvv' => $faker->randomNumber(3,true),
        'pago_vencimiento' => $faker->creditCardExpirationDateString,
        'remember_token' => Str::random(10),
    ];
});
