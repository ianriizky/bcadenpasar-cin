<?php

namespace App\Http\Requests\User;

use App\Models\Branch;
use App\Models\Role;
use App\Models\User;
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
            'branch_id' => ['required', Rule::exists(Branch::class, 'id')],

            'username' => ['required', 'string', 'max:255', Rule::unique(User::class)],
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', Rule::exists(Role::class, 'name')],
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \App\Models\User
     */
    public function store(): User
    {
        /** @var \App\Models\User $user */
        $user = User::make($this->validated());

        $user->bypassEmailVerification();
        $user->setBranchRelationValue($this->getBranch())->save();

        return $user;
    }
}
