<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;

/**
 * Use this middleware to convert a strings with value "__null" to null.
 * This is useful for the select2.js where we want to send a null request value
 * into the server using string because the select2.js does not support null
 * as their selected value in the <select>.
 */
class ConvertNullStringsToNull extends ConvertEmptyStringsToNull
{
    /**
     * Expressions value of "null".
     *
     * @var string
     */
    const NULL_EXPRESSION = '__null';

    /**
     * {@inheritDoc}
     */
    protected function transform($key, $value)
    {
        return is_string($value) && $value === static::NULL_EXPRESSION ? null : $value;
    }
}
