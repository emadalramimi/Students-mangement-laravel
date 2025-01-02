<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization service.
     */
    public function boot(): void
    {
        // Gates for module management
        Gate::define('gerer-modules', function (User $user) {
            return $user->estEnseignant();
        });

        // Gates for evaluation management
        Gate::define('gerer-evaluations', function (User $user) {
            return $user->estEnseignant();
        });

        // Gates for note management
        Gate::define('gerer-notes', function (User $user) {
            return $user->estEnseignant();
        });

        // Gates for viewing student notes
        Gate::define('voir-notes-eleve', function (User $user) {
            return $user->estEleve() || $user->estEnseignant();
        });

        // Gates for creating and managing student records
        Gate::define('gerer-etudiants', function (User $user) {
            return $user->estEnseignant();
        });

        // Gates for profile management
        Gate::define('modifier-profil', function (User $user, User $profile) {
            return $user->id === $profile->id;
        });
    }
}
