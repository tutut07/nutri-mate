@extends('layouts.app')

@section('title', 'Tambah Menu')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h3 class="fw-bold text-success mb-3">
                ➕ Tambah Menu Bergizi
            </h3>
            <p class="text-muted">Masukkan data menu makanan bergizi dengan lengkap.</p>

            <form action="{{ route('admin.menu.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Menu</label>
                    <input type="text" name="bahan" class="form-control" placeholder="Contoh: Nasi Putih" required>
                </div>
                <div class="mb-3">
    <label class="form-label">Kategori</label>
    <select name="kategori" class="form-select" required>
        <option value="">-- Pilih Kategori --</option>
        <option value="Karbohidrat">Karbohidrat</option>
        <option value="Protein Hewani">Protein </option>
        <option value="Protein Nabati">Snack</option>
        <option value="Sayuran">Sayuran</option>
        <option value="Buah">Buah</option>
    </select>
</div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Kalori (kkal)</label>
                        <input type="number" name="energi" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Protein (g)</label>
                        <input type="number" step="0.1" name="protein" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Lemak (g)</label>
                        <input type="number" step="0.1" name="lemak" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Karbohidrat (g)</label>
                        <input type="number" step="0.1" name="karbo" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Serat (g)</label>
                        <input type="number" step="0.1" name="serat" class="form-control" required>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-save"></i> Simpan Menu
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
