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

$factory->define(App\MasterBuilding::class, function (Faker $faker) {
    return [
        'society_id' => $faker->numberBetween(1, 10),
        'building_no' => $faker->numberBetween(300, 34585),
        'name' => $faker->name,
        'description' =>  $faker->name,
    ];
});
