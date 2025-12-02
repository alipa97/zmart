<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InfaqKios;
use App\Models\Kios;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Collection;

class AllInfaqController extends Controller
{
    // Menampilkan semua data infaq
    public function index(Request $request)
    {
        // Ambil tanggal dari form
        $tanggal = $request->input('tanggal');

        // Ambil semua infaq, atau filter berdasarkan tanggal jika ada input
        $query = InfaqKios::with('kios')->orderBy('tanggal', 'desc');

        if ($tanggal) {
            $query->whereDate('tanggal', $tanggal); // filter berdasarkan tanggal
        }

        $infaqs = $query->get();

        $layout = auth()->user()->role == 'admin' ? 'layouts.admin' : 'layouts.master';

        return view('admin.semua-infaq.index', compact('infaqs', 'tanggal', 'layout'));
    }

    // Form untuk tambah infaq baru
    public function create()
    {
        $daftarKios = Kios::all();
        return view('admin.semua-infaq.form', compact('daftarKios'));
    }

    // Simpan data infaq baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'kios_id' => 'required|exists:kios,id',
            'nominal' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
            'via' => 'required|string|max:255',
        ]);

        InfaqKios::create($request->all());

        return redirect()->route('semua-infaq.index')->with('success', 'Data infaq berhasil ditambahkan.');
    }

    // Form edit data infaq
    public function edit($id)
    {
        $infaq = InfaqKios::findOrFail($id);
        $daftarKios = Kios::all();
        return view('admin.semua-infaq.form', compact('infaq', 'daftarKios'));
    }

    // Simpan hasil edit
    public function update(Request $request, $id)
    {
        $request->validate([
            'kios_id' => 'required|exists:kios,id',
            'nominal' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
            'via' => 'required|string|max:255',
        ]);

        $infaq = InfaqKios::findOrFail($id);
        $infaq->update($request->all());

        return redirect()->route('semua-infaq.index')->with('success', 'Data infaq berhasil diperbarui.');
    }

    // Hapus data infaq
    public function destroy($id)
    {
        $infaq = InfaqKios::findOrFail($id);
        $infaq->delete();

        return redirect()->route('semua-infaq.index')->with('success', 'Data infaq berhasil dihapus.');
    }

    public function cetakLaporan(Request $request)
    {
        $query = InfaqKios::with('kios')->orderBy('kios_id')->orderBy('tanggal');

        $tanggal = null;
        if ($request->filled('tanggal')) {
            $tanggal = $request->tanggal;
            $query->whereDate('tanggal', $request->tanggal);
        }

        $infaqs = $query->get();

        $infaqKiosGrouped = $infaqs->groupBy(function ($item) {
            return $item->kios->nama_kios ?? 'Tidak Diketahui';
        });

        $totalInfaq = $infaqs->sum('nominal');

        $pdf = Pdf::loadView('admin.semua-infaq.laporan-pdf', compact('infaqKiosGrouped', 'totalInfaq', 'tanggal'))->setPaper('A4', 'potrait');

        return $pdf->download('laporan_infaq_kios.pdf');
    }

}
