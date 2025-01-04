<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    public function index()
    {
        $dosen = Dosen::all();
        $fakultas = Fakultas::all();

        if(Auth::user()->hasRole('dosen'))  {
            return view('role.dosen.index', compact('dosen', 'fakultas'));
        }

        return view('dosen.index', compact('dosen', 'fakultas'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required|min:3',
                'nip' => 'required|min:3|max:50',
                'fakultas_id' => 'required|exists:fakultas,id',
            ],
            [
                'nama.required' => 'Nama Dosen Wajib Diisi',
                'nama.min' => 'Nama Dosen Minimal 3 Karakter',
                'email.required' => 'Email Wajib Diisi',
                'email.email' => 'Email Tidak Valid',
                'email.unique' => 'Email Sudah Terdaftar',
                'nip.required' => 'NIP Wajib Diisi',
                'nip.min' => 'NIP Minimal 3 Karakter',
                'nip.max' => 'NIP Maksimal 50 Karakter',
                'nip.unique' => 'NIP Sudah Terdaftar',
                'fakultas_id.required' => 'Fakultas Wajib Dipilih',
                'fakultas_id.exists' => 'Fakultas Tidak Valid',
            ]
        );

        // Buat User baru
        $user = User::create([
            'name' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => Hash::make('password'), 
        ]);
        // Berikan role mahasiswa
        $user->assignRole('dosen');

        $data = [
            'nip' => $request->input('nip'),
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'fakultas_id' => $request->input('fakultas_id'),
            'user_id' => $user->id,
        ];

        
        Dosen::create($data);
        return redirect()->route('dashboard-dosen');
    }
    public function update(Request $request, Dosen $dosen)
    {
        $request->validate(
            [
                'nama' => 'required|min:3',
                'email' => 'required|min:3',
                'nip' => 'required|min:3|max:50',
                'fakultas_id' => 'required|exists:fakultas,id',
            ],
            [
                'nama.required' => 'Nama Dosen Wajib Diisi',
                'nama.min' => 'Nama Dosen Minimal 3 Karakter',
                'email.required' => 'Email Wajib Diisi',
                'email.email' => 'Email Tidak Valid',
                'email.unique' => 'Email Sudah Terdaftar',
                'nip.required' => 'NIP Wajib Diisi',
                'nip.min' => 'NIP Minimal 3 Karakter',
                'nip.max' => 'NIP Maksimal 50 Karakter',
                'nip.unique' => 'NIP Sudah Terdaftar',
                'fakultas_id.required' => 'Fakultas Wajib Dipilih',
                'fakultas_id.exists' => 'Fakultas Tidak Valid',
            ]
        );

        // Perbarui data User terkait
        $dosen->user->update([
            'name' => $request->input('nama'),
            'email' => $request->input('email'),
        ]);

        $data = [
            'nip' => $request->input('nip'),
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'fakultas_id' => $request->input('fakultas_id'),
        ];

        $dosen->update($data);
        return redirect()->route('dashboard-dosen');
    }
    public function destroy(Dosen $dosen)
    {
        $dosen->delete();
        return redirect()->route('dashboard-dosen');
    }
}
