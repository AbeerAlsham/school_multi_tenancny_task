<?php

namespace App\Providers;

use App\Models\School;
use App\Models\User;
use App\Policies\SchoolPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Gate::policy(School::class, SchoolPolicy::class);

        Gate::define('manage-teacher', function (User $user) {
            return $user->isSuperAdmin();
        });
    }
}
