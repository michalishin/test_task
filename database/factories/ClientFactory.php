<?php

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

$factory->define(App\Client::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'date_of_birth' => $faker->dateTimeBetween(
            Carbon\Carbon::now()->addYears(-75),
            Carbon\Carbon::now()->addYears(-18)
        ),
        'sex' => $faker->randomElement(['m','f']),
    ];
});
