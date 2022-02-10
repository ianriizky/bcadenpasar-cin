<?php

namespace App\Models\Concerns\Target;

use App\Support\Models\BelongsToBranch;
use App\Support\Models\HasManyAchievements;
use Spatie\Permission\Traits\HasRoles;

/**
 * @see \App\Models\Target
 */
trait Relation
{
    use HasRoles,
        BelongsToBranch,
        HasManyAchievements;
}
