<?php

namespace App\Http\Requests\Branch;

use App\Models\Branch;

class StoreRequest extends AbstractRequest
{
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
