<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JenisKebutuhanController;
use App\Http\Controllers\PrioritasKebutuhanController;
use App\Http\Controllers\RencanaKebutuhanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\HakAksesController;
use App\Http\Controllers\UsulanAnggaranController;
use App\Http\Controllers\RFQController;
use App\Http\Controllers\VendorController;

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
    Route::put('rencana-kebutuhan/{id}/update-prioritas', [RencanaKebutuhanController::class, 'updatePrioritas'])->name('rencana-kebutuhan.update-prioritas');

    Route::prefix('usulan-anggaran')->name('usulan-anggaran.')->group(function () {
        Route::get('/', [UsulanAnggaranController::class, 'index'])->name('index');
        Route::get('create', [UsulanAnggaranController::class, 'create'])->name('create');
        Route::post('/', [UsulanAnggaranController::class, 'store'])->name('store');
        Route::get('{id}', [UsulanAnggaranController::class, 'show'])->name('show');
        Route::get('{id}/edit', [UsulanAnggaranController::class, 'edit'])->name('edit');
        Route::put('{id}', [UsulanAnggaranController::class, 'update'])->name('update');
        Route::delete('{id}', [UsulanAnggaranController::class, 'destroy'])->name('destroy');
    });

    Route::put('/usulan-anggaran/{id}/update-status/{status_id}', [UsulanAnggaranController::class, 'updateStatus'])
    ->name('usulan-anggaran.update-status');


    Route::get('/rfq', [RFQController::class, 'index'])->name('rfq.index');
    Route::get('rfq/create', [RFQController::class, 'create'])->name('rfq.create');
    Route::post('rfq', [RFQController::class, 'store'])->name('rfq.store');
    Route::get('/rfq/{id}', [RFQController::class, 'show'])->name('rfq.show');
    Route::get('/rfq/{id}/edit', [RFQController::class, 'edit'])->name('rfq.edit');
    Route::put('/rfq/{id}', [RFQController::class, 'update'])->name('rfq.update');
    Route::delete('/rfq/{id}', [RFQController::class, 'destroy'])->name('rfq.destroy');

    Route::resource('vendors', VendorController::class);
    Route::patch('/vendors/{vendor}/toggle-status', [VendorController::class, 'toggleStatus'])->name('vendors.toggle-status');


});



require __DIR__.'/auth.php';
