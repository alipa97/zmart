@extends('layouts.master')

@section('content')

<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-8">Peta Kota Bontang</h2>

        <!-- Dropdown untuk memilih kios tujuan -->
        <div class="mb-4">
            <label for="endPoint" class="block text-lg font-medium">Pilih Kios Tujuan:</label>
            <select id="endPoint" class="w-full p-2 border rounded">
                @foreach ($kios as $kios)
                    <option value="{{ $kios->latitude }},{{ $kios->longitude }}">{{ $kios->nama_kios }}</option>
                @endforeach
            </select>
            <p class="py-2"><b>Kemudian pilih lokasi anda di peta</b></p>
        </div>

        <div class="text-center">
            <button id="routeButton" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow hover:bg-blue-600">
                Tampilkan Rute
            </button>
        </div>

        <!-- Div untuk peta -->
        <div id="map" class="w-full h-[500px] rounded-lg shadow-md mt-4"></div> 
        <div class="py-4">
            <a href="{{ url()->previous() }}" class="bg-yellow-500 text-white px-6 py-2 rounded-full hover:bg-yellow-600">Kembali</a>
        </div>

    </div>
</section>

<!-- Leaflet & Geocoder -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Inisialisasi peta
        var map = L.map('map').setView([0.13, 117.5], 14);

        // Tambahkan layer OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var startMarker;  // Variable untuk marker titik awal

        // Fungsi untuk menambahkan marker pada peta
        function addStartMarker(lat, lng) {
            if (startMarker) {
                // Hapus marker sebelumnya jika ada
                map.removeLayer(startMarker);
            }
            startMarker = L.marker([lat, lng]).addTo(map)
                .bindPopup("Titik Awal")
                .openPopup();
            
            // Simpan koordinat titik awal ke elemen input
            document.getElementById('startPoint').value = lat + "," + lng;
        }

        // Event listener untuk klik di peta
        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;
            addStartMarker(lat, lng);  // Tambahkan marker pada posisi klik
        });

        // Inisialisasi input untuk titik awal (sebagai placeholder)
        var startPointInput = document.createElement('input');
        startPointInput.type = 'hidden';
        startPointInput.id = 'startPoint';
        document.body.appendChild(startPointInput);

        // Tombol untuk menampilkan rute
        var routeButton = document.getElementById('routeButton');
        routeButton.addEventListener('click', function () {
            var startPoint = document.getElementById('startPoint').value;
            var endPoint = document.getElementById('endPoint').value;

            // Jika titik awal belum dipilih (tidak ada koordinat)
            if (!startPoint) {
                alert("Pilih titik awal Anda dengan mengklik peta.");
                return;
            }

            // Pastikan koordinat valid
            var startCoords = startPoint.split(',');
            var endCoords = endPoint.split(',');

            // Tambahkan rute ke peta
            L.Routing.control({
                waypoints: [
                    L.latLng(startCoords[0], startCoords[1]),
                    L.latLng(endCoords[0], endCoords[1])
                ],
                // routeWhileDragging: true
            }).addTo(map);
        });
    });
</script>

@endsection
