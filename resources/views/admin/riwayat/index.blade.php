@extends('layouts.app')

@section('title', 'Riwayat Pendaftaran Siswa')

@section('content')
<div class="container-fluid py-4">

    <div class="dashboard-header mb-4">
        <h4 class="fw-bold mb-1">Riwayat Pendaftaran</h4>
        <span class="text-secondary">
            Daftar seluruh siswa yang telah diterima atau ditolak
        </span>
    </div>

    <div class="card shadow border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fw-semibold">
                <i class="bi bi-archive"></i> Riwayat Pendaftaran Siswa
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
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th>Tanggal Daftar</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pendaftar as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $item->user->name }}</td>
                            <td>{{ $item->user->email }}</td>
                            <td>{{ $item->pendidikan }}</td>
                            <td>{{ $item->sekolah_univ }}</td>
                            <td>{{ $item->jurusan_program }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>
                                @if($item->status === 'approved')
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle"></i> Diterima
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        <i class="bi bi-x-circle"></i> Ditolak
                                    </span>
                                @endif
                            </td>
                            <td>
                                {{ $item->keterangan ?? '-' }}
                            </td>
                            <td>
                                {{ $item->created_at->format('d M Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted py-4">
                                <i class="bi bi-inbox"></i><br>
                                Belum ada riwayat pendaftaran
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
