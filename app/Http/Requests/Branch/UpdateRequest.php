<?php

namespace App\Http\Requests\Branch;

use App\Models\Branch;

class UpdateRequest extends AbstractRequest
{
    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'address' => 'required|string',
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \App\Models\Branch
     */
    public function update(Branch $branch): Branch
    {
        $branch->update($this->validated());

        return $branch;
    }
}
