<?php

namespace App\Http\Requests\User;

use App\Models\Role;
use App\Models\User;
use App\Rules\BranchExists;
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
            'branch_id' => ['required', new BranchExists($this->user())],

            'username' => ['required', 'string', 'max:255', Rule::unique(User::class)],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', Rule::exists(Role::class, 'name')],
            'is_verified' => ['required', 'boolean'],
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

        $user->setBranchRelationValue($this->getBranch())->save();

        return $user;
    }
}
