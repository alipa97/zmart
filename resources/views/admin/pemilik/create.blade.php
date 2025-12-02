@extends('layouts.admin')

@section('content')
<!-- Form Tambah Pemilik Kios -->
<section class="py-12 bg-gray-100">
    <div class="container mx-auto max-w-6xl">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-3xl font-bold text-center mb-6">Form Tambah Pemilik Kios</h2>

            <form action="{{ route('pemilik.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Pemilik -->
                    <div class="mb-4">
                        <label for="nama_pemilik" class="block text-gray-700">Nama Pemilik</label>
                        <input type="text" name="nama_pemilik" id="nama_pemilik" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Nama Pemilik" required>
                    </div>

                    <!-- Tempat Lahir -->
                    <div class="mb-4">
                        <label for="tempat_lahir" class="block text-gray-700">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" id="tempat_lahir" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Tempat Lahir">
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="mb-4">
                        <label for="tanggal_lahir" class="block text-gray-700">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="w-full p-2 border border-gray-300 rounded-lg">
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="text-center mt-6">
                    <a href="{{ url()->previous() }}" class="bg-yellow-500 text-white px-6 py-2 rounded-full hover:bg-yellow-600">Kembali</a>
                    <button type="submit" class="bg-indigo-600 text-white font-semibold py-2 px-6 rounded-full hover:bg-indigo-500 transition">Simpan Pemilik Kios</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
