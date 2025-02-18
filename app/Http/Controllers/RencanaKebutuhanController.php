<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RencanaKebutuhan;
use App\Models\JenisKebutuhan;
use App\Models\PrioritasKebutuhan;

class RencanaKebutuhanController extends Controller
{
    /**
     * Menampilkan daftar rencana kebutuhan.
     */
    public function index()
    {
        $rencanaKebutuhan = RencanaKebutuhan::with(['jenisKebutuhan', 'prioritasKebutuhan'])->get();
        return view('rencana_kebutuhan.index', compact('rencanaKebutuhan'));
    }

    /**
     * Menampilkan form untuk membuat rencana kebutuhan baru.
     */
    public function create()
    {
        $jenisKebutuhan = JenisKebutuhan::where('status', 1)->get();
        //$prioritasKebutuhan = PrioritasKebutuhan::where('status', 1)->get();

        return view('rencana_kebutuhan.create', compact('jenisKebutuhan'));
    }

    /**
     * Menyimpan data rencana kebutuhan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:200',
            'deskripsi' => 'nullable|string',
            'jenis_kebutuhan_id' => 'required|exists:jenis_kebutuhan,id',
        ]);

        // Mendapatkan bulan dan tahun saat ini
        $bulan = date('m'); // Format 2 digit bulan
        $tahun = date('Y'); // Format 4 digit tahun

        // Mendapatkan ID terakhir dan menambahkan 1
        $lastId = RencanaKebutuhan::latest()->first();
        $newId = $lastId ? str_pad($lastId->id + 1, 3, '0', STR_PAD_LEFT) : '001'; // 3 digit ID

        // Format Nomor Rencana Kebutuhan
        $nomor = "RK.$bulan/TNI/$newId/$tahun";

        // Simpan data ke database
        RencanaKebutuhan::create([
            'nomor' => $nomor,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'jenis_kebutuhan_id' => $request->jenis_kebutuhan_id,
            'prioritas_id' => 1,
        ]);

        return redirect()->route('rencana-kebutuhan.index')->with('success', 'Rencana Kebutuhan berhasil ditambahkan.');
    }



    /**
     * Menampilkan form untuk mengedit rencana kebutuhan.
     */
    public function edit($id)
    {
        $rencanaKebutuhan = RencanaKebutuhan::findOrFail($id);
        $jenisKebutuhan = JenisKebutuhan::where('status', 1)->get();
        $prioritasKebutuhan = PrioritasKebutuhan::where('status', 1)->get();

        return view('rencana_kebutuhan.edit', compact('rencanaKebutuhan', 'jenisKebutuhan', 'prioritasKebutuhan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:200',
            'deskripsi' => 'nullable|string',
            'jenis_kebutuhan_id' => 'required|exists:jenis_kebutuhan,id',
        ]);

        $rencanaKebutuhan = RencanaKebutuhan::findOrFail($id);
        $rencanaKebutuhan->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'jenis_kebutuhan_id' => $request->jenis_kebutuhan_id,
        ]);

        return redirect()->route('rencana-kebutuhan.index')->with('success', 'Rencana Kebutuhan berhasil diperbarui.');
    }

    public function show($id)
    {
        $rencanaKebutuhan = RencanaKebutuhan::with(['jenisKebutuhan', 'prioritasKebutuhan'])->findOrFail($id);

        return view('rencana_kebutuhan.show', compact('rencanaKebutuhan'));
    }


    /**
     * Menghapus rencana kebutuhan dari database.
     */
    public function destroy($id)
    {
        $rencanaKebutuhan = RencanaKebutuhan::findOrFail($id);
        $rencanaKebutuhan->delete();

        return redirect()->route('rencana-kebutuhan.index')->with('success', 'Rencana Kebutuhan berhasil dihapus.');
    }
}
