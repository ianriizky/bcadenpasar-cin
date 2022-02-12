<?php

namespace App\Models\Concerns\Target;

use App\Support\Models\Relation\BelongsToBranch;
use App\Support\Models\Relation\BelongsToCreatedBy;
use App\Support\Models\Relation\HasManyAchievements;
use Spatie\Permission\Traits\HasRoles;

/**
 * @see \App\Models\Target
 */
trait Relation
{
    use HasRoles,
        BelongsToBranch,
        BelongsToCreatedBy,
        HasManyAchievements;
}
