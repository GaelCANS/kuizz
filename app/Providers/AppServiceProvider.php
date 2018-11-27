<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('regame', function($attribute, $value, $parameters) {
            return User::whereEmail($value)->whereQuizzId($parameters[0])->count() == 0;
        });
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
