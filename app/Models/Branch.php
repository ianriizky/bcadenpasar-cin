<?php

namespace App\Models;

use App\Enum\Periodicity;
use App\Infrastructure\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

/**
 * @method static \Database\Factories\BranchFactory<static> factory(callable|array|int|null $count = null, callable|array $state = []) Get a new factory instance for the model.
 */
class Branch extends Model
{
    use HasFactory,
        Concerns\Branch\Attribute,
        Concerns\Branch\Relation;

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'name',
        'address',
    ];

    /**
     * Return the specified amount from this current target based on the given periodicity.
     *
     * @param  \App\Enum\Periodicity  $periodicity
     * @return int
     */
    public function currentTargetAmountForPeriodicity(Periodicity $periodicity): int
    {
        if (is_null($this->currentTarget)) {
            return 0;
        }

        return $this->currentTarget->amount->amountForPeriodicity($periodicity);
    }

    /**
     * Return the specified amount of this achievement based on the given parameter.
     *
     * @param  \Illuminate\Support\Carbon  $startDate
     * @param  \Illuminate\Support\Carbon  $endDate
     * @param  \App\Enum\Periodicity  $periodicity
     * @return mixed
     */
    public function achievementAmount(Carbon $startDate, Carbon $endDate, Periodicity $periodicity)
    {
        return $this->achievements()
            ->whereBetween('achievements.achieved_date', [$startDate->startOfDay(), $endDate->endOfDay()])
            ->where('targets.periodicity', $periodicity)
            ->sum('achievements.amount');
    }
}
