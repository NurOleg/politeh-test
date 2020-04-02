<?php
/**
 * Created by PhpStorm.
 * User: Oleg
 * Date: 01.04.2020
 * Time: 19:43
 */

namespace App\Services;


use App\Employee;
use App\Http\Requests\Employee\ListEmployeeRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class EmployeeService
{
    /**
     * @param ListEmployeeRequest $request
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function employeeFetch(ListEmployeeRequest $request): Collection
    {
        $employee = Employee::query();

        if ($request->has('without_department')) {
            $employee->whereNull('department_id');
        }

        if ($request->has('first_name')) {
            $employee->whereFirstName($request->get('first_name'));
        }

        if ($request->has('second_name')) {
            $employee->whereSecondName($request->get('second_name'));
        }

        if ($request->has('country_name')) {
            $employee->whereHas('country', function (Builder $query) use ($request) {
                $query->whereName($request->get('country_name'));
            });
        }

        if ($request->has('city_name')) {
            $employee->whereHas('city', function (Builder $query) use ($request) {
                $query->whereName($request->get('city_name'));
            });
        }

        return $employee->get();
    }
}