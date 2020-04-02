<?php

namespace App\Http\Controllers;

use App\City;
use App\Department;
use App\Employee;
use App\Http\Requests\Department\CreateDepartmentRequest;
use App\Http\Requests\Department\UpdateDepartmentRequest;
use App\Services\DepartmentService;
use App\Services\DepartmentValidatorService;
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
     * @var DepartmentValidatorService
     */
    private $departmentValidatorService;

    /**
     * DepartmentController constructor.
     * @param DepartmentService $departmentService
     * @param DepartmentValidatorService $departmentValidatorService
     */
    public function __construct(DepartmentService $departmentService, DepartmentValidatorService $departmentValidatorService)
    {
        $this->departmentService = $departmentService;
        $this->departmentValidatorService = $departmentValidatorService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::all();
        return response()->json($departments);
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
     * @param Department $department
     * @return JsonResponse
     */
    public function show(Department $department)
    {
        $department->load(['city', 'employees', 'rooms']);
        return response()->json($department);
    }

    /**
     * @param UpdateDepartmentRequest $request
     * @param Department $department
     * @return JsonResponse
     */
    public function update(UpdateDepartmentRequest $request, Department $department): JsonResponse
    {
        $this->departmentValidatorService->checkEmployeesFree($request->get('employees'));

        return $this->departmentService->update($request, $department);
    }

    /**
     * @param Department $department
     * @return View
     */
    public function showWeb(Department $department): View
    {
        return view('sections.department', ['department' => $department]);
    }

    /**
     * @param Department $department
     * @return View
     */
    public function editWeb(Department $department): View
    {
        return view('sections.department_edit', ['department' => $department]);
    }

    /**
     * @return View
     */
    public function createWeb(): View
    {
        $cities = City::all();
        return view('sections.department_create', ['cities' => $cities]);
    }
}
