<?php

namespace App\Providers;

use App\Http\Controllers\MenuController;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        view()->composer('*' , function ($view){
           $userMenu = app(MenuController::class)->getUserMenu();
           $view->with(compact('userMenu'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
