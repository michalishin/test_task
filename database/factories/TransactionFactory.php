<?php

use Faker\Generator as Faker;

$factory->define(\App\Transaction::class, function (Faker $faker) {
    return [
        'type_id' => \App\Transaction::INITIAL_TRANSACTION,
        'amount' => $faker->randomFloat(2,100,10000)
    ];
});
