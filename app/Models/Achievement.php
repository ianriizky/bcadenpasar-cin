<?php

namespace App\Models;

use App\Events\CreatingBelongsToCreatedBy;
use App\Infrastructure\Contracts\Models\Relation\BelongsToCreatedBy;
use App\Infrastructure\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Achievement extends Model implements BelongsToCreatedBy
{
    use HasFactory,
        Concerns\Achievement\Attribute,
        Concerns\Achievement\Relation;

    /**
     * Value of date format ISO.
     *
     * @var string
     */
    const DATE_FORMAT_ISO = 'dddd, DD MMMM YYYY';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'achieved_date',
        'amount',
        'note',
    ];

    /**
     * {@inheritDoc}
     */
    protected $casts = [
        'achieved_date' => 'datetime',
        'amount' => 'integer',
    ];

    /**
     * {@inheritDoc}
     */
    protected $dispatchesEvents = [
        'creating' => CreatingBelongsToCreatedBy::class,
    ];
}
