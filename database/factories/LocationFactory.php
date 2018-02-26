<?php

use Faker\Generator as Faker;

$factory->define(App\Location::class, function (Faker $faker) {
    return [
        'lat' => $faker->latitude($min = -90, $max = 90),
        'long' => $faker->longitude($min = -180, $max = 180),
        'state_id' => rand(1,20)
    ];
});
