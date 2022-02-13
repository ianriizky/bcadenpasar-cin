<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Infrastructure\Foundation\Auth{
/**
 * App\Infrastructure\Foundation\Auth\User
 *
 * @property int $id
 * @property int|null $branch_id
 * @property string $username
 * @property string $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property int $is_verified
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed|array $raw
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\Authenticatable, \Illuminate\Contracts\Auth\Access\Authorizable, \Illuminate\Contracts\Auth\CanResetPassword {}
}

namespace App\Models{
/**
 * App\Models\Achievement
 *
 * @property int $id
 * @property int $target_id
 * @property int|null $event_id
 * @property \Illuminate\Support\Carbon $achieved_date
 * @property int|null $achieved_by
 * @property int $amount
 * @property string|null $note
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $achievedBy
 * @property-read \App\Models\User|null $createdBy
 * @property-read \App\Models\Event|null $event
 * @property-read string $achieved_date_iso_format
 * @property-read mixed|array $raw
 * @property-read \App\Models\Target $target
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement query()
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereAchievedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereAchievedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereTargetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereUpdatedAt($value)
 */
	class Achievement extends \Eloquent implements \App\Infrastructure\Contracts\Models\Relation\BelongsToCreatedBy {}
}

namespace App\Models{
/**
 * App\Models\Branch
 *
 * @method static \Database\Factories\BranchFactory<static> factory(callable|array|int|null $count = null, callable|array $state = []) Get a new factory instance for the model.
 * @property int $id
 * @property string $name
 * @property string $address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Achievement[] $achievements
 * @property-read int|null $achievements_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Event[] $events
 * @property-read int|null $events_count
 * @property-read mixed|array $raw
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Target[] $targets
 * @property-read int|null $targets_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\BranchFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Branch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Branch query()
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereUpdatedAt($value)
 */
	class Branch extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Event
 *
 * @property int $id
 * @property int $branch_id
 * @property string $name
 * @property \Illuminate\Support\Carbon $date
 * @property string $location
 * @property string|null $note
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Achievement[] $achievements
 * @property-read int|null $achievements_count
 * @property-read \App\Models\Branch $branch
 * @property-read \App\Models\User|null $createdBy
 * @property-read string $date_iso_format
 * @property-read mixed|array $raw
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|Event role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUpdatedAt($value)
 */
	class Event extends \Eloquent implements \App\Infrastructure\Contracts\Models\Relation\BelongsToBranch, \App\Infrastructure\Contracts\Models\Relation\HasManyAchievements, \App\Infrastructure\Contracts\Models\Relation\BelongsToCreatedBy {}
}

namespace App\Models{
/**
 * App\Models\Role
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string $name
 * @property string $guard_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 */
	class Role extends \Eloquent implements \App\Models\Concerns\Role\Attribute {}
}

namespace App\Models{
/**
 * App\Models\Target
 *
 * @method static \Database\Factories\TargetFactory<static> factory(callable|array|int|null $count = null, callable|array $state = []) Get a new factory instance for the model.
 * @property int $id
 * @property int $branch_id
 * @property \Spatie\Enum\Enum|null $periodicity Enum of App\Enum\Periodicity
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon $end_date
 * @property \App\Entity\TargetAmount $amount
 * @property string|null $note
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Achievement[] $achievements
 * @property-read int|null $achievements_count
 * @property-read \App\Models\Branch $branch
 * @property-read \App\Models\User|null $createdBy
 * @property-read string $end_date_iso_format
 * @property-read mixed|array $raw
 * @property-read string $start_date_iso_format
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Database\Factories\TargetFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Target newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Target newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Target permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Target query()
 * @method static \Illuminate\Database\Eloquent\Builder|Target role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Target whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Target whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Target whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Target whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Target whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Target whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Target whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Target wherePeriodicity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Target whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Target whereUpdatedAt($value)
 */
	class Target extends \Eloquent implements \App\Infrastructure\Contracts\Models\Relation\BelongsToBranch, \App\Infrastructure\Contracts\Models\Relation\HasManyAchievements, \App\Infrastructure\Contracts\Models\Relation\BelongsToCreatedBy {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @method static \Database\Factories\UserFactory<static> factory(callable|array|int|null $count = null, callable|array $state = []) Get a new factory instance for the model.
 * @property int $id
 * @property int|null $branch_id
 * @property string $username
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property bool $is_verified
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Achievement[] $achievements
 * @property-read int|null $achievements_count
 * @property-read \App\Models\Branch|null $branch
 * @property-read string $is_active_badge
 * @property-read string $profile_image
 * @property-read mixed|array $raw
 * @property-read string $role
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 */
	class User extends \Eloquent implements \App\Infrastructure\Contracts\Auth\HasRole, \Illuminate\Contracts\Auth\MustVerifyEmail, \App\Infrastructure\Contracts\Auth\BypassVerifyEmail, \App\Infrastructure\Contracts\Auth\MustVerifyUser, \App\Infrastructure\Contracts\Models\Relation\BelongsToBranch, \App\Infrastructure\Contracts\Models\Relation\HasManyAchievements {}
}

