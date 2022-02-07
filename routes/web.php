<?php

use App\Http\Controllers\AchievementController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
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

    Route::prefix('/master')->name('master.')->group(function () {
        Route::view('/', 'master.index')->name('index')->middleware('can:view-master');

        Route::prefix('/branch')->name('branch.')->group(function () {
            Route::post('/datatable', [BranchController::class, 'datatable'])->name('datatable');
            Route::delete('/multiple', [BranchController::class, 'destroyMultiple'])->name('destroy-multiple');
        });
        Route::resource('/branch', BranchController::class);

        Route::prefix('/user')->name('user.')->group(function () {
            Route::post('/datatable', [UserController::class, 'datatable'])->name('datatable');
            Route::delete('/multiple', [UserController::class, 'destroyMultiple'])->name('destroy-multiple');
        });
        Route::resource('/user', UserController::class);
    });

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

        Route::resource('/achievement', AchievementController::class);
    });

    Route::prefix('/report')->name('report.')->controller(ReportController::class)->group(function () {
        Route::view('/', 'report.index')->name('index');

        Route::prefix('/laporan-pencapaian-new-cin')->name('laporan-pencapaian-new-cin.')->group(function () {
            Route::view('/', 'report.laporan-pencapaian-new-cin')->name('index');
            Route::post('/chart', 'laporanPencapaianNewCinChart')->name('chart');
        });

        Route::prefix('/dashboard-growth-new-cin')->name('dashboard-growth-new-cin.')->group(function () {
            Route::view('/', 'report.dashboard-growth-new-cin')->name('index');
        });

        Route::prefix('/dashboard-penutupan-cin')->name('dashboard-penutupan-cin.')->group(function () {
            Route::view('/', 'report.dashboard-penutupan-cin')->name('index');
        });
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

