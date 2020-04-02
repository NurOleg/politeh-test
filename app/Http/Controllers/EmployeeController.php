<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Http\Requests\Employee\ListEmployeeRequest;
use App\Services\EmployeeService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    private $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    /**
     * Display a listing of the resource.
     * @param ListEmployeeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ListEmployeeRequest $request)
    {
        $employees = $this->employeeService->employeeFetch($request);

        return response()->json($employees);
    }

    /**
     * @param Employee $employee
     * @return JsonResponse
     */
    public function show(Employee $employee): JsonResponse
    {
        $employee->load(['country', 'city', 'department']);
        return response()->json($employee);
    }

    /**
     * @param Employee $employee
     * @return View
     */
    public function showWeb(Employee $employee): View
    {
        return view('sections.employee', ['employee' => $employee]);
    }
}
