@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="dashboard-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 fw-bold">Dashboard Admin</h4>
        <span class="text-secondary">Ringkasan data pendaftar</span>
    </div>
</div>

<div class="row g-4">

    {{-- Total Pendaftar --}}
    <div class="col-xl-3 col-md-6">
        <div class="dashboard-card card shadow-sm border-0 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted small mb-1">Total Pendaftar</p>
                    <h3 class="fw-bold">{{ $totalPendaftar }}</h3>
                </div>
                <div class="icon-wrap bg-primary">
                    <i class="bi bi-people-fill"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Pending --}}
    <div class="col-xl-3 col-md-6">
        <div class="dashboard-card card shadow-sm border-0 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted small mb-1">Menunggu Verifikasi</p>
                    <h3 class="fw-bold">{{ $pending }}</h3>
                </div>
                <div class="icon-wrap bg-warning">
                    <i class="bi bi-hourglass-split"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Diterima --}}
    <div class="col-xl-3 col-md-6">
        <div class="dashboard-card card shadow-sm border-0 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted small mb-1">Diterima</p>
                    <h3 class="fw-bold">{{ $diterima }}</h3>
                </div>
                <div class="icon-wrap bg-success">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Ditolak --}}
    <div class="col-xl-3 col-md-6">
        <div class="dashboard-card card shadow-sm border-0 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted small mb-1">Ditolak</p>
                    <h3 class="fw-bold">{{ $ditolak }}</h3>
                </div>
                <div class="icon-wrap bg-danger">
                    <i class="bi bi-x-circle-fill"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow-sm border-0 p-3 mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h6 class="fw-bold mb-1">Status Pendaftaran</h6>
            <span class="text-muted">
                Saat ini:
                @if($pendaftaranStatus === 'aktif')
                    <span class="badge bg-success">AKTIF</span>
                @else
                    <span class="badge bg-danger">NONAKTIF</span>
                @endif
            </span>
        </div>

        <form action="{{ route('admin.pendaftaran.toggle') }}" method="POST">
            @csrf
            <button class="btn btn-outline-primary">
                {{ $pendaftaranStatus === 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }}
            </button>
        </form>
    </div>
</div>


</div>

{{-- Tambahan Style --}}
<style>
    .dashboard-card {
        border-radius: 14px;
        transition: .2s;
    }
    .dashboard-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.08);
    }
    .icon-wrap {
        width: 55px;
        height: 55px;
        border-radius: 14px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 28px;
        color: white;
    }
</style>
@endsection
