<?php

namespace App\Http\Controllers;

use App\Models\InfaqKios;
use App\Models\Kios;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class InfaqKiosController extends Controller
{
    /**
     * Menampilkan daftar infaq untuk kios tertentu.
     */
    public function index($kios_id)
    {
        $infaqKios = InfaqKios::where('kios_id', $kios_id)->get();
        // dd($infaqKios->first()->id); // Mengambil properti dari objek pertama
        $kios = Kios::find($kios_id);

        if (!$kios) {
            return redirect()->back()->with('error', 'Kios tidak ditemukan.');
        }

        return view('admin.infaq.index', compact('infaqKios', 'kios_id', 'kios'));
    }

    /**
     * Menampilkan form untuk menambahkan infaq baru.
     */
    public function create($kios_id)
    {
        $kios = Kios::find($kios_id);
        // dd($kios->nama_kios);
        return view('admin.infaq.create', compact('kios'));
    }

    /**
     * Menyimpan data infaq baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kios_id' => 'required|exists:kios,id',
            'nominal' => 'required|numeric',
            'tanggal' => 'required|date',
            'via' => 'required|string|max:255',
        ]);

        InfaqKios::create($request->all());

        return redirect()->route('infaq.index', $request->kios_id)
                         ->with('success', 'Data infaq berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data infaq.
     */
    public function edit($kios_id, InfaqKios $infaqKios)
    {
        $kios = Kios::find($kios_id);
    
        if (!$kios) {
            return redirect()->back()->with('error', 'Kios tidak ditemukan.');
        }
    
        return view('admin.infaq.edit', compact('kios', 'infaqKios', 'kios_id'));
    }
    
    public function update(Request $request, $kios_id, InfaqKios $infaqKios)
    {
        $validated = $request->validate([
            'nominal' => 'required|numeric',
            'tanggal' => 'required|date',
            'via' => 'required|string',
        ]);
    
        $infaqKios->update($validated);
    
        return redirect()->route('infaq.index', ['kios_id' => $kios_id])
                         ->with('success', 'Data infaq berhasil diperbarui.');
    }

    /**
     * Menghapus data infaq.
     */
    public function destroy($kios_id, InfaqKios $infaqKios)
    {
        $infaqKios->delete();

        return redirect()->route('infaq.index', $kios_id)
                         ->with('success', 'Data infaq berhasil dihapus.');
    }

    public function generateLaporan()
    {
        $infaqKiosGrouped = InfaqKios::with('kios:id,nama_kios,nomor_kios') // Pastikan relasi memuat nomor_kios
            ->get(['kios_id', 'nominal', 'tanggal', 'via'])
            ->groupBy(function ($infaq) {
                return $infaq->kios->nama_kios ?? 'Tanpa Nama'; // Grup berdasarkan nama kios
            });
    
        $totalInfaq = $infaqKiosGrouped->flatMap(function ($infaqs) {
            return $infaqs;
        })->sum('nominal');
    
        return Pdf::loadView('kios.laporan_pdf', compact('infaqKiosGrouped', 'totalInfaq'))
            ->setPaper('a4', 'potrait')
            ->download('laporan_kios_zmart.pdf');
    }   
}
