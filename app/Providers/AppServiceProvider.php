<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Schema; //Import Schema

use View;
use App\Trip;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191); //Solved by increasing StringLength

        // Share the trip list globally to be used on layout
        $tripLists = Trip::where('end_date', '!=', NULL)->where('is_deleted', '!=', '1')->get();
        View::share('tripLists', $tripLists);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
