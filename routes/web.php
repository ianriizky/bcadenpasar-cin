<?php

use App\Http\Controllers\AchievementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\MonitoringController;
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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('/education')->name('education.')->controller(EducationController::class)->group(function () {
        Route::prefix('/webinar-literasi-keuangan')->name('webinar-literasi-keuangan.')->group(function () {
            Route::view('/', 'education.webinar-literasi-keuangan.index')->name('index');

            Route::view('/template-surat-penawaran-webinar', 'education.webinar-literasi-keuangan.template-surat-penawaran-webinar')->name('template-surat-penawaran-webinar');
            Route::view('/template-presentasi-webinar-literasi-keuangan', 'education.webinar-literasi-keuangan.template-presentasi-webinar-literasi-keuangan')->name('template-presentasi-webinar-literasi-keuangan');
            Route::view('/template-rundown-webinar-literasi-keuangan', 'education.webinar-literasi-keuangan.template-rundown-webinar-literasi-keuangan')->name('template-rundown-webinar-literasi-keuangan');
            Route::view('/pemetaan-sekolah-kampus-potensi-webinar', 'education.webinar-literasi-keuangan.pemetaan-sekolah-kampus-potensi-webinar')->name('pemetaan-sekolah-kampus-potensi-webinar');
            Route::view('/input-rencana-penyelenggaraan-webinar', 'education.webinar-literasi-keuangan.input-rencana-penyelenggaraan-webinar')->name('input-rencana-penyelenggaraan-webinar');
        });

        Route::prefix('/pembukaan-rekening-online')->name('pembukaan-rekening-online.')->group(function () {
            Route::view('/', 'education.pembukaan-rekening-online')->name('index');
        });

        Route::prefix('/employee-get-cin')->name('employee-get-cin.')->group(function () {
            Route::view('/', 'education.employee-get-cin')->name('index');
        });
    });

    Route::resource('education', EducationController::class);
    Route::resource('monitoring', MonitoringController::class);
    Route::resource('achievement', AchievementController::class);
});

