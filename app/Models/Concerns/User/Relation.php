<?php

namespace App\Models\Concerns\User;

use App\Models\Achievement;
use App\Models\Branch;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int|null $branch_id Foreign key of \App\Models\Branch.
 * @property-read \App\Models\Branch|null $branch
 * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\Achievement> $achievements
 *
 * @see \App\Models\User
 */
trait Relation
{
    /**
     * Define an inverse one-to-one or many relationship with \App\Models\Branch.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

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
     * Set \App\Models\Branch model relation value.
     *
     * @param  \App\Models\Branch  $branch
     * @return $this
     */
    public function setBranchRelationValue(Branch $branch)
    {
        $this->branch()->associate($branch);

        return $this;
    }

    /**
     * Define a one-to-many relationship with App\Models\Achievement.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function achievements(): HasMany
    {
        return $this->hasMany(Achievement::class);
    }

    /**
     * Return collection of \App\Models\Achievement model relation value.
     *
     * @return \Illuminate\Database\Eloquent\Collection<\App\Models\Achievement>
     */
    public function getAchievementsRelationValue(): Collection
    {
        return $this->getCollectionValue('achievements', Achievement::class);
    }

    /**
     * Set collection of \App\Models\Achievement model relation value.
     *
     * @param  \Illuminate\Database\Eloquent\Collection<\App\Models\Achievement>  $achievements
     * @return $this
     */
    public function setAchievementsRelationValue(Collection $achievements)
    {
        if ($this->isCollectionValid($achievements, Achievement::class)) {
            $this->setRelation('achievements', $achievements);
        }

        return $this;
    }
}
