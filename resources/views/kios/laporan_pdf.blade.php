<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penerimaan Zakat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 40px; /* Menambahkan ruang agar tidak terlalu rapat */
            position: relative;
        }

        .header img {
            position: absolute;
            top: 0px; /* Menyesuaikan jarak logo dari atas */
            left: 5px; /* Menyesuaikan jarak logo dari kiri */
            width: 100px;
            height: auto;
            margin-top: -20px; /* Memberikan jarak lebih untuk tidak menutupi tabel */
            margin-bottom: 10px;
        }

        .header h1 {
            font-size: 18px;
            margin: 0;
        }
        .header h2 {
            font-size: 16px;
            margin: 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th {
            background-color: #d4edda; /* Hijau soft */
            border: 1px solid #ccc;
            text-align: left;
            padding: 8px;
        }
        .table td {
            border: 1px solid #ccc;
            padding: 8px;
        }
        .total {
            text-align: right;
            font-weight: bold;
            margin-top: 20px;
        }
        .narrow {
            width: 80px; /* Atur lebar tetap */
            text-align: center; /* Rata tengah */
        }
    </style>
</head>
<body>

    <div class="header">
        <img src="{{ public_path('img/logo baznas bontang.png') }}" alt="Logo Baznas Bontang" class="w-12 h-12">
        <h1>LAPORAN PENERIMAAN INFAQ SEDEKAH KIOS ZMART</h1> 
        <h1>BADAN AMIL ZAKAT NASIONAL KOTA BONTANG</h1>
        <!-- ini kalau mau ada bulan dan tahun hari dimana laporan di print -->
        <!-- <h1>BULAN {{ strtoupper(now()->translatedFormat('F Y')) }}</h1> --> 
    </div>

    <table class="table">
        <thead>
            <tr>
                <th style="text-align: center;">Nomor Kios</th> <!-- Kolom nomor kios -->
                <th style="text-align: center;">Nama Kios</th>
                <th style="text-align: center;">Tanggal</th>
                <th style="text-align: center;">Nominal</th>
                <th style="text-align: center;">Via</th>
            </tr>
        </thead>
        <tbody>
            @php $nomorUrut = 1; @endphp
            @foreach($infaqKiosGrouped as $kiosNama => $infaqs)
                <tr style="text-align: center;">
                    <td class="narrow" rowspan="{{ $infaqs->count() }}">
                        {{ $infaqs->first()->kios->nomor_kios ?? 'Tidak Ada' }}
                    </td> <!-- Nomor kios -->
                    <td rowspan="{{ $infaqs->count() }}">{{ $kiosNama }}</td> <!-- Nama kios -->
                    @foreach($infaqs as $index => $infaq)
                        @if($index > 0)
                            <tr style="text-align: center;">
                        @endif
                        <td>{{ \Carbon\Carbon::parse($infaq->tanggal)->format('d-m-Y') }}</td>
                        <td>Rp{{ number_format($infaq->nominal, 0, ',', '.') }}</td>
                        <td>{{ $infaq->via }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tr>
        </tbody>
    </table>



    <p class="total">Total Penerimaan: Rp{{ number_format($totalInfaq, 0, ',', '.') }}</p>

</body>
</html>
