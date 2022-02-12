<?php

namespace App\Models\Concerns\User;

use App\Models\Achievement;
use App\Models\Branch;
use App\Support\Models\Relation\BelongsToBranch;
use App\Support\Models\Relation\HasManyAchievements;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\Role> $roles
 * @property int|null $branch_id Foreign key of \App\Models\Branch.
 * @property-read \App\Models\Branch|null $branch
 * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\Achievement> $achievements
 *
 * @see \App\Models\User
 */
trait Relation
{
    use HasRoles,
        BelongsToBranch,
        HasManyAchievements;

    /**
     * Return \App\Models\Branch model relation value.
     *
     * @return \App\Models\Branch|null
     */
    public function getBranchRelationValue(): ?Branch
    {
        return $this->getRelationValue('branch');
    }

    /**
     * Define a one-to-many relationship with \App\Models\Achievement.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function achievements(): HasMany
    {
        return $this->hasMany(Achievement::class, 'achieved_by');
    }
}
