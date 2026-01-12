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
        @foreach($riwayat as $tanggal => $items)
            <div class="card mb-4 shadow-sm">

                <div class="card-header bg-success text-white 
                            d-flex justify-content-between align-items-center">
                    <span>
                        📅 {{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}
                    </span>

                    <a href="{{ route('riwayat.download', $tanggal) }}"
                       class="btn btn-sm btn-light text-success fw-bold">
                        ⬇ Download PDF
                    </a>
                </div>

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
                            @foreach($items as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->kategori }}</td>
                                    <td>{{ $item->bahan->bahan }}</td>
                                    <td>{{ $item->bahan->energi }}</td>
                                    <td>{{ $item->bahan->protein }}</td>
                                    <td>{{ $item->bahan->lemak }}</td>
                                    <td>{{ $item->bahan->karbo }}</td>
                                    <td>{{ $item->bahan->serat }}</td>
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
