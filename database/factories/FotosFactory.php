<?php

use Faker\Generator as Faker;

$factory->define(App\Foto::class, function (Faker $faker) {
    return [

      'src' => $faker->image,
      'residencia_id' => $faker->numberBetween($min=1, $max=17)
        //
    ];
});
