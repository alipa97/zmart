<?php

namespace App\Http\Controllers;

use App\Models\Pemilik;
use Illuminate\Http\Request;

class PemilikController extends Controller
{
    // Menampilkan daftar pemilik
    public function index(Request $request)
    {
        // $pemilik = Pemilik::all();
        // Ambil query pencarian dari input pengguna
        $search = $request->input('search');
    
        // Query database untuk mencari pemilik berdasarkan nama jika ada pencarian
        $pemilik = Pemilik::when($search, function ($query, $search) {
                $query->where('nama_pemilik', 'like', '%' . $search . '%');
            })
            ->orderBy('nama_pemilik', 'asc')
            ->get();
        return view('admin.pemilik.index', compact('pemilik', 'search'));
    }

    // Menampilkan form untuk menambah pemilik baru
    public function create()
    {
        return view('admin.pemilik.create');
    }

    // Menyimpan data pemilik baru ke dalam database
    public function store(Request $request)
    {
        $request->validate([
            'nama_pemilik' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
        ]);

        Pemilik::create($request->all());

        return redirect()->route('pemilik.index')->with('success', 'Pemilik berhasil ditambahkan');
    }

    // Menampilkan form edit untuk pemilik tertentu
    public function edit($id)
    {
        $pemilik = Pemilik::findOrFail($id);
        return view('admin.pemilik.edit', compact('pemilik'));
    }

    // Mengupdate data pemilik di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pemilik' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
        ]);

        $pemilik = Pemilik::findOrFail($id);
        $pemilik->update($request->all());

        return redirect()->route('pemilik.index')->with('success', 'Pemilik berhasil diperbarui');
    }

    // Menghapus data pemilik dari database
    public function destroy($id)
    {
        $pemilik = Pemilik::findOrFail($id);
        $pemilik->delete();

        return redirect()->route('pemilik.index')->with('success', 'Pemilik berhasil dihapus');
    }
}
