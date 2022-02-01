<?php

namespace App\Models\Concerns\Achievement;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int|null $user_id Foreign key of \App\Models\User.
 * @property-read \App\Models\User|null $user
 *
 * @see \App\Models\Achievement
 */
trait Relation
{
    /**
     * Define an inverse one-to-one or many relationship with \App\Models\User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Return \App\Models\User model relation value.
     *
     * @return \App\Models\User|null
     */
    public function getUserRelationValue(): ?User
    {
        return $this->getRelationValue('user');
    }

    /**
     * Set \App\Models\User model relation value.
     *
     * @param  \App\Models\User  $user
     * @return $this
     */
    public function setUserRelationValue(User $user)
    {
        $this->user()->associate($user);

        return $this;
    }
}
