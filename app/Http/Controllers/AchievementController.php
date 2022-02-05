<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    /**
     * Display index page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('achievement.index');
    }

    /**
     * Display laporan pencapaian new cin page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function laporanPencapaianNewCin()
    {
        return view('achievement.laporan-pencapaian-new-cin');
    }

    /**
     * Return laporan pencapaian new cin chart data as json response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function laporanPencapaianNewCinChart()
    {
        return response()->json([
            'labels' => [
                'Sunday',
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
                'Saturday',
            ],
            'datasets' => [
                [
                    'label' => 'Jumlah New CiN',
                    'data' => [460, 458, 330, 502, 430, 610, 488],
                    'borderWidth' => 2,
                    'backgroundColor' => 'rgba(254,86,83,.7)',
                    'borderColor' => 'rgba(254,86,83,.7)',
                    'borderWidth' => 2.5,
                    'pointBackgroundColor' => '#ffffff',
                    'pointRadius' => 4,
                ],
                [
                    'label' => 'Target Bulanan',
                    'data' => [550, 558, 390, 562, 490, 670, 538],
                    'borderWidth' => 2,
                    'backgroundColor' => 'rgba(63,82,227,.8)',
                    'borderColor' => 'transparent',
                    'borderWidth' => 0,
                    'pointBackgroundColor' => '#999999',
                    'pointRadius' => 4,
                ],
            ],
        ]);
    }

    /**
     * Display dashboard growth newcin page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboardGrowthNewCin()
    {
        return view('achievement.dashboard-growth-new-cin');
    }

    /**
     * Display dashboard penutupancin page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboardPenutupanCin()
    {
        return view('achievement.dashboard-penutupan-cin');
    }
}
