<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        $prodi = Prodi::all();
        $user = Auth::user();

        if($user->hasRole('mahasiswa'))  {
            return view('role.mahasiswa.index', compact('mahasiswa', 'prodi'));
        }

        return view('mahasiswa.index', compact('mahasiswa', 'prodi'));
    }
    

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required|min:3|max:50',
                'nim' => 'required|min:3|max:50',
                'prodi_id' => 'required|exists:prodis,id',
            ],
            [
                'nama.required' => 'Nama Mahasiswa Wajib Diisi',
                'nama.min' => 'Nama Mahasiswa Minimal 3 Karakter',
                'nama.max' => 'Nama Mahasiswa Maksimal 50 Karakter',
                'nim.required' => 'NIM Wajib Diisi',
                'nim.min' => 'NIM Minimal 3 Karakter',
                'nim.max' => 'NIM Maksimal 50 Karakter',
                'nim.unique' => 'NIM Sudah Terdaftar',
                'prodi_id.required' => 'Prodi Wajib Dipilih',
                'prodi_id.exists' => 'Prodi Tidak Valid',
            ]
        );

        $data = [
            'nim' => $request->input('nim'),
            'nama' => $request->input('nama'),
            'prodi_id' => $request->input('prodi_id'),
        ];

        Mahasiswa::create($data);
        return redirect()->route('dashboard-mahasiswa');
    }
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate(
            [
                'nama' => 'required|min:3|max:50',
                'nim' => 'required|min:3|max:50',
                'prodi_id' => 'required|exists:prodis,id',
            ],
            [
                'nama.required' => 'Nama Mahasiswa Wajib Diisi',
                'nama.min' => 'Nama Mahasiswa Minimal 3 Karakter',
                'nama.max' => 'Nama Mahasiswa Maksimal 50 Karakter',
                'nim.required' => 'NIM Wajib Diisi',
                'nim.min' => 'NIM Minimal 3 Karakter',
                'nim.max' => 'NIM Maksimal 50 Karakter',
                'nim.unique' => 'NIM Sudah Terdaftar',
                'prodi_id.required' => 'Prodi Wajib Dipilih',
                'prodi_id.exists' => 'Prodi Tidak Valid',
            ]
        );

        $data = [
            'nim' => $request->input('nim'),
            'nama' => $request->input('nama'),
            'prodi_id' => $request->input('prodi_id'),
        ];

        $mahasiswa->update($data);
        return redirect()->route('dashboard-mahasiswa');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('dashboard-mahasiswa');
    }
    
}
