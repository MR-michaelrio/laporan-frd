<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\ReguController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\LaporanFinalController;
use App\Models\anggota;
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

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        $jmlhanggota = anggota::all()->count();
        return view('template.master',compact('jmlhanggota'));
    })->name('index');

    Route::resource('anggota', AnggotaController::class);
    Route::resource('regu', ReguController::class);
    // Route::resource('absen', AbsenController::class);
    Route::resource('laporan', LaporanFinalController::class);
    Route::get('/index2',[AnggotaController::class, 'index2'])->name('agt.index2');
    Route::get('/pdf/{id}',[AbsenController::class, 'generatePDF'])->name('absen.pdf');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
Auth::routes();

Route::get('/laporan1',[LaporanFinalController::class, 'laporanfinal'])->name('laporan.final');
Route::post('/laporan1',[LaporanFinalController::class, 'store'])->name('laporan.store');

Route::get('/absen1',[AbsenController::class, 'index2'])->name('absen.index2');
Route::post('/absen1',[AbsenController::class, 'store2'])->name('absen.store2');

Route::get('/pass', function () {
    $hashedPassword = bcrypt('admin1234');
    return $hashedPassword;
});

