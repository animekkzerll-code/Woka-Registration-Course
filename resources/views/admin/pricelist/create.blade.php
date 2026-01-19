@extends('layouts.app')

@section('title', 'Tambah Pricelist')

@section('content')
<div class="container-fluid py-4">

    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-1">Tambah Paket Kursus</h4>
            <span class="text-secondary">Buat paket dan harga baru</span>
        </div>
        <a href="{{ route('admin.pricelist.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="card shadow border-0">
        <div class="card-header bg-white">
            <h6 class="mb-0 fw-semibold">
                <i class="bi bi-plus-circle"></i> Form Pricelist
            </h6>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.pricelist.store') }}" method="POST">
                @csrf

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama Paket</label>
                        <input type="text" name="nama_paket"
                            class="form-control"
                            value="{{ old('nama_paket') }}">
                        @error('nama_paket')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Jenis Paket</label>
                        <select name="jenis" class="form-select">
                            <option value="">-- Pilih Jenis --</option>
                            <option value="reguler">Reguler</option>
                            <option value="group">Group</option>
                        </select>
                        @error('jenis')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Durasi</label>
                        <select name="durasi" class="form-select">
                            <option value="">-- Pilih Durasi --</option>
                            <option value="1 Bulan">1 Bulan</option>
                            <option value="3 Bulan">3 Bulan</option>
                            <option value="1 Tahun">1 Tahun</option>
                        </select>
                        @error('durasi')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold" id="hargaLabel">Harga (Rp)</label>
                        <input type="number" name="harga" id="hargaInput"
                            class="form-control"
                            value="{{ old('harga') }}">
                        @error('harga')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                </div>

                <div class="mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-save me-1"></i> Simpan Paket
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- UX Harga Berdasarkan Jenis --}}
<script>
    const jenisSelect = document.querySelector('select[name="jenis"]');
    const hargaLabel = document.getElementById('hargaLabel');
    const hargaInput = document.getElementById('hargaInput');

    function updateHarga() {
        const jenis = jenisSelect.value;

        if (jenis === 'reguler') {
            hargaLabel.innerText = 'Harga Reguler (Rp)';
        } else if (jenis === 'group') {
            hargaLabel.innerText = 'Harga Group (Rp)';
        } else if (jenis === 'privat') {
            hargaLabel.innerText = 'Harga Privat (Rp)';
        } else {
            hargaLabel.innerText = 'Harga (Rp)';
        }
    }

    jenisSelect.addEventListener('change', updateHarga);
    updateHarga();
</script>
@endsection