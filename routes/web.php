<?php

use App\Http\Controllers\AchievementController;
use App\Http\Controllers\DailyAchievementController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__.'/auth.php';

Route::view('/', 'welcome');

Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::prefix('/education')->name('education.')->group(function () {
        Route::view('/', 'education.index')->name('index');

        Route::prefix('/webinar-literasi-keuangan')->name('webinar-literasi-keuangan.')->group(function () {
            Route::view('/', 'education.webinar-literasi-keuangan.index')->name('index');

            Route::view('/template-surat-penawaran-webinar', 'education.webinar-literasi-keuangan.template-surat-penawaran-webinar')->name('template-surat-penawaran-webinar');
            Route::view('/template-presentasi-webinar-literasi-keuangan', 'education.webinar-literasi-keuangan.template-presentasi-webinar-literasi-keuangan')->name('template-presentasi-webinar-literasi-keuangan');
            Route::view('/template-rundown-webinar-literasi-keuangan', 'education.webinar-literasi-keuangan.template-rundown-webinar-literasi-keuangan')->name('template-rundown-webinar-literasi-keuangan');
            Route::view('/pemetaan-sekolah-kampus-potensi-webinar', 'education.webinar-literasi-keuangan.pemetaan-sekolah-kampus-potensi-webinar')->name('pemetaan-sekolah-kampus-potensi-webinar');
            Route::view('/input-rencana-penyelenggaraan-webinar', 'education.webinar-literasi-keuangan.input-rencana-penyelenggaraan-webinar')->name('input-rencana-penyelenggaraan-webinar');
        });

        Route::view('/pembukaan-rekening-online', 'education.pembukaan-rekening-online')->name('pembukaan-rekening-online');
        Route::view('/employee-get-cin', 'education.employee-get-cin')->name('employee-get-cin');
    });

    Route::prefix('/monitoring')->name('monitoring.')->group(function () {
        Route::view('/', 'monitoring.index')->name('index');

        Route::resource('/daily-achievement', DailyAchievementController::class);
    });

    Route::prefix('/achievement')->name('achievement.')->controller(AchievementController::class)->group(function () {
        Route::view('/', 'achievement.index')->name('index');

        Route::get('/dashboard-pencapaian', 'dashboardPencapaian')->name('dashboard-pencapaian');
        Route::get('/dashboard-growth-new-cin', 'dashboardGrowthNewCin')->name('dashboard-growth-new-cin');
        Route::get('/dashboard-penutupan-cin', 'dashboardPenutupanCin')->name('dashboard-penutupan-cin');
    });
});

