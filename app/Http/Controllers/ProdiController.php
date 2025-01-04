<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prodi = Prodi::all();

        return view('prodi.index', compact('prodi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            ]);

        $data = [
            'nama' => $request->input('nama'),
        ];

        Prodi::create($data);
        return redirect()->route('dashboard-prodi');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prodi $prodi)
    {
        $request->validate([
            'nama' => 'required|min:3|max:50',
        ],
        [
            'nama.required' => 'Nama Prodi Wajib Diisi',
            'nama.min' => 'Nama Prodi Minimal 3 Karakter',
            'nama.max' => 'Nama Prodi Maximal 50 Karakter',
        ]);

        $data = [
            'nama' => $request->input('nama'),
        ];
        
        $prodi->update($data);
        return redirect()->route('dashboard-prodi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prodi $prodi)
    {
        $prodi->delete();
        return redirect()->route('dashboard-prodi');
    }
}
