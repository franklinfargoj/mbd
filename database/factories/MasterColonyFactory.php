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

$factory->define(App\MasterColony::class, function (Faker $faker) {

	$users = App\MasterWard::all()->pluck('id')->toArray();

	return [
        'ward_id' => $faker->randomElement($users),
        'name' => $faker->name,
        'description' =>  $faker->name,
    ];
});
