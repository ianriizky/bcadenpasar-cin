<?php

namespace App\Infrastructure\Models\Relation;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

interface HasManyAchievements
{
    /**
     * Define a one-to-many relationship with \App\Models\Achievement.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function achievements(): HasMany;

    /**
     * Return collection of \App\Models\Achievement model relation value.
     *
     * @return \Illuminate\Database\Eloquent\Collection<\App\Models\Achievement>
     */
    public function getAchievementsRelationValue(): Collection;

    /**
     * Set collection of \App\Models\Achievement model relation value.
     *
     * @param  \Illuminate\Database\Eloquent\Collection<\App\Models\Achievement>  $achievements
     * @return $this
     */
    public function setAchievementsRelationValue(Collection $achievements);
}
