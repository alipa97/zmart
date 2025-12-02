<?php

namespace App\Http\Controllers;

use App\Models\Pemilik;
use Illuminate\Http\Request;

class CheckOwnerController extends Controller
{
    // dd("hello world");
    // KiosController.php
    public function index(Request $request)
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
        return view('admin.kios.verify', compact('pemilik', 'search'));
        // return view('admin.kios.verify');
    }
}
