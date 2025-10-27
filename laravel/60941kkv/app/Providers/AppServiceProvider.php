<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


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
        $this->registerPolicies();

        Gate::define('library-manager', function (User $user) {
            return in_array($user->role->name, ['editor', 'admin']);
        });

        Gate::define('create-publication', function ($user) {
            return in_array($user->role->name, ['editor', 'admin']);
        });

        Gate::define('reader', function (User $user, $copy) {
            return in_array($user->role->name, ['reader', 'editor', 'admin']);
        });
    }
}

