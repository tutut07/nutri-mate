@extends('layouts.app')

@section('content')

<style>
/* ===== GLOBAL ===== */
body {
    background: linear-gradient(
        180deg,
        #e9efec 100%,
       
    );
}.text-soft { color: #6c757d; font-size: .95rem; }
.section-pad { padding: 80px 0; }
/* DIPERKECIL */
.section-pad { padding: 40px 0; }
/* ===== HERO SLIDER ===== */
.hero-slider {
    border-radius: 28px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0,0,0,.1);
}

.hero-slide {
    min-height: 420px;
    background-size: cover;
    background-position: center;
}
.hero-overlay {
    background: linear-gradient(
        rgba(247, 247, 247, 0.99),
        rgba(244, 231, 231, 0.55)
    );
    min-height: 420px;
    display: flex;
    align-items: center;
}
.hero-content { color: #141010; }
.hero-slider {
    width: 100vw;
    margin-left: calc(-50vw + 50%);
    margin-right: calc(-50vw + 50%);
    border-radius: 0;
}

/* ===== CARD ===== */
.card-light {
    background: #fff;
    border-radius: 15px;
    padding: 32px;
    box-shadow: 0 10px 30px rgba(0,0,0,.05);
    transition: .3s ease;
}
.card-light:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 40px rgba(0,0,0,.1);
}
.icon-circle {
    width: 78px;
    height: 78px;
    font-size: 34px;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #e6f4ea;
    border-radius: 50%;
    color: #198754;
    margin-bottom: 18px;
}

/* ===== SPLIT ===== */
.split-box {
    background: #fff;
    border-radius: 30px;
    overflow: hidden;
    box-shadow: 0 12px 35px rgba(0,0,0,.06);
}
.split-img {
    background-size: cover;
    background-position: center;
    min-height: 100%;
}

/* ===== ANIMATION ===== */
.fade-el {
    opacity: 0;
    transform: translateY(30px);
    transition: .9s ease;
}
.fade-el.visible {
    opacity: 1;
    transform: translateY(0);
}
.btn-mulai {
    background: linear-gradient(90deg, #8fc414, #60c414);
    color: #fff;
    border: none;
}

.btn-mulai:hover {
    background: linear-gradient(90deg, #86c414, #61b80f);
    color: #fff;
}

</style>


<!-- ================= HERO SLIDER ================= -->
<div id="heroCarousel" class="carousel slide hero-slider fade-el"
     data-bs-ride="carousel"
     data-bs-interval="5000">

    <div class="carousel-inner">

        <div class="carousel-item active hero-slide"
             style="background-image:url('{{ asset('images/home/hero1.jpg') }}')">
            <div class="hero-overlay">
                <div class="container hero-content text-center">
                    <h1 class="fw-bold mb-3">🍽 Rekomendasi Makanan Bergizi</h1>
                    <p class="fs-5 mb-4">
                        Sistem rekomendasi menu berdasarkan kebutuhan nutrisi individu
                    </p>
                    <a href="{{ Auth::check() ? route('form') : route('login') }}"
                       class="btn btn-mulai btn-lg px-5">
                        Hitung Nutrisi
                    </a>
                </div>
            </div>
        </div>

        <div class="carousel-item hero-slide"
             style="background-image:url('{{ asset('images/home/hero2.jpg') }}')">
            <div class="hero-overlay">
                <div class="container hero-content text-center">
                    <h1 class="fw-bold mb-3">Pendekatan Berbasis Data Gizi</h1>
                    <p class="fs-5">
                        Mengacu pada standar Kementerian Kesehatan dan WHO
                    </p>
                </div>
            </div>
</div>
</div>

<!-- ================= FITUR SISTEM ================= -->
<div class="section-pad">
    <div class="row g-4 text-center">
        <div class="col-md-4 fade-el">
            <div class="card-light h-100">
                <div class="icon-circle mx-auto">💪</div>
                <h5 class="fw-semibold text-success">Gizi Seimbang</h5>
                <p class="text-soft">
                    Rekomendasi menu disusun berdasarkan kebutuhan energi dan zat gizi makro.
                </p>
            </div>
        </div>
        <div class="col-md-4 fade-el">
            <div class="card-light h-100">
                <div class="icon-circle mx-auto">🍲</div>
                <h5 class="fw-semibold text-success">Menu Bergizi</h5>
                <p class="text-soft">
                    Menu disesuaikan dengan kategori bahan pangan dan kandungan nutrisinya.
                </p>
            </div>
        </div>
        <div class="col-md-4 fade-el">
            <div class="card-light h-100">
                <div class="icon-circle mx-auto">📊</div>
                <h5 class="fw-semibold text-success">Analisis Nutrisi</h5>
                <p class="text-soft">
                    Perhitungan gizi ditampilkan secara transparan dan terstruktur.
                </p>
            </div>
        </div>
    </div>


<!-- ================= TENTANG SISTEM ================= -->
<div class="section-pad">
    <div class="row split-box fade-el">
        <div class="col-md-6 p-5">
            <h2 class="fw-bold text-success mb-3"> Tentang Sistem</h2>
            <p class="text-soft">
                Sistem rekomendasi makanan bergizi ini dikembangkan untuk membantu pengguna
                dalam menentukan menu makanan sesuai kebutuhan nutrisi harian.
            </p>
            <p class="text-soft">
                Perhitungan mengacu pada literatur gizi, standar Kementerian Kesehatan RI,
                serta referensi WHO terkait kebutuhan energi dan zat gizi.
            </p>
        </div>
        <div class="col-md-6 split-img"
             style="background-image:url('{{ asset('images/home/1.jpg') }}')"></div>
    </div>
</div>

<!-- ================= DATA GIZI ================= -->
<div class="section-pad">
    <div class="row split-box fade-el">
        <div class="col-md-6 split-img"
             style="background-image:url('{{ asset('images/home/2.jpg') }}')"></div>
        <div class="col-md-6 p-5">
            <h2 class="fw-bold text-success mb-3"> Latar Belakang Gizi Anak</h2>
            <ul class="text-soft">
                <li>Berdasarkan Riskesdas dan SSGI, masalah gizi anak masih menjadi perhatian nasional.</li>
                <li>Konsumsi sayur dan buah masih di bawah rekomendasi.</li>
                <li>Anemia dan obesitas menjadi tantangan gizi ganda.</li>
            </ul>
            <p class="text-soft mt-3">
                <em>Sumber: Kementerian Kesehatan RI, Riskesdas, WHO</em>
            </p>
        </div>
    </div>
</div>

<!-- ================= CTA AKADEMIK ================= -->
<div class="text-center my-5 p-5 rounded-4 fade-el"
     style="background:#e6f4ea">
    <h3 class="fw-bold text-success mb-3">
        Implementasi Sistem Rekomendasi Gizi
    </h3>
    <p class="text-soft mb-4">
        Sistem ini diharapkan dapat mendukung pengambilan keputusan menu makanan berbasis data gizi.
    </p>
    <a href="{{ Auth::check() ? route('form') : route('login') }}"
                       class="btn btn-mulai btn-lg px-5">
                        Mulai Perhitungan
                    </a>

</div>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 900,
    easing: 'ease-out-cubic',
    once: true
  });
</script>

<script>
const fadeEls = document.querySelectorAll('.fade-el');
function fadeOnScroll() {
    fadeEls.forEach(el => {
        if (el.getBoundingClientRect().top < window.innerHeight - 100) {
            el.classList.add('visible');
        }
    });
}
window.addEventListener('scroll', fadeOnScroll);
window.addEventListener('load', fadeOnScroll);
</script>

@endsection
