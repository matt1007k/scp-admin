<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DescuentoController;
use App\Http\Controllers\Admin\FormsController;
use App\Http\Controllers\Admin\HaberController;
use App\Http\Controllers\Admin\ImportarController;
use App\Http\Controllers\Admin\PagoController;
use App\Http\Controllers\Admin\PersonaController;
use App\Http\Controllers\Admin\ReporteController;
use App\Http\Controllers\Admin\VolumesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::redirect('/', '/login', 301);

Route::middleware('auth')->group(function () {

  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

  Route::prefix('admin')->group(function () {

    Route::resource('users', UserController::class)->except(['show', 'destroy']);
    Route::resource('roles', RoleController::class)->except(['show', 'destroy']);
    Route::resource('people', PersonaController::class)->except(['show', 'destroy']);
    Route::resource('assets', HaberController::class)->except(['show', 'destroy']);
    Route::resource('discounts', DescuentoController::class)->except(['show', 'destroy']);
    Route::resource('payments', PagoController::class)->except(['show', 'destroy']);
    Route::resource('imports', ImportarController::class)->except(['show', 'destroy']);
    Route::resource('volumes', VolumesController::class)->except(['show', 'destroy']);
    Route::resource('forms', FormsController::class)->except(['show', 'destroy']);

    Route::get('imports/payments', [ImportarController::class, 'payments'])->name('imports.payments');
    Route::post('imports/payments', [ImportarController::class, 'uploadPayments'])->name('imports.upload.payments');
    Route::get('imports/people', [ImportarController::class, 'people'])->name('imports.people');
    Route::post('imports/people', [ImportarController::class, 'uploadPeople'])->name('imports.upload.people');
    Route::get('imports/judicials', [ImportarController::class, 'judicials'])->name('imports.judicials');
    Route::post('imports/judicials', [ImportarController::class, 'uploadJudicials'])->name('imports.upload.judicials');

    Route::get('reports/year', [ReporteController::class, 'yearReport'])->name('reports.year');
    Route::get('reports/years', [ReporteController::class, 'yearsReport'])->name('reports.years');
    Route::get('reports/judicials', [ReporteController::class, 'judicialsReport'])->name('reports.judicials');
    Route::get('reports/voucher', [ReporteController::class, 'voucherReport'])->name('reports.voucher');

    Route::post('forms/upload', [FormsController::class, 'uploadFile'])->name('forms.upload');
  });

  Route::get('/reporte/por-anios/{params_code}', [ReporteController::class, 'porAnios'])->name('reports.poranios');
  Route::get('/reporte/por-anio/{params_code}', [ReporteController::class, 'porAnio'])->name('reports.poranio');
  Route::get('/reporte/judicial/{params_code}', [ReporteController::class, 'byJudicial'])->name('reports.porjudicial');
  Route::get('/reporte/boleta/{params_code}', [ReporteController::class, 'byVoucher'])->name('reports.byVoucher');

  Route::controller(ProfileController::class)->group(function () {
    Route::get('/account-setting', 'setting')->name('account-setting');
    // Route::put('/update-password/{user}', 'updatePassword')->name('account-setting.updatePassword');
  });
});
