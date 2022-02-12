<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\User\StoreRequest;
use App\Models\Branch;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class RegisterRequest extends StoreRequest
{
    /**
     * {@inheritDoc}
     */
    public function authorize()
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return [
            'branch_id' => ['required', Rule::exists(Branch::class, 'id')],

            'username' => ['required', 'string', 'max:255', Rule::unique(User::class)],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function attributes()
    {
        return array_merge(Arr::except(parent::attributes(), ['role', 'is_verified']), [
            'agree_with_terms' => trans('Terms of Service'),
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function store(): User
    {
        return parent::store()->syncRoles(Role::ROLE_STAFF);
    }

    /**
     * {@inheritDoc}
     */
    public function getBranch(string $key = 'branch_id'): Branch
    {
        return Branch::find($this->input($key));
    }
}
