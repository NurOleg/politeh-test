<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\City;
use App\Country;
use Faker\Generator as Faker;

$factory->define(City::class, function (Faker $faker) {
    return [
        'name'       => $faker->city,
        'code'       => $faker->citySuffix,
        'country_id' => factory(Country::class)->create()->id
    ];
});
