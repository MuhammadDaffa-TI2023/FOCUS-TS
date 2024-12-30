<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
    public function index () {
        $dokumen = Dokumen::all();
        return view('dokumen.index', compact('dokumen'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama' => 'required',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx|max:5048'
        ]);

        // Simpan file jika ada
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads', 'public'); // Menyimpan file di folder storage/app/public/uploads
        }

        Dokumen::create([
            'nama' => $request->nama,
            'file' => $filePath,
        ]);

        return redirect()->route('dashboard-dokumen');

    }

    public function update(Request $request, Dokumen $dokumen) {
        $request->validate([
            'nama' => 'required',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx|max:5048'
        ]);

        $filePath = $dokumen->file; 
        if ($request->hasFile('file')) {
            if ($filePath) {
                Storage::delete('public/' . $filePath);
            }
            // Simpan file baru
            $filePath = $request->file('file')->store('uploads', 'public');
        }

        $dokumen->update([
            'nama' => $request->nama,
            'file' => $filePath,
        ]);

        return redirect()->route('dashboard-dokumen');

    }

    public function destroy(Dokumen $dokumen){
        $dokumen->delete();
        return redirect()->route('dashboard-dokumen');
    }
}
