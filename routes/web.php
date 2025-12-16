<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrokerController;
use App\Http\Controllers\AnalystController;

Route::get('/', function () {
    return view('welcome');
});

// admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');
Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update');
Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.deletee');

// broker
Route::get('/broker', [BrokerController::class, 'index'])->name('broker.index');

// analyst
Route::get('/analyst/cases', [AnalystController::class, 'index'])->name('analyst.cases');
Route::post('/analyst/risk/{id}', [AnalystController::class, 'runRisk'])->name('analyst.Risk');

