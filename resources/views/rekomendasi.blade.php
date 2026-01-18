@extends('layouts.app')

@section('content')
<div class="container py-5">

@guest
    <div class="alert alert-warning text-center p-4 rounded-3 shadow-sm">
        <h4 class="text-danger mb-2">Akses Ditolak!</h4>
        <p>
            Silakan
            <a href="{{ url('/login') }}" class="fw-bold text-decoration-none text-success">
                login terlebih dahulu
            </a>
            untuk menghitung rekomendasi menu bergizi.
        </p>
    </div>
@else

<div class="card shadow-lg p-4 border-0 rounded-4">
    <h2 class="text-center mb-4 text-success fw-bold">
        Rekomendasi Menu Makanan Bergizi
    </h2>

    {{-- ================= ERROR GLOBAL ================= --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ================= FORM INPUT ================= --}}
    @if(!isset($rekomendasi))
    <form action="{{ url('/rekomendasi/hitung') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="mb-3">
</div>
    <div class="mb-3">
    <label class="form-label fw-semibold">Nama</label>
    <input
        type="text"
        name="nama"
        class="form-control"
        placeholder="Masukkan nama"
        value="{{ old('nama', $input['nama'] ?? '') }}"
        required
    >
</div>


            <div class="col-md-6">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select" required>
                    <option value="">-- Pilih --</option>
                    <option value="pria" {{ old('jenis_kelamin')=='pria' ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="wanita" {{ old('jenis_kelamin')=='wanita' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Usia (tahun)</label>
                <input type="number"
                       name="usia"
                       class="form-control"
                       min="4"
                       max="18"
                       value="{{ old('usia') }}"
                       required>
                <small class="text-muted">Usia anak sekolah: 4 – 18 tahun</small>
                @error('usia')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Berat Badan (kg)</label>
                <input type="number"
                       name="berat"
                       class="form-control"
                       value="{{ old('berat') }}"
                       required>
                @error('berat')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Tinggi Badan (cm)</label>
                <input type="number"
                       name="tinggi"
                       class="form-control"
                       value="{{ old('tinggi') }}"
                       required>
                @error('tinggi')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="text-center mt-4">
            <button class="btn btn-success px-4">Hitung</button>
        </div>
    </form>
    @endif


    {{-- ================= HASIL ================= --}}
    @if(isset($rekomendasi))

    <div class="row mt-4">

        {{-- KIRI --}}
        <div class="col-md-6">
            <h5 class="fw-bold text-primary">Hasil Perhitungan Kebutuhan</h5>
            <ul class="list-group mb-3">
                <li class="list-group-item">Kalori Harian: {{ number_format($kalori_harian,2) }} kkal</li>
                <li class="list-group-item">Protein: {{ number_format($protein_harian,2) }} g</li>
                <li class="list-group-item">Lemak: {{ number_format($lemak_harian,2) }} g</li>
                <li class="list-group-item">Karbohidrat: {{ number_format($karbo_harian,2) }} g</li>
                <li class="list-group-item">Serat: {{ number_format($serat_harian,2) }} g</li>
            </ul>
        </div>

        {{-- KANAN --}}
        <div class="col-md-6">
            <h5 class="fw-bold text-success text-center">
                Grafik Target vs Kondisi Anak
            </h5>
            <canvas id="nutrisiChart"></canvas>
        </div>
    </div>

    {{-- ================= TABEL MENU ================= --}}
    <h5 class="fw-bold text-success mt-5">
        Menu Makanan yang Direkomendasikan
    </h5>

    <form action="{{ url('/rekomendasi/tolak') }}" method="POST">
        @csrf
        <table class="table table-bordered table-hover mt-3">
            <thead class="table-success">
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Nama Bahan</th>
                    <th>Energi</th>
                    <th>Protein</th>
                    <th>Lemak</th>
                    <th>Karbo</th>
                    <th>Serat</th>
                    <th>Tidak Disukai</th>
                </tr>
            </thead>
            <tbody>
            @foreach($rekomendasi as $i => $item)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td>{{ $item->bahan }}</td>
                    <td>{{ $item->energi }}</td>
                    <td>{{ $item->protein }}</td>
                    <td>{{ $item->lemak }}</td>
                    <td>{{ $item->karbo }}</td>
                    <td>{{ $item->serat }}</td>
                    <td class="text-center">
                        <input type="checkbox" name="tidak_suka[]" value="{{ $item->id }}">
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        @foreach($input as $k => $v)
            <input type="hidden" name="{{ $k }}" value="{{ $v }}">
        @endforeach

        <div class="text-center mt-3">
            <button class="btn btn-warning">Ganti Menu</button>
            <a href="{{ url('/rekomendasi') }}" class="btn btn-secondary ms-2">Hitung Ulang</a>
            <a href="{{ route('rekomendasi.riwayat') }}" class="btn btn-outline-success ms-2">
                Riwayat
            </a>
        </div>
    </form>

    @endif
</div>
@endguest
</div>

{{-- ================= SCRIPT GRAFIK ================= --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@if(isset($rekomendasi))
<script>
new Chart(document.getElementById('nutrisiChart'), {
    type: 'bar',
    data: {
        labels: ['Energi','Protein','Lemak','Karbohidrat','Serat'],
        datasets: [
            {
                label: 'Target Harian',
                data: [
                    {{ $kalori_harian }},
                    {{ $protein_harian }},
                    {{ $lemak_harian }},
                    {{ $karbo_harian }},
                    {{ $serat_harian }}
                ]
            },
            {
                label: 'Kondisi Anak Saat Ini',
                data: [
                    {{ $aktual['energi'] }},
                    {{ $aktual['protein'] }},
                    {{ $aktual['lemak'] }},
                    {{ $aktual['karbo'] }},
                    {{ $aktual['serat'] }}
                ]
            }
        ]
    },
    options: {
        responsive: true,
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>
@endif
@endsection
