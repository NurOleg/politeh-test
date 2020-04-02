<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Department;
use App\City;
use Faker\Generator as Faker;

$factory->define(Department::class, function (Faker $faker) {
    return [
        // уникальное "имя"
        'name'        => $faker->uuid,
        'description' => $faker->randomLetter,
        'city_id'     => factory(City::class)->create()->id
    ];
});
