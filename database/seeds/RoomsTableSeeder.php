<?php

use Illuminate\Database\Seeder;
use App\Department;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = Department::all();

        foreach ($departments as $department) {
            if ($department->name === 'Отдел кадров') {
                DB::table('rooms')->insert([
                    [
                        'name'          => 'Офис 1',
                        'department_id' => $department->id
                    ],
                    [
                        'name'          => 'Офис 2',
                        'department_id' => $department->id
                    ]
                ]);
            } else {
                DB::table('rooms')->insert([
                    [
                        'name'          => 'Склад 1',
                        'department_id' => $department->id
                    ],
                    [
                        'name'          => 'Склад 2',
                        'department_id' => $department->id
                    ]
                ]);
            }

        }
    }
}
