<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use Illuminate\Http\Request;

class MentorController extends Controller
{
    public function index()
    {
        $mentor = Mentor::all();

        return view('mentor.index', compact('mentor'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required|min:3|max:50',
                'bidang' => 'required',
            ],
            [
                'nama.required' => 'Nama Mahasiswa Wajib Diisi',
                'nama.min' => 'Nama Mahasiswa Minimal 3 Karakter',
                'nama.max' => 'Nama Mahasiswa Maksimal 50 Karakter',
                'bidang.required' => 'NIM Wajib Diisi',
            ]
        );

        $data = [
            'nama' => $request->input('nama'),
            'bidang' => $request->input('bidang'),
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
            ],
            [
                'nama.required' => 'Nama Mahasiswa Wajib Diisi',
                'nama.min' => 'Nama Mahasiswa Minimal 3 Karakter',
                'nama.max' => 'Nama Mahasiswa Maksimal 50 Karakter',
                'bidang.required' => 'NIM Wajib Diisi',
            ]
        );

        $data = [
            'nama' => $request->input('nama'),
            'bidang' => $request->input('bidang'),
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
