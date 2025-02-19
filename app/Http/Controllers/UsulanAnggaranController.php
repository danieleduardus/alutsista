<?php

namespace App\Http\Controllers;

use App\Models\UsulanAnggaran;
use App\Models\RencanaKebutuhan;
use App\Models\StatusUsulanAnggaran;
use Illuminate\Http\Request;

class UsulanAnggaranController extends Controller
{
    /**
     * Menampilkan daftar usulan anggaran.
     */
    public function index()
    {
        $usulanAnggaran = UsulanAnggaran::orderBy('nomor', 'asc')->get();
        return view('usulan_anggaran.index', compact('usulanAnggaran'));
    }


    /**
     * Menampilkan form untuk membuat usulan anggaran baru.
     */
    public function create()
    {
        $rencanaKebutuhan = RencanaKebutuhan::whereNull('usulan_anggaran_id')->get();
        return view('usulan_anggaran.create', compact('rencanaKebutuhan'));
    }


    /**
     * Menyimpan usulan anggaran baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
            'rencana_kebutuhan' => 'required|array',
            'rencana_kebutuhan.*' => 'exists:rencana_kebutuhan,id',
        ]);

        // Generate Nomor Usulan Anggaran
        $bulan = date('m'); // Format 2 digit bulan
        $tahun = date('Y'); // Format 4 digit tahun
        $lastId = UsulanAnggaran::latest()->first();
        $newId = $lastId ? str_pad($lastId->id + 1, 3, '0', STR_PAD_LEFT) : '001';
        $nomor = "UA.$bulan/TNI/$newId/$tahun";

        // Simpan usulan anggaran
        $usulanAnggaran = UsulanAnggaran::create([
            'nomor' => $nomor,
            'judul' => $request->judul,
            'jumlah' => $request->jumlah,
            'status_id' => 1
        ]);

        // Update Rencana Kebutuhan dengan ID Usulan Anggaran
        RencanaKebutuhan::whereIn('id', $request->rencana_kebutuhan)
            ->update(['usulan_anggaran_id' => $usulanAnggaran->id]);

        return redirect()->route('usulan-anggaran.index')->with('success', 'Usulan Anggaran berhasil ditambahkan.');
    }



    /**
     * Menampilkan detail usulan anggaran.
     */
    public function show($id)
    {
        $usulanAnggaran = UsulanAnggaran::with('rencanaKebutuhan')->findOrFail($id);
        return view('usulan_anggaran.show', compact('usulanAnggaran'));
    }

    /**
     * Menampilkan form edit usulan anggaran.
     */
    public function edit($id)
    {
        $usulanAnggaran = UsulanAnggaran::with('rencanaKebutuhan')->findOrFail($id);
        $rencanaKebutuhan = RencanaKebutuhan::all();

        return view('usulan_anggaran.edit', compact('usulanAnggaran', 'rencanaKebutuhan'));
    }

    /**
     * Memproses update data usulan anggaran.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
            'rencana_kebutuhan' => 'required|array',
            'rencana_kebutuhan.*' => 'exists:rencana_kebutuhan,id',
        ]);

        $usulanAnggaran = UsulanAnggaran::findOrFail($id);
        $usulanAnggaran->update([
            'judul' => $request->judul,
            'jumlah' => $request->jumlah,
        ]);

        // Sync many-to-many relation
        $usulanAnggaran->rencanaKebutuhan()->sync($request->rencana_kebutuhan);

        return redirect()->route('usulan-anggaran.index')->with('success', 'Usulan Anggaran berhasil diperbarui.');
    }


    /**
     * Menghapus usulan anggaran.
     */
    public function destroy($id)
    {
        $usulanAnggaran = UsulanAnggaran::findOrFail($id);
        $usulanAnggaran->delete();

        return redirect()->route('usulan-anggaran.index')->with('success', 'Usulan anggaran berhasil dihapus.');
    }
}
