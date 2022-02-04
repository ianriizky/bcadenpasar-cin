<?php

namespace App\Http\Requests\Branch;

use App\Models\Branch;
use App\Models\Role;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class StoreRequest extends AbstractRequest
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
     * Store a newly created resource in storage.
     *
     * @return \App\Models\Branch
     */
    public function store(): Branch
    {
        /** @var \App\Models\Branch $branch */
        $branch = Branch::make($this->validated());

        $branch->save();

        return $branch;
    }
}
