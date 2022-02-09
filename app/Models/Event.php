<?php

namespace App\Models;

use App\Infrastructure\Contracts\Model\HasCreatedByAttribute;
use App\Infrastructure\Database\Eloquent\Model;
use App\Listeners\FillCreatedByWhenCreatingModel;
use App\Support\Model\HandleCreatedByAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model implements HasCreatedByAttribute
{
    use HasFactory,
        HandleCreatedByAttribute,
        Concerns\Event\Attribute;

    /**
     * {@inheritDoc}
     */
    protected $dispatchesEvents = [
        'creating' => FillCreatedByWhenCreatingModel::class,
    ];
}
