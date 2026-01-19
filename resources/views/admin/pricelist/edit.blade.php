@extends('layouts.app')

@section('title', 'Edit Pricelist')

@section('content')
<div class="container-fluid py-4">

    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-1">Edit Paket Kursus</h4>
            <span class="text-secondary">Perbarui paket dan harga</span>
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
                <i class="bi bi-pencil-square"></i> Form Edit Pricelist
            </h6>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.pricelist.update', $pricelist->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama Paket</label>
                        <input type="text" name="nama_paket"
                               class="form-control"
                               value="{{ old('nama_paket', $pricelist->nama_paket) }}"
                               required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Jenis Paket</label>
                        <select name="jenis" class="form-select" required>
                            <option value="">-- Pilih Jenis --</option>
                            <option value="reguler" {{ old('jenis', $pricelist->jenis) == 'reguler' ? 'selected' : '' }}>Reguler</option>
                            <option value="group" {{ old('jenis', $pricelist->jenis) == 'group' ? 'selected' : '' }}>Group</option>
                            <option value="privat" {{ old('jenis', $pricelist->jenis) == 'privat' ? 'selected' : '' }}>Privat</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Durasi</label>
                        <select name="durasi" class="form-select" required>
                            <option value="">-- Pilih Durasi --</option>
                            <option value="1 Bulan" {{ old('durasi', $pricelist->durasi) == '1 Bulan' ? 'selected' : '' }}>1 Bulan</option>
                            <option value="3 Bulan" {{ old('durasi', $pricelist->durasi) == '3 Bulan' ? 'selected' : '' }}>3 Bulan</option>
                            <option value="1 Tahun" {{ old('durasi', $pricelist->durasi) == '1 Tahun' ? 'selected' : '' }}>1 Tahun</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold" id="hargaLabel">Harga (Rp)</label>
                        <input type="number" name="harga" id="hargaInput"
                               class="form-control"
                               value="{{ old('harga', $pricelist->harga) }}"
                               required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="is_active" class="form-select">
                            <option value="1" {{ old('is_active', $pricelist->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('is_active', $pricelist->is_active) == 0 ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>

                </div>

                <div class="mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-save me-1"></i> Update Paket
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
    updateHarga(); // auto saat halaman load
</script>
@endsection
