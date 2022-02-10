<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\User\StoreRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Arr;

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
        return array_merge(Arr::except(parent::rules(), ['role', 'is_verified']), [
            'agree_with_terms' => 'required|boolean|in:1',
        ]);
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
}
