<?php

namespace App\Http\Controllers;

use App\Constants\Workoffs\WorkoffKeys;
use App\Requests\Workoffs\WorkoffsRequest;
use App\Services\Workoffs as WorkoffsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Workoffs extends Controller
{
    private $workoffsService;

    public function __construct()
    {
        $this->workoffsService = app(WorkoffsService::class);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    final public function add(Request $request): JsonResponse
    {
        $workoffRequest = new WorkoffsRequest(
            $request->input(WorkoffKeys::TC_NO),
            $request->input(WorkoffKeys::BEGIN_DATE),
            $request->input(WorkoffKeys::END_DATE),
        );

        return response()->json($this->workoffsService->addOrUpdate($workoffRequest)->toArray());
    }

    /**
     * @param Request $request
     * @param string $tcNo
     * @param string $beginDate
     * @param string $endDate
     * @return JsonResponse
     */
    final public function edit(Request $request, string $tcNo, string $beginDate, string $endDate): JsonResponse
    {
        $workoffRequest = new WorkoffsRequest(
            $request->input(WorkoffKeys::TC_NO),
            $request->input(WorkoffKeys::BEGIN_DATE),
            $request->input(WorkoffKeys::END_DATE),
        );

        return response()->json($this->workoffsService->addOrUpdate($workoffRequest, $tcNo, $beginDate, $endDate)->toArray());
    }

    /**
     * @param Request $request
     * @param string $tcNo
     * @param string $beginDate
     * @param string $endDate
     * @return void
     */
    final public function delete(Request $request, string $tcNo, string $beginDate, string $endDate): JsonResponse
    {
        $workoffRequest = new WorkoffsRequest($tcNo, $beginDate, $endDate);

        return response()->json($this->workoffsService->delete($workoffRequest)->toArray());
    }

    /**
     * @param Request $request
     * @param string $beginDate
     * @param string $endDate
     * @return JsonResponse
     */
    final public function getEmployeesListByDateRange(Request $request, string $beginDate, string $endDate): JsonResponse
    {
        $workoffRequest = new WorkoffsRequest(null, $beginDate, $endDate);

        return response()->json($this->workoffsService->getEmployeesListByDateRange($workoffRequest)->toArray());
    }

    /**
     * @param Request $request
     * @param string $name
     * @return JsonResponse
     */
    final public function getEmployeeByName(Request $request, string $name): JsonResponse
    {
        return response()->json($this->workoffsService->getEmployeeByName($name)->toArray());
    }

    /**
     * @param Request $request
     * @param string $workoffStatus
     * @return JsonResponse
     */
    final public function getEmployeesListByWorkoffStatus(Request $request, string $workoffStatus): JsonResponse
    {
    return response()->json($this->workoffsService->getEmployeesListByWorkoffStatus($workoffStatus)->toArray());
    }
}
