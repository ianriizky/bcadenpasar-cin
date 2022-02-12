<?php

namespace App\Models;

use App\Infrastructure\Contracts\Auth\BypassVerifyEmail;
use App\Infrastructure\Contracts\Auth\MustVerifyUser;
use App\Infrastructure\Foundation\Auth\User as Authenticatable;
use App\Infrastructure\Models\Relation\BelongsToBranch;
use App\Infrastructure\Models\Relation\HasManyAchievements;
use App\Support\Models\BypassEmailVerification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method static \Database\Factories\UserFactory<static> factory(callable|array|int|null $count = null, callable|array $state = []) Get a new factory instance for the model.
 */
class User extends Authenticatable implements MustVerifyEmail, BypassVerifyEmail, MustVerifyUser, BelongsToBranch, HasManyAchievements
{
    use HasApiTokens, HasFactory, Notifiable, BypassEmailVerification,
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
        'is_verified',
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
        'is_verified' => 'boolean',
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
     * {@inheritDoc}
     */
    public function bypassEmailVerification(Carbon $date = null)
    {
        $this->email_verified_at = $date ?? Carbon::now();

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function hasVerifiedUser(): bool
    {
        return $this->is_verified;
    }

    /**
     * {@inheritDoc}
     */
    public function markUserAsVerified(): bool
    {
        return $this->forceFill(['is_verified' => true])->save();
    }
}
