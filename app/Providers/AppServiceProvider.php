<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Barangay;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Paginator::useBootstrap();
        // $brgy = Barangay::find(1)->pluck('name')->first();
        view()->composer('layout', function ($view) {
          $brgy = Barangay::find(1)->select('name')->first();;
          $view->brgy = $brgy;
        });
    }
}
