@extends('layouts.app')

@section('title', 'Kelola Pengguna')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-success fw-bold">👥 Kelola Pengguna</h2>
    <p class="text-muted">Admin dapat melihat dan mengelola data pengguna yang terdaftar di sistem.</p>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-success text-center">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Tanggal Daftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="text-center">
                                <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : 'secondary' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="text-center">{{ $user->created_at->format('d M Y') }}</td>
                            <td class="text-center">
                                @if($user->role !== 'admin')
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus pengguna ini?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada pengguna terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
