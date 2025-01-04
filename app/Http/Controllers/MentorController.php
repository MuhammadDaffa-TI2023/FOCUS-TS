<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MentorController extends Controller
{
    public function index()
    {
        $mentor = Mentor::all();

        if(Auth::user()->hasRole('mentor'))  {
            return view('role.mentor.index', compact('mentor'));
        }

        return view('mentor.index', compact('mentor'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required|min:3|max:50',
                'bidang' => 'required',
                'email' => 'required|email|unique:users,email',
                'gambar' => 'nullable|file|mimes:jpg,jpeg,png|max:3048',
            ],
            [
                'nama.required' => 'Nama Mahasiswa Wajib Diisi',
                'nama.min' => 'Nama Mahasiswa Minimal 3 Karakter',
                'nama.max' => 'Nama Mahasiswa Maksimal 50 Karakter',
                'email.required' => 'Email Wajib Diisi',
                'email.email' => 'Email Tidak Valid',
                'email.unique' => 'Email Sudah Terdaftar',
                'bidang.required' => 'NIM Wajib Diisi',
            ]
        );

        // Simpan file jika ada
        $filePath = null;
        if ($request->hasFile('gambar')) {
            $filePath = $request->file('gambar')->store('uploads', 'public'); // Menyimpan file di folder storage/app/public/uploads
        }

        // Buat User baru
        $user = User::create([
            'name' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => Hash::make('password'), 
        ]);
        $user->assignRole('mentor');

        $data = [
            'nama' => $request->input('nama'),
            'bidang' => $request->input('bidang'),
            'email' => $request->input('email'),
            'user_id' => $user->id,
            'gambar' => $filePath,
        ];

        Mentor::create($data);
        return redirect()->route('dashboard-mentor');
    }
    public function update(Request $request, Mentor $mentor)
    {
        $request->validate(
            [
                'nama' => 'required|min:3|max:50',
                'bidang' => 'required',
                'email' => 'required|min:3',
                'gambar' => 'nullable|file|mimes:jpg,jpeg,png|max:3048',
            ],
            [
                'nama.required' => 'Nama Mahasiswa Wajib Diisi',
                'nama.min' => 'Nama Mahasiswa Minimal 3 Karakter',
                'nama.max' => 'Nama Mahasiswa Maksimal 50 Karakter',
                'email.required' => 'Email Wajib Diisi',
                'email.email' => 'Email Tidak Valid',
                'email.unique' => 'Email Sudah Terdaftar',
                'nim.required' => 'NIM Wajib Diisi',
                'bidang.required' => 'NIM Wajib Diisi',
            ]
        );

        $filePath = $mentor->gambar;
        if ($request->hasFile('gambar')) {
            // Hapus file lama jika ada
            if ($filePath) {
                Storage::delete('public/' . $filePath);
            }
            // Simpan file baru
            $filePath = $request->file('gambar')->store('uploads', 'public');
        }

        $mentor->user->update([
            'name' => $request->input('nama'),
            'email' => $request->input('email'),
        ]);


        $data = [
            'nama' => $request->input('nama'),
            'bidang' => $request->input('bidang'),
            'email' => $request->input('email'),
            'gambar' => $filePath,
        ];

        $mentor->update($data);
        return redirect()->route('dashboard-mentor');
    }

    public function destroy(Mentor $mentor)
    {
        $mentor->delete();
        return redirect()->route('dashboard-mentor');
    }
}
