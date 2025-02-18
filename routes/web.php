<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JenisKebutuhanController;
use App\Http\Controllers\PrioritasKebutuhanController;
use App\Http\Controllers\RencanaKebutuhanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\HakAksesController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //Route Master Data
    Route::resource('jenis-kebutuhan', JenisKebutuhanController::class);
    Route::patch('jenis-kebutuhan/{id}/toggle-status', [JenisKebutuhanController::class, 'toggleStatus'])->name('jenis-kebutuhan.toggle-status');

    Route::resource('prioritas-kebutuhan', PrioritasKebutuhanController::class);
    Route::patch('prioritas-kebutuhan/{id}/toggle-status', [PrioritasKebutuhanController::class, 'toggleStatus'])->name('prioritas-kebutuhan.toggle-status');

    Route::resource('pengguna', PenggunaController::class);
    Route::resource('hak-akses', HakAksesController::class);
    Route::put('hak-akses/{id}/toggle-status', [HakAksesController::class, 'toggleStatus'])->name('hak-akses.toggle-status');


    //Route::resource('rencana-kebutuhan', RencanaKebutuhanController::class)->name('rencana-kebutuhan');
    Route::get('/rencana-kebutuhan', [RencanaKebutuhanController::class, 'index'])->name('rencana-kebutuhan.index');
    Route::get('rencana-kebutuhan/create', [RencanaKebutuhanController::class, 'create'])->name('rencana-kebutuhan.create');
    Route::post('rencana-kebutuhan', [RencanaKebutuhanController::class, 'store'])->name('rencana-kebutuhan.store');
    Route::get('rencana-kebutuhan/{id}/edit', [RencanaKebutuhanController::class, 'edit'])->name('rencana-kebutuhan.edit');
    Route::put('rencana-kebutuhan/{id}', [RencanaKebutuhanController::class, 'update'])->name('rencana-kebutuhan.update');
    Route::delete('rencana-kebutuhan', [RencanaKebutuhanController::class, 'destroy'])->name('rencana-kebutuhan.destroy');
    Route::get('rencana-kebutuhan/{id}', [RencanaKebutuhanController::class, 'show'])->name('rencana-kebutuhan.show');


});



require __DIR__.'/auth.php';
