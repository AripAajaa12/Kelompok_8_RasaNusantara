<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\FavoritController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ResepAdminController;
use App\Http\Controllers\Admin\KategoriAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\RatingAdminController;
use App\Http\Controllers\KategoriController;

// === HALAMAN PUBLIK ===
Route::get('/', fn() => view('index'))->name('beranda');
Route::get('/tentang', fn() => view('tentang'))->name('tentang');
Route::get('/kontak', fn() => view('kontak'))->name('kontak');

// Resep publik
Route::get('/resep', [ResepController::class, 'index'])->name('resep.index');
Route::get('/resep/{slug}', [ResepController::class, 'show'])->name('resep.show');
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('/kategori/{slug}', [ResepController::class, 'kategori'])->name('kategori.show');
Route::get('/pencarian', [ResepController::class, 'cari'])->name('pencarian');

// === AUTENTIKASI ===
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// === USER TERAUTENTIKASI ===
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Favorit
    Route::get('/favorit', [FavoritController::class, 'index'])->name('favorit.index');
    Route::post('/favorit', [FavoritController::class, 'store'])->name('favorit.store');
    Route::delete('/favorit/{id}', [FavoritController::class, 'destroy'])->name('favorit.destroy');

    // Rating & Ulasan
    Route::post('/rating', [RatingController::class, 'store'])->name('rating.store');
    Route::delete('/rating/{id}', [RatingController::class, 'destroy'])->name('rating.destroy');

    // Profil
    Route::get('/profil', [ProfilController::class, 'show'])->name('profil.show');
    Route::get('/profil/edit', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
});

// === ADMIN ===
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Kelola Resep
    Route::resource('resep', ResepAdminController::class);

    // Kelola Kategori
    Route::get('kategori', [KategoriAdminController::class, 'index'])->name('kategori.index');
    Route::post('kategori', [KategoriAdminController::class, 'store'])->name('kategori.store');
    Route::put('kategori/{kategori}', [KategoriAdminController::class, 'update'])->name('kategori.update');
    Route::delete('kategori/{kategori}', [KategoriAdminController::class, 'destroy'])->name('kategori.destroy');

    // Kelola Pengguna
    Route::get('pengguna', [UserAdminController::class, 'index'])->name('pengguna.index');
    Route::put('pengguna/{user}', [UserAdminController::class, 'update'])->name('pengguna.update');
    Route::delete('pengguna/{user}', [UserAdminController::class, 'destroy'])->name('pengguna.destroy');

    // Kelola Ulasan
    Route::get('ulasan', [RatingAdminController::class, 'index'])->name('ulasan.index');
    Route::delete('ulasan/{rating}', [RatingAdminController::class, 'destroy'])->name('ulasan.destroy');
    Route::patch('ulasan/{rating}/toggle', [RatingAdminController::class, 'toggleApprove'])->name('ulasan.toggle');

    // Statistik
    Route::get('statistik', function() {
        $resepTerpopuler = \App\Models\Resep::with('kategori')->orderByDesc('views')->limit(10)->get();
        $kategoriFavorit = \App\Models\Kategori::withCount('reseps')->orderByDesc('reseps_count')->get();
        $aktivitasUser   = \App\Models\User::withCount(['ratings','favoritReseps'])->orderByDesc('ratings_count')->limit(10)->get();
        return view('admin.statistik', compact('resepTerpopuler','kategoriFavorit','aktivitasUser'));
    })->name('statistik');
});
