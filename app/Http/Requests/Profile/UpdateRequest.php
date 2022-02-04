<?php

namespace App\Http\Requests\Profile;

use App\Infrastructure\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UpdateRequest extends FormRequest
{
    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        return [
            'username' => ['required', 'string', 'max:255', Rule::unique(User::class)->ignoreModel($user)],
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignoreModel($user)],
            'password' => ['sometimes', 'nullable', 'confirmed', Rules\Password::defaults()],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function validated()
    {
        $validated = parent::validated();

        if ($this->isNotFilled('password')) {
            Arr::forget($validated, 'password');
        }

        return $validated;
    }
}
