<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArsipDashboardController;

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

Route::middleware(['auth', 'admin'])->prefix('user')->group(function () {
    // Rute-rute yang hanya bisa diakses oleh admin
    // User routes
    Route::get('/', [UserController::class, 'index'])->name('user.list');
    Route::get('/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/create', [UserController::class, 'store'])->name('user.store');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/edit/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
    Route::post('/import', [UserController::class, 'import'])->name('user.import');
});
Route::middleware(['auth', 'admin'])->prefix('dosen')->group(function () {
    // Rute-rute yang hanya bisa diakses oleh admin
    // Dosen Route
    Route::get('/', [DosenController::class, 'index'])->name('dosen.list');
    Route::get('/create', [
        DosenController::class, 'create'
    ])->name('dosen.create');
    Route::post('/create', [DosenController::class, 'store'])->name('dosen.store');
    Route::get('/edit/{id}', [DosenController::class, 'edit'])->name('dosen.edit');
    Route::put('/edit/{id}', [DosenController::class, 'update'])->name('dosen.update');
    Route::delete('/{id}', [DosenController::class, 'destroy'])->name('dosen.delete');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/arsip', [DashboardController::class, 'ars'])->name('dahboard.arsip');
    Route::put('/dashboard/{id}', [DashboardController::class, 'update'])->name('dashboard.update');

    Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
    Route::get('/contoh', [UserController::class, 'contoh'])->name('contoh');
    Route::post('/user/template', [UserController::class, 'templateExcel'])->name('template.user');

    // Arsip Route
    Route::get('/arsip', [ArsipController::class, 'index'])->name('arsip.list');
    Route::get('/arsip/create', [ArsipController::class, 'create'])->name('arsip.create');
    Route::post('/arsip/create', [ArsipController::class, 'store'])->name('arsip.store');
    Route::get('/arsip/{id}', [ArsipController::class, 'edit'])->name('arsip.edit');
    Route::put('/arsip/{id}', [ArsipController::class, 'update'])->name('arsip.update');
    Route::delete('/arsip/{id}', [ArsipController::class, 'destroy'])->name('arsip.delete');
    Route::get('/arsip/show/{id}', [ArsipController::class, 'show'])->name('arsip.show');
    Route::get('/arsip/download/{id}', [ArsipController::class, 'downloadPdf'])->name('arsip.download');
    Route::post('/export', [ArsipController::class, 'downloadExcel'])->name('arsip.export');
    Route::get('/tes', [ArsipController::class, 'tes'])->name('tes');

    Route::get('/arsip-tahun', [ArsipDashboardController::class, 'index'])->name('arsip.tahun');
    Route::get('/arsip-tahun/{year}', [ArsipDashboardController::class, 'detail'])->name('arsip.tahun.detail');
    Route::get('/myArsip', [DashboardController::class, 'myArsip'])->name('arsip.myArsip');
    // Logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});


// Auth
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('signin');
});

// Not Found
Route::fallback(function () {
    return view('pages.error');
});
