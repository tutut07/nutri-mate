@extends('layouts.app')

@section('content')

<style>
/* GLOBAL TYPOGRAPHY */
.text-soft { font-size: 1rem; color: #6c757d; }
.section-bg { background: #f8faf8; }
.card-light {
    background: #ffffff;
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.05);
    transition: transform .3s ease;
}
.card-light:hover { transform: translateY(-4px); }

/* ICON SECTION */
.icon-circle {
    width: 80px; height: 80px;
    font-size: 36px;
    display: flex; justify-content: center; align-items: center;
    background: #e6f4ea;
    border-radius: 50%;
    color: #198754;
    margin: auto;
}

/* FADE ON SCROLL */
.fade-el { opacity: 0; transform: translateY(30px); transition: .8s ease; }
.fade-el.visible { opacity: 1; transform: translateY(0); }

</style>

<div class="container py-5">

    <!-- HERO -->
    <div class="text-center py-5 fade-el">
        <h1 class="fw-bold text-success">🍽 Rekomendasi Makanan Bergizi</h1>
        @auth
            <h5 class="mt-2">Selamat Datang, {{ Auth::user()->name }} 👋</h5>
        @endauth

        <p class="text-soft mt-3 fs-5">
            Temukan rekomendasi makanan bergizi sesuai kebutuhan tubuhmu.
            Mulai hidup sehat dengan perhitungan gizi yang tepat 💚
        </p>

        <a href="{{ Auth::check() ? route('form') : route('login') }}"
            class="btn btn-success btn-lg mt-3 px-5">
            Hitung Nutrisi 🍎
        </a>
    </div>

    <!-- PROGRAM UTAMA (KARTU MIRIP pojokgizi.id) -->
    <div class="row text-center g-4 mt-5">
        <div class="col-md-4 fade-el">
            <div class="card-light h-100">
                <div class="icon-circle mb-3">💪</div>
                <h5 class="fw-semibold text-success">Gizi Seimbang</h5>
                <p class="text-soft">Rekomendasi makanan untuk keseimbangan nutrisi harian.</p>
            </div>
        </div>
        <div class="col-md-4 fade-el">
            <div class="card-light h-100">
                <div class="icon-circle mb-3">🍲</div>
                <h5 class="fw-semibold text-success">Menu Bergizi</h5>
                <p class="text-soft">Pilihan menu sehat & lezat sesuai kebutuhan nutrisimu.</p>
            </div>
        </div>
        <div class="col-md-4 fade-el">
            <div class="card-light h-100">
                <div class="icon-circle mb-3">📊</div>
                <h5 class="fw-semibold text-success">Analisis Nutrisi</h5>
                <p class="text-soft">Detail perhitungan gizi yang mudah dipahami.</p>
            </div>
        </div>
    </div>

    <!-- CONTENT PENJELASAN -->
    <div class="section-bg p-5 rounded-4 mt-5 fade-el">
        <h2 class="fw-bold text-success text-center mb-4">🌿 Tentang Gizi Seimbang</h2>
        <p class="text-soft fs-6 mb-3">
            Gizi seimbang adalah susunan makanan sehari-hari yang mengandung zat gizi dalam jenis dan jumlah
            yang sesuai dengan kebutuhan tubuh. Prinsip gizi seimbang tidak hanya berfokus pada makanan bergizi,
            tetapi juga mencakup pola hidup sehat seperti aktivitas fisik, menjaga kebersihan, dan berat badan ideal.
        </p>
        <p class="text-soft fs-6">
            Tubuh manusia membutuhkan karbohidrat, protein, lemak, vitamin, mineral, dan serat untuk fungsi optimal.
            Kekurangan maupun kelebihan gizi dapat menyebabkan berbagai masalah kesehatan.
        </p>
    </div>

    <!-- DATA GIZI -->
    <div class="section-bg p-5 rounded-4 mt-5 fade-el">
        <h2 class="fw-bold text-success text-center mb-4">🎒 Data Gizi Anak Sekolah</h2>
        <ul class="text-soft fs-6">
            <li>🍱 Kekurangan energi kronik (KEK): 10–12%</li>
            <li>🥬 Konsumsi sayur & buah rendah (70–100 gram/hari)</li>
            <li>🩸 Anemia prevalen 25–30%</li>
            <li>⚖️ Obesitas 10–12%</li>
            <li>🚶‍♂️ Aktivitas fisik menurun (>50%)</li>
        </ul>
    </div>

</div>

<script>
const fadeEls = document.querySelectorAll('.fade-el');
function fadeOnScroll() {
    fadeEls.forEach(el => {
        const rect = el.getBoundingClientRect().top;
        if (rect < window.innerHeight - 80) el.classList.add('visible');
    });
}
window.addEventListener('scroll', fadeOnScroll);
window.addEventListener('load', fadeOnScroll);
</script>

@endsection
