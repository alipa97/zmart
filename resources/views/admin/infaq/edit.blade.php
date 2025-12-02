@extends('layouts.admin')

@section('content')
<!-- Form Edit Infaq Kios -->
<section class="py-12 bg-gray-100">
    <div class="container mx-auto max-w-4xl">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-3xl font-bold text-center mb-6">Form Edit Infaq Kios {{ $kios->nama_kios }}</h2>

            <form action="{{ route('infaq.update', ['kios_id' => $kios_id, 'infaqKios' => $infaqKios->id]) }}" method="POST">
                @csrf
                @method('PUT') <!-- Method PUT untuk update -->

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nominal Infaq -->
                    <div class="mb-4">
                        <label for="nominal" class="block text-gray-700">Nominal Infaq</label>
                        <input type="number" name="nominal" id="nominal" class="w-full p-2 border border-gray-300 rounded-lg" value="{{ old('nominal', $infaqKios->nominal) }}" required>
                    </div>

                    <!-- Tanggal Infaq -->
                    <div class="mb-4">
                        <label for="tanggal" class="block text-gray-700">Tanggal Infaq</label>
                        <input type="date" name="tanggal" id="tanggal" class="w-full p-2 border border-gray-300 rounded-lg" value="{{ old('tanggal', $infaqKios->tanggal) }}" required>
                    </div>

                    <!-- Via (Metode Pembayaran) -->
                    <div class="mb-4">
                        <label for="via" class="block text-gray-700">Via</label>
                        <input type="text" name="via" id="via" class="w-full p-2 border border-gray-300 rounded-lg" value="{{ old('via', $infaqKios->via) }}" required>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="text-center mt-6">
                    <a href="{{ route('infaq.index', $infaqKios->kios_id) }}" class="bg-yellow-500 text-white px-6 py-2 rounded-full hover:bg-yellow-600">Kembali</a>
                    <button type="submit" class="bg-indigo-600 text-white font-semibold py-2 px-6 rounded-full hover:bg-indigo-500 transition">Update Infaq</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
