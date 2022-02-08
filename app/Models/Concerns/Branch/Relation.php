<?php

namespace App\Models\Concerns\Branch;

use App\Models\Event;
use App\Models\Target;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\User> $users
 * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\Target> $targets
 * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\Event> $events
 *
 * @see \App\Models\Branch
 */
trait Relation
{
    /**
     * Define a one-to-many relationship with App\Models\User.
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
     * Define a one-to-many relationship with App\Models\Target.
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
     * Define a one-to-many relationship with App\Models\Event.
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
}
