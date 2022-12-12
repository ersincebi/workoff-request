<?php

namespace App\Providers;

use App\Services\Employees as EmployeesService;
use App\Services\Workoffs as WorkoffsService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EmployeesService::class, function() {
            return new EmployeesService();
        });

        $this->app->bind(WorkoffsService::class, function() {
            return new WorkoffsService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
