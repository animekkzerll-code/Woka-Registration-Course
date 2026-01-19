@extends('layouts.app')

@section('title', 'Detail Pendaftaran')

@section('content')
<div class="container-sm py-4">

    {{-- ALERT SESSION --}}
    @if(session('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-white border-0 pb-2">
            <h5 class="fw-semibold mb-0">
                <i class="bi bi-file-earmark-text me-1"></i> Detail Pendaftaran
            </h5>
            <small class="text-muted">Informasi lengkap pendaftaran Anda</small>
        </div>

        <div class="card-body pt-3">

            {{-- STATUS --}}
            <div class="mb-3">
                @if($pendaftaran->status === 'pending')
                    <span class="badge rounded-pill bg-warning text-dark">
                        <i class="bi bi-hourglass-split"></i> Pending
                    </span>
                @elseif($pendaftaran->status === 'approved')
                    <span class="badge rounded-pill bg-success">
                        <i class="bi bi-check-circle"></i> Diterima
                    </span>
                @else
                    <span class="badge rounded-pill bg-danger">
                        <i class="bi bi-x-circle"></i> Ditolak
                    </span>
                    <p class="mt-2"><strong>Keterangan:</strong> {{ $pendaftaran->keterangan ?? '-' }}</p>
                @endif
            </div>

            {{-- DATA PENDAFTARAN --}}
            <div class="row g-2">
                <div class="col-md-6">
                    <label class="text-muted">Nama</label>
                    <input class="form-control" value="{{ auth()->user()->name }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="text-muted">Email</label>
                    <input class="form-control" value="{{ auth()->user()->email }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="text-muted">Pendidikan</label>
                    <input class="form-control" value="{{ $pendaftaran->pendidikan }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="text-muted">Sekolah / Universitas</label>
                    <input class="form-control" value="{{ $pendaftaran->sekolah_univ }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="text-muted">Jurusan / Program</label>
                    <input class="form-control" value="{{ $pendaftaran->jurusan_program }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="text-muted">Kelas / Tingkat</label>
                    <input class="form-control" value="{{ $pendaftaran->kelas_tingkat }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="text-muted">NISN / NIM</label>
                    <input class="form-control" value="{{ $pendaftaran->nim_nisn }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="text-muted">No HP</label>
                    <input class="form-control" value="{{ $pendaftaran->phone }}" readonly>
                </div>
                <div class="col-12">
                    <label class="text-muted">CV / Portofolio</label>
                    @if($pendaftaran->cv_link)
                        <a href="{{ $pendaftaran->cv_link }}" target="_blank" class="form-control text-decoration-none">
                            {{ $pendaftaran->cv_link }}
                        </a>
                    @else
                        <input class="form-control" value="-" readonly>
                    @endif
                </div>
                <div class="col-12">
                    <label class="text-muted">Tanggal Daftar</label>
                    <input class="form-control" value="{{ $pendaftaran->created_at->format('d M Y H:i') }}" readonly>
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ route('admin.pendaftar.index') }}" class="btn btn-light">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>

        </div>
    </div>

</div>
@endsection
