<?php

use App\Http\Controllers\AchievementController;
use App\Http\Controllers\Auth\UserVerificationPromptController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TargetController;
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

Route::get('/verify-user', [UserVerificationPromptController::class, '__invoke'])
    ->middleware('auth')
    ->name('verification-user.notice');

Route::middleware('auth:web', 'user_is_verified')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::prefix('/master')->name('master.')->middleware('can:view-master')->group(function () {
        Route::view('/', 'master.index')->name('index');

        Route::prefix('/branch')->name('branch.')->controller(BranchController::class)->group(function () {
            Route::post('/datatable', 'datatable')->name('datatable');
            Route::delete('/multiple', 'destroyMultiple')->name('destroy-multiple');
        });
        Route::resource('/branch', BranchController::class);

        Route::prefix('/user')->name('user.')->controller(UserController::class)->group(function () {
            Route::post('/datatable', 'datatable')->name('datatable');
            Route::delete('/multiple', 'destroyMultiple')->name('destroy-multiple');
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

    Route::prefix('/monitoring')->name('monitoring.')->middleware('can:view-monitoring')->group(function () {
        Route::view('/', 'monitoring.index')->name('index');

        Route::prefix('/target')->name('target.')->controller(TargetController::class)->group(function () {
            Route::post('/datatable', 'datatable')->name('datatable');
            Route::delete('/multiple', 'destroyMultiple')->name('destroy-multiple');
        });
        Route::resource('/target', TargetController::class);

        Route::prefix('/event')->name('event.')->controller(EventController::class)->group(function () {
            Route::post('/datatable', 'datatable')->name('datatable');
            Route::delete('/multiple', 'destroyMultiple')->name('destroy-multiple');
        });
        Route::resource('/event', EventController::class);

        Route::prefix('/achievement')->name('achievement.')->controller(AchievementController::class)->group(function () {
            Route::post('/datatable', 'datatable')->name('datatable');
            Route::delete('/multiple', 'destroyMultiple')->name('destroy-multiple');

            Route::prefix('/select2')->name('select2.')->group(function () {
                Route::get('/target/{branch?}', 'select2Target')->name('target');
                Route::get('/event/{branch?}', 'select2Event')->name('event');
                Route::get('/user/{branch?}', 'select2User')->name('user');
            });
        });
        Route::resource('/achievement', AchievementController::class);
    });

    Route::prefix('/report')->name('report.')->controller(ReportController::class)->middleware('can:view-report')->group(function () {
        Route::view('/', 'report.index')->name('index');

        Route::prefix('/laporan-pencapaian-new-cin')->name('laporan-pencapaian-new-cin.')->group(function () {
            Route::view('/', 'report.laporan-pencapaian-new-cin')->name('index');
            Route::post('/chart', 'laporanPencapaianNewCinChart')->name('chart');
        });

        Route::get('/dashboard-growth-new-cin', 'dashboardGrowthNewCin')->name('dashboard-growth-new-cin.index');

        Route::get('/dashboard-penutupan-cin', 'dashboardPenutupanCin')->name('dashboard-penutupan-cin.index');
    });

    Route::prefix('/profile')->name('profile.')->controller(ProfileController::class)->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::put('/', 'update')->name('update');
    });
});

