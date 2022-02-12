<?php

namespace App\Infrastructure\Contracts\Models\Relation;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface BelongsToCreatedBy
{
    /**
     * Define an inverse one-to-one relationship with \App\Models\User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy(): BelongsTo;

    /**
     * Return \App\Models\User model relation value.
     *
     * @return \App\Models\User
     */
    public function getCreatedByRelationValue(): User;

    /**
     * Set \App\Models\User model relation value.
     *
     * @param  \App\Models\User  $user
     * @return $this
     */
    public function setCreatedByRelationValue(User $user);
}
