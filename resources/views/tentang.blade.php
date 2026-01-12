@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body">
        <h2 class="text-success mb-3">Tentang Aplikasi Rekomendasi Makanan</h2>
        <p class="text-muted">
            Aplikasi ini dibuat untuk membantu orang tua, guru, dan anak sekolah dalam memilih menu makanan bergizi 
            berdasarkan kebutuhan nutrisi harian. Dengan memanfaatkan data bahan makanan dan perhitungan nilai gizi, 
            sistem ini memberikan rekomendasi menu yang seimbang agar anak mendapatkan asupan yang sesuai untuk 
            mendukung pertumbuhan dan aktivitas belajar mereka.
        </p>

        <h4 class="text-success mt-4">Tujuan</h4>
        <ul>
            <li>Meningkatkan kesadaran pentingnya gizi seimbang untuk anak sekolah.</li>
            <li>Menyediakan rekomendasi makanan yang bergizi berdasarkan data nutrisi.</li>
            <li>Memudahkan pengguna dalam merencanakan menu harian.</li>
        </ul>

        <h4 class="text-success mt-4">Fitur Utama</h4>
        <ul>
            <li>Perhitungan nilai gizi dari bahan makanan.</li>
            <li>Rekomendasi menu otomatis sesuai kebutuhan anak.</li>
            <li>Antarmuka yang mudah digunakan.</li>
        </ul>

        <div class="text-center mt-4">
            <a href="{{ url('/') }}" class="btn btn-success">Kembali ke Beranda</a>
        </div>
    </div>
</div>
@endsection
