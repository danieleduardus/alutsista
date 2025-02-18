<?php

namespace App\Http\Controllers;

use App\Models\JenisKebutuhan;
use Illuminate\Http\Request;

class JenisKebutuhanController extends Controller
{
    public function index()
    {
        $jenisKebutuhan = JenisKebutuhan::all();
        $header = ' <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Jenis Kebutuhan
                    </h2>';
        return view('jenis_kebutuhan.index', compact('jenisKebutuhan', 'header'));
    }

    public function create()
    {
        return view('jenis_kebutuhan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|string|max:50'
        ]);
    
        JenisKebutuhan::create([
            'jenis' => $request->jenis
        ]);

        return redirect()->route('jenis-kebutuhan.index')->with('success', 'Jenis Kebutuhan berhasil ditambahkan.');
    }

    public function show(JenisKebutuhan $jenisKebutuhan)
    {
        return view('jenis_kebutuhan.show', compact('jenisKebutuhan'));
    }

    public function edit($id)
    {
        $jenisKebutuhan = JenisKebutuhan::findOrFail($id);
        return view('jenis_kebutuhan.edit', compact('jenisKebutuhan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis' => 'required|string|max:50'
        ]);

        $jenisKebutuhan = JenisKebutuhan::findOrFail($id);
        $jenisKebutuhan->update([
            'jenis' => $request->jenis
        ]);

        return redirect()->route('jenis-kebutuhan.index')->with('success', 'Jenis Kebutuhan berhasil diperbarui.');
    }


    public function destroy(JenisKebutuhan $jenisKebutuhan)
    {
        $jenisKebutuhan->delete();
        return redirect()->route('jenis-kebutuhan.index')->with('success', 'Jenis Kebutuhan berhasil dihapus.');
    }

    public function toggleStatus($id)
    {
        $jenisKebutuhan = JenisKebutuhan::findOrFail($id);
        $jenisKebutuhan->status = !$jenisKebutuhan->status; // Toggle status (1 <-> 0)
        $jenisKebutuhan->save();

        return redirect()->route('jenis-kebutuhan.index')->with('success', 'Status berhasil diperbarui.');
    }

}
