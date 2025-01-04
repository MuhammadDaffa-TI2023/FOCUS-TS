<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index()
    {
        $materi = Materi::all();
        $kategori = Kategori::all();

        if(Auth::user()->hasRole('mahasiswa'))  {
            return view('role.mahasiswa.materi', compact('materi', 'kategori'));
        }
        if(Auth::user()->hasRole('dosen'))  {
            return view('role.dosen.materi', compact('materi', 'kategori'));
        }
        if(Auth::user()->hasRole('mentor'))  {
            return view('role.mentor.materi', compact('materi', 'kategori'));
        }

        return view('materi.index', compact('materi', 'kategori'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama' => 'required',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx',
            'kategori_id' => 'required|exists:kategori,id',
        ]);

        // Simpan file jika ada
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads', 'public'); // Menyimpan file di folder storage/app/public/uploads
        }


        Materi::create([
            'nama' => $request->nama,
            'tanggal' => now(),
            'kategori_id' => $request->kategori_id,
            'user_id' => $user->id,
            'file' => $filePath,
        ]);

        if(Auth::user()->hasRole('dosen'))  {
            return redirect()->route('dosen-materi');
        }
        if(Auth::user()->hasRole('mentor'))  {
            return redirect()->route('mentor-materi');
        }

        return redirect()->route('dashboard-materi');
    }
    public function update(Request $request, Materi $materi)
    {
        $user = Auth::user();

        $request->validate([
            'nama' => 'required',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx',
            'kategori_id' => 'required|exists:kategori,id',
        ]);

        // Menyimpan file jika ada
        $filePath = $materi->file;
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($filePath) {
                Storage::delete('public/' . $filePath);
            }
            // Simpan file baru
            $filePath = $request->file('file')->store('uploads', 'public');
        }


        $materi->update([
            'nama' => $request->nama,
            'tanggal' => now(),
            'kategori_id' => $request->kategori_id,
            'user_id' => $user->id,
            'file' => $filePath,
        ]);

        if(Auth::user()->hasRole('dosen'))  {
            return redirect()->route('dosen-materi');
        }
        if(Auth::user()->hasRole('mentor'))  {
            return redirect()->route('mentor-materi');
        }

        return redirect()->route('dashboard-materi');
    }
    public function destroy(Request $request, Materi $materi)
    {
        $user = Auth::user();

        if(Auth::user()->hasRole('dosen'))  {
            if ($materi->user_id !== $user->id) {
                return redirect()->route('dosen-materi');
            }
        }
        if ($user->hasRole('mentor')) {
            if ($materi->user_id != $user->id) {
                // Jika materi bukan milik user yang login, arahkan ke halaman materi mentor
                return redirect()->route('mentor-materi')->with('error', 'Anda tidak memiliki hak untuk menghapus materi ini.');
            }
    
            // Hapus materi jika benar milik user yang login
            $materi->delete();
    
            // Redirect dengan pesan sukses
            return redirect()->route('mentor-materi')->with('success', 'Materi berhasil dihapus.');
        }
        // Hapus materi
        $materi->delete();

        return redirect()->route('dashboard-materi');
    }
}
