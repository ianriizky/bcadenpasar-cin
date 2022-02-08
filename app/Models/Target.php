<?php

namespace App\Models;

use App\Casts\TargetAmount;
use App\Enum\Periodicity;
use App\Infrastructure\Contracts\Model\HasCreatedByAttribute;
use App\Infrastructure\Database\Eloquent\Model;
use App\Listeners\FillCreatedByWhenCreatingModel;
use App\Support\Model\HandleCreatedByAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Target extends Model implements HasCreatedByAttribute
{
    use HasFactory,
        HandleCreatedByAttribute,
        Concerns\Target\Attribute,
        Concerns\Target\Relation;

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
        'creating' => FillCreatedByWhenCreatingModel::class,
    ];
}
