@extends('layouts.admin')

@section('content')

<section class="py-12 bg-gray-100">
    <div class="container mx-auto max-w-6xl">
        <div class="bg-white p-8 rounded-lg shadow-lg">

            <h2 class="text-3xl font-bold text-center mb-6">
                {{ isset($infaq) ? 'Edit Infaq Kios' : 'Tambah Infaq Kios' }}
            </h2>

            <form action="{{ isset($infaq) 
                ? route('semua-infaq.update', $infaq->id) 
                : route('semua-infaq.store') }}" method="POST">
                @csrf
                @if(isset($infaq))
                    @method('PUT')
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Pilih Kios -->
                    <div class="mb-4">
                        <label for="kios_id" class="block text-gray-700 font-semibold">Pilih Kios</label>
                        <select name="kios_id" id="kios_id" required
                            class="w-full p-2 border border-gray-300 rounded-lg">
                            <option value="">-- Pilih Kios --</option>
                            @foreach($daftarKios as $kios)
                                <option value="{{ $kios->id }}"
                                    {{ old('kios_id', $infaq->kios_id ?? '') == $kios->id ? 'selected' : '' }}>
                                    {{ $kios->nama_kios }} ({{ $kios->nomor_kios }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tanggal -->
                    <div class="mb-4">
                        <label for="tanggal" class="block text-gray-700 font-semibold">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" required
                            class="w-full p-2 border border-gray-300 rounded-lg"
                            value="{{ old('tanggal', $infaq->tanggal ?? '') }}">
                    </div>

                    <!-- Nominal -->
                    <div class="mb-4">
                        <label for="nominal" class="block text-gray-700 font-semibold">Nominal (Rp)</label>
                        <input type="number" name="nominal" id="nominal" required
                            class="w-full p-2 border border-gray-300 rounded-lg"
                            value="{{ old('nominal', $infaq->nominal ?? '') }}">
                    </div>

                    <!-- Via / Metode -->
                    <div class="mb-4">
                        <label for="via" class="block text-gray-700 font-semibold">Via / Metode</label>
                        <input type="text" name="via" id="via" required
                            class="w-full p-2 border border-gray-300 rounded-lg"
                            value="{{ old('via', $infaq->via ?? '') }}" placeholder="Contoh: Tunai, Transfer, dll">
                    </div>
                </div>

                <!-- Tombol -->
                <div class="text-center mt-6 space-x-4">
                    <button type="submit" 
                        class="bg-indigo-600 text-white font-semibold py-2 px-6 rounded-full hover:bg-indigo-500 transition">
                        {{ isset($infaq) ? 'Update Infaq' : 'Simpan Infaq' }}
                    </button>
                    <a href="{{ route('semua-infaq.index') }}" 
                        class="bg-yellow-500 text-white px-6 py-2 rounded-full hover:bg-yellow-600">Kembali</a>
                </div>
            </form>

        </div>
    </div>
</section>

@endsection
