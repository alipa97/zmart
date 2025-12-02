<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListInfaqController extends Controller
{
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

        return view('admin.semua-infaq.index', compact('infaqs', 'tanggal'));
    }
}
