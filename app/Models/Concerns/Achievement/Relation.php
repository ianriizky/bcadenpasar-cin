<?php

namespace App\Models\Concerns\Achievement;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int|null $achieved_by Foreign key of \App\Models\User.
 * @property-read \App\Models\User|null $achieved_by
 *
 * @see \App\Models\Achievement
 */
trait Relation
{
    /**
     * Define an inverse one-to-one relationship with \App\Models\User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function achievedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'achieved_by');
    }

    /**
     * Return \App\Models\User model relation value.
     *
     * @return \App\Models\User|null
     */
    public function getAchievedByRelationValue(): ?User
    {
        return $this->getRelationValue('achieved_by');
    }

    /**
     * Set \App\Models\User model relation value.
     *
     * @param  \App\Models\User  $user
     * @return $this
     */
    public function setAchievedByRelationValue(User $user)
    {
        $this->achievedBy()->associate($user);

        return $this;
    }
}
