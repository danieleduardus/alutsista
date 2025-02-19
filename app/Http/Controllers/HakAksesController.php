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
            'menu_master_data' => $request->has('menu_master_data') ? 1 : 0,
            'menu_rencana_kebutuhan' => $request->has('menu_rencana_kebutuhan') ? 1 : 0,
            'menu_usulan_anggaran' => $request->has('menu_usulan_anggaran') ? 1 : 0,
            'menu_rfq' => $request->has('menu_rfq') ? 1 : 0,
            'menu_kontrak' => $request->has('menu_kontrak') ? 1 : 0,
            'mengelola_master_data' => $request->has('mengelola_master_data') ? 1 : 0,
            'membuat_rencana_kebutuhan' => $request->has('membuat_rencana_kebutuhan') ? 1 : 0,
            'menentukan_prioritas_rencana_kebutuhan' => $request->has('menentukan_prioritas_rencana_kebutuhan') ? 1 : 0,
            'membuat_usulan_anggaran' => $request->has('membuat_usulan_anggaran') ? 1 : 0,
            'mengubah_usulan_anggaran' => $request->has('mengubah_usulan_anggaran') ? 1 : 0,
            'menyetujui_usulan_anggaran' => $request->has('menyetujui_usulan_anggaran') ? 1 : 0,
            'membuat_rfq' => $request->has('membuat_rfq') ? 1 : 0,
            'mengubah_rfq' => $request->has('mengubah_rfq') ? 1 : 0,
            'menyetujui_dan_mempublikasikan_rfq' => $request->has('menyetujui_dan_mempublikasikan_rfq') ? 1 : 0,
            'memilih_vendor_dan_penawaran' => $request->has('memilih_vendor_dan_penawaran') ? 1 : 0,
            'menandatangani_kontrak' => $request->has('menandatangani_kontrak') ? 1 : 0,
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
            'menu_master_data' => $request->has('menu_master_data') ? 1 : 0,
            'menu_rencana_kebutuhan' => $request->has('menu_rencana_kebutuhan') ? 1 : 0,
            'menu_usulan_anggaran' => $request->has('menu_usulan_anggaran') ? 1 : 0,
            'menu_rfq' => $request->has('menu_rfq') ? 1 : 0,
            'menu_kontrak' => $request->has('menu_kontrak') ? 1 : 0,
            'mengelola_master_data' => $request->has('mengelola_master_data') ? 1 : 0,
            'membuat_rencana_kebutuhan' => $request->has('membuat_rencana_kebutuhan') ? 1 : 0,
            'menentukan_prioritas_rencana_kebutuhan' => $request->has('menentukan_prioritas_rencana_kebutuhan') ? 1 : 0,
            'membuat_usulan_anggaran' => $request->has('membuat_usulan_anggaran') ? 1 : 0,
            'mengubah_usulan_anggaran' => $request->has('mengubah_usulan_anggaran') ? 1 : 0,
            'menyetujui_usulan_anggaran' => $request->has('menyetujui_usulan_anggaran') ? 1 : 0,
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
