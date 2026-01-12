@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Dashboard Admin ☕</h2>
    <p>Selamat datang, {{ Auth::user()->name }}!</p>

    <div class="row mt-4">

        {{-- Kelola Pengguna --}}
        <div class="col-md-4 mb-3">
            <a href="{{ route('admin.users.index') }}" class="text-decoration-none text-dark">
                <div class="card shadow-sm p-4 dashboard-card">
                    <h5>Total Pengguna</h5>
                    <p class="fs-3 fw-bold">{{ $userCount ?? 0 }}</p>
                </div>
            </a>
        </div>

        {{-- Kelola Menu --}}
        <div class="col-md-4 mb-3">
            <a href="{{ route('admin.menu.index') }}" class="text-decoration-none text-dark">
                <div class="card shadow-sm p-4 dashboard-card">
                    <h5>Total Menu</h5>
                    <p class="fs-3 fw-bold">{{ $menuCount ?? 0 }}</p>
                </div>
            </a>
        </div>

        {{-- Perhitungan Nutrisi (jika belum ada halaman, NON-AKTIF) --}}
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm p-4 dashboard-card disabled-card">
                <h5>Total Perhitungan Nutrisi</h5>
                <p class="fs-3 fw-bold">{{ $calcCount ?? 0 }}</p>
                <small>Fitur belum tersedia</small>
            </div>
        </div>

    </div>
</div>
@endsection
