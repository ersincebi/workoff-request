<?php

namespace App\Http\Controllers;

use App\Constants\Employees\EmployeeKeys;
use App\Requests\Employees\EmployeeAddOrUpdate;
use App\Requests\Employees\EmployeeDelete;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\Employees as EmployeesService;

class Employees extends Controller
{
    private $employeesService;

    public function __construct()
    {
        $this->employeesService = app(EmployeesService::class);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    final public function add(Request $request): JsonResponse
    {
        $employeeRequest = new EmployeeAddOrUpdate(
            $request->input(EmployeeKeys::TC_NO),
            $request->input(EmployeeKeys::SGK_NO),
            $request->input(EmployeeKeys::NAME),
            $request->input(EmployeeKeys::SURNAME),
            $request->input(EmployeeKeys::BEGIN_DATE),
            $request->input(EmployeeKeys::QUIT_DATE)
        );

        return response()->json($this->employeesService->addOrUpdate($employeeRequest)->toArray());
    }

    /**
     * @param Request $request
     * @param string $tcNo
     * @return JsonResponse
     */
    final public function edit(Request $request, string $tcNo): JsonResponse
    {
        $employeeRequest = new EmployeeAddOrUpdate(
            $request->input(EmployeeKeys::TC_NO),
            $request->input(EmployeeKeys::SGK_NO),
            $request->input(EmployeeKeys::NAME),
            $request->input(EmployeeKeys::SURNAME),
            $request->input(EmployeeKeys::BEGIN_DATE),
            $request->input(EmployeeKeys::QUIT_DATE)
        );

        return response()->json($this->employeesService->addOrUpdate($employeeRequest, true)->toArray());
    }

    /**
     * @param Request $request
     * @param string $tcNo
     * @return JsonResponse
     */
    final public function delete(Request $request, string $tcNo): JsonResponse
    {
        $employeeRequest = new EmployeeDelete($request->input(EmployeeKeys::TC_NO));

        return response()->json($this->employeesService->delete($employeeRequest)->toArray());
    }
}
