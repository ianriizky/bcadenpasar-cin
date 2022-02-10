<?php

namespace App\Models;

use App\Casts\TargetAmount;
use App\Enum\Periodicity;
use App\Events\CreatingHasCreatedByAttribute;
use App\Infrastructure\Contracts\Model\HasCreatedByAttribute;
use App\Infrastructure\Database\Eloquent\Model;
use App\Infrastructure\Models\Relation\BelongsToBranch;
use App\Infrastructure\Models\Relation\HasManyAchievements;
use App\Support\Models\HandleCreatedByAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @method static \Database\Factories\TargetFactory<static> factory(callable|array|int|null $count = null, callable|array $state = []) Get a new factory instance for the model.
 */
class Target extends Model implements BelongsToBranch, HasManyAchievements, HasCreatedByAttribute
{
    use HasFactory,
        HandleCreatedByAttribute,
        Concerns\Target\Attribute,
        Concerns\Target\Relation;

    /**
     * Value of date format ISO.
     *
     * @var string
     */
    const DATE_FORMAT_ISO = 'DD MMMM YYYY';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'periodicity',
        'start_date',
        'end_date',
        'amount',
        'note',
    ];

    /**
     * {@inheritDoc}
     */
    protected $casts = [
        'periodicity' => Periodicity::class,
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'amount' => TargetAmount::class,
    ];

    /**
     * {@inheritDoc}
     */
    protected $dispatchesEvents = [
        'creating' => CreatingHasCreatedByAttribute::class,
    ];
}
