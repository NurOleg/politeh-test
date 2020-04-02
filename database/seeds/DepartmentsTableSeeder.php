<?php

use Illuminate\Database\Seeder;
use App\City;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = City::all();

        foreach ($cities as $city) {
            DB::table('departments')->insert([
                [
                    'name'        => 'Отдел кадров',
                    'description' => 'Описание отдела кадров в городе ' . $city->name,
                    'city_id'     => $city->id
                ],
                [
                    'name'        => 'Складской отдел',
                    'description' => 'Описание складского отдела в городе ' . $city->name,
                    'city_id'     => $city->id
                ]
            ]);
        }
    }
}
