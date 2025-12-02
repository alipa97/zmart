@extends('layouts.admin')

@section('content')
<!-- Form Edit Kios -->
<section class="py-12 bg-gray-100">
    <div class="container mx-auto max-w-6xl">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-3xl font-bold text-center mb-6">Form Edit Kios</h2>

            <form action="{{ route('kios.update', $kios->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <input type="hidden" name="pemilik_id" value="{{ $kios->pemilik_id }}"> 

                    <!-- Nama Pemilik Kios -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Nama Pemilik Kios</label>
                        <p class="w-full p-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-800">
                            {{ $pemilik->nama_pemilik }}
                        </p>
                    </div>

                    <!-- Nomor Kios -->
                    <div class="mb-4">
                        <label for="nomor_kios" class="block text-gray-700">Nomor Kios</label>
                        <input type="text" name="nomor_kios" id="nomor_kios" class="w-full p-2 border border-gray-300 rounded-lg bg-gray-300 cursor-not-allowed text-gray-500" value="{{ $kios->nomor_kios }}" readonly>
                    </div>

                    <!-- Nama Kios -->
                    <div class="mb-4">
                        <label for="nama_kios" class="block text-gray-700">Nama Kios</label>
                        <input type="text" name="nama_kios" id="nama_kios" class="w-full p-2 border border-gray-300 rounded-lg" value="{{ $kios->nama_kios }}" placeholder="Nama Kios">
                    </div>
                    
                    <!-- No HP -->
                    <div class="mb-4">
                        <label for="no_hp" class="block text-gray-700">No HP</label>
                        <input type="text" name="no_hp" id="no_hp" class="w-full p-2 border border-gray-300 rounded-lg" value="{{ $kios->no_hp }}" placeholder="Nomor HP">
                    </div>

                    <!-- Alamat -->
                    <div class="mb-4">
                        <label for="alamat" class="block text-gray-700">Alamat</label>
                        <textarea name="alamat" id="alamat" rows="4" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Alamat Kios">{{ $kios->alamat }}</textarea>
                    </div>

                    <!-- Peta untuk memilih lokasi kios -->
                    <div id="map" class="w-full h-96 rounded-lg shadow-md mb-6"></div>

                    <!-- Input Latitude & Longitude (Hidden) -->
                    <input type="hidden" id="latitude" name="latitude" value="{{ $kios->latitude }}">
                    <input type="hidden" id="longitude" name="longitude" value="{{ $kios->longitude }}">

                    <!-- RT -->
                    <div class="mb-4">
                        <label for="rt" class="block text-gray-700">RT</label>
                        <input type="text" name="rt" id="rt" class="w-full p-2 border border-gray-300 rounded-lg" value="{{ $kios->rt }}" placeholder="RT">
                    </div>

                    <!-- Kelurahan -->
                    <div class="mb-4">
                        <label for="kelurahan" class="block text-gray-700">Kelurahan</label>
                        <input type="text" name="kelurahan" id="kelurahan" class="w-full p-2 border border-gray-300 rounded-lg" value="{{ $kios->kelurahan }}" placeholder="Kelurahan">
                    </div>

                    <!-- Kecamatan -->
                    <div class="mb-4">
                        <label for="kecamatan" class="block text-gray-700">Kecamatan</label>
                        <input type="text" name="kecamatan" id="kecamatan" class="w-full p-2 border border-gray-300 rounded-lg" value="{{ $kios->kecamatan }}" placeholder="Kecamatan">
                    </div>

                    <!-- Tahun -->
                    <div class="mb-4">
                        <label for="tahun" class="block text-gray-700">Tahun</label>
                        <input type="text" name="tahun" id="tahun" class="w-full p-2 border border-gray-300 rounded-lg" value="{{ $kios->tahun }}" placeholder="Tahun">
                    </div>

                    <!-- Keterangan -->
                    <div class="mb-4">
                        <label for="keterangan" class="block text-gray-700">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" rows="4" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Keterangan">{{ $kios->keterangan }}</textarea>
                    </div>

                    <!-- Gambar Kios -->
                    <div class="mb-4">
                        <label for="foto" class="block text-gray-700">Upload Gambar Kios</label>
                        <input type="file" name="foto" id="foto" class="w-full p-2 border border-gray-300 rounded-lg">
                        @if ($kios->foto)
                            <p class="text-gray-600 mt-2">Gambar saat ini:</p>
                            <img src="{{ asset('kios/'.$kios->foto) }}" alt="Foto Kios" class="w-20 h-20 mt-2 border rounded">
                        @endif
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="text-center mt-6">
                    <button type="submit" class="bg-indigo-600 text-white font-semibold py-2 px-6 rounded-full hover:bg-indigo-500 transition">Simpan Perubahan</button>
                    <a href="{{ url()->previous() }}" class="bg-yellow-500 text-white px-6 py-2 rounded-full hover:bg-yellow-600">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</section>

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var map = L.map('map').setView([{{ $kios->latitude }}, {{ $kios->longitude }}], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var marker = L.marker([{{ $kios->latitude }}, {{ $kios->longitude }}]).addTo(map);

        // Mengatur nilai latitude dan longitude ketika peta diklik
        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            if (marker) {
                map.removeLayer(marker);
            }

            marker = L.marker([lat, lng]).addTo(map);

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                .then(response => response.json())
                .then(data => {
                    var address = data.display_name || "Alamat tidak ditemukan";
                    document.getElementById('alamat').value = address;
                })
                .catch(error => console.error('Error:', error));
        });
    });
</script>
@endsection
