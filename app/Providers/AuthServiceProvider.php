<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
     * Register any authentication / authorization services.
     */
    // public function boot(): void
    // {
    //     $this->registerPolicies();
    //     //

    //     Gate::define('add-teacher', function ($user) {
    //         return $user->role === 'Admin';
    //     });

    //     Gate::define('delete-teacher', function ($user) {
    //         return $user->role === 'Admin';
    //     });

    //     Gate::define('post-news', function ($user) {
    //         return $user->role === 'Admin';
    //     });

    //     Gate::define('mark-attendance', function ($user) {
    //         return $user->role === 'Teacher';
    //     });

    //     Gate::define('post-assignment', function ($user) {
    //         return $user->role === 'Teacher';
    //     });

    //     Gate::define('give-score', function ($user) {
    //         return $user->role === 'Teacher';
    //     });

    //     Gate::define('view-assignment', function ($user) {
    //         return $user->role === 'Student';
    //     });

    //     Gate::define('submit-assignment', function ($user) {
    //         return $user->role === 'Student';
    //     });

    // }

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('add-teacher', function ($user) {
            return $user->role === 'Admin';
        });

        Gate::define('delete-teacher', function ($user) {
            return $user->role === 'Admin';
        });

        Gate::define('post-news', function ($user) {
            return $user->role === 'Admin';
        });

        Gate::define('mark-attendance', function ($user) {
            return $user->role === 'Teacher';
        });

        Gate::define('post-assignment', function ($user) {
            return $user->role === 'Teacher';
        });

        Gate::define('give-score', function ($user) {
            return $user->role === 'Teacher';
        });

        Gate::define('view-assignment', function ($user) {
            return $user->role === 'Student';
        });

        Gate::define('submit-assignment', function ($user) {
            return $user->role === 'Student';
        });
    }

}
