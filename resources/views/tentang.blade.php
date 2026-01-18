@extends('layouts.app')

@section('content')
<style>
    .btn-tentang {
    background: linear-gradient(90deg, #8fc414, #60c414);
    color: #fff;
    border: none;
}
</style>
<div class="container py-5">

    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

        <div class="row g-0 align-items-center">

            {{-- GAMBAR --}}
            <div class="col-md-5">
                <img src="{{ asset('images/home/tentang.jpg') }}"
                     class="img-fluid h-100 w-100 object-fit-cover"
                     alt="Gizi Anak">
            </div>

            {{-- KONTEN --}}
            <div class="col-md-7">
                <div class="card-body p-4 p-md-5">

                    <h2 class="fw-bold text-success mb-3">
                        Tentang NutriMate
                    </h2>

                    <p class="text-muted mb-4">
                        <strong>NutriMate</strong> adalah aplikasi rekomendasi makanan
                        yang membantu orang tua dan anak sekolah dalam memilih
                        menu makanan bergizi berdasarkan kebutuhan nutrisi harian.
                        Sistem ini mengolah data gizi untuk memberikan rekomendasi
                        menu yang seimbang guna mendukung pertumbuhan dan aktivitas belajar.
                    </p>

                    <div class="mb-4">
                        <h5 class="fw-semibold text-success">Tujuan</h5>
                        <ul class="text-muted">
                            <li>Meningkatkan kesadaran pentingnya gizi seimbang.</li>
                            <li>Menyediakan rekomendasi menu berbasis data nutrisi.</li>
                            <li>Membantu perencanaan menu harian anak.</li>
                        </ul>
                    </div>

                    <div class="mb-4">
                        <h5 class="fw-semibold text-success">Fitur Utama</h5>
                        <ul class="text-muted">
                            <li>Perhitungan nilai gizi bahan makanan.</li>
                            <li>Rekomendasi menu otomatis sesuai kebutuhan.</li>
                            <li>Antarmuka sederhana dan mudah digunakan.</li>
                        </ul>
                    </div>

                    <a href="{{ url('/') }}" class="btn btn-tentang btn-lg px-4">
                        Kembali ke Beranda
                    </a>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
