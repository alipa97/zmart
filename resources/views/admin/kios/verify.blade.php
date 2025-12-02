@extends('layouts.admin')

@section('content')
<h3 class="text-3xl font-medium text-gray-700">Verifikasi Pemilik Kios</h3>

<div class="container mx-auto mt-4">
    <p class="text-gray-600 mb-4">Apakah pemilik sudah terdaftar? Silakan cari nama pemilik dan pilih pemilik terlebih dahulu.</p>

    <form method="GET" action="{{ route('verify.index') }}" class="mb-4">
        <input type="text" name="search" placeholder="Cari nama pemilik..." class="border p-2 rounded">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Cari</button>
        <a href="{{ route('pemilik.create') }}" class="bg-purple-800 text-white px-4 py-2 rounded hover:bg-blue-600">Belum ada pemilik? Tambah Pemilik</a>
        <a href="{{ url()->previous() }}" class="bg-yellow-500 text-white px-6 py-2 rounded hover:bg-yellow-600">Kembali</a>
    </form>


    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="px-6 py-3 border-b">No</th>
                <th class="px-6 py-3 border-b">Nama Pemilik</th>
                <th class="px-6 py-3 border-b">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pemilik as $index => $item)
            <tr>
                <td class="px-6 py-4 border-b">{{ $index + 1 }}</td>
                <td class="px-6 py-4 border-b">{{ $item->nama_pemilik }}</td>
                <td class="px-6 py-4 border-b">
                    <a href="{{ route('kios.create', $item->id) }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        Pilih Pemilik
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
