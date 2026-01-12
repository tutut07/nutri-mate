@extends('layouts.app')

@section('title', 'Kelola Menu')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-success fw-bold">📋 Kelola Menu Bergizi</h2>
    <p class="text-muted">Admin dapat menambah, mengedit, atau menghapus data menu makanan bergizi di sini.</p>

    {{-- 🔍 Search Bar dan Tombol Tambah --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <form action="{{ route('admin.menu.index') }}" method="GET" class="d-flex w-50">
            <input 
                type="text" 
                name="search" 
                class="form-control me-2" 
                placeholder="Cari nama bahan atau menu..." 
                value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-success">
                <i class="bi bi-search"></i> Cari
            </button>
        </form>
        <a href="{{ route('admin.menu.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Tambah Menu Baru
        </a>
    </div>

    {{-- 📋 Tabel Data --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-success text-center">
                    <tr>
                        <th>#</th>
                        <th>Nama Menu</th>
                        <th>Kalori</th>
                        <th>Protein (g)</th>
                        <th>Lemak (g)</th>
                        <th>Karbo (g)</th>
                        <th>Serat (g)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($menus as $index => $menu)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $menu->bahan }}</td>
                            <td class="text-center">{{ $menu->energi }}</td>
                            <td class="text-center">{{ $menu->protein }}</td>
                            <td class="text-center">{{ $menu->lemak }}</td>
                            <td class="text-center">{{ $menu->karbo }}</td>
                            <td class="text-center">{{ $menu->serat }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.menu.edit', $menu->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus menu ini?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Belum ada data bahan makanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
