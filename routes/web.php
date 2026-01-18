<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RecommendationController;
use Barryvdh\DomPDF\Facade\Pdf;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Semua route web aplikasi didefinisikan di sini.
| Ketika user mengakses http://127.0.0.1:8000/, akan diarahkan ke halaman home.
|
*/

// Rekomendasi makanan
Route::get('/form', [RekomendasiController::class, 'index'])->name('form');
Route::post('/rekomendasi/hitung', [RekomendasiController::class, 'hitung'])->name('rekomendasi.hitung');

// Halaman utama menampilkan home user
Route::get('/', function () {
    return view('user.home');
})->name('home');

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rekomendasi (user)
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/rekomendasi', [RekomendasiController::class, 'index'])->name('rekomendasi.index');
    Route::post('/rekomendasi/hitung', [RekomendasiController::class, 'hitung'])->name('rekomendasi.hitung');
    Route::post('/rekomendasi/tolak', [RekomendasiController::class, 'tolak']); // 🔹 tambahkan ini
});

/// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Kelola pengguna
    Route::get('/manage-users', [AdminController::class, 'manageUsers'])->name('admin.users.index');
    Route::delete('/manage-users/{id}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');

    // Kelola menu
    Route::get('/manage-menu', [AdminController::class, 'manageMenu'])->name('admin.menu.index');
    Route::get('/manage-menu/create', [AdminController::class, 'createMenu'])->name('admin.menu.create');
    Route::get('/manage-menu/{id}/edit', [AdminController::class, 'editMenu'])->name('admin.menu.edit');
    Route::delete('/manage-menu/{id}', [AdminController::class, 'destroyMenu'])->name('admin.menu.destroy');
    
});

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
// Halaman Tentang (bebas diakses)
Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');

Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [AuthController::class, 'resetPassword'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'updatePassword'])
    ->middleware('guest')
    ->name('password.update');
Route::middleware(['auth'])->group(function () {
    Route::get('/rekomendasi/riwayat', [RekomendasiController::class, 'riwayat'])
        ->name('rekomendasi.riwayat');
});
Route::get('/riwayat', [RekomendasiController::class, 'riwayat'])
    ->middleware('auth')
    ->name('riwayat');
Route::get('/riwayat/download/{tanggal}/{nama}', 
    [RekomendasiController::class, 'download']
)->name('riwayat.download');
Route::delete('/riwayat/{tanggal}/{nama}', 
    [RekomendasiController::class, 'hapusRiwayat']
)->name('riwayat.hapus');

/// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard');

    // ========================
    // KELOLA MENU
    // ========================
    Route::get('/manage-menu', [AdminController::class, 'manageMenu'])
        ->name('admin.menu.index');

    Route::get('/manage-menu/create', [AdminController::class, 'createMenu'])
        ->name('admin.menu.create');

    Route::post('/manage-menu', [AdminController::class, 'storeMenu'])
        ->name('admin.menu.store');

    Route::get('/manage-menu/{id}/edit', [AdminController::class, 'editMenu'])
        ->name('admin.menu.edit');

    Route::put('/manage-menu/{id}', [AdminController::class, 'updateMenu'])
        ->name('admin.menu.update');

    Route::delete('/manage-menu/{id}', [AdminController::class, 'destroyMenu'])
        ->name('admin.menu.destroy');
});
