<?php

use Illuminate\Database\Seeder;
use App\Country;
use App\City;
use App\Department;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countryId = Country::all()->first()->id;
        $cities = City::all();
        $departments = Department::all();
        $employeesData = [];
        $faker = Faker::create();

        for ($i = 0; $i <= 30; $i++) {
            $employeesData[] = [
                'first_name'    => $faker->firstName,
                'second_name'   => $faker->lastName,
                'country_id'    => $countryId,
                'city_id'       => $cities->random()->id,
                'department_id' => rand(0, 2) > 1 ? $departments->random()->id : null,
            ];
        }
        DB::table('employees')->insert($employeesData);
    }
}
