<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::all();

        return view('kategori.index', compact('kategori'));
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

        Kategori::create($data);
        return redirect()->route('dashboard-kategori');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama' => 'required|min:3',
        ],
        [
            'nama.required' => 'Nama kategori Wajib Diisi',
            'nama.min' => 'Nama kategori Minimal 3 Karakter',
        ]);

        $data = [
            'nama' => $request->input('nama'),
        ];
        
        $kategori->update($data);
        return redirect()->route('dashboard-kategori');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->route('dashboard-kategori');
    }
}
