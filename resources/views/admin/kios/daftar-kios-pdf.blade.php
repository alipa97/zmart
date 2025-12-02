<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Kios Zmart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }

        .header img {
            position: absolute;
            top: -12;
            left: 10px;
            width: 80px;
        }

        .header h1 {
            font-size: 18px;
            margin: 2;
        }

        .header p {
            font-size: 12px;
            margin-top: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #999;
            padding: 6px 4px;
            vertical-align: top;
        }

        th {
            background-color: #d4edda;
            text-align: center;
        }

        td.center {
            text-align: center;
        }

        td.left {
            text-align: left;
        }

        /* Optional: Biarkan kolom tetap proporsional */
        th:nth-child(1) { width: 30px; }      /* No */
        th:nth-child(2) { width: 60px; }      /* Nomor Kios */
        th:nth-child(3) { width: 100px; }     /* Nama Kios */
        th:nth-child(4) { width: 100px; }     /* Pemilik */
        th:nth-child(5) { width: 150px; }     /* Alamat */
        th:nth-child(6) { width: 30px; }      /* RT */
        th:nth-child(7) { width: 80px; }      /* Kelurahan */
        th:nth-child(8) { width: 80px; }      /* Kecamatan */
        th:nth-child(9) { width: 90px; }      /* No HP */
        th:nth-child(10) { width: 100px; }    /* Keterangan */
    </style>
</head>
<body>

    <div class="header">
        <img src="{{ public_path('img/logo baznas bontang.png') }}" alt="Logo">
        <h1>DAFTAR KIOS ZMART</h1>
        <h1>BADAN AMIL ZAKAT NASIONAL KOTA BONTANG</h1>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Kios</th>
                <th>Nama Kios</th>
                <th>Pemilik</th>
                <th>Alamat</th>
                <th>RT</th>
                <th>Kelurahan</th>
                <th>Kecamatan</th>
                <th>No HP</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kios as $index => $item)
            <tr>
                <td class="center">{{ $index + 1 }}</td>
                <td class="center">{{ $item->nomor_kios }}</td>
                <td class="left">{{ $item->nama_kios }}</td>
                <td class="left">{{ $item->pemilik->nama_pemilik ?? 'Tidak Diketahui' }}</td>
                <td class="left">{{ $item->alamat }}</td>
                <td class="center">{{ $item->rt }}</td>
                <td class="center">{{ $item->kelurahan }}</td>
                <td class="center">{{ $item->kecamatan }}</td>
                <td class="center">{{ $item->no_hp }}</td>
                <td class="left">{{ $item->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
