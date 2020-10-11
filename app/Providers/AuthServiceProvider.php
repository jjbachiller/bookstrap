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
          return Carbon::now()->lt($user->subscribed_until);
        });

        Gate::define('download-book', function($user) {
          $subscription = $user->subscription();
          if (!$subscription) return false;
          return $subscription['week_downloads'] > $user->numDownloadsThisWeek();
        });

        // requiredSpace: Space necessary in bytes.
        Gate::define('space-available', function($user, $requiredSpace) {
          $subscription = $user->subscription();
          if (!$subscription) return false;
          return $subscription['disk_quote'] >= ($user->diskOccupation() + $requiredSpace);
        });

        Gate::define('library-content-access', function($user) {

        });
    }
}
