<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\TblDbeliController;
use App\Http\Controllers\Dashboard\TblHbeliController;
use App\Http\Controllers\Dashboard\TblStockController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\TblBarangController;
use App\Http\Controllers\Dashboard\TblSuplierController;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        // Route::get('/orders/{id}', 'show');
        // Route::post('/orders', 'store');
    });
    Route::controller(TblBarangController::class)->name('barang.')->group(function () {
        Route::get('/barang', 'index')->name('index');
    });
    Route::controller(TblSuplierController::class)->name('suplier.')->group(function () {
        Route::get('/supliers', 'index')->name('index');
    });
    Route::controller(TblStockController::class)->name('stock.')->group(function () {
        Route::get('/stocks', 'index')->name('index');
        // Route::get('/pdf', 'pdf')->name('pdf');
        Route::get('/export-pdf', 'exportPdf')->name('export-pdf');
        Route::get('/export-excel', 'exportExcel')->name('export-excel');
        Route::post('/stocks/store', 'store')->name('store');
        Route::put('/stocks/update/{id}', 'update')->name('update');
        Route::delete('/stocks/delete/{id}', 'destroy')->name('destroy');
    });
    Route::controller(TblHbeliController::class)->name('pembelian.')->group(function () {
        Route::get('/pembelian', 'index')->name('index');
        Route::post('/pembelian/store', 'store')->name('store');
        Route::put('/pembelian/update/{id}', 'update')->name('update');
        Route::delete('/pembelian/delete/{id}', 'destroy')->name('destroy');
    });
    Route::controller(TblDbeliController::class)->name('detail.pembelian.')->group(function () {
        Route::get('/detail/pembelian', 'index')->name('index');
        Route::post('/detail/pembelian/store', 'store')->name('store');
        Route::put('/detail/pembelian/update/{id}', 'update')->name('update');
        Route::delete('/detail/pembelian/delete/{id}', 'destroy')->name('destroy');
    });
});


