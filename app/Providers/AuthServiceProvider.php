<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
Use Carbon\Carbon;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('active-subscription', function($user) {
          return Carbon::now()->lt($user->suscribed_until);
        });

        Gate::define('download-book', function($user) {
          // Get subscription config for $user->subscription_type
          // Compare weeks downloads with $user->numDownloadsThisWeek();
        });

        Gate::define('has-space-available', function($user, $requiredSpace) {
          // Get subscription config for $user->subscription_type
          // Compare SUM($user->books->total_space) + $requiredSpace??? with space available.
        });

        Gate::define('library-content-access', function($user) {
          // Check if user is silver or gold
        })
    }
}
