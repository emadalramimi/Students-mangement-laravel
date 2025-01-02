<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthorizationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Gate pour gérer l'accès aux modules
        Gate::define('gerer-modules', function () {
            return Auth::user() && Auth::user()->estEnseignant();
        });

        // Gate pour gérer les notes
        Gate::define('gerer-notes', function () {
            return Auth::user() && Auth::user()->estEnseignant();
        });

        // Gate pour gérer les évaluations
        Gate::define('gerer-evaluations', function () {
            return Auth::user() && Auth::user()->estEnseignant();
        });
    }
}
