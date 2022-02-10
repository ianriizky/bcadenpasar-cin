<?php

namespace App\Http\Requests\User;

use App\Infrastructure\Foundation\Http\FormRequest;
use App\Models\Branch;

abstract class AbstractRequest extends FormRequest
{
    /**
     * {@inheritDoc}
     */
    public function authorize()
    {
        return !is_null($this->user());
    }

    /**
     * {@inheritDoc}
     */
    public function attributes()
    {
        return [
            'branch_id' => trans('menu.branch'),
            'username' => trans('Username'),
            'name' => trans('Name'),
            'email' => trans('Email'),
            'role' => trans('Role'),
            'is_verified' => trans('Verified'),
        ];
    }

    /**
     * Return branch model based on the request.
     *
     * @param  string  $key
     * @return \App\Models\Branch
     */
    public function getBranch(string $key = 'branch_id'): Branch
    {
        return Branch::find($this->input($key));
    }
}
