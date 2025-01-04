<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Materi;
use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class BerandaController extends Controller
{
    public function index() {
        $jumlahMahasiswa = Mahasiswa::count();
        $jumlahMateri = Materi::count();
        $jumlahMentor = Mentor::all();

        if (Route::currentRouteName() == 'beranda-about') {
            // Jika route adalah 'beranda-about', kembalikan tampilan 'about'
            return view('about', compact('jumlahMahasiswa', 'jumlahMateri', 'jumlahMentor'));
        }
        if (Route::currentRouteName() == 'beranda-mentor') {
            // Jika route adalah 'beranda-about', kembalikan tampilan 'about'
            return view('mentor', compact('jumlahMahasiswa', 'jumlahMateri', 'jumlahMentor'));
        }

        // Mengirim jumlah mahasiswa ke view
        return view('beranda', compact('jumlahMahasiswa', 'jumlahMateri', 'jumlahMentor'));
    }
}
