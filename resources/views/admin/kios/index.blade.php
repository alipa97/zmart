@extends('layouts.admin')

@section('content')

<h3 class="text-3xl font-medium text-gray-700">Kios</h3>

<div class="container mx-auto mt-2">
    {{-- Awal Bagian Flash Message --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Berhasil!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Gagal!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif
    {{-- Akhir Bagian Flash Message --}}
    <div class="py-5">
        <form method="GET" action="{{ route('kios.index') }}" class="mb-4">
            <input type="text" name="search" placeholder="Cari nama pengguna..." class="border p-2 rounded">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Cari</button>
            <a href="{{ route('verify.index') }}" class="bg-blue-500 text-white px-12 py-2 rounded hover:bg-blue-600">Tambah</a>
            <a href="{{ route('kios.laporan') }}" class="bg-gray-500 text-white px-12 py-2 rounded hover:bg-gray-600">Print Laporan</a>
        </form>
    </div>
    <div class="flex flex-col">
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                No
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Nama Kios
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Nomor Kios
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Pemilik
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Alamat
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Status
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($kios as $index => $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-medium leading-5 text-gray-900">{{ $index + 1 }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-medium leading-5 text-gray-900">{{ $item->nama_kios }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-medium leading-5 text-gray-900">{{ $item->nomor_kios }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">{{ $item->pemilik->nama_pemilik }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">{{ $item->alamat }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 {{ $item->status === 'aktif' ? 'text-green-600 font-semibold' : 'text-zinc-600 font-semibold' }}">
                                        {{ ucfirst($item->status) }}
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-sm font-medium leading-5 text-right whitespace-no-wrap border-b border-gray-200">
                                    <div class="flex justify-end space-x-1"> <!-- Menggunakan flex dan space-x-2 untuk jarak -->
                                        <a href="{{ route('kios.show', $item->id) }}" class="bg-blue-500 text-white px-3 py-2 rounded hover:bg-blue-600">Detail</a>
                                        <a href="{{ route('kios.edit', $item->id) }}" class="bg-yellow-500 text-white px-3 py-2 rounded hover:bg-yellow-600">Edit</a>
                                        <form action="{{ route('kios.destroy', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600">
                                                Delete
                                            </button>
                                        </form>
                                        <form action="{{ route('kios.toggleStatus', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="{{ $item->status === 'aktif' ? 'bg-green-600 hover:bg-green-700 px-3' : 'bg-zinc-600 hover:bg-zinc-700 px-6' }} text-white py-2 rounded">
                                                {{ $item->status === 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
