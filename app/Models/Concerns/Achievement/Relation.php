<?php

namespace App\Models\Concerns\Achievement;

use App\Models\Target;
use App\Models\User;
use App\Support\Models\Relation\BelongsToCreatedBy;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $target_id Foreign key of \App\Models\Target.
 * @property-read \App\Models\Target $target
 * @property int|null $event_id Foreign key of \App\Models\Event.
 * @property-read \App\Models\Event|null $event
 * @property int|null $achieved_by Foreign key of \App\Models\User.
 * @property-read \App\Models\User|null $achievedBy
 *
 * @see \App\Models\Achievement
 */
trait Relation
{
    use BelongsToCreatedBy;

    /**
     * Define an inverse one-to-many relationship with \App\Models\Target.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function target(): BelongsTo
    {
        return $this->belongsTo(Target::class);
    }

    /**
     * Return \App\Models\Target model relation value.
     *
     * @return \App\Models\Target
     */
    public function getTargetRelationValue(): Target
    {
        return $this->getRelationValue('target');
    }

    /**
     * Set \App\Models\Target model relation value.
     *
     * @param  \App\Models\Target  $target
     * @return $this
     */
    public function setTargetRelationValue(Target $target)
    {
        $this->target()->associate($target);

        return $this;
    }

    /**
     * Define an inverse one-to-many relationship with \App\Models\Event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Return \App\Models\Event model relation value.
     *
     * @return \App\Models\Event|null
     */
    public function getEventRelationValue(): ?Event
    {
        return $this->getRelationValue('event');
    }

    /**
     * Set \App\Models\Event model relation value.
     *
     * @param  \App\Models\Event  $event
     * @return $this
     */
    public function setEventRelationValue(Event $event)
    {
        $this->event()->associate($event);

        return $this;
    }

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
