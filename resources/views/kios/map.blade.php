@extends('layouts.master')

@section('content')

<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-8">Peta Kota Bontang</h2>

        <div class="text-center p-4">
            <a href="{{ route('kios.rute') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow hover:bg-blue-600">Cari Rute</a>
            <!-- fitur pencarian kios -->
            <input type="text" id="searchInput" placeholder="Cari kios..." class="border p-2 rounded ml-4 w-1/3">
        </div>
        
        <div id="map" class="w-full h-[500px] rounded-lg shadow-md"></div> <!-- Berikan tinggi yang jelas untuk div map -->
    </div>
</section>

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Inisialisasi peta
        var map = L.map('map').setView([0.13, 117.5], 14);

        // Tambahkan tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Ikon warna
        var iconBiru = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-blue.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        var iconMerah = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        // Data kios
        var kiosData = @json($kios);
        var markers = [];

        // Tambahkan marker ke peta
        kiosData.forEach(function(kios) {
            if (kios.latitude && kios.longitude) {
                var icon = kios.status === 'aktif' ? iconBiru : iconMerah;
                var marker = L.marker([kios.latitude, kios.longitude], { icon: icon })
                    .bindPopup("<b>" + kios.nama_kios + "</b><br>Lokasi: " + kios.alamat + "<br>Status: " + kios.status);
                marker.kiosInfo = kios; // simpan data kios di marker
                marker.addTo(map);
                markers.push(marker);
            }
        });

        // Fungsi pencarian
        document.getElementById('searchInput').addEventListener('input', function () {
            var keyword = this.value.toLowerCase();

            var found = false;
            markers.forEach(function(marker) {
                var nama = marker.kiosInfo.nama_kios.toLowerCase();
                var alamat = marker.kiosInfo.alamat.toLowerCase();
                var match = nama.includes(keyword) || alamat.includes(keyword);

                if (match) {
                    marker.addTo(map);
                    if (!found) {
                        map.setView(marker.getLatLng(), 16); // fokus ke hasil pertama
                        marker.openPopup();
                        found = true;
                    }
                } else {
                    map.removeLayer(marker);
                }
            });
        });
    });
</script>



@endsection