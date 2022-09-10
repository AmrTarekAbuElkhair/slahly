<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            'App\Http\Interfaces\Mobile\SettingsRepositoryInterface',
            'App\Http\Eloquent\Mobile\SettingsRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\Mobile\Provider\AuthRepositoryInterface',
            'App\Http\Eloquent\Mobile\Provider\AuthRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\Mobile\Provider\BookingRepositoryInterface',
            'App\Http\Eloquent\Mobile\Provider\BookingRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\Mobile\Provider\WorksRepositoryInterface',
            'App\Http\Eloquent\Mobile\Provider\WorksRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\Mobile\User\AuthRepositoryInterface',
            'App\Http\Eloquent\Mobile\User\AuthRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\Mobile\User\BookingRepositoryInterface',
            'App\Http\Eloquent\Mobile\User\BookingRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\Mobile\User\PackageRepositoryInterface',
            'App\Http\Eloquent\Mobile\User\PackageRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\Mobile\User\OfferRepositoryInterface',
            'App\Http\Eloquent\Mobile\User\OfferRepository'
        );
    }
}
