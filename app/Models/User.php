<?php

namespace App\Models;

use App\Infrastructure\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable,
        Concerns\User\Attribute,
        Concerns\User\Event,
        Concerns\User\Relation;

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
    ];

    /**
     * {@inheritDoc}
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * {@inheritDoc}
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Determine if the user has the role of "admin".
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->hasRole(Role::ROLE_ADMIN);
    }

    /**
     * Determine if the user has the role of "staff".
     *
     * @return bool
     */
    public function isStaff(): bool
    {
        return $this->hasRole(Role::ROLE_STAFF);
    }

    /**
     * Bypass email verification process by fill the "email_verified_at" field.
     *
     * @param  \Illuminate\Support\Carbon|null  $date
     * @return $this
     */
    public function bypassEmailVerification(Carbon $date = null)
    {
        $this->email_verified_at = $date ?? Carbon::now();

        return $this;
    }
}
