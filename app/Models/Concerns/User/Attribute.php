<?php

namespace App\Models\Concerns\User;

use Illuminate\Support\Facades\Hash;

/**
 * @property string $username
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon $email_verified_at
 * @property string $password
 * @property boolean $is_verified
 * @property-read string $remember_token
 * @property-read string $role
 * @property-read string $profile_image
 * @property-read string $is_verified_badge
 *
 * @see \App\Models\User
 */
trait Attribute
{
    /**
     * Set "password" attribute value.
     *
     * @param  mixed  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);

        return $this;
    }

    /**
     * Return "role" attribute value.
     *
     * @return string
     */
    public function getRoleAttribute(): string
    {
        $this->load('roles:id,name');

        return $this->roles->first()->name;
    }

    /**
     * Return "profile_image" attribute value.
     *
     * @return string
     */
    public function getProfileImageAttribute(): string
    {
        return gravatar_image($this->email);
    }

    /**
     * Return "is_verified_badge" attribute value.
     *
     * @return string
     */
    public function getIsVerifiedBadgeAttribute(): string
    {
        return sprintf(<<<'html'
            <span class="badge badge-%s">
                <i class="fa fa-%s"></i> %s
            </span>
        html,
            $this->is_verified ? 'success' : 'danger',
            $this->is_verified ? 'check-circle' : 'times-circle',
            $this->is_verified ? trans('Active') : trans('Not Active')
        );
    }
}
