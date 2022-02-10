<?php

namespace App\Http\Requests\Target;

use App\Models\Target;

class UpdateRequest extends AbstractRequest
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Target  $target
     * @return \App\Models\Target
     */
    public function update(Target $target): Target
    {
        $target = $target->fill($this->validated())->setBranchRelationValue(
            $this->getBranch()
        );

        $target->save();

        return $target;
    }
}
