<?php

namespace App\Http\Requests\Auth;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
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
            'company_name' => ['required', 'string', 'max:255'],

            'username' => ['required', 'string', 'max:255', new Rules\Unique(User::class)],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', new Rules\Unique(User::class)],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function attributes()
    {
        return [
            'company_name' => trans('Company Name'),

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
        $company = Company::create([
            'name' => $this->input('company_name'),
        ]);

        /** @var \App\Models\User $user */
        $user = User::make([
            'username' => $this->input('username'),
            'name' => $this->input('name'),
            'email' => $this->input('email'),
            'password' => $this->input('password'),
        ]);

        $user->setCompanyRelationValue($company)->save();

        return $user->fresh();
    }
}
