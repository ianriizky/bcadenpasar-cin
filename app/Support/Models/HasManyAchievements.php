<?php

namespace App\Support\Models;

use App\Models\Achievement;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\Achievement> $achievements
 */
trait HasManyAchievements
{
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
