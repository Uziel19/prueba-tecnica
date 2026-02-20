<?php

namespace App\Providers;

use App\Contracts\ConsentLogServiceInterface;
use App\Contracts\UserCardServiceInterface;
use App\Contracts\UserServiceInterface;
use App\Services\ConsentLogService;
use App\Services\UserCardService;
use App\Services\UserService;
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
        $this->app->bind(
            UserServiceInterface::class,
            UserService::class
        );

        $this->app->bind(
            UserCardServiceInterface::class,
            UserCardService::class

        );

        $this->app->bind(
            ConsentLogServiceInterface::class,
            ConsentLogService::class
        );
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
