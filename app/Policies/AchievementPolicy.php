<?php

namespace App\Policies;

use App\Models\Achievement;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AchievementPolicy
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
     * @param  \App\Models\Achievement  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Achievement $model)
    {
        return $model->target->branch->users->contains($user);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $this->viewAny($user);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Achievement  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Achievement $model)
    {
        if ($user->isManager()) {
            return $this->view($user, $model);
        }

        if ($user->isStaff()) {
            return $this->view($user, $model) && $model->achievedBy->is($user);
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Achievement  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Achievement $model)
    {
        return $this->update($user, $model);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Achievement  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Achievement $model)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Achievement  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Achievement $model)
    {
        return $user->isAdmin();
    }
}
