<?php

namespace App\Models;

use App\Infrastructure\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Monitoring extends Model
{
    use HasFactory,
        Concerns\Monitoring\Attribute;

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'name',
    ];
}
