<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\TransaksiUserController;
use App\Http\Controllers\Admin\Jenis_jasaController;
use App\Http\Controllers\Admin\LaporanAdminController;
use App\Http\Controllers\Admin\KasirTransaksiController;
use App\Http\Controllers\Admin\TransaksiAdminController;
use App\Http\Controllers\WelcomeController; // Asumsi ada controller untuk homepage


// Homepage
Route::get('/', function () {
    return view('landing.index');
})->name('landing');
Route::get('/about', [LandingController::class, 'about'])->name('about');
Route::get('/services', [LandingController::class, 'services'])->name('services');
Route::get('/contact', [LandingController::class, 'contact'])->name('contact');


// Autentikasi User
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');


// Autentikasi Admin (asumsi admin login di URL berbeda)
Route::prefix('admin')->group(function () {
    Route::get('login', [AuthAdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AuthAdminController::class, 'login']);
    // Logout Admin akan berada di dalam middleware 'auth:admin'
});



Route::middleware(['auth'])->group(function () {
    // Dashboard Pengguna
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

    // Profil Pengguna
    Route::get('/profile', [UserController::class, 'showProfile'])->name('user.profile.update');
    Route::put('/profile', [UserController::class, 'update']);

    // Transaksi Pengguna
    // Resource hanya untuk 'index', 'create', 'store', dan 'show'
    Route::resource('transaksi', TransaksiUserController::class)->only([
        'index',
        'create',
        'store',
        'show'
    ])->names('user.transaksi');
});



Route::prefix('admin')->middleware(['auth:admin'])->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Logout Admin
    Route::post('/logout', [AuthAdminController::class, 'logout'])->name('admin.logout');

    // Pengelolaan Jenis Jasa (CRUD Penuh)
    Route::resource('jenis-jasa', Jenis_jasaController::class)->names('admin.jenis_jasa');

    // Pengelolaan Transaksi (CRUD Penuh + Ubah Status)
    Route::resource('transaksi', TransaksiAdminController::class)->names('admin.transaksi');
    Route::patch('transaksi/{transaksi}/status', [TransaksiAdminController::class, 'updateStatus'])->name('admin.transaksi.update_status');
    Route::get(
        '/admin/transaksi/{id}/cetak',
        [TransaksiAdminController::class, 'cetak']
    )->name('admin.transaksi.cetak');

    Route::prefix('kasir')->group(function () {
        Route::get('/create', [KasirTransaksiController::class, 'create'])->name('admin.kasir.create');
        Route::post('/store', [KasirTransaksiController::class, 'store'])->name('admin.kasir.store');
    });


    // Laporan
    Route::get('laporan', [LaporanAdminController::class, 'index'])->name('admin.laporan.index');
    Route::get('laporan/cetak', [LaporanAdminController::class, 'generatePdf'])->name('admin.laporan.generate'); // Untuk men-download/menampilkan laporan

    Route::resource('user_admin', AdminController::class)->names('admin.user_admin');
    
});
