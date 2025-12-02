<?php

namespace App\Http\Controllers;

use App\Models\Kios;
use App\Models\Pemilik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KiosController extends Controller
{
    /**
     * Menampilkan form tambah Kios.
     */
    public function create($id)
    {
        
        // Ambil pemilik berdasarkan ID
        $pemilik_id = $id;
        $pemilik = Pemilik::findOrFail($pemilik_id);
        $nama_pemilik = $pemilik->nama_pemilik;

        // Ambil nomor kios terakhir berdasarkan nomor_kios
        $latestKios = Kios::orderBy('nomor_kios', 'desc')->first();
        
        // Jika ada kios yang sudah ada, ubah nomor kios ke integer, tambahkan 1, dan format kembali ke string dengan dua digit
        if ($latestKios) {
            // Konversi ke integer, tambahkan 1, lalu format ke dua digit
            $nomor_kios_int = intval($latestKios->nomor_kios); 
            $nomor_kios = str_pad($nomor_kios_int + 1, 2, '0', STR_PAD_LEFT); // Format menjadi '01', '02', dll.
        } else {
            $nomor_kios = '01'; // Jika tidak ada kios, mulai dari '01'
        }

    
        return view('admin.kios.create', compact('pemilik_id', 'nama_pemilik', 'nomor_kios'));
    }

    /**
     * Menyimpan data Kios ke database.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'pemilik_id' => 'required',
            'nomor_kios' => 'required|string|max:4',
            'nama_kios' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'latitude' => 'required',
            'longitude' => 'required',
            'rt' => 'required|string|max:5',
            'kelurahan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'tahun' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi file gambar opsional
        ]);

        // Buat instance model Kios baru
        $kios = Kios::create($request->except('foto'));
        $filePath = public_path('kios');

        // Handle upload gambar jika ada
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $file_name = time() . $file->getClientOriginalName();
            $file->move($filePath, $file_name);

            $kios->foto = $file_name;
        }

        $kios->save();

        return redirect()->route('kios.index')->with('success', 'Kios berhasil ditambahkan');
    }

    /**
     * Menampilkan daftar kios yang telah disimpan.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $kios = Kios::query();
    
        if ($search) {
            $kios->where('nama_kios', 'LIKE', "%{$search}%");
        }
    
        $kios = $kios->with('pemilik')->get();
        // $kios = Kios::with('pemilik')->get();
        return view('admin.kios.index', compact('kios'));
    }

    public function show($id)
    {
        $kios = Kios::findOrFail($id);
        return view('admin.kios.show', compact('kios'));
    }

    public function edit($id)
    {
        // Temukan data kios berdasarkan ID
        $kios = Kios::findOrFail($id);
        $pemilik = Pemilik::find($kios->pemilik_id); // Jika ada relasi dengan tabel pemilik
    
        // Pastikan data pemilik juga sudah ada (opsional, jika perlu)
        // $nama_pemilik = $pemilik ? $pemilik->nama_pemilik : 'Tidak Ada Pemilik';
    
        return view('admin.kios.edit', compact('kios', 'pemilik'));
    }    

    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'pemilik_id' => 'required',
            'nomor_kios' => 'required|string|max:4',
            'nama_kios' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'latitude' => 'required',
            'longitude' => 'required',
            'rt' => 'required|string|max:5',
            'kelurahan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'tahun' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        // Dapatkan data Kios berdasarkan ID
        $kios = Kios::findOrFail($id);
    
        // Update data Kios
        $kios->update([
            'pemilik_id' => $request->pemilik_id,
            'nomor_kios' => $request->nomor_kios,
            'nama_kios' => $request->nama_kios,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'rt' => $request->rt,
            'kelurahan' => $request->kelurahan,
            'kecamatan' => $request->kecamatan,
            'keterangan' => $request->keterangan,
            'tahun' => $request->tahun,
        ]);
    
        // Tentukan path tempat menyimpan file gambar
        $filePath = public_path('kios');
    
        // Handle upload gambar jika ada
        if ($request->hasFile('foto')) {
            // Hapus gambar lama jika ada
            if ($kios->foto && file_exists($filePath . '/' . $kios->foto)) {
                unlink($filePath . '/' . $kios->foto);
            }
    
            // Upload gambar baru
            $file = $request->file('foto');
            $file_name = time() . '_' . $file->getClientOriginalName();
            $file->move($filePath, $file_name);
    
            // Update nama file gambar pada database
            $kios->foto = $file_name;
        }
    
        // Simpan perubahan
        $kios->save();
    
        return redirect()->route('kios.index')->with('success', 'Kios berhasil diperbarui');
    }
    

    /**
     * Menghapus data Kios
     */
    public function destroy($id)
    {
        $kios = Kios::findOrFail($id);

        // Hapus gambar dari storage jika ada
        if ($kios->foto) {
            Storage::disk('public')->delete($kios->foto);
        }

        $kios->delete();

        return redirect()->route('kios.index')->with('success', 'Kios berhasil dihapus');
    }

    public function showMap()
    {
        $kios = Kios::all(); // Ambil semua data kios dari database
        return view('kios.map', compact('kios')); // Kirim data ke view
    }    

    public function showRute()
    {
        $kios = Kios::all(); // Ambil semua data kios dari database
        return view('kios.rute', compact('kios')); // Kirim data ke view
    }    
    
    public function toggleStatus($id)
    {
        $kios = Kios::findOrFail($id);
        $kios->status = $kios->status === 'aktif' ? 'nonaktif' : 'aktif';
        $kios->save();

        return redirect()->back()->with('success', 'Status kios berhasil diperbarui.');
    }

}
