<?php

namespace App\Models;

use App\Infrastructure\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory,
        Concerns\Company\Attribute,
        Concerns\Company\Relation;

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'name',
    ];
}
