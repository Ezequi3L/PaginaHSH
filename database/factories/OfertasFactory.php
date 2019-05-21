<?php

use Faker\Generator as Faker;

$factory->define(App\Oferta::class, function (Faker $faker) {
    return [
      'subasta_id' => App\Subasta::all()->random()->value('id'),
      'monto' => $faker->randomFloat($nbMaxDecimals = 2, $min = App\Oferta::all()->max('monto'), $max = NULL),
      'mail' => $faker->email()
        //
    ];
});
