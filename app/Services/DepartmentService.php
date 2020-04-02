<?php
/**
 * Created by PhpStorm.
 * User: Oleg
 * Date: 02.04.2020
 * Time: 14:18
 */

namespace App\Services;


use App\City;
use App\Department;
use App\Employee;
use App\Http\Requests\Department\CreateDepartmentRequest;
use App\Http\Requests\Department\UpdateDepartmentRequest;
use App\Room;
use Illuminate\Http\JsonResponse;

class DepartmentService
{
    /**
     * @param UpdateDepartmentRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(UpdateDepartmentRequest $request, $id): JsonResponse
    {
        $department = Department::find($id);

        if ($request->has('rooms_deleted')) {
            Room::whereIn('id', $request->get('rooms_deleted'))->update(['department_id' => null]);
        }

        if ($request->has('rooms')) {
            $rooms = Room::find($request->get('rooms'));
            $department->rooms()->saveMany($rooms);
        }

        if ($request->has('employees')) {
            $employees = Employee::find($request->get('employees'));
            $department->employees()->saveMany($employees);
        }

        $department->update($request->all());

        return response()->json($department, 200);
    }

    /**
     * @param CreateDepartmentRequest $request
     * @return JsonResponse
     */
    public function create(CreateDepartmentRequest $request): JsonResponse
    {
        $department = Department::create($request->all());

        if ($request->has('rooms')) {
            $rooms = Room::find($request->get('rooms'));
            $department->rooms()->saveMany($rooms);
        }

        if ($request->has('employees')) {
            $employees = Employee::find($request->get('employees'));
            $department->employees()->saveMany($employees);
        }

        return response()->json($department, 201);
    }
}