<?php

namespace App\Http\Requests\User;

use App\Models\Role;
use App\Models\User;
use App\Rules\BranchExists;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UpdateRequest extends AbstractRequest
{
    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return [
            'branch_id' => ['required', new BranchExists($this->user())],

            'username' => ['required', 'string', 'max:255', Rule::unique(User::class)->ignoreModel($this->route('user'))],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignoreModel($this->route('user'))],
            'password' => ['sometimes', 'nullable', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', Rule::exists(Role::class, 'name')],
            'is_verified' => ['required', 'boolean'],
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\User  $user
     * @return \App\Models\User
     */
    public function update(User $user): User
    {
        $user = $user->fill($this->validated())->setBranchRelationValue(
            $this->getBranch()
        );

        $user->save();

        return $user;
    }
}
