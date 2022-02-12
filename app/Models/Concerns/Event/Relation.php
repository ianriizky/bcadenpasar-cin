<?php

namespace App\Models\Concerns\Event;

use App\Support\Models\Relation\BelongsToBranch;
use App\Support\Models\Relation\BelongsToCreatedBy;
use App\Support\Models\Relation\HasManyAchievements;
use Spatie\Permission\Traits\HasRoles;

/**
 * @see \App\Models\Event
 */
trait Relation
{
    use HasRoles,
        BelongsToBranch,
        BelongsToCreatedBy,
        HasManyAchievements;
}
