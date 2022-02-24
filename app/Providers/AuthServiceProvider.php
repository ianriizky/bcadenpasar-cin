<?php

namespace App\Providers;

use App\Infrastructure\Contracts\Auth\HasRole;
use App\Models\Achievement;
use App\Models\Branch;
use App\Models\Event;
use App\Models\Target;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
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

        Gate::before(function (HasRole $user, $ability, array $models) {
            if ($user->isAdmin()) {
                if (in_array($ability, ['delete', 'forceDelete'])) {
                    $model = head($models);

                    if ($model instanceof Model && $model->is($user)) {
                        return false;
                    }
                }

                return true;
            }
        });

        Gate::define('view-dashboard', fn (HasRole $user) =>
            $user->isManager() || $user->isStaff()
        );

        Gate::define('view-master', fn (User $user) =>
            $user->can('viewAny', Branch::class) ||
            $user->can('viewAny', User::class)
        );

        Gate::define('view-education', fn (HasRole $user) =>
            $user->isManager() || $user->isStaff()
        );

        Gate::define('view-monitoring', fn (User $user) =>
            $user->can('viewAny', Target::class) ||
            $user->can('viewAny', Event::class) ||
            $user->can('viewAny', Achievement::class)
        );

        Gate::define('view-report', fn (User $user) =>
            $user->isManager()
        );
    }
}
