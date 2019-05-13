<?php

use Faker\Generator as Faker;

$factory->define(App\Ubicacion::class, function (Faker $faker) {
    return [
      'ciudad' => $faker->city,
      'provincia' => $faker->state
        //
    ];
});
