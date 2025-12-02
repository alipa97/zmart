@extends('layouts.admin')

@section('content')

<h3 class="text-3xl font-medium text-gray-700">Daftar Infaq Kios {{ $kios->nama_kios }}</h3>

<div class="container mx-auto mt-2">
    <div class="py-5">
        <a href="{{ route('infaq.create', $kios->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Tambah Infaq</a>
        <a href="{{ route('kios.show', $kios->id) }}" class="bg-yellow-500 text-white px-6 py-2 rounded hover:bg-yellow-600">Kembali</a>
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
                                Nominal
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Tanggal
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Via
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($infaqKios as $index => $infaq)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-medium leading-5 text-gray-900">{{ $index + 1 }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-medium leading-5 text-gray-900">Rp {{ number_format($infaq->nominal, 0, ',', '.') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-medium leading-5 text-gray-900">{{ $infaq->tanggal }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">{{ $infaq->via }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium leading-5 text-right whitespace-no-wrap border-b border-gray-200">
                                    <div class="flex justify-end space-x-1">
                                        <a href="{{ route('infaq.edit', ['kios_id' => $kios->id, 'infaqKios' => $infaq->id]) }}" class="bg-blue-500 text-white px-3 py-2 rounded hover:bg-blue-600">Edit</a>
                                        <form action="{{ route('infaq.destroy', ['kios_id' => $kios->id, 'infaqKios' => $infaq->id] ) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600">
                                                Delete
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
