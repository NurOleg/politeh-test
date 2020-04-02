<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Room;
use App\Department;
use Faker\Generator as Faker;

$factory->define(Room::class, function (Faker $faker) {
    return [
        'name'          => $faker->uuid,
        'department_id' => factory(Department::class)->create()->id
    ];
});
