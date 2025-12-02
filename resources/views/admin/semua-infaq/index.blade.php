@extends($layout)

@section('content')

<h3 class="text-3xl font-medium text-gray-700">Semua Infaq Kios</h3>

<div class="container mx-auto mt-2">
    <!-- <div class="py-5">
        <a href="{{ route('semua-infaq.create') }}" class="bg-blue-500 text-white px-12 py-2 rounded hover:bg-blue-600">Tambah</a>
        <a href="{{ route('kios.laporan') }}" class="bg-gray-500 text-white px-12 py-2 rounded hover:bg-gray-600">Print Laporan</a>
    </div> -->
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
    <div class="py-5 flex flex-wrap justify-between items-center gap-4">
        <!-- Form filter tanggal -->
        <form method="GET" action="{{ route('semua-infaq.index') }}" class="flex items-center gap-2">
            <label for="tanggal" class="text-gray-700 font-medium">Pilih Tanggal:</label>
            <input type="date" name="tanggal" id="tanggal" class="border p-2 rounded">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Tampilkan</button>
        </form>

        <!-- Tombol Tambah dan Laporan -->
        <div class="flex gap-2">
            <a href="{{ route('semua-infaq.create') }}" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">Tambah</a>
            <!-- <a href="{{ route('kios.laporan') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Print Laporan</a> -->
            <a href="{{ route('semua-infaq.laporan', ['tanggal' => request('tanggal')]) }}"
            class="bg-gray-500 text-white px-12 py-2 rounded hover:bg-gray-600">
            Print Laporan
            </a>

        </div>
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
                                Tanggal
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Nominal
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Metode/Via
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($infaqs as $index => $infaq)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-medium leading-5 text-gray-900">{{ $index + 1 }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-medium leading-5 text-gray-900">{{ $infaq->kios->nama_kios }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">{{ \Carbon\Carbon::parse($infaq->tanggal)->format('d M Y') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">Rp {{ number_format($infaq->nominal, 0, ',', '.') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">{{ $infaq->via }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium leading-5 text-right whitespace-no-wrap border-b border-gray-200">
                                    <div class="flex justify-end space-x-1"> <!-- Menggunakan flex dan space-x-2 untuk jarak -->
                                        <a href="{{ route('semua-infaq.edit', $infaq->id) }}" class="bg-blue-500 text-white px-3 py-2 rounded hover:bg-blue-600">Edit</a>
                                        <form action="{{ route('semua-infaq.destroy', $infaq->id) }}" method="POST" class="inline">
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
