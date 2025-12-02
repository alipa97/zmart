<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ListAdminController;
use App\Http\Controllers\KiosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\CheckOwnerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListKiosController;
use App\Http\Controllers\InfaqKiosController;
use App\Http\Controllers\AllInfaqController;
use App\Http\Controllers\ListInfaqController;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/home', [HomeController::class, 'index'])->name('pages.home');

// Route::get('/dashboardddd', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/semua-infaq/pdf', [AllInfaqController::class, 'cetakLaporan'])->name('semua-infaq.laporan');

    // Route::get('/list-infaq', [ListInfaqController::class, 'index'])->name('list-infaq.index');
    Route::get('/semua-infaq', [AllInfaqController::class, 'index'])->name('semua-infaq.index');
});

Route::get('/map', [KiosController::class, 'showMap'])->name('kios.map');
Route::get('/map/rute', [KiosController::class, 'showRute'])->name('kios.rute');

Route::get('/daftarKios', [ListKiosController::class, 'index'])->name('daftarKios.index');

// Rute untuk admin
Route::middleware([AdminMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/list-admin', [ListAdminController::class, 'index'])->name('admin.new_admin.index');
    Route::get('/admin/new-admin', [ListAdminController::class, 'create'])->name('admin.new_admin.create');

    Route::resource('verify', CheckOwnerController::class);

    //CRUD Pemilik
    Route::resource('pemilik', PemilikController::class);

    Route::resource('users', UserController::class);

    
    //CRUD kios
    Route::get('/list-kios', [KiosController::class, 'index'])->name('kios.index');
    Route::get('/list-kios/create/{id}', [KiosController::class, 'create'])->name('kios.create');
    Route::post('/list-kios/store', [KiosController::class, 'store'])->name('kios.store');
    Route::get('/list-kios/{kios}', [KiosController::class, 'show'])->name('kios.show');
    Route::get('/list-kios/{kios}/edit', [KiosController::class, 'edit'])->name('kios.edit');
    Route::put('/list-kios/{kios}', [KiosController::class, 'update'])->name('kios.update');
    Route::delete('/list-kios/{kios}', [KiosController::class, 'destroy'])->name('kios.destroy');

    Route::patch('/kios/{id}/toggle-status', [KiosController::class, 'toggleStatus'])->name('kios.toggleStatus');

    Route::get('/laporan-pdf', [ListKiosController::class, 'cetakDaftarKios'])->name('kios.laporan');

    Route::prefix('kios/{kios_id}/infaq')->group(function () {
        Route::get('/', [InfaqKiosController::class, 'index'])->name('infaq.index');
        Route::get('/create', [InfaqKiosController::class, 'create'])->name('infaq.create');
        Route::post('/store', [InfaqKiosController::class, 'store'])->name('infaq.store');
        Route::get('/{infaqKios}/edit', [InfaqKiosController::class, 'edit'])->name('infaq.edit');
        Route::put('/{infaqKios}', [InfaqKiosController::class, 'update'])->name('infaq.update');
        Route::delete('/{infaqKios}', [InfaqKiosController::class, 'destroy'])->name('infaq.destroy');
    });
    
    //Semua Infaq
    // Route::get('/semua-infaq', [AllInfaqController::class, 'index'])->name('semua-infaq.index');
    Route::get('/semua-infaq/create', [AllInfaqController::class, 'create'])->name('semua-infaq.create');
    Route::post('/semua-infaq/store', [AllInfaqController::class, 'store'])->name('semua-infaq.store');
    Route::get('/semua-infaq/{infaqKios}/edit', [AllInfaqController::class, 'edit'])->name('semua-infaq.edit');
    Route::put('/semua-infaq/{infaqKios}', [AllInfaqController::class, 'update'])->name('semua-infaq.update');
    Route::delete('/semua-infaq/{infaqKios}', [AllInfaqController::class, 'destroy'])->name('semua-infaq.destroy');
    // Route::get('/semua-infaq/pdf', [AllInfaqController::class, 'cetakLaporan'])->name('semua-infaq.laporan');
});

require __DIR__.'/auth.php';
