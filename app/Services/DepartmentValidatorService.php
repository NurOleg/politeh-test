<?php
/**
 * Created by PhpStorm.
 * User: Oleg
 * Date: 02.04.2020
 * Time: 16:41
 */

namespace App\Services;


use App\Employee;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class DepartmentValidatorService
{
    /**
     * @param array|null $employees
     */
    public function checkEmployeesFree(array $employees = null)
    {
        if ($employees === null) {
            return;
        }

        $departmentsCount = Employee::whereIn('id', $employees)->whereNull('department_id')->count();

        if ($departmentsCount) {
            throw new UnprocessableEntityHttpException('All employees must be without department');
        }
    }
}