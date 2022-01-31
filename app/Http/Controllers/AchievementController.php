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
     * Display dashboard pencapaian page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboardPencapaian()
    {
        return view('achievement.dashboard-pencapaian');
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
