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

$factory->define(App\MasterSociety::class, function (Faker $faker) {
    return [
        'colony_id' => $faker->numberBetween(1, 30),
        'name' => $faker->name,
        'description' =>  $faker->name,
    ];
});
