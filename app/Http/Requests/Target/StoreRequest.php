<?php

namespace App\Http\Requests\Target;

use App\Models\Target;

class StoreRequest extends AbstractRequest
{
    /**
     * Store a newly created resource in storage.
     *
     * @return \App\Models\Target
     */
    public function store(): Target
    {
        /** @var \App\Models\Target $target */
        $target = Target::make($this->validated());

        $target->setBranchRelationValue($this->getBranch())->save();

        return $target;
    }
}
