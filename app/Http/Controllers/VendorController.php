<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\StatusVendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Menampilkan daftar vendor.
     */
    public function index()
    {
        $vendors = Vendor::with('status')->paginate(10);
        return view('vendors.index', compact('vendors'));
    }

    /**
     * Menampilkan form tambah vendor.
     */
    public function create()
    {
        $users = \App\Models\User::doesntHave('vendors')->where('hak_akses_id', 5)->get();
        return view('vendors.create', compact('users'));
    }


    /**
     * Menyimpan vendor baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'telepon' => 'required|string|max:15',
        ]);

        Vendor::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'user_id' => $request->user_id,
            'telepon' => $request->telepon,
            'status_id' => 1, // Set status default ke 1
        ]);

        return redirect()->route('vendors.index')->with('success', 'Vendor berhasil ditambahkan.');
    }


    /**
     * Menampilkan detail vendor tertentu.
     */
    public function show(Vendor $vendor)
    {
        return view('vendors.show', compact('vendor'));
    }

    /**
     * Menampilkan form edit vendor.
     */
    public function edit(Vendor $vendor)
    {
        // Ambil pengguna dengan hak_akses_id = 5 yang belum menjadi vendor, serta user vendor saat ini
        $users = \App\Models\User::where('hak_akses_id', 5)
                    ->where(function ($query) use ($vendor) {
                        $query->whereNotIn('id', function ($subQuery) {
                            $subQuery->select('user_id')->from('vendors');
                        })
                        ->orWhere('id', $vendor->user_id); // Sertakan user yang sedang digunakan oleh vendor
                    })
                    ->get();

        return view('vendors.edit', compact('vendor', 'users'));
    }


    /**
     * Memperbarui data vendor di database.
     */
    public function update(Request $request, Vendor $vendor)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'telepon' => 'required|string|max:15',
        ]);

        $vendor->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'user_id' => $request->user_id,
            'telepon' => $request->telepon,
        ]);

        return redirect()->route('vendors.index')->with('success', 'Vendor berhasil diperbarui.');
    }


    /**
     * Menghapus vendor dari database.
     */
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();

        return redirect()->route('vendors.index')->with('success', 'Vendor berhasil dihapus.');
    }

    /**
     * Mengubah status vendor (Aktif/Non-aktif).
     */
    public function toggleStatus(Vendor $vendor)
    {
        $vendor->status_id = $vendor->status_id == 1 ? 2 : 1; // Misalnya 1 = Aktif, 2 = Non-Aktif
        $vendor->save();

        return redirect()->route('vendors.index')->with('success', 'Status vendor berhasil diperbarui.');
    }
}
