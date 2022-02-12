<?php

namespace App\Rules;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Database\Eloquent\Builder;

class BranchExists implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function __construct(
        protected User $user
    ) {
        //
    }

    /**
     * {@inheritDoc}
     */
    public function passes($attribute, $value)
    {
        return Branch::whereKey($value)
            ->when($this->user->isManager(), function (Builder $query) {
                $query->whereKey($this->user->branch->getKey());
            })
            ->exists();
    }

    /**
     * {@inheritDoc}
     */
    public function message()
    {
        return trans('validation.exists');
    }
}
