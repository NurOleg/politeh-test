<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Country;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $country = Country::all()->first();

        DB::table('cities')->insert([
            [
                'name'       => 'Санкт-Петербург',
                'code'       => 'spb',
                'country_id' => $country->id
            ],
            [
                'name'       => 'Москва',
                'code'       => 'moscow',
                'country_id' => $country->id
            ],
            [
                'name'       => 'Екатеринбург',
                'code'       => 'ekb',
                'country_id' => $country->id
            ],
        ]);
    }
}
