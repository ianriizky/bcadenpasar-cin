<?php

namespace App\Models\Concerns\Event;

use App\Support\Models\BelongsToBranch;
use App\Support\Models\HasManyAchievements;
use Spatie\Permission\Traits\HasRoles;

/**
 * @see \App\Models\Event
 */
trait Relation
{
    use HasRoles,
        BelongsToBranch,
        HasManyAchievements;
}
