<?php

namespace App\Http\Controllers;

use App\Models\Kios;
use App\Models\InfaqKios;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ListKiosController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $kios = Kios::query();
    
        if ($search) {
            $kios->where('nama_kios', 'LIKE', "%{$search}%");
        }
    
        $kios = $kios->with('pemilik')->get(); // Mendapatkan data dengan relasi ke pemilik jika ada
    
        return view('kios.index', compact('kios'));
    }

    public function cetakDaftarKios()
    {
        $kios = Kios::orderBy('nomor_kios')->get();

        $pdf = Pdf::loadView('admin.kios.daftar-kios-pdf', compact('kios'))->setPaper('A4', 'landscape');

        return $pdf->download('daftar_kios.pdf');
    }
    
}
