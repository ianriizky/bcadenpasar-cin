<?php

namespace App\Models\Concerns\Branch;

use App\Models\Achievement;
use App\Models\Event;
use App\Models\Target;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\User> $users
 * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\Target> $targets
 * @property-read \App\Models\Target|null $currentTarget
 * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\Event> $events
 * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\Achievement> $achievements
 * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\Achievement> $currentAchievements
 *
 * @see \App\Models\Branch
 */
trait Relation
{
    /**
     * Define a one-to-many relationship with \App\Models\User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Return collection of \App\Models\User model relation value.
     *
     * @return \Illuminate\Database\Eloquent\Collection<\App\Models\User>
     */
    public function getUsersRelationValue(): Collection
    {
        return $this->getCollectionValue('users', User::class);
    }

    /**
     * Set collection of \App\Models\User model relation value.
     *
     * @param  \Illuminate\Database\Eloquent\Collection<\App\Models\User>  $users
     * @return $this
     */
    public function setUsersRelationValue(Collection $users)
    {
        if ($this->isCollectionValid($users, User::class)) {
            $this->setRelation('users', $users);
        }

        return $this;
    }

    /**
     * Define a one-to-many relationship with \App\Models\Target.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function targets(): HasMany
    {
        return $this->hasMany(Target::class);
    }

    /**
     * Return collection of \App\Models\Target model relation value.
     *
     * @return \Illuminate\Database\Eloquent\Collection<\App\Models\Target>
     */
    public function getTargetsRelationValue(): Collection
    {
        return $this->getCollectionValue('targets', Target::class);
    }

    /**
     * Set collection of \App\Models\Target model relation value.
     *
     * @param  \Illuminate\Database\Eloquent\Collection<\App\Models\Target>  $targets
     * @return $this
     */
    public function setTargetsRelationValue(Collection $targets)
    {
        if ($this->isCollectionValid($targets, Target::class)) {
            $this->setRelation('targets', $targets);
        }

        return $this;
    }

    /**
     * Define a one-to-one relationship with \App\Models\Target.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function currentTarget(): HasOne
    {
        return $this->hasOne(Target::class)->ofMany([
            static::CREATED_AT => 'max',
        ], function (Builder $query) {
            $now = Carbon::now();

            $query
                ->where('start_date', '<=', $now->copy()->startOfDay())
                ->where('end_date', '>=', $now->copy()->endOfDay());
        });
    }

    /**
     * Return \App\Models\Target model relation value.
     *
     * @return \App\Models\Target|null
     */
    public function getCurrentTargetRelationValue(): ?Target
    {
        return $this->getRelationValue('currentTarget');
    }

    /**
     * Define a one-to-many relationship with \App\Models\Event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    /**
     * Return collection of \App\Models\Event model relation value.
     *
     * @return \Illuminate\Database\Eloquent\Collection<\App\Models\Event>
     */
    public function getEventsRelationValue(): Collection
    {
        return $this->getCollectionValue('events', Event::class);
    }

    /**
     * Set collection of \App\Models\Event model relation value.
     *
     * @param  \Illuminate\Database\Eloquent\Collection<\App\Models\Event>  $events
     * @return $this
     */
    public function setEventsRelationValue(Collection $events)
    {
        if ($this->isCollectionValid($events, Event::class)) {
            $this->setRelation('events', $events);
        }

        return $this;
    }

    /**
     * Define a has-many-through relationship with \App\Models\Achievement through \App\Models\Target.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function achievements(): HasManyThrough
    {
        return $this->hasManyThrough(Achievement::class, Target::class);
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

    /**
     * Define a has-many-through relationship with \App\Models\Achievement through \App\Models\Target.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function currentAchievements(): HasManyThrough
    {
        return $this->hasManyThrough(Achievement::class, Target::class)->where('targets.id', $this->currentTarget?->getKey());
    }

    /**
     * Return collection of \App\Models\Achievement model relation value.
     *
     * @return \App\Models\Achievement|null
     */
    public function getCurrentAchievementRelationValue(): ?Achievement
    {
        return $this->getCollectionValue('achievements', Achievement::class)->first();
    }
}
