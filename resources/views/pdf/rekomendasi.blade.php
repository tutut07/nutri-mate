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

    {{-- ========================= --}}
    {{-- DATA AKUN (LOGIN) --}}
    {{-- ========================= --}}
    <p>
        <strong>Nama Akun:</strong>
        {{ $user->name ?? $user->username ?? '-' }} <br>

        <strong>Tanggal:</strong>
        {{ \Carbon\Carbon::parse($tanggal)->format('d-m-Y') }} <br>

        <strong>Jam:</strong>
        {{ $jam }}
    </p>

    <hr>

    {{-- ========================= --}}
    {{-- DATA PENGGUNA (ANAK) --}}
    {{-- ========================= --}}
    @php
        $anak = $riwayat->first();
    @endphp

    <h3>Data Pengguna (Anak)</h3>

    <ul>
        <li><strong>Nama Anak:</strong> {{ $anak->nama ?? '-' }}</li>
        <li><strong>Jenis Kelamin:</strong> {{ $anak->jenis_kelamin ?? '-' }}</li>
        <li><strong>Usia:</strong> {{ $anak->usia ?? '-' }} tahun</li>
        <li><strong>Berat Badan:</strong> {{ $anak->berat ?? '-' }} kg</li>
        <li><strong>Tinggi Badan:</strong> {{ $anak->tinggi ?? '-' }} cm</li>
    </ul>

    <hr>

    {{-- ========================= --}}
    {{-- HASIL GIZI --}}
    {{-- ========================= --}}
    <h3>Hasil Perhitungan Kebutuhan Gizi</h3>

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

    <hr>

    {{-- ========================= --}}
    {{-- TABEL REKOMENDASI --}}
    {{-- ========================= --}}
    <h3>Rekomendasi Menu</h3>

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

    <p style="margin-top:20px;">
        <em>Dokumen ini dihasilkan otomatis oleh sistem rekomendasi nutrisi.</em>
    </p>

</body>
</html>
