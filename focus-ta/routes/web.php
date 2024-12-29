<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\ProfileController;
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
    
    // Admin
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard-admin');

    // Prodi
    Route::get('/dashboard/prodi', [ProdiController::class, 'index'])->name('dashboard-prodi');
    Route::post('/dashboard/prodi', [ProdiController::class, "store"])->name('add-prodi');
    Route::put('/prodi/{prodi}', [ProdiController::class, "update"])->name('edit-prodi');
    Route::delete('/prodi/{prodi}', [ProdiController::class, "destroy"])->name('delete-prodi');

    // Fakultas
    Route::get('/dashboard/fakultas', [FakultasController::class, 'index'])->name('dashboard-fakultas');
    Route::post('/dashboard/fakultas', [FakultasController::class, "store"])->name('add-fakultas');
    Route::put('/fakultas/{fakultas}', [FakultasController::class, "update"])->name('edit-fakultas');
    Route::delete('/fakultas/{fakultas}', [FakultasController::class, "destroy"])->name('delete-fakultas');

    // mahasiswa
    Route::get('/dashboard/mahasiswa', [MahasiswaController::class, "index"])->name('dashboard-mahasiswa');
    Route::post('/dashboard/mahasiswa', [MahasiswaController::class, "store"])->name('add-mahasiswa');
    Route::put('/dashboard/mahasiswa/{mahasiswa}', [MahasiswaController::class, "update"])->name('edit-mahasiswa');
    Route::delete('/dashboard/mahasiswa/{mahasiswa}', [MahasiswaController::class, "destroy"])->name('delete-mahasiswa');
    Route::get('/dashboard/mahasiswa/{id}/detail', [MahasiswaController::class, 'show'])->name('detail-mahasiswa');

    // mahasiswa
    Route::get('/dashboard/dosen', [DosenController::class, "index"])->name('dashboard-dosen');
    Route::post('/dashboard/dosen', [DosenController::class, "store"])->name('add-dosen');
    Route::put('/dashboard/dosen/{dosen}', [DosenController::class, "update"])->name('edit-dosen');
    Route::delete('/dashboard/dosen/{dosen}', [DosenController::class, "destroy"])->name('delete-dosen');
    Route::get('/dashboard/dosen/{id}/detail', [DosenController::class, 'show'])->name('detail-dosen');

    // mentor
    Route::get('/dashboard/mentor', [MentorController::class, "index"])->name('dashboard-mentor');
    Route::post('/dashboard/mentor', [MentorController::class, "store"])->name('add-mentor');
    Route::put('/dashboard/mentor/{mentor}', [MentorController::class, "update"])->name('edit-mentor');
    Route::delete('/dashboard/mentor/{mentor}', [MentorController::class, "destroy"])->name('delete-mentor');
    Route::get('/dashboard/mentor/{id}/detail', [MentorController::class, 'show'])->name('detail-mentor');

});

require __DIR__.'/auth.php';
