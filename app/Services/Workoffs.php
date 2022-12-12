<?php

namespace App\Services;

use App\Constants\Employees\EmployeeKeys;
use App\Constants\Workoffs\WorkoffKeys;
use App\Requests\Employees\EmployeeAddOrUpdate;
use App\Requests\Employees\EmployeeDelete;
use App\Requests\Workoffs\WorkoffsRequest;
use App\Results\ApiResult;
use App\Models\Workoffs as WorkoffsModel;
use Carbon\Carbon;
use Datetime;

class Workoffs
{
    use ApiResult;

    private const PRESENT = "present";

    private const ABSENT = "absent";

    /**
     * @param WorkoffsRequest $workoffsRequest
     * @param string|null $tcNo
     * @param string|null $beginDate
     * @param string|null $endDate
     * @return Workoffs
     */
    public function addOrUpdate(WorkoffsRequest $workoffsRequest, string $tcNo = null, string $beginDate = null, string $endDate = null): Workoffs
    {
        $result = new self;
        $model = new WorkoffsModel();

        if (isset($tcNo, $beginDate, $endDate)) {
            $model->updated_at = new Datetime();
        }

        $model[WorkoffKeys::TC_NO] = $workoffsRequest->getTcNo();
        $model[WorkoffKeys::BEGIN_DATE] = $workoffsRequest->getBeginDate();
        $model[WorkoffKeys::END_DATE] = $workoffsRequest->getEndDate();

        $queryResult = $model->save();

        if ($queryResult) {
            $result->setSuccess(true);
            $result->setData($queryResult);
            $result->setMessage('Workoff Created');
        } else {
            $result->setSuccess(false);
            $result->setMessage('An Error Occur');
        }

        return $result;
    }

    /**
     * @param WorkoffsRequest $workoffsRequest
     * @return Workoffs
     */
    public function delete(WorkoffsRequest $workoffsRequest): Workoffs
    {
        $result = new self;
        $model = new WorkoffsModel();

        $queryResult = $model::where(WorkoffKeys::TC_NO, $workoffsRequest->getTcNo())
            ->where(WorkoffKeys::BEGIN_DATE, $workoffsRequest->getBeginDate())
            ->where(WorkoffKeys::END_DATE, $workoffsRequest->getEndDate())
            ->delete();

        if ($queryResult) {
            $result->setSuccess(false);
            $result->setData($workoffsRequest->getTcNo());
            $result->setMessage('Workoff Removed');
        } else {
            $result->setSuccess(false);
            $result->setMessage('An Error Occur');
        }

        return $result;
    }

    /**
     * @param WorkoffsRequest $workoffsRequest
     * @return Workoffs
     */
    public function getEmployeesListByDateRange(WorkoffsRequest $workoffsRequest): Workoffs
    {
        $result = new self;
        $model = new WorkoffsModel();

        if ($workoffsRequest->getBeginDate() < $workoffsRequest->getBeginDate()) {
            $result->setSuccess(false);
            $result->setMessage('Wrong date range, begin date must be smaller!');
        } else {
            $queryResult = $model::where(WorkoffKeys::BEGIN_DATE, '>=', $workoffsRequest->getBeginDate())
                ->where(WorkoffKeys::END_DATE, '<=', $workoffsRequest->getEndDate())
                ->get()
                ->toArray();

            if ($queryResult) {
                $result->setSuccess(false);
                $result->setData($queryResult);
                $result->setMessage('Datas in range');
            } else {
                $result->setSuccess(false);
                $result->setMessage('An Error Occur');
            }
        }

        return $result;
    }

    /**
     * @param string $name
     * @return Workoffs
     */
    public function getEmployeeByName(string $name): Workoffs
    {
        $result = new self;
        $model = new WorkoffsModel();

        if (!isset($name)) {
            $result->setSuccess(false);
            $result->setMessage('Employee name must be passed on url!');
        } else {
            $queryResult = $model::where(EmployeeKeys::TABLE.'.'.EmployeeKeys::NAME, 'LIKE', "%{$name}%")
                ->orWhere(EmployeeKeys::TABLE.'.'.EmployeeKeys::SURNAME, 'LIKE', "%{$name}%")
                ->orWhere(DB::raw("CONCAT(`employees.name`, `employees.surname`)"), 'LIKE', "%{$name}%")
                ->join(EmployeeKeys::TABLE, EmployeeKeys::TABLE.'.'.EmployeeKeys::TC_NO, WorkoffKeys::TABLE.'.'.WorkoffKeys::TC_NO)
                ->get()
                ->toArray();

            if ($queryResult) {
                $result->setSuccess(false);
                $result->setData($queryResult);
                $result->setMessage('Datas in range');
            } else {
                $result->setSuccess(false);
                $result->setMessage('An Error Occur');
            }
        }

        return $result;
    }

    /**
     * @param string $workoffStatus
     * @return Workoffs
     */
    public function getEmployeesListByWorkoffStatus(string $workoffStatus): Workoffs
    {
        $result = new self;

        if (!isset($workoffStatus)) {
            $result->setSuccess(false);
            $result->setMessage('Workoff status mus be set to present or absent!');

            return $result;
        }

        $model = new WorkoffsModel();

        if (self::PRESENT) {
            $queryResult = $model::where(WorkoffKeys::BEGIN_DATE, '<=', Carbon::now())
                ->where(WorkoffKeys::END_DATE, '>=', Carbon::now());
        } else if (self::ABSENT) {
            $queryResult = $model::where(WorkoffKeys::BEGIN_DATE, '>=', Carbon::now())
                ->where(WorkoffKeys::END_DATE, '<=', Carbon::now());
        }

        $queryResult->get()->toArray();
        if ($queryResult) {
            $result->setSuccess(false);
            $result->setData($queryResult);
            $result->setMessage('Datas in range');
        }


        return $result;
    }
}
