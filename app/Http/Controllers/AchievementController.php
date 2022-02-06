<?php

namespace App\Http\Controllers;

use App\Http\Requests\Achievement\LaporanPencapaianNewCinChartRequest;
use App\Repositories\AchievementRepository;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    /**
     * Create a new instance class.
     *
     * @param  \App\Repositories\AchievementRepository  $achievementRepository
     * @return void
     */
    public function __construct(
        protected AchievementRepository $achievementRepository
    ) {
        //
    }

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
     * @param  \App\Http\Requests\Achievement\LaporanPencapaianNewCinChartRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function laporanPencapaianNewCinChart(LaporanPencapaianNewCinChartRequest $request)
    {
        $data = $this->achievementRepository->chartLaporanPencapaianNewCin(
            $request->date('start_date'),
            $request->date('end_date'),
            $request->periodicity
        );

        return response()->json($data);
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
