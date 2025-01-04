<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\JanjiTemu;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JanjiTemuController extends Controller
{
    public function index() {
        $user = Auth::user();
    
        // Jika pengguna adalah mahasiswa
        if ($user->hasRole('mahasiswa')) {
            $mahasiswa = Mahasiswa::where('user_id', $user->id)->first(); // Cari mahasiswa berdasarkan user_id
            // if (!$mahasiswa) {
            //     return redirect()->route('mahasiswa');
            // }
        
            // Filter janji temu berdasarkan mahasiswa yang login
            $janjitemu = JanjiTemu::where('mahasiswa_id', $mahasiswa->id)->paginate(5);
            $dosen = Dosen::all(); // Tambahkan ini agar variabel $dosen tersedia
            return view('role.mahasiswa.janji-temu', compact('janjitemu', 'mahasiswa', 'dosen'));
        }
    
        // Jika pengguna adalah dosen
        if ($user->hasRole('dosen')) {
            $dosen = Dosen::where('user_id', $user->id)->first(); // Cari dosen berdasarkan user_id
            if (!$dosen) {
                return redirect()->route('dosen');
            }
    
            // Filter janji temu berdasarkan dosen yang login
            $janjitemu = JanjiTemu::where('dosen_id', $dosen->id)->paginate(5);
            return view('role.dosen.janji-temu', compact('janjitemu', 'dosen'));
        }
    
        // Default untuk admin atau peran lain
        $janjitemu = JanjiTemu::paginate(5);
        $dosen = Dosen::all();
        $mahasiswa = Mahasiswa::all();
        return view('janjiTemu.index', compact('janjitemu', 'dosen', 'mahasiswa'));
    }
    

    public function search(Request $request)
    {
        $search = $request->input('search');
        $dosen = Dosen::all();
        $mahasiswa = Mahasiswa::all();

        $janjitemu = JanjiTemu::where('tanggal', 'like', "%$search%")
            ->orWhere('jam', 'like', "%$search%")
            ->orWhereHas('dosen', function ($query) use ($search) {
                $query->where('nama', 'like', "%$search%");
            })
            ->orWhereHas('mahasiswa', function ($query) use ($search) {
                $query->where('nama', 'like', "%$search%");
            })
            ->paginate(5); 

    if ($janjitemu->isEmpty()) {
        $message = 'Data Janji Temu ' . $search . ' tidak ditemukan';
    } else {
        $message = null; 
    }

        return view('janjiTemu.index', compact('mahasiswa','dosen','janjitemu', 'message'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->hasRole('mahasiswa')) {
            $mahasiswa = $user->mahasiswa; // Pastikan relasi di model User ke Mahasiswa sudah benar

            // Validasi input
            $request->validate([
                'tanggal' => 'required|date',
                'jam' => 'required',
                'dosen_id' => 'required|exists:dosen,id',
            ]);

            // Buat janji temu
            JanjiTemu::create([
                'tanggal' => $request->input('tanggal'),
                'jam' => $request->input('jam'),
                'dosen_id' => $request->input('dosen_id'),
                'mahasiswa_id' => $mahasiswa->id, // Otomatis ambil dari data mahasiswa login
                'status' => 'Proses', // Status default adalah Proses
            ]);

            return redirect()->route('mahasiswa-janjitemu');
        }


        // Validasi data
        $request->validate([
            'tanggal' => 'required|date',
            'jam' => 'required',
            'dosen_id' => 'required|exists:dosen,id',
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'status' => 'required|in:Proses,Setuju,Tolak',
        ]);
    
       JanjiTemu::create([
            'tanggal' => $request->input('tanggal'),
            'jam' => $request->input('jam'),
            'dosen_id' => $request->input('dosen_id'),
            'mahasiswa_id' => $request->input('mahasiswa_id'),
            'status' => $request->input('status'),
        ]);
    
    
        // Redirect dengan pesan sukses
        return redirect()->route('dashboard-janjiTemu');
    }


    public function update(Request $request, JanjiTemu $janjiTemu)
    {
        $user = Auth::user();

        if ($user->hasRole('mahasiswa')) {
            // Validasi khusus mahasiswa
            $request->validate([
                'tanggal' => 'required|date',
                'jam' => 'required',
                'dosen_id' => 'required|exists:dosen,id',
            ]);

            $status = 'Proses';

            // Data yang dapat diperbarui oleh mahasiswa
            $janjiTemu->update([
                'tanggal' => $request->input('tanggal'),
                'jam' => $request->input('jam'),
                'status' => $status,
                'dosen_id' => $request->input('dosen_id'),
            ]);

            return redirect()->route('mahasiswa-janjitemu');
        }
        if ($user->hasRole('dosen')) {
            // Validasi khusus mahasiswa
            $request->validate([
                'status' => 'required',
            ]);

            // Data yang dapat diperbarui oleh mahasiswa
            $janjiTemu->update([
                'status' => $request->input('status'),
            ]);

            return redirect()->route('dosen-janjitemu');
        }

        // Validasi data
        $request->validate([
            'tanggal' => 'required|date',
            'jam' => 'required',
            'dosen_id' => 'required|exists:dosen,id',
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'status' => 'required|in:Proses,Setuju,Tolak',
        ]);
    
       $janjiTemu->update([
            'tanggal' => $request->input('tanggal'),
            'jam' => $request->input('jam'),
            'dosen_id' => $request->input('dosen_id'),
            'mahasiswa_id' => $request->input('mahasiswa_id'),
            'status' => $request->input('status'),
        ]);
    
    
        return redirect()->route('dashboard-janjiTemu');
    }
    
    public function destroy(JanjiTemu $janjiTemu) {
        $janjiTemu->delete();
        return redirect()->route('dashboard-janjiTemu');
    }
}
