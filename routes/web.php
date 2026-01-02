<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrokerController;
use App\Http\Controllers\AnalystController;
use App\Http\Controllers\InspectorController;

use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

// admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');
Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update');
Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.delete');

// broker
Route::get('/broker', [BrokerController::class, 'index'])->name('broker.index');

// analyst
Route::get('/analyst/cases', [AnalystController::class, 'index'])->name('analyst.cases');
Route::post('/analyst/risk/{id}', [AnalystController::class, 'runRisk'])->name('analyst.risk');

// inspector
Route::get('/inspector', [InspectorController::class, 'index']);
Route::get('/inspector/case/{case}', [InspectorController::class, 'show']);
Route::post('/inspector/decision/{id}', [InspectorController::class, 'decision']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
