<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    public function index()
    {
        $fakultas = Fakultas::all();

        return view('fakultas.index', compact('fakultas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            ]);

        $data = [
            'nama' => $request->input('nama'),
        ];

        Fakultas::create($data);
        return redirect()->route('dashboard-fakultas');
    }

    public function update(Request $request, Fakultas $fakultas)
    {
        $request->validate([
            'nama' => 'required|min:3|max:50',
        ],
        [
            'nama.required' => 'Nama Fakultas Wajib Diisi',
            'nama.min' => 'Nama Fakultas Minimal 3 Karakter',
            'nama.max' => 'Nama Fakultas Maximal 50 Karakter',
        ]);

        $data = [
            'nama' => $request->input('nama'),
        ];
        
        $fakultas->update($data);
        return redirect()->route('dashboard-fakultas');
    }

    public function destroy(Fakultas $fakultas)
    {
        $fakultas->delete();
        return redirect()->route('dashboard-fakultas');
    }
}
