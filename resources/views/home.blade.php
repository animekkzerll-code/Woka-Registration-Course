@extends('layouts.home')

@section('title', 'Woka GO!')

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(session('info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{ session('info') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@auth
@if(Auth::user()->role === 'siswa')

@if(isset($langganan) && $langganan)
<div class="alert alert-success shadow-sm">
    <h6 class="fw-bold mb-1">🎉 Langganan Aktif</h6>

    <div class="small text-muted">
        Paket:
        <b>{{ $langganan->paket->nama_paket }}</b>
        ({{ ucfirst($langganan->paket->jenis) }})
    </div>

    <div class="mt-1">
        ⏳ Sisa waktu:
        <span class="fw-bold text-danger">
            {{ $sisaHari }} hari
        </span>
    </div>

    <div class="small text-muted">
        Berlaku sampai {{ $expiredAt->format('d M Y') }}
    </div>
</div>
@else
{{--<div class="alert alert-warning shadow-sm">
    ⚠️ Kamu belum memiliki langganan aktif.
    <a href="{{ route('siswa.pendaftaran.create') }}" class="fw-bold">
        Daftar sekarang
    </a>
</div>--}}
@endif

@endif
@endauth



<section class="hero">
    <div class="hero-text">
        <small>WEB & ONLINE KURSUS</small>
        <h1>Belajar Web Jadi Lebih Mudah</h1>
        <p>
            Woka Academy membantu kamu menguasai web development
            melalui pembelajaran terstruktur, berbasis project,
            dan siap digunakan di dunia kerja.
        </p>
        @auth
        @if(Auth::user()->role === 'siswa')

        @php
        $pendaftaranStatus = \App\Models\Setting::get('pendaftaran_status');
        @endphp

        @if($pendaftaranStatus === 'aktif')
        <a href="{{ route('siswa.pendaftaran.create') }}" class="btn-main">
            🚀 Daftar Sekarang
        </a>
        @endif

        @endif
        @endauth

    </div>

    <div class="hero-image">
        <img src="{{ asset('assets/hero.png') }}" alt="Hero">
    </div>

    <!-- FLOATING ICONS -->
</section>
@endsection