@extends('layouts.admin')

@section('content')

<h3 class="text-3xl font-semibold text-gray-700 mb-5">Detail Kios</h3>

<div class="container mx-auto p-8 bg-white shadow-lg rounded-lg">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div class="space-y-4">
            <div class="bg-gray-200 p-4 rounded-lg shadow">
                <h4 class="text-lg font-semibold text-black flex items-center">
                    <span class="material-icons ml-2"></span> Nama Kios
                </h4>
                <p class="text-gray-600 ml-2 whitespace-normal break-all">{{ $kios->nama_kios }}</p> 
            </div>
            <div class="bg-gray-200 p-4 rounded-lg shadow">
                <h4 class="text-lg font-semibold text-black flex items-center">
                    <span class="material-icons ml-2"></span> Alamat
                </h4>
                <p class="text-gray-600 ml-2 whitespace-normal break-all">{{ $kios->alamat }}</p>
            </div>
            <div class="bg-gray-200 p-4 rounded-lg shadow">
                <h4 class="text-lg font-semibold text-black flex items-center">
                    <span class="material-icons ml-2"></span> RT
                </h4>
                <p class="text-gray-600 ml-2 whitespace-normal break-all">{{ $kios->rt }}</p>
            </div>
            <div class="bg-gray-200 p-4 rounded-lg shadow">
                <h4 class="text-lg font-semibold text-black flex items-center">
                    <span class="material-icons ml-2"></span> Kelurahan
                </h4>
                <p class="text-gray-600 ml-2 whitespace-normal break-all">{{ $kios->kelurahan }}</p>
            </div>
            <div class="bg-gray-200 p-4 rounded-lg shadow">
                <h4 class="text-lg font-semibold text-black flex items-center">
                    <span class="material-icons ml-2"></span> Kecamatan
                </h4>
                <p class="text-gray-600 ml-2 whitespace-normal break-all">{{ $kios->kecamatan }}</p>
            </div>
        </div>
        
        <div class="space-y-4">
            <div class="bg-gray-200 p-4 rounded-lg shadow">
                <h4 class="text-lg font-semibold text-black flex items-center">
                    <span class="material-icons ml-2"></span> Nomor Kios
                </h4>
                <p class="text-gray-600 ml-2 whitespace-normal break-all">{{ $kios->nomor_kios }}</p>
            </div>
            <div class="bg-gray-200 p-4 rounded-lg shadow">
                <h4 class="text-lg font-semibold text-black flex items-center">
                    <span class="material-icons ml-2"></span> Nomor HP
                </h4>
                <p class="text-gray-600 ml-2 whitespace-normal break-all">{{ $kios->no_hp }}</p>
            </div>
            <!-- <div class="bg-gray-200 p-4 rounded-lg shadow">
                <h4 class="text-lg font-semibold text-black flex items-center">
                    <span class="material-icons ml-2"></span> Nominal Infaq
                </h4>
                <p class="text-gray-600 ml-2 whitespace-normal break-all">Rp{{ number_format($kios->nominal_infaq, 0, ',', '.') }}</p>
            </div> -->
            <div class="bg-gray-200 p-4 rounded-lg shadow">
                <h4 class="text-lg font-semibold text-black flex items-center">
                    <span class="material-icons ml-2"></span> Tahun
                </h4>
                <p class="text-gray-600 ml-2 whitespace-normal break-all">{{ $kios->tahun }}</p>
            </div>
            <div class="bg-gray-200 p-4 rounded-lg shadow">
                <h4 class="text-lg font-semibold text-black flex items-center">
                    <span class="material-icons ml-2"></span> Keterangan
                </h4>
                <p class="text-gray-600 ml-2 whitespace-normal break-all">{{ $kios->keterangan }}</p>
            </div>
            <div class="bg-gray-200 p-4 rounded-lg shadow">
                <h4 class="text-lg font-semibold text-black flex items-center">
                    <span class="material-icons ml-2"></span> Status
                </h4>
                <p class="ml-2 whitespace-normal break-all 
                    {{ $kios->status === 'aktif' ? 'text-green-600' : 'text-red-600' }}">
                    {{ ucfirst($kios->status) }}
                </p>
            </div>
        </div>
        
        <div class="col-span-1 md:col-span-2">
            <h4 class="text-xl font-semibold text-gray-700 mt-4 mb-2">Foto Kios</h4>
            <div class="bg-gray-100 p-4 rounded-lg shadow">
                @if ($kios->foto)
                    <img src="{{ asset('kios/' . $kios->foto) }}" alt="Foto Kios" class="w-full md:w-1/2 h-auto rounded-lg object-cover mx-auto">
                @else
                    <p class="text-gray-500 text-center">Tidak ada foto tersedia.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="flex justify-end space-x-4 mt-8">
        <a href="{{ route('kios.index') }}" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">Kembali</a>
        <a href="{{ route('infaq.index', $kios->id) }}" class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">Infaq</a>
        <a href="{{ route('kios.edit', $kios->id) }}" class="bg-yellow-500 text-white px-6 py-2 rounded hover:bg-yellow-600">Edit</a>
        <form action="{{ route('kios.destroy', $kios->id) }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin menghapus kios ini?');" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded hover:bg-red-600">Hapus</button>
        </form>
    </div>
</div>

@endsection
