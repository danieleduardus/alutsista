<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Menggunakan model User
use App\Models\HakAkses;

class PenggunaController extends Controller
{
    /**
     * Menampilkan daftar pengguna.
     */
    public function index()
    {
        $pengguna = User::with('hakAkses')->get(); // Ambil data user dengan relasi hak akses
        return view('pengguna.index', compact('pengguna'));
    }


    /**
     * Menampilkan form tambah pengguna.
     */
    public function create()
    {
        $hakAkses = HakAkses::all(); // Ambil semua data Hak Akses
        return view('pengguna.create', compact('hakAkses'));
    }

    /**
     * Menyimpan data pengguna baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'hak_akses_id' => 'required|exists:hak_akses,id',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'hak_akses_id' => $request->hak_akses_id,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }



    /**
     * Menampilkan form edit pengguna.
     */
    public function edit($id)
    {
        $pengguna = User::findOrFail($id);
        $hakAkses = HakAkses::all(); // Ambil semua data Hak Akses
        return view('pengguna.edit', compact('pengguna', 'hakAkses'));
    }


    /**
     * Menyimpan perubahan data pengguna.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $id,
            'hak_akses_id' => 'required|exists:hak_akses,id',
            'password' => 'nullable|min:6',
        ]);

        $pengguna = User::findOrFail($id);
        $pengguna->update([
            'name' => $request->name,
            'email' => $request->email,
            'hak_akses_id' => $request->hak_akses_id,
            'password' => $request->password ? bcrypt($request->password) : $pengguna->password,
        ]);

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
