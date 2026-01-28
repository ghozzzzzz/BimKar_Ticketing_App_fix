<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lokasis = Lokasi::all();
        return view('admin.lokasi.index', compact('lokasis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Not used - using modal instead
        return redirect()->route('admin.lokasis.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lokasi' => 'required|string|max:255',
        ]);

        Lokasi::create($validatedData);

        return redirect()->route('admin.lokasis.index')->with('success', 'Lokasi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Not used - using modal instead
        return redirect()->route('admin.lokasis.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Not used - using modal instead
        return redirect()->route('admin.lokasis.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $lokasi = Lokasi::findOrFail($id);

            $validatedData = $request->validate([
                'nama_lokasi' => 'required|string|max:255',
            ]);

            $lokasi->update($validatedData);

            return redirect()->route('admin.lokasis.index')->with('success', 'Lokasi berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui lokasi: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $lokasi = Lokasi::findOrFail($id);
            $lokasi->delete();

            return redirect()->route('admin.lokasis.index')->with('success', 'Lokasi berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus lokasi: ' . $e->getMessage()]);
        }
    }
}