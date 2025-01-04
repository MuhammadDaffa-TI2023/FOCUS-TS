<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
    public function index () {
        $user = Auth::user();
        $dokumen = Dokumen::all();
        $dosen = Dosen::all();
        
        // dd($dokumen);
        if($user->hasRole('mahasiswa')) {
            $dokumen = Dokumen::where('user_id', $user->id)->get();
            return view('role.mahasiswa.dokumen', compact('dokumen', 'dosen'));
        }
        if($user->hasRole('dosen')) {
            // Ambil data dosen yang sesuai dengan user id (misalnya)
            $dosen = Dosen::where('user_id', $user->id)->first(); // atau Dosen::find($user->id);
            
            // Cek jika $dosen ditemukan
            if ($dosen) {
                $dokumen = Dokumen::where('dosen_id', $dosen->id)->get();
                return view('role.dosen.dokumen', compact('dokumen', 'dosen'));
            } 
        }


        return view('dokumen.index', compact('dokumen', 'dosen'));
    }

    public function store(Request $request) {

        $user = Auth::user();

        $request->validate([
            'keterangan' => 'nullable',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx|max:5048',
            'status' => 'nullable|in:Setuju,Revisi,Proses',
            'keterangan_dosen' => 'nullable|string',
            'dosen_id' => 'required|exists:dosen,id',
        ]);

        // Simpan file jika ada
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads', 'public'); // Menyimpan file di folder storage/app/public/uploads
        }

        $status = $user->hasRole('mahasiswa') ? 'Proses' : $request->status;
        $keterangan = null;
        if ($user->hasRole('admin') || $user->hasRole('mahasiswa')) {
            $keterangan = $request->keterangan;
        }
        $keteranganDosen = null;
        if ($user->hasRole('dosen')) {
            $keterangan = $request->keterangan;
        }

        Dokumen::create([
            'keterangan' => $keterangan,
            'keterangan_dosen' => $keteranganDosen,
            'status' => $status,
            'dosen_id' => $request->dosen_id,
            'user_id' => $user->id,
            'file' => $filePath,
        ]);

        if($user->hasRole('mahasiswa')) {
            return redirect()->route('mahasiswa-dokumen');
        }

        return redirect()->route('dashboard-dokumen');

    }

    public function update(Request $request, Dokumen $dokumen)
    {

        $user = Auth::user();
        // Validasi input
        $request->validate([
            'keterangan' => 'nullable',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx|max:5048',
            'status' => 'nullable|in:Setuju,Revisi,Proses',
            'dosen_id' => 'required|exists:dosen,id',
        ]);

        // Menyimpan file jika ada
        $filePath = $dokumen->file;
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($filePath) {
                Storage::delete('public/' . $filePath);
            }
            // Simpan file baru
            $filePath = $request->file('file')->store('uploads', 'public');
        }
        $status = $user->hasRole('mahasiswa') ? 'Proses' : $request->status;

        // Update dokumen, pastikan user_id selalu sesuai dengan user yang login
        $dokumen->update([
            'keterangan' => $request->keterangan,
            'dosen_id' => $request->dosen_id,
            'status' => $status,
            'file' => $filePath,
        ]);

        if($user->hasRole('mahasiswa')) {
            return redirect()->route('mahasiswa-dokumen');
        }

        // Redirect ke halaman dokumen
        return redirect()->route('dashboard-dokumen');
    }
    public function update2(Request $request, Dokumen $dokumen)
    {

        $user = Auth::user();
        // Validasi input
        $request->validate([
            'keterangan_dosen' => 'nullable',
            'status' => 'nullable|in:Setuju,Revisi,Proses',
        ]);

        // Menyimpan file jika ada
        $filePath = $dokumen->file;
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($filePath) {
                Storage::delete('public/' . $filePath);
            }
            // Simpan file baru
            $filePath = $request->file('file')->store('uploads', 'public');
        }
        
        $dataDosen = $dokumen->dosen_id;

        // Update dokumen, pastikan user_id selalu sesuai dengan user yang login
        $dokumen->update([
            'keterangan_dosen' => $request->keterangan_dosen,
            'status' => $request->status,
        ]);

        if($user->hasRole('dosen')) {
            return redirect()->route('dosen-dokumen');
        }

        // Redirect ke halaman dokumen
        return redirect()->route('dashboard-dokumen');
    }


    public function destroy(Dokumen $dokumen){
        $dokumen->delete();

        if(Auth::user()->hasRole('mahasiswa')) {
            return redirect()->route('mahasiswa-dokumen');
        }
        return redirect()->route('dashboard-dokumen');
    }
}
