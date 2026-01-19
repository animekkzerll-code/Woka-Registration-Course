@extends('layouts.home')

@section('title', 'Detail Pendaftaran')

@section('content')
<div class="container py-4">

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-3">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-warning alert-dismissible fade show mb-3">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 rounded-4">

        {{-- HEADER --}}
        <div class="card-header bg-white border-0 pb-0">
            <h5 class="fw-bold mb-0">
                <i class="bi bi-file-earmark-text text-primary me-1"></i>
                Detail Pendaftaran
            </h5>
            <small class="text-muted">Data pendaftaran peserta</small>
        </div>

        <div class="card-body pt-4">

            {{-- STATUS --}}
            <div class="mb-4">
                @if($pendaftaran->status === 'pending')
                    <span class="badge rounded-pill bg-warning text-dark px-3 py-2">
                        <i class="bi bi-hourglass-split me-1"></i>
                        Menunggu Verifikasi
                    </span>
                @elseif($pendaftaran->status === 'approved')
                    <span class="badge rounded-pill bg-success px-3 py-2">
                        <i class="bi bi-check-circle me-1"></i>
                        Diterima
                    </span>
                @else
                    <span class="badge rounded-pill bg-danger px-3 py-2">
                        <i class="bi bi-x-circle me-1"></i>
                        Ditolak
                    </span>
                @endif
            </div>

            {{-- DATA PENDAFTARAN --}}
            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label text-muted">Nama</label>
                    <input type="text" class="form-control"
                           value="{{ auth()->user()->name }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted">Email</label>
                    <input type="text" class="form-control"
                           value="{{ auth()->user()->email }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted">Pendidikan</label>
                    <input type="text" class="form-control"
                           value="{{ $pendaftaran->pendidikan }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted">Sekolah / Universitas</label>
                    <input type="text" class="form-control"
                           value="{{ $pendaftaran->sekolah_univ }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted">Jurusan / Program</label>
                    <input type="text" class="form-control"
                           value="{{ $pendaftaran->jurusan_program }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted">Kelas / Tingkat</label>
                    <input type="text" class="form-control"
                           value="{{ $pendaftaran->kelas_tingkat }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted">NISN / NIM</label>
                    <input type="text" class="form-control"
                           value="{{ $pendaftaran->nim_nisn }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted">No HP</label>
                    <input type="text" class="form-control"
                           value="{{ $pendaftaran->phone }}" readonly>
                </div>

                <div class="col-12">
                    <label class="form-label text-muted">CV / Portofolio</label>
                    <input type="text" class="form-control"
                           value="{{ $pendaftaran->cv_link ?? '-' }}" readonly>
                </div>

                @if($pendaftaran->keterangan)
                <div class="col-12">
                    <label class="form-label text-muted">Keterangan</label>
                    <textarea class="form-control" readonly>{{ $pendaftaran->keterangan }}</textarea>
                </div>
                @endif

            </div>

            {{-- TOMBOL EDIT JIKA MASIH PENDING --}}
            @if($pendaftaran->status === 'pending')
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('siswa.pendaftaran.edit', $pendaftaran->id) }}"
                       class="btn btn-outline-primary px-4">
                        <i class="bi bi-pencil-square me-1"></i>
                        Edit Data
                    </a>
                </div>
            @endif

            <div class="mt-3">
                <a href="{{ route('siswa.riwayat') }}" class="btn btn-secondary">
                    ← Kembali
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
