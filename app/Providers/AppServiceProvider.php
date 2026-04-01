<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Services\UserService;
use App\Repositories\ProfileRepositoryInterface;
use App\Repositories\ProfileRepository;
use App\Services\ProfileService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ProfileRepositoryInterface::class, ProfileRepository::class);

        $this->app->bind(UserService::class, function($app){
            return new UserService($app->make(UserRepositoryInterface::class));
        });

        $this->app->bind(ProfileService::class, function($app){
            return new ProfileService($app->make(ProfileRepositoryInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
