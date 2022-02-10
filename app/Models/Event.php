<?php

namespace App\Models;

use App\Infrastructure\Contracts\Model\HasCreatedByAttribute;
use App\Infrastructure\Database\Eloquent\Model;
use App\Infrastructure\Models\Relation\BelongsToBranch;
use App\Infrastructure\Models\Relation\HasManyAchievements;
use App\Listeners\FillCreatedByWhenCreatingModel;
use App\Support\Models\HandleCreatedByAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model implements BelongsToBranch, HasManyAchievements, HasCreatedByAttribute
{
    use HasFactory,
        HandleCreatedByAttribute,
        Concerns\Event\Attribute,
        Concerns\Event\Relation;

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
        'name',
        'date',
        'location',
        'note',
    ];

    /**
     * {@inheritDoc}
     */
    protected $casts = [
        'date' => 'datetime',
    ];

    /**
     * {@inheritDoc}
     */
    protected $dispatchesEvents = [
        'creating' => FillCreatedByWhenCreatingModel::class,
    ];
}
