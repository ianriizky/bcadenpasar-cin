<?php

namespace App\Models;

use App\Infrastructure\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Achievement extends Model
{
    use HasFactory,
        Concerns\Achievement\Attribute,
        Concerns\Achievement\Relation;

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'name',
    ];
}
