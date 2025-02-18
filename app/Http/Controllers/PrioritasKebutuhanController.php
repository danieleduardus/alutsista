<?php

namespace App\Http\Controllers;

use App\Models\PrioritasKebutuhan;
use Illuminate\Http\Request;

class PrioritasKebutuhanController extends Controller
{
    public function index()
    {
        $prioritasKebutuhan = PrioritasKebutuhan::all();
        return view('prioritas_kebutuhan.index', compact('prioritasKebutuhan'));
    }

    public function create()
    {
        return view('prioritas_kebutuhan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'prioritas' => 'required|string|max:50'
        ]);

        PrioritasKebutuhan::create([
            'prioritas' => $request->prioritas,
            'status' => 1 // Set default status aktif
        ]);

        return redirect()->route('prioritas-kebutuhan.index')->with('success', 'Prioritas Kebutuhan berhasil ditambahkan.');
    }


    public function show(PrioritasKebutuhan $prioritasKebutuhan)
    {
        return view('prioritas_kebutuhan.show', compact('prioritasKebutuhan'));
    }

    public function edit(PrioritasKebutuhan $prioritasKebutuhan)
    {
        return view('prioritas_kebutuhan.edit', compact('prioritasKebutuhan'));
    }

    public function update(Request $request, PrioritasKebutuhan $prioritasKebutuhan)
    {
        $request->validate([
            'prioritas' => 'required|string|max:50'
        ]);

        $prioritasKebutuhan->update($request->all());

        return redirect()->route('prioritas-kebutuhan.index')->with('success', 'Prioritas Kebutuhan berhasil diperbarui.');
    }

    public function destroy(PrioritasKebutuhan $prioritasKebutuhan)
    {
        $prioritasKebutuhan->delete();
        return redirect()->route('prioritas-kebutuhan.index')->with('success', 'Prioritas Kebutuhan berhasil dihapus.');
    }

    public function toggleStatus($id)
    {
        $prioritasKebutuhan = PrioritasKebutuhan::findOrFail($id);
        $prioritasKebutuhan->status = !$prioritasKebutuhan->status; // Toggle status (1 <-> 0)
        $prioritasKebutuhan->save();

        return redirect()->route('prioritas-kebutuhan.index')->with('success', 'Status berhasil diperbarui.');
    }
}
