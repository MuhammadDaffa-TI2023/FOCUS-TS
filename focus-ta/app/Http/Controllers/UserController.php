<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $users = User::all();

        return view('user.index', compact('users'));
    }

    public function store(Request $request) {
        // Validasi input
        $request->validate([
            'username' => 'required|unique:users,name',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|array',
            'role.*' => 'exists:roles,name', // Pastikan role yang dipilih ada
        ]);

        // Membuat user baru
        $user = new User();
        $user->name = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        // Menetapkan role pada user
        $user->syncRoles($request->input('role'));

        // Redirect atau kembali ke halaman daftar user
        return redirect()->route('dashboard-user');
    }
    public function update(Request $request, User $user) {
        // Validasi input
        $request->validate([
            'username' => 'required|unique:users,name,' . $user->id, // Abaikan validasi unique jika sedang mengedit user yang sama
            'email' => 'required|unique:users,email,' . $user->id, // Abaikan validasi unique jika sedang mengedit user yang sama
            'password' => 'nullable|min:6', // Password hanya perlu divalidasi jika diubah
            'role' => 'required|array',
            'role.*' => 'exists:roles,name', // Pastikan role yang dipilih ada
        ]);
    
        // Update data user
        $user->name = $request->input('username');
        $user->email = $request->input('email');
        
        // Jika password diubah, hash password baru
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        
        $user->save();
    
        // Menetapkan atau memperbarui role pada user
        $user->syncRoles($request->input('role'));
    
        // Redirect atau kembali ke halaman daftar user
        return redirect()->route('dashboard-user');
    }

    public function destroy(User $user) {
        $user->delete();
        return redirect()->route('dashboard-user');
    }
    
}
