<?php

use Faker\Generator as Faker;

$factory->define(App\Residencia::class, function (Faker $faker) {
    return [
      'descripcion' => $faker->sentence(10),
      'ubicacion_id' => App\Ubicacion::all()->random()->value('id'),
      'foto_id' => App\Foto::all()->random()->value('id')
        //
    ];
});
