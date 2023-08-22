<?php

use Doctrine\DBAL\Schema\Index;
use Illuminate\Support\Facades\Route;

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


Route::redirect('/', '/admin/login', 301);

Route::get('formpengajuan', [App\Http\Controllers\CetakFormPengajuan::class, 'index'])->name('form-pemeriksaan.cetak');
Route::get('bukticair', [App\Http\Controllers\CetakFormPengajuan::class, 'bukticair'])->name('form-bukticair.cetak');
Route::get('laporan', [App\Http\Controllers\CetakFormPengajuan::class, 'laporan'])->name('form-laporan.cetak');
