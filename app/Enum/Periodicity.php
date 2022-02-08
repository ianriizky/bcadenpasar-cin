<?php

namespace App\Enum;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self daily()
 * @method static self weekly()
 * @method static self monthly()
 * @method static self yearly()
 * @method bool isDaily() Determine when the current enum value is daily.
 * @method bool isWeekly() Determine when the current enum value is weekly.
 * @method bool isMonthly() Determine when the current enum value is monthly.
 * @method bool isYearly() Determine when the current enum value is yearly.
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
