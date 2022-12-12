<?php

use App\Http\Controllers\Employees;
use App\Http\Controllers\Workoffs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], static function () {
    Route::controller(Employees::class)->group(static function () {
        Route::post('employee/add', 'add');
        Route::put('employee/{tcNo}/edit', 'edit');
        Route::delete('employee/{tcNo}/delete', 'delete');
    });
    Route::controller(Workoffs::class)->group(static function () {
        Route::post('workoff/add', 'add');
        Route::put('workoff/{tcNo}/{beginDate}/{endDate}', 'edit');
        Route::delete('workoff/{tcNo}/{beginDate}/{endDate}', 'delete');
        Route::get('workoff/{beginDate}/{endDate}', 'getEmployeesListByDateRange');
        Route::get('workoff/{name}/employee', 'getEmployeeByName');
        Route::get('workoff/{workoffStatus}/status', 'getEmployeesListByWorkoffStatus');
    });
});
