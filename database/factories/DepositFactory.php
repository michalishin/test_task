<?php

use Faker\Generator as Faker;

$factory->define(\App\Deposit::class, function (Faker $faker) {
    return [
        'client_id' => \App\Client::inRandomOrder()->first()->id,
        'percent' => $faker->randomFloat(2,1,10),
        'created_at' => $faker->dateTimeBetween(Carbon\Carbon::now()->addYears(-1))
    ];
});
