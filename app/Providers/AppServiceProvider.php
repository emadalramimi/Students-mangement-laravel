<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('access-modules', function ($user) {
            return $user->role === 'prof';
        });

        Gate::define('manage-students', function ($user) {
            return $user->role === 'prof';
        });

        Gate::define('manage-evaluations', function ($user) {
            return $user->role === 'prof';
        });
    }    
}
