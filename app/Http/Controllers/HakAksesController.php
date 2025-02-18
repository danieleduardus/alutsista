<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HakAkses; // Model untuk Hak Akses

class HakAksesController extends Controller
{
    /**
     * Menampilkan daftar hak akses.
     */
    public function index()
    {
        $hakAkses = HakAkses::all();
        return view('hak_akses.index', compact('hakAkses'));
    }

    /**
     * Menampilkan form tambah hak akses.
     */
    public function create()
    {
        return view('hak_akses.create');
    }

    /**
     * Menyimpan data hak akses baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'hak_akses' => 'required|string|max:100|unique:hak_akses,hak_akses',
        ]);

        HakAkses::create([
            'hak_akses' => $request->hak_akses,
            'status' => 1, // Default status aktif
        ]);

        return redirect()->route('hak-akses.index')->with('success', 'Hak Akses berhasil ditambahkan.');
    }


    /**
     * Menampilkan form edit hak akses.
     */
    public function edit($id)
    {
        $hakAkses = HakAkses::findOrFail($id);
        return view('hak_akses.edit', compact('hakAkses'));
    }

    /**
     * Menyimpan perubahan data hak akses.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'hak_akses' => 'required|string|max:100|unique:hak_akses,hak_akses,' . $id,
            'status' => 'required|boolean',
        ]);

        $hakAkses = HakAkses::findOrFail($id);
        $hakAkses->update([
            'hak_akses' => $request->hak_akses,
            'status' => $request->status,
        ]);

        return redirect()->route('hak-akses.index')->with('success', 'Hak Akses berhasil diperbarui.');
    }


    /**
     * Menghapus hak akses.
     */
    public function destroy($id)
    {
        $hakAkses = HakAkses::findOrFail($id);
        $hakAkses->delete();

        return redirect()->route('hak-akses.index')->with('success', 'Hak Akses berhasil dihapus.');
    }

    public function toggleStatus($id)
    {
        $hakAkses = HakAkses::findOrFail($id);
        $hakAkses->update(['status' => !$hakAkses->status]);

        return redirect()->route('hak-akses.index')->with('success', 'Status Hak Akses berhasil diperbarui.');
    }

}
