<?php

namespace App\Repositories;

use App\Enum\Periodicity;
use App\Models\Branch;
use Illuminate\Support\Carbon;

class ReportRepository
{
    /**
     * Return chart data of laporan pencapaian new cin.
     *
     * @param  \Illuminate\Support\Carbon  $startDate
     * @param  \Illuminate\Support\Carbon  $endDate
     * @param  \App\Enum\Periodicity  $periodicity
     * @return array
     */
    public function chartLaporanPencapaianNewCin(Carbon $startDate, Carbon $endDate, Periodicity $periodicity): array
    {
        $branches = Branch::all();

        $branchesAchievementAmount = $branches->map(fn (Branch $branch) =>
            $branch->achievements()
                ->whereBetween('achievements.achieved_date', [$startDate->startOfDay(), $endDate->endOfDay()])
                ->where('targets.periodicity', $periodicity)
                ->sum('achievements.amount')
        );

        $branchesTargetAmount = $branches->map(fn (Branch $branch) =>
            $branch->currentTargetAmountForPeriodicity($periodicity)
        );

        return [
            'labels' => $branches->pluck('name'),
            'datasets' => [
                [
                    'label' => trans('Number of New CiN'),
                    'data' => $branchesAchievementAmount,
                    'backgroundColor' => 'rgba(254,86,83,.7)',
                    'borderColor' => 'rgba(254,86,83,.7)',
                    'borderWidth' => 2.5,
                    'pointBackgroundColor' => '#ffffff',
                    'pointRadius' => 4,
                ],
                [
                    'label' => trans(':periodicity target', ['periodicity' => $periodicity->label]),
                    'data' => $branchesTargetAmount,
                    'backgroundColor' => 'rgba(63,82,227,.8)',
                    'borderColor' => 'transparent',
                    'borderWidth' => 0,
                    'pointBackgroundColor' => '#999999',
                    'pointRadius' => 4,
                ],
            ],
        ];
    }
}
