@extends('layouts.admin')

@section('content')
<!-- Form Tambah Kios -->
<section class="py-12 bg-gray-100">
    <div class="container mx-auto max-w-6xl">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-3xl font-bold text-center mb-6">Form Tambah Kios</h2>

            <form action="{{ route('kios.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <input type="hidden" name="pemilik_id" value="{{ $pemilik_id }}"> 
                    
                    <!-- Nama Pemilik Kios -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Nama Pemilik Kios</label>
                        <p class="w-full p-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-800">
                            {{ $nama_pemilik }}
                        </p>
                    </div>

                    <!-- Nomor Kios -->
                    <div class="mb-4">
                        <label for="nomor_kios" class="block text-gray-700">Nomor Kios</label>
                        <input type="text" name="nomor_kios" id="nomor_kios" class="w-full p-2 border border-gray-300 rounded-lg bg-gray-300 cursor-not-allowed text-gray-500" value="{{ $nomor_kios }}" readonly>
                    </div>

                    <!-- Nama Kios -->
                    <div class="mb-4">
                        <label for="nama_kios" class="block text-gray-700">Nama Kios</label>
                        <input type="text" name="nama_kios" id="nama_kios" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Nama Kios" required>
                    </div>

                    <!-- No HP -->
                    <div class="mb-4">
                        <label for="no_hp" class="block text-gray-700">No HP</label>
                        <input type="text" name="no_hp" id="no_hp" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Nomor HP" required>
                    </div>
                    
                    <!-- Alamat (Otomatis diisi dari peta) -->
                    <div class="mb-4">
                        <label for="alamat" class="block text-gray-700">Alamat</label>
                        <textarea name="alamat" id="alamat" rows="4" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Alamat Kios" readonly></textarea>
                    </div>

                    <!-- Peta untuk memilih lokasi kios -->
                    <div id="map" class="w-full h-96 rounded-lg shadow-md mb-6"></div>

                    <!-- Input Latitude & Longitude (Hidden) -->
                    <input type="hidden" id="latitude" name="latitude">
                    <input type="hidden" id="longitude" name="longitude">

                    <!-- RT -->
                    <div class="mb-4">
                        <label for="rt" class="block text-gray-700">RT</label>
                        <input type="text" name="rt" id="rt" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="RT" required>
                    </div>

                    <!-- Kelurahan -->
                    <div class="mb-4">
                        <label for="kelurahan" class="block text-gray-700">Kelurahan</label>
                        <input type="text" name="kelurahan" id="kelurahan" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Kelurahan" required>
                    </div>

                    <!-- Kecamatan -->
                    <div class="mb-4">
                        <label for="kecamatan" class="block text-gray-700">Kecamatan</label>
                        <input type="text" name="kecamatan" id="kecamatan" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Kecamatan" required>
                    </div>

                    <!-- Keterangan -->
                    <div class="mb-4">
                        <label for="keterangan" class="block text-gray-700">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" rows="4" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Keterangan"></textarea>
                    </div>

                    <!-- Tahun -->
                    <div class="mb-4">
                        <label for="tahun" class="block text-gray-700">Tahun</label>
                        <input type="number" name="tahun" id="tahun" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Masukkan Tahun" required>
                    </div>

                    <!-- Gambar Kios -->
                    <div class="mb-4">
                        <label for="foto" class="block text-gray-700">Upload Gambar Kios</label>
                        <input type="file" name="foto" id="foto" class="w-full p-2 border border-gray-300 rounded-lg">
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="text-center mt-6">
                    <button type="submit" class="bg-indigo-600 text-white font-semibold py-2 px-6 rounded-full hover:bg-indigo-500 transition">Simpan Kios</button>
                    <a href="{{ url()->previous() }}" class="bg-yellow-500 text-white px-6 py-2 rounded-full hover:bg-yellow-600">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var map = L.map('map').setView([0.13, 117.5], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var marker;

        // ✅ Tambahkan control pencarian ke dalam peta
        var geocoder = L.Control.geocoder({
            defaultMarkGeocode: false,
            placeholder: 'Cari di wilayah Bontang',
            geocoder: L.Control.Geocoder.nominatim({
                geocodingQueryParams: {
                    viewbox: '117.43,0.24,117.62,0.07', // batas Bontang (kira-kira)
                    bounded: 1 // wajib untuk membatasi hasil
                }
            })
        })
        .on('markgeocode', function(e) {
            var center = e.geocode.center;
            map.setView(center, 16);

            if (marker) {
                marker.setLatLng(center);
            } else {
                marker = L.marker(center).addTo(map);
            }
        })
        .addTo(map); // ✅ HARUS ADA ini agar search bar muncul!

        // Event klik di peta
        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            if (marker) {
                marker.setLatLng([lat, lng]);
            } else {
                marker = L.marker([lat, lng]).addTo(map);
            }

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
