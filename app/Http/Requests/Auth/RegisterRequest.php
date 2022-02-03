<?php

namespace App\Http\Requests\Auth;

use App\Models\Branch;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Event;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
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
        return [
            'branch_id' => trans('Branch Name'),

            'username' => trans('Username'),
            'name' => trans('Name'),
            'email' => trans('Email Address'),
            'password' => trans('Password'),
            'agree_with_terms' => trans('Terms of Service'),
        ];
    }

    /**
     * Register user based on the given request.
     *
     * @return \App\Models\User
     */
    public function register(): User
    {
        /** @var \App\Models\User $user */
        $user = User::make([
            'username' => $this->input('username'),
            'name' => $this->input('name'),
            'email' => $this->input('email'),
            'password' => $this->input('password'),
        ]);

        $user->setAttribute('email_verified_at', Carbon::now());
        $user->syncRoles(Role::ROLE_STAFF);
        $user->setBranchRelationValue(Branch::find($this->input('branch_id')))->save();

        Event::dispatch(new Registered($user));

        return $user->fresh();
    }
}
