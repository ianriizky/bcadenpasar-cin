<?php

namespace App\Models;

use App\Infrastructure\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Education extends Model
{
    use HasFactory,
        Concerns\Education\Attribute;

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'name',
    ];
}
