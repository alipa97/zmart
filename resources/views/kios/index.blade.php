@extends('layouts.master')

@section('content')

<!-- Hero Section -->
<section class="bg-indigo-600 text-white py-20">
    <div class="container mx-auto text-center">
        <h1 class="text-5xl font-bold mb-4">Daftar Kios ZMart</h1>
        <p class="text-xl mb-8">Temukan kios ZMart di berbagai lokasi strategis.</p>
        
        <!-- Tombol Search Kios -->
        <form action="{{ route('daftarKios.index') }}" method="GET" class="mt-6">
            <input type="text" name="search" placeholder="Cari kios berdasarkan nama atau alamat..." 
                   class="w-1/2 px-4 py-2 rounded-full text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500" 
                   value="{{ request('search') }}">
            <button type="submit" class="bg-white text-indigo-600 font-semibold py-2 px-6 rounded-full hover:bg-gray-200 transition">
                Cari
            </button>
        </form>

        <!-- Tombol Laporan PDF (Hanya untuk pengguna yang login) -->
        @auth
        <div class="mt-8">
            <a href="{{ route('semua-infaq.index') }}" class="bg-white text-indigo-600 font-semibold py-2 px-6 rounded-full hover:bg-gray-200 transition">
                Lihat Semua Infaq Kios
            </a>
        </div>
        @endauth
    </div>
</section>

<!-- Grid Kios Section -->
<section class="py-12 bg-gray-100">
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold text-center mb-10">Kios-Kios Kami</h2>
        
        <!-- Grid Kios -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse($kios as $kio)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                @if ($kio->foto)
                    <img src="{{ asset('kios/' . $kio->foto) }}" alt="Foto Kios" class="w-full h-48 object-cover">
                @else
                    <img src="https://via.placeholder.com/400x200" alt="Foto Kios" class="w-full h-48 object-cover">
                @endif
                <div class="p-4">
                    @if ($kio->nama_kios)
                        <h3 class="text-xl font-bold mb-2">{{ $kio->nama_kios }}</h3>
                    @endif
                    <p class="text-gray-700 mb-4">RT {{ $kio->rt }}, Kel. {{ $kio->kelurahan }}, Kec. {{ $kio->kecamatan }}<br>
                    {{ $kio->alamat }}</p>
                    <p class="text-gray-700 mb-4">Nomor Kios: {{ $kio->nomor_kios }}</p>
                    <p class="text-gray-700 mb-4">Pemilik: {{ $kio->pemilik->nama_pemilik ?? 'Tidak Diketahui' }}</p>
                </div>
            </div>
            @empty
            <p class="text-center text-gray-700">Kios tidak ditemukan.</p>
            @endforelse
        </div>
    </div>
</section>

@endsection
