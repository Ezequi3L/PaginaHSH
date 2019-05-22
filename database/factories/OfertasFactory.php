<?php

use Faker\Generator as Faker;

$factory->define(App\Oferta::class, function (Faker $faker) {
    return [
      'subasta_id' => $faker->numberBetween($min=1, $max=17),
      'monto' => $faker->randomFloat($nbMaxDecimals = 2, $min = App\Oferta::all()->max('monto'), $max = NULL),
      'mail' => $faker->email()
        //
    ];
});
