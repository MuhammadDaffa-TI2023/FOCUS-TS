<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\JanjiTemuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Mentor;
use Illuminate\Support\Facades\Route;

Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/beranda/about', [BerandaController::class, 'index'])->name('beranda-about');
Route::get('/beranda/mentor', [BerandaController::class, 'index'])->name('beranda-mentor');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ROLE MAHASISWA
Route::middleware(['auth', 'role:mahasiswa'])->group( function() {
    // dashboard
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa');
    Route::get('/mahasiswa/dokumen', [DokumenController::class, 'index'])->name('mahasiswa-dokumen');
    Route::post('/mahasiswa/dokumen', [DokumenController::class, "store"])->name('add-dokumen-mhs');
    Route::put('/mahasiswa/dokumen/{dokumen}', [DokumenController::class, "update"])->name('edit-dokumen-mhs');
    Route::delete('/mahasiswa/dokumen/{dokumen}', [DokumenController::class, "destroy"])->name('delete-dokumen-mhs');

    // Janji Temu
    Route::get('/mahasiswa/janji-temu', [JanjiTemuController::class, "index"])->name('mahasiswa-janjitemu');
    Route::get('/mahasiswa/janji-temu/search', [JanjiTemuController::class, "search"])->name('search-janjitemu-mhs');
    Route::post('/mahasiswa/janji-temu', [JanjiTemuController::class, "store"])->name('add-janjitemu-mhs');
    Route::put('/mahasiswa/janji-temu/{janjiTemu}', [JanjiTemuController::class, "update"])->name('edit-janjitemu-mhs');
    Route::delete('/mahasiswa/janji-temu/{janjiTemu}', [JanjiTemuController::class, "destroy"])->name('delete-janjitemu-mhs');

    // Materi
    Route::get('/mahasiswa/materi', [MateriController::class, 'index'])->name('mahasiswa-materi');
});

// ROLE DOSEN
Route::middleware(['auth', 'role:dosen'])->group( function() {
    // dashboard
    Route::get('/dosen', [DosenController::class, 'index'])->name('dosen');
    Route::get('/dosen/dokumen', [DokumenController::class, 'index'])->name('dosen-dokumen');
    Route::put('/dosen/dokumen/{dokumen}', [DokumenController::class, "update2"])->name('edit-dokumen-dosen');

    // Janji Temu
    Route::get('/dosen/janji-temu', [JanjiTemuController::class, "index"])->name('dosen-janjitemu');
    Route::get('/dosen/janji-temu/search', [JanjiTemuController::class, "search"])->name('search-janjitemu-dosen');
    Route::post('/dosen/janji-temu', [JanjiTemuController::class, "store"])->name('add-janjitemu-dosen');
    Route::put('/dosen/janji-temu/{janjiTemu}', [JanjiTemuController::class, "update"])->name('edit-janjitemu-dosen');
    Route::delete('/dosen/janji-temu/{janjiTemu}', [JanjiTemuController::class, "destroy"])->name('delete-janjitemu-dosen');

    // Materi
    Route::get('/dosen/materi', [MateriController::class, 'index'])->name('dosen-materi');
    Route::post('/dosen/materi', [MateriController::class, "store"])->name('add-materi-dosen');
    Route::put('/dosen/materi/{materi}', [MateriController::class, "update"])->name('edit-materi-dosen');
    Route::delete('/dosen/materi/{materi}', [MateriController::class, "destroy"])->name('delete-materi-dosen');
});
// ROLE MENTOR
Route::middleware(['auth', 'role:mentor'])->group( function() {
    // dashboard
    Route::get('/mentor', [MentorController::class, 'index'])->name('mentor');
    // Materi
    Route::get('/mentor/materi', [MateriController::class, 'index'])->name('mentor-materi');
    Route::post('/mentor/materi', [MateriController::class, "store"])->name('add-materi-mentor');
    Route::put('/mentor/materi/{materi}', [MateriController::class, "update"])->name('edit-materi-mentor');
    Route::delete('/mentor/materi/{materi}', [MateriController::class, "destroy"])->name('delete-materi-mentor');
});


// ROLE ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Admin
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard-admin');

    // Users
    Route::get('/dashboard/users', [UserController::class, 'index'])->name('dashboard-user');
    Route::post('/dashboard/users', [UserController::class, "store"])->name('add-user');
    Route::put('/users/{user}', [UserController::class, "update"])->name('edit-user');
    Route::delete('/users/{user}', [UserController::class, "destroy"])->name('delete-user');

    // Prodi
    Route::get('/dashboard/prodi', [ProdiController::class, 'index'])->name('dashboard-prodi');
    Route::post('/dashboard/prodi', [ProdiController::class, "store"])->name('add-prodi');
    Route::put('/prodi/{prodi}', [ProdiController::class, "update"])->name('edit-prodi');
    Route::delete('/prodi/{prodi}', [ProdiController::class, "destroy"])->name('delete-prodi');

    // Kategori
    Route::get('/dashboard/kategori', [KategoriController::class, 'index'])->name('dashboard-kategori');
    Route::post('/dashboard/kategori', [KategoriController::class, "store"])->name('add-kategori');
    Route::put('/kategori/{kategori}', [KategoriController::class, "update"])->name('edit-kategori');
    Route::delete('/kategori/{kategori}', [KategoriController::class, "destroy"])->name('delete-kategori');
    
    // Dokumen
    Route::get('/dashboard/dokumen', [DokumenController::class, 'index'])->name('dashboard-dokumen');
    Route::post('/dashboard/dokumen', [DokumenController::class, "store"])->name('add-dokumen');
    Route::put('/dokumen/{dokumen}', [DokumenController::class, "update"])->name('edit-dokumen');
    Route::delete('/dokumen/{dokumen}', [DokumenController::class, "destroy"])->name('delete-dokumen');
    
    // Materi
    Route::get('/dashboard/materi', [MateriController::class, 'index'])->name('dashboard-materi');
    Route::post('/dashboard/materi', [MateriController::class, "store"])->name('add-materi');
    Route::put('/materi/{materi}', [MateriController::class, "update"])->name('edit-materi');
    Route::delete('/materi/{materi}', [MateriController::class, "destroy"])->name('delete-materi');

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

    // mahasiswa
    Route::get('/dashboard/dosen', [DosenController::class, "index"])->name('dashboard-dosen');
    Route::post('/dashboard/dosen', [DosenController::class, "store"])->name('add-dosen');
    Route::put('/dashboard/dosen/{dosen}', [DosenController::class, "update"])->name('edit-dosen');
    Route::delete('/dashboard/dosen/{dosen}', [DosenController::class, "destroy"])->name('delete-dosen');

    // mentor
    Route::get('/dashboard/mentor', [MentorController::class, "index"])->name('dashboard-mentor');
    Route::post('/dashboard/mentor', [MentorController::class, "store"])->name('add-mentor');
    Route::put('/dashboard/mentor/{mentor}', [MentorController::class, "update"])->name('edit-mentor');
    Route::delete('/dashboard/mentor/{mentor}', [MentorController::class, "destroy"])->name('delete-mentor');
    
    // Janji Temu
    Route::get('/dashboard/janji-temu', [JanjiTemuController::class, "index"])->name('dashboard-janjiTemu');
    Route::get('/dashboard/janji-temu/search', [JanjiTemuController::class, "search"])->name('search-janjiTemu');
    Route::post('/dashboard/janji-temu', [JanjiTemuController::class, "store"])->name('add-janjiTemu');
    Route::put('/dashboard/janji-temu/{janjiTemu}', [JanjiTemuController::class, "update"])->name('edit-janjiTemu');
    Route::delete('/dashboard/janji-temu/{janjiTemu}', [JanjiTemuController::class, "destroy"])->name('delete-janjiTemu');

});

require __DIR__.'/auth.php';
