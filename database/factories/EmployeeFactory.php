<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
use App\Country;
use App\City;
use App\Department;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'first_name'    => $faker->firstName,
        'second_name'   => $faker->lastName,
        'country_id'    => factory(Country::class)->create()->id,
        'city_id'       => factory(City::class)->create()->id,
        'department_id' => factory(Department::class)->create()->id,
    ];
});
