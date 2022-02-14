<?php

namespace App\Providers;

use App\Infrastructure\Contracts\Auth\HasRole;
use App\Models\Branch;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * {@inheritDoc}
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function (HasRole $user, $ability) {
            if ($user->isAdmin()) {
                return true;
            }
        });

        Gate::define('view-dashboard', fn (HasRole $user) =>
            $user->isAdmin() || $user->isStaff()
        );

        Gate::define('view-master', fn (User $user) =>
            $user->can('viewAny', Branch::class) ||
            $user->can('viewAny', User::class) ||
            $user->can('viewAny', Role::class)
        );
    }
}
