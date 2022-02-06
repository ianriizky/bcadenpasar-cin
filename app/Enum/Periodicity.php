<?php

namespace App\Enum;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self yearly()
 * @method static self monthly()
 * @method static self weekly()
 * @method static self daily()
 */
class Periodicity extends Enum
{
    /**
     * {@inheritDoc}
     */
    protected static function labels(): array
    {
        return [
            'yearly' => trans('Yearly'),
            'monthly' => trans('Monthly'),
            'weekly' => trans('Weekly'),
            'daily' => trans('Daily'),
        ];
    }
}
