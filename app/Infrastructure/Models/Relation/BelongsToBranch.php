<?php

namespace App\Infrastructure\Models\Relation;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface BelongsToBranch
{
    /**
     * Define an inverse one-to-many relationship with \App\Models\Branch.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch(): BelongsTo;

    /**
     * Return \App\Models\Branch model relation value.
     *
     * @return \App\Models\Branch|null
     */
    public function getBranchRelationValue();

    /**
     * Set \App\Models\Branch model relation value.
     *
     * @param  \App\Models\Branch  $branch
     * @return $this
     */
    public function setBranchRelationValue(Branch $branch);
}
