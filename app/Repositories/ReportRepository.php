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

        return [
            'labels' => $branches->pluck('name'),
            'datasets' => [
                [
                    'label' => trans('Number of New CiN'),
                    'data' => $branches->map(fn (Branch $branch) => rand(1, 100)),
                    'backgroundColor' => 'rgba(254,86,83,.7)',
                    'borderColor' => 'rgba(254,86,83,.7)',
                    'borderWidth' => 2.5,
                    'pointBackgroundColor' => '#ffffff',
                    'pointRadius' => 4,
                ],
                [
                    'label' => trans(':periodicity target', ['periodicity' => $periodicity->label]),
                    'data' => $branches->map(fn (Branch $branch) => rand(1, 100)),
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
