@extends('layouts.app')

@section('title', 'Manajemen Pendaftaran Siswa')

@section('content')
<div class="container-fluid py-4">

    <div class="dashboard-header mb-4">
        <h4 class="fw-bold mb-1">Manajemen Pendaftaran</h4>
        <span class="text-secondary">Kelola data pendaftaran siswa</span>
    </div>

    <div class="card shadow border-0">
        <div class="card-header bg-white">
            <h6 class="mb-0 fw-semibold">
                <i class="bi bi-people"></i> Data Pendaftaran Siswa
            </h6>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Pendidikan</th>
                        <th>Sekolah / Univ</th>
                        <th>Jurusan</th>
                        <th>No HP</th>
                        <th>Paket</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th>Tanggal Daftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pendaftar as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $item->user->name ?? '-' }}</td>
                        <td>{{ $item->user->email ?? '-' }}</td>
                        <td>{{ $item->pendidikan ?? '-' }}</td>
                        <td>{{ $item->sekolah_univ ?? '-' }}</td>
                        <td>{{ $item->jurusan_program ?? '-' }}</td>
                        <td>{{ $item->phone ?? '-' }}</td>
                        <td>
                            @if($item->paket)
                            Rp {{ number_format($item->paket->harga, 0, ',', '.') }}
                            @else
                            -
                            @endif
                        </td>   
                        <td>
                            @if($item->status === 'approved')
                            <span class="badge bg-success">
                                <i class="bi bi-check-circle"></i> Diterima
                            </span>
                            @elseif($item->status === 'rejected')
                            <span class="badge bg-danger">
                                <i class="bi bi-x-circle"></i> Ditolak
                            </span>
                            @else
                            <span class="badge bg-warning text-dark">
                                <i class="bi bi-hourglass-split"></i> Pending
                            </span>
                            @endif
                        </td>

                        <td>{{ $item->keterangan ?? '-' }}</td>

                        <td>
                            {{ optional($item->tanggal_daftar)->format('d M Y') ?? '-' }}
                        </td>

                        {{-- AKSI --}}
                        <td class="text-nowrap">
                            <a href="{{ route('admin.pendaftar.detail', $item->id) }}"
                                class="btn btn-info btn-sm">
                                <i class="bi bi-eye"></i>
                            </a>

                            @if($item->status === 'pending')
                            <form action="{{ route('admin.pendaftar.approve', $item->id) }}"
                                method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="keterangan" value="Diterima oleh admin">
                                <button class="btn btn-success btn-sm"
                                    onclick="return confirm('Terima pendaftaran ini?')">
                                    <i class="bi bi-check-lg"></i>
                                </button>
                            </form>

                            <form action="{{ route('admin.pendaftar.reject', $item->id) }}"
                                method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="keterangan" value="Ditolak oleh admin">
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Tolak pendaftaran ini?')">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-4"></i><br>
                            Belum ada data pendaftaran
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection