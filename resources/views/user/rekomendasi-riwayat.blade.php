@extends('layouts.app')

@section('content')
<div class="container py-5">

    <h2 class="text-center mb-4 text-success fw-bold">
        Riwayat Rekomendasi Makanan
    </h2>

    @if($riwayat->isEmpty())
        <div class="alert alert-info text-center">
            Belum ada riwayat rekomendasi.
        </div>
    @else

        @foreach($riwayat as $group)

            @php
                // 🔥 Ambil data PASTI dari database
                $first   = $group->first();
                $tanggal = $first->tanggal;
                $nama    = $first->nama;
            @endphp

            <div class="card mb-4 shadow-sm">

                {{-- HEADER --}}
                <div class="card-header bg-success text-white
            d-flex justify-content-between align-items-center">

    <div>
        Tanggal: {{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}
        <br>
        Nama: <strong>{{ $nama }}</strong>
    </div>

    <div class="d-flex gap-2">
        {{-- DOWNLOAD --}}
        <a href="{{ route('riwayat.download', [$tanggal, $nama]) }}"
           class="btn btn-sm btn-light text-success fw-bold">
            ⬇ Download PDF
        </a>

        {{-- HAPUS --}}
        <form action="{{ route('riwayat.hapus', [$tanggal, $nama]) }}"
              method="POST"
              onsubmit="return confirm('Yakin ingin menghapus riwayat ini?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger fw-bold">
                🗑 Hapus
            </button>
        </form>
    </div>

</div>

                {{-- BODY --}}
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="table-success">
                            <tr class="text-center">
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Nama Bahan</th>
                                <th>Energi</th>
                                <th>Protein</th>
                                <th>Lemak</th>
                                <th>Karbo</th>
                                <th>Serat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($group as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->kategori }}</td>
                                    <td>{{ $item->bahan->bahan ?? '-' }}</td>
                                    <td>{{ $item->bahan->energi ?? 0 }}</td>
                                    <td>{{ $item->bahan->protein ?? 0 }}</td>
                                    <td>{{ $item->bahan->lemak ?? 0 }}</td>
                                    <td>{{ $item->bahan->karbo ?? 0 }}</td>
                                    <td>{{ $item->bahan->serat ?? 0 }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        @endforeach

    @endif
</div>
@endsection
