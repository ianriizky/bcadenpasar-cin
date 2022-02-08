<?php

namespace App\Support\Model;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HandleCreatedByAttribute
{
    /**
     * Define an inverse one-to-one relationship with \App\Models\User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function created_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Return \App\Models\User model relation value.
     *
     * @return \App\Models\User
     */
    public function getCreatedByRelationValue(): User
    {
        return $this->getRelationValue('created_by');
    }

    /**
     * Set \App\Models\User model relation value.
     *
     * @param  \App\Models\User  $user
     * @return $this
     */
    public function setCreatedByRelationValue(User $user)
    {
        $this->created_by()->associate($user);

        return $this;
    }
}
