<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JenisKebutuhanController;
use App\Http\Controllers\PrioritasKebutuhanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('jenis-kebutuhan', JenisKebutuhanController::class);
    Route::patch('jenis-kebutuhan/{id}/toggle-status', [JenisKebutuhanController::class, 'toggleStatus'])->name('jenis-kebutuhan.toggle-status');

    Route::resource('prioritas-kebutuhan', PrioritasKebutuhanController::class);

    //Route::get('/rencana-kebutuhan', [RencanaKebutuhanController::class, 'list'])->name('rencanakebutuhan.list');
});



require __DIR__.'/auth.php';
