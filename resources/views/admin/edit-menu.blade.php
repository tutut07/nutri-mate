@extends('layouts.app')

@section('title', 'Edit Menu')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h3 class="fw-bold text-warning mb-3">
                ✏️ Edit Menu Bergizi
            </h3>
            <p class="text-muted">Perbarui data menu makanan bergizi.</p>

            <form action="{{ route('admin.menu.update', $menu->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Menu</label>
                    <input 
                        type="text" 
                        name="bahan" 
                        class="form-control" 
                        value="{{ $menu->bahan }}" 
                        required>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Kalori (kkal)</label>
                        <input type="number" name="energi" class="form-control" value="{{ $menu->energi }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Protein (g)</label>
                        <input type="number" step="0.1" name="protein" class="form-control" value="{{ $menu->protein }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Lemak (g)</label>
                        <input type="number" step="0.1" name="lemak" class="form-control" value="{{ $menu->lemak }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Karbohidrat (g)</label>
                        <input type="number" step="0.1" name="karbo" class="form-control" value="{{ $menu->karbo }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Serat (g)</label>
                        <input type="number" step="0.1" name="serat" class="form-control" value="{{ $menu->serat }}" required>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-warning px-4">
                        <i class="bi bi-check-circle"></i> Update Menu
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
