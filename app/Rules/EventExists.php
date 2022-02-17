<?php

namespace App\Rules;

use App\Models\Branch;
use App\Models\Event;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Database\Eloquent\Builder;

class EventExists implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Branch  $branch
     * @return void
     */
    public function __construct(
        protected User $user,
        protected Branch $branch
    ) {
        //
    }

    /**
     * {@inheritDoc}
     */
    public function passes($attribute, $value)
    {
        return Event::whereKey($value)
            ->unless($this->user->isAdmin(), function (Builder $query) {
                $query->where('branch_id', $this->branch->getKey());
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
