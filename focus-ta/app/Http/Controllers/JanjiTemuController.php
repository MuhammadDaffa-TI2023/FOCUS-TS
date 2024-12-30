<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\JanjiTemu;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class JanjiTemuController extends Controller
{
    public function index() {
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
