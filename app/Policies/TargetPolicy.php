<?php

namespace App\Policies;

use App\Models\Target;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TargetPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     *
     * @param  \App\Models\User  $user
     * @param  string  $ability
     * @return void|bool
     */
    public function before(User $user, $ability)
    {
        if ($user->isAdmin() && in_array($ability, ['viewAny', 'view'])) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->isStaff();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Target  $target
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Target $target)
    {
        return $user->isStaff() && $target->branch->users->contains($user);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->isAdmin() || $user->isStaff();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Target  $target
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Target $target)
    {
        return $user->isStaff() && $target->branch->users->contains($user);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Target  $target
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Target $target)
    {
        return $user->isStaff() && $target->branch->users->contains($user);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Target  $target
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Target $target)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Target  $target
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Target $target)
    {
        return $user->isAdmin();
    }
}
