<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        $dosen = Dosen::all();
        $fakultas = Fakultas::all();

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
                'nip.required' => 'NIP Wajib Diisi',
                'nip.min' => 'NIP Minimal 3 Karakter',
                'nip.max' => 'NIP Maksimal 50 Karakter',
                'nip.unique' => 'NIP Sudah Terdaftar',
                'fakultas_id.required' => 'Fakultas Wajib Dipilih',
                'fakultas_id.exists' => 'Fakultas Tidak Valid',
            ]
        );

        $data = [
            'nip' => $request->input('nip'),
            'nama' => $request->input('nama'),
            'fakultas_id' => $request->input('fakultas_id'),
        ];

        Dosen::create($data);
        return redirect()->route('dashboard-dosen');
    }
    public function update(Request $request, Dosen $dosen)
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
                'nip.required' => 'NIP Wajib Diisi',
                'nip.min' => 'NIP Minimal 3 Karakter',
                'nip.max' => 'NIP Maksimal 50 Karakter',
                'nip.unique' => 'NIP Sudah Terdaftar',
                'fakultas_id.required' => 'Fakultas Wajib Dipilih',
                'fakultas_id.exists' => 'Fakultas Tidak Valid',
            ]
        );

        $data = [
            'nip' => $request->input('nip'),
            'nama' => $request->input('nama'),
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
