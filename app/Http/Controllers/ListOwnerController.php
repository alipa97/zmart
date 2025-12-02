<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListOwnerController extends Controller
{
    public function index()
    {
        return view('admin.kios.owner');
    }

    public function show(Request $request)
    {
        // Ambil query pencarian dari input pengguna
        $search = $request->input('search');

        // Query database untuk mencari pemilik berdasarkan nama jika ada pencarian
        $pemilik = Pemilik::when($search, function ($query, $search) {
                $query->where('nama_pemilik', 'like', '%' . $search . '%');
            })
            ->orderBy('nama_pemilik', 'asc')
            ->get();

        // Kembalikan ke view dengan hasil pencarian
        return view('admin.kios.ownerList', compact('pemilik', 'search'));
    }
}
