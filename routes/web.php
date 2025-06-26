<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CoaController;
use App\Http\Controllers\PeriodeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.dashboard');
})->name('dashboard');
Route::get('/coa', [CoaController::class, 'index'])->name('coa');
Route::get('/saldoAwal', function () {
    return view('pages.saldoAwal');
})->name('saldoAwal');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'submitLogin'])->name('login.submit');
Route::get('/jurnalUmum', function () {
    return view('pages.jurnalUmum');
})->name('jurnalUmum');
Route::get('/jurnalPemasukan', function () {
    return view('pages.jurnalPemasukan');
})->name('jurnalPemasukan');
Route::get('/jurnalPengeluaran', function () {
    return view('pages.jurnalPengeluaran');
})->name('jurnalPengeluaran');
Route::get('/bukuBesar', function () {
    return view('pages.bukuBesar');
})->name('bukuBesar');
Route::get('/neracaSaldo', function () {
    return view('pages.neracaSaldo');
})->name('neracaSaldo');
Route::get('/posisiKeuangan', function () {
    return view('pages.posisiKeuangan');
})->name('posisiKeuangan');
Route::get('/laporanSaldoAwal', function () {
    return view('pages.laporanSaldoAwal');
})->name('laporanSaldoAwal');
Route::get('/settingPeriode', [PeriodeController::class, 'index'])->name('settingPeriode');
Route::get('/laporan-aktivitas', function () {
    return view('pages.laporanAktivitas');
})->name('laporan-aktivitas');
Route::get('/debug', function () {
    return view('pages.debug');
});
Route::get('/logout', function() { return view('pages.logout'); })->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout.submit');
Route::post('/coa', [CoaController::class, 'store'])->name('coa.store');
Route::post('/settingPeriode', [PeriodeController::class, 'store'])->name('periode.store');

// API Proxy Routes untuk JavaScript
Route::get('/api-proxy/periode/{id}', [PeriodeController::class, 'getPeriodeById']);
Route::put('/api-proxy/periode/{id}', [PeriodeController::class, 'updatePeriode']);
Route::delete('/api-proxy/periode/{id}', [PeriodeController::class, 'deletePeriode']);