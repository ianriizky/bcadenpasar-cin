<?php

namespace App\Models;

use App\Infrastructure\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,
        Concerns\User\Attribute,
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
}
