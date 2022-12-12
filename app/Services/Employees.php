<?php

namespace App\Services;

use App\Constants\Employees\EmployeeKeys;
use App\Requests\Employees\EmployeeAddOrUpdate;
use App\Requests\Employees\EmployeeDelete;
use App\Results\ApiResult;
use App\Models\Employees as EmployeesModel;
use Datetime;

class Employees
{
    use ApiResult;

    /**
     * @param EmployeeAddOrUpdate $employeeAddOrUpdate
     * @return Employees
     */
    public function addOrUpdate(EmployeeAddOrUpdate $employeeAddOrUpdate, bool $edit): Employees
    {
        $result = new self;
        $model = new EmployeesModel();

        if ($edit) {
            $model->updated_at = new Datetime();
        }

        $model[EmployeeKeys::TC_NO] = $employeeAddOrUpdate->getTcNo();
        $model[EmployeeKeys::SGK_NO] = $employeeAddOrUpdate->getSgkNo();
        $model[EmployeeKeys::NAME] = $employeeAddOrUpdate->getName();
        $model[EmployeeKeys::SURNAME] = $employeeAddOrUpdate->getSurname();
        $model[EmployeeKeys::BEGIN_DATE] = $employeeAddOrUpdate->getBeginDate();
        $model[EmployeeKeys::QUIT_DATE] = $employeeAddOrUpdate->getQuitDate();

        $queryResult = $model->save();

        if ($queryResult) {
            $result->setSuccess(true);
            $result->setData($queryResult);
            $result->setMessage('Employee Created');
        } else {
            $result->setSuccess(false);
            $result->setMessage('An Error Occur');
        }

        return $result;
    }

    /**
     * @param EmployeeDelete $employeeDelete
     * @return Employees
     */
    public function delete(EmployeeDelete $employeeDelete): Employees
    {
        $result = new self;
        $model = new EmployeesModel();

        $queryResult = $model::where(EmployeeKeys::TC_NO, $employeeDelete->getTcNo())->delete();

        if ($queryResult) {
            $result->setSuccess(false);
            $result->setData($employeeDelete->getTcNo());
            $result->setMessage('Employee Removed');
        } else {
            $result->setSuccess(false);
            $result->setMessage('An Error Occur');
        }

        return $result;
    }
}
