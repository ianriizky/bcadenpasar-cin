<?php

namespace App\Http\Controllers;

use App\Http\Requests\Report\LaporanPencapaianNewCinChartRequest;
use App\Repositories\ReportRepository;

class ReportController extends Controller
{
    /**
     * Create a new instance class.
     *
     * @param  \App\Repositories\ReportRepository  $reportRepository
     * @return void
     */
    public function __construct(
        protected ReportRepository $reportRepository
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
        return view('report.index');
    }

    /**
     * Return laporan pencapaian new cin chart data as json response.
     *
     * @param  \App\Http\Requests\Achievement\LaporanPencapaianNewCinChartRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function laporanPencapaianNewCinChart(LaporanPencapaianNewCinChartRequest $request)
    {
        $data = $this->reportRepository->chartLaporanPencapaianNewCin(
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
        return view('report.dashboard-growth-new-cin');
    }

    /**
     * Display dashboard penutupancin page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboardPenutupanCin()
    {
        return view('report.dashboard-penutupan-cin');
    }
}
