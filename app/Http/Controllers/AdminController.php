<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kios;
use App\Models\InfaqKios;
use App\Models\Pemilik;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        // Total nominal infaq per tahun dari tabel infaq_kios
        $infaqPerYear = InfaqKios::select(
                DB::raw('YEAR(tanggal) as year'), // Mengambil tahun dari kolom 'tanggal' di infaq_kios
                DB::raw('SUM(nominal) as total_infaq')
            )
            ->groupBy('year')
            ->orderBy('year', 'ASC')
            ->get();
    
        // Total kios penerima manfaat di kota Bontang
        $totalKios = Kios::count();
    
        // Total users
        $totalUsers = User::count();
    
        // Total pemilik
        // $totalPemilik = Pemilik::count();
        
        // Total infaq per bulan
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $infaqPerMonth = InfaqKios::whereMonth('tanggal', $currentMonth)
            ->whereYear('tanggal', $currentYear)
            ->sum('nominal');
    
        // Mengirim data ke view 'admin.dashboard'
        return view('admin.dashboard', compact('infaqPerYear', 'totalKios', 'totalUsers', 'infaqPerMonth'));
    }
}
