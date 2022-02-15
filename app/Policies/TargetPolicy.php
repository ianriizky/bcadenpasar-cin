<?php

namespace App\Policies;

use App\Models\Target;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TargetPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->isManager() || $user->isStaff();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Target  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Target $model)
    {
        return $model->branch->users->contains($user);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->isManager() && !$user->branch->currentTarget;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Target  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Target $model)
    {
        return $user->isManager() && $this->view($user, $model);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Target  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Target $model)
    {
        return $this->update($user, $model);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Target  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Target $model)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Target  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Target $model)
    {
        return $user->isAdmin();
    }
}
