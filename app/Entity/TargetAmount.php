<?php

namespace App\Entity;

use App\Enum\Periodicity;
use App\Models\Target;
use Illuminate\Support\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class TargetAmount extends DataTransferObject
{
    /**
     * Determine when the target amount including weekend (saturday and sunday) or not.
     *
     * @var bool
     */
    public static bool $includeWeekend = false;

    /** Target amount in "daily" format. */
    public int $daily;

    /** Target amount in "weekly" format. */
    public int $weekly;

    /** Target amount in "monthly" format. */
    public int $monthly;

    /** Target amount in "yearly" format. */
    public int $yearly;

    /**
     * Create a new instance class from the given model.
     *
     * @param  \App\Models\Target  $model
     * @return static
     */
    public static function fromModel(Target $model)
    {
        $amount = $model->getAttributeFromArray('amount');

        [$daily, $weekly, $monthly, $yearly] = match ($model->periodicity) {
            Periodicity::daily() => static::getAmountFromDaily($amount),
            Periodicity::weekly() => static::getAmountFromWeekly($amount),
            Periodicity::monthly() => static::getAmountFromMonthly($amount),
            Periodicity::yearly() => static::getAmountFromYearly($amount),
        };

        return new static(compact('daily', 'weekly', 'monthly', 'yearly'));
    }

    /**
     * Return the specified amount based on the given periodicity.
     *
     * @param  \App\Enum\Periodicity  $periodicity
     * @return int
     */
    public function amountForPeriodicity(Periodicity $periodicity): int
    {
        return match ($periodicity) {
            Periodicity::daily() => $this->daily,
            Periodicity::weekly() => $this->weekly,
            Periodicity::monthly() => $this->monthly,
            Periodicity::yearly() => $this->yearly,
        };
    }

    /**
     * Return the days per week based on the current $includeWeekend value.
     *
     * @return int
     */
    protected static function daysPerWeek(): int
    {
        return Carbon::DAYS_PER_WEEK - (static::$includeWeekend ? 0 : count(Carbon::getWeekendDays()));
    }

    /**
     * Return list of target amount from daily periodicity.
     *
     * @param  int  $amount
     * @return int[]
     */
    protected static function getAmountFromDaily(int $amount): array
    {
        $daily = $amount;
        $weekly = $daily * static::daysPerWeek();
        $monthly = $weekly * Carbon::WEEKS_PER_MONTH;
        $yearly = $monthly * Carbon::MONTHS_PER_YEAR;

        return [$daily, $weekly, $monthly, $yearly];
    }

    /**
     * Return list of target amount from weekly periodicity.
     *
     * @param  int  $amount
     * @return int[]
     */
    protected static function getAmountFromWeekly(int $amount): array
    {
        $weekly = $amount;
        $daily = $weekly / static::daysPerWeek();
        $monthly = $weekly * Carbon::WEEKS_PER_MONTH;
        $yearly = $monthly * Carbon::MONTHS_PER_YEAR;


        return [$daily, $weekly, $monthly, $yearly];
    }

    /**
     * Return list of target amount from monthly periodicity.
     *
     * @param  int  $amount
     * @return int[]
     */
    protected static function getAmountFromMonthly(int $amount): array
    {
        $monthly = $amount;
        $weekly = $monthly / Carbon::WEEKS_PER_MONTH;
        $daily = $weekly / static::daysPerWeek();
        $yearly = $monthly * Carbon::MONTHS_PER_YEAR;

        return [$daily, $weekly, $monthly, $yearly];
    }

    /**
     * Return list of target amount from yearly periodicity.
     *
     * @param  int  $amount
     * @return int[]
     */
    protected static function getAmountFromYearly(int $amount): array
    {
        $yearly = $amount;
        $monthly = $yearly / Carbon::MONTHS_PER_YEAR;
        $weekly = $monthly / Carbon::WEEKS_PER_MONTH;
        $daily = $weekly / static::daysPerWeek();

        return [$daily, $weekly, $monthly, $yearly];
    }
}
