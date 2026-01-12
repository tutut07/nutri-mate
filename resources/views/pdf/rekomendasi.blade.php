<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekomendasi Nutrisi</title>
    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 12px;
        }
        h2, h3 {
            margin-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }
        th {
            background: #eee;
        }
        ul {
            padding-left: 15px;
        }
        hr {
            margin: 10px 0;
        }
    </style>
</head>
<body>

    <h2>Rekomendasi Menu Makanan</h2>

    <p>
        <strong>Nama Pengguna:</strong> {{ $user->name ?? $user->username ?? '-' }} <br>

        <strong>Tanggal:</strong>
        {{ \Carbon\Carbon::parse($tanggal)->format('d-m-Y') }} <br>

        <strong>Jam:</strong>
        {{ \Carbon\Carbon::parse($waktu)->format('H:i') }}
    </p>

    <hr>

    <h3>Data Pengguna</h3>
    <ul>
        <li>Jenis Kelamin: {{ $input['jenis_kelamin'] ?? '-' }}</li>
        <li>Usia: {{ $input['usia'] ?? '-' }} tahun</li>
        <li>Berat Badan: {{ $input['berat'] ?? '-' }} kg</li>
        <li>Tinggi Badan: {{ $input['tinggi'] ?? '-' }} cm</li>
    </ul>


    <h3>Hasil Perhitungan Kebutuhan Gizi Harian</h3>

<table>
    <thead>
        <tr>
            <th>Komponen</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Energi</td>
            <td>{{ number_format($hasilGizi['energi'], 2) }} kkal</td>
        </tr>
        <tr>
            <td>Protein</td>
            <td>{{ number_format($hasilGizi['protein'], 2) }} g</td>
        </tr>
        <tr>
            <td>Lemak</td>
            <td>{{ number_format($hasilGizi['lemak'], 2) }} g</td>
        </tr>
        <tr>
            <td>Karbohidrat</td>
            <td>{{ number_format($hasilGizi['karbo'], 2) }} g</td>
        </tr>
        <tr>
            <td>Serat</td>
            <td>{{ number_format($hasilGizi['serat'], 2) }} g</td>
        </tr>
    </tbody>
</table>


    <h3>Rekomendasi Menu</h3>

    @if($riwayat->count())
        <table>
            <thead>
                <tr>
                    <th>Kategori</th>
                    <th>Nama Menu</th>
                    <th>Energi</th>
                    <th>Protein</th>
                    <th>Lemak</th>
                    <th>Karbo</th>
                    <th>Serat</th>
                </tr>
            </thead>
            <tbody>
                @foreach($riwayat as $item)
                    <tr>
                        <td>{{ $item->kategori }}</td>

                        {{-- NAMA MENU dari tabel bahan --}}
                        <td>{{ optional($item->bahan)->bahan ?? '-' }}</td>

                        <td>{{ optional($item->bahan)->energi ?? 0 }}</td>
                        <td>{{ optional($item->bahan)->protein ?? 0 }}</td>
                        <td>{{ optional($item->bahan)->lemak ?? 0 }}</td>
                        <td>{{ optional($item->bahan)->karbo ?? 0 }}</td>
                        <td>{{ optional($item->bahan)->serat ?? 0 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p><em>Data rekomendasi tidak tersedia.</em></p>
    @endif

    <p style="margin-top:20px;">
        <em>Dokumen ini dihasilkan otomatis oleh sistem rekomendasi nutrisi.</em>
    </p>

</body>
</html>
