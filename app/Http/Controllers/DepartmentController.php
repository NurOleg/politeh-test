<?php

namespace App\Http\Controllers;

use App\City;
use App\Department;
use App\Employee;
use App\Http\Requests\Department\CreateDepartmentRequest;
use App\Http\Requests\Department\UpdateDepartmentRequest;
use App\Services\DepartmentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class DepartmentController extends Controller
{
    /**
     * @var DepartmentService
     */
    private $departmentService;

    /**
     * DepartmentController constructor.
     * @param DepartmentService $departmentService
     */
    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::all();
        return response()->json($departments, 200);
    }

    /**
     * @param CreateDepartmentRequest $request
     * @return JsonResponse
     */
    public function store(CreateDepartmentRequest $request)
    {
        return $this->departmentService->create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department = Department::with(['city', 'employees', 'rooms'])->find($id);
        return response()->json($department, 200);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateDepartmentRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(UpdateDepartmentRequest $request, $id): JsonResponse
    {
        $this->checkEmployees($request->get('employees'));

        return $this->departmentService->update($request, $id);
    }

    /**
     * @param $id
     * @return View
     */
    public function showWeb($id): View
    {
        return view('sections.department', ['department' => Department::find($id)]);
    }

    /**
     * @param $id
     * @return View
     */
    public function editWeb($id): View
    {
        return view('sections.department_edit', ['department' => Department::find($id)]);
    }

    /**
     * @return View
     */
    public function createWeb(): View
    {
        $cities = City::all();
        return view('sections.department_create', ['cities' => $cities]);
    }

    /**
     * @param array $employees
     */
    private function checkEmployees(array $employees = null)
    {
        if ($employees === null) {
            return;
        }

        $departmentsIds = Employee::find($employees)->pluck('department_id')->toArray();
        if (!empty(array_filter($departmentsIds, function ($a) {
            return $a !== null;
        }))) {
            throw new UnprocessableEntityHttpException('All employees must be without department');
        }
    }
}
