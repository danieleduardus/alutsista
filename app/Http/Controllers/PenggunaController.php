<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Menggunakan model User

class PenggunaController extends Controller
{
    /**
     * Menampilkan daftar pengguna.
     */
    public function index()
    {
        $pengguna = User::all();
        return view('pengguna.index', compact('pengguna'));
    }

    /**
     * Menampilkan form tambah pengguna.
     */
    public function create()
    {
        return view('pengguna.create');
    }

    /**
     * Menyimpan data pengguna baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hashing password
        ]);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }


    /**
     * Menampilkan form edit pengguna.
     */
    public function edit($id)
    {
        $pengguna = User::findOrFail($id);
        return view('pengguna.edit', compact('pengguna'));
    }


    /**
     * Menyimpan perubahan data pengguna.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6', // Password opsional
        ]);

        $pengguna = User::findOrFail($id);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // Hanya update password jika ada input baru
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $pengguna->update($data);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil diperbarui.');
    }


    /**
     * Menghapus pengguna.
     */
    public function destroy($id)
    {
        $pengguna = User::findOrFail($id);
        $pengguna->delete();

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
