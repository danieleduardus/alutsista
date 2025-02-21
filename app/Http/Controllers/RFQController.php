<?php

namespace App\Http\Controllers;

use App\Models\RFQ;
use App\Models\RFQDetail;
use App\Models\UsulanAnggaran;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RFQController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rfqs = RFQ::with('usulanAnggaran')->paginate(10);
        return view('rfq.index', compact('rfqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil daftar Usulan Anggaran yang belum memiliki RFQ
        $usulanAnggaran = UsulanAnggaran::doesntHave('rfq')->where('status_id', 2)->get();

        return view('rfq.create', compact('usulanAnggaran'));
    }

    /**
     * Menyimpan RFQ baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'usulan_anggaran_id' => 'required|exists:usulan_anggaran,id',
            'tanggal_batas_pemenuhan' => 'required|date',
            'catatan_pengiriman' => 'nullable|string',
            'rfq_details' => 'required|array',
            'rfq_details.*.nama_barang' => 'required|string|max:255',
            'rfq_details.*.quantity' => 'required|integer|min:1',
            'rfq_details.*.spesifikasi' => 'nullable|string',
        ]);

        // Simpan data RFQ
        $rfq = RFQ::create([
            'usulan_anggaran_id' => $request->usulan_anggaran_id,
            'tanggal_batas_pemenuhan' => $request->tanggal_batas_pemenuhan,
            'catatan_pengiriman' => $request->catatan_pengiriman,
            'status_id' => $request->status_id ?? 1, // Jika tidak ada status, default ke 1
        ]);

        // Simpan data RFQ Detail
        foreach ($request->rfq_details as $detail) {
            RFQDetail::create([
                'rfq_id' => $rfq->id,
                'nama_barang' => $detail['nama_barang'],
                'quantity' => $detail['quantity'],
                'spesifikasi' => $detail['spesifikasi'] ?? null,
            ]);
        }

        return redirect()->route('rfq.index')->with('success', 'RFQ berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $rfq = RFQ::with('usulanAnggaran', 'details')->findOrFail($id);
        return view('rfq.show', compact('rfq'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rfq = RFQ::with('details', 'usulanAnggaran')->findOrFail($id);
        return view('rfq.edit', compact('rfq'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_batas_pemenuhan' => 'required|date',
            'catatan_pengiriman' => 'nullable|string',
            'rfq_details' => 'required|array',
            'rfq_details.*.nama_barang' => 'required|string|max:255',
            'rfq_details.*.quantity' => 'required|integer|min:1',
            'rfq_details.*.spesifikasi' => 'nullable|string',
        ]);

        $rfq = RFQ::findOrFail($id);
        $rfq->update([
            'tanggal_batas_pemenuhan' => $request->tanggal_batas_pemenuhan,
            'catatan_pengiriman' => $request->catatan_pengiriman,
        ]);

        // Hapus data lama dan tambahkan yang baru
        $rfq->details()->delete();
        foreach ($request->rfq_details as $detail) {
            $rfq->details()->create([
                'nama_barang' => $detail['nama_barang'],
                'quantity' => $detail['quantity'],
                'spesifikasi' => $detail['spesifikasi'] ?? null,
            ]);
        }

        return redirect()->route('rfq.index')->with('success', 'RFQ berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rfq = RFQ::findOrFail($id);

        // Hapus semua detail barang yang terkait dengan RFQ
        $rfq->details()->delete();

        // Hapus RFQ itu sendiri
        $rfq->delete();

        return redirect()->route('rfq.index')->with('success', 'RFQ berhasil dihapus.');
    }

}
