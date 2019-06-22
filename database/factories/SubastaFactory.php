<?php

use Faker\Generator as Faker;

$factory->define(App\Subasta::class, function (Faker $faker) {
    return [
      'residencia_id' => $faker->numberBetween($min=1, $max=6),
      'fecha_reserva' => $faker->unique()->dateTimeBetween('now', '+2 years'),
      'monto_minimo' => $faker->randomNumber($nbDigits = 2),
    ];
});
