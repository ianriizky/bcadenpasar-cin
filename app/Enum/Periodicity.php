<?php

namespace App\Enum;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self daily()
 * @method static self weekly()
 * @method static self monthly()
 * @method static self yearly()
 */
class Periodicity extends Enum
{
    /**
     * {@inheritDoc}
     */
    protected static function labels(): array
    {
        return [
            'daily' => trans('Daily'),
            'weekly' => trans('Weekly'),
            'monthly' => trans('Monthly'),
            'yearly' => trans('Yearly'),
        ];
    }
}
