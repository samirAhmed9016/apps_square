<?php

namespace App\Providers;

use App\Interfaces\Auth\LocationRepositoryInterface;

use App\Interfaces\Auth\OTPRepositoryInterface;
use App\Interfaces\Auth\UserRepositoryInterface;
use App\Repositories\Auth\LocationRepository;
use App\Repositories\Auth\OTPRepository;
use App\Repositories\Auth\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(OTPRepositoryInterface::class, OTPRepository::class);
        $this->app->bind(LocationRepositoryInterface::class, LocationRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
