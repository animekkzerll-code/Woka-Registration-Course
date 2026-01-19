@extends('layouts.app')

@section('title', 'Edit Pendaftaran')

@section('content')
<div class="container-fluid py-4">

    <div class="mb-4">
        <h4 class="fw-bold mb-1">Edit Pendaftaran</h4>
        <p class="text-muted mb-0">
            Perubahan hanya dapat dilakukan selama status masih <b>Pending</b>
        </p>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-white border-0 pb-0">
            <h5 class="fw-bold mb-1">
                <i class="bi bi-pencil-square"></i> Form Edit Data
            </h5>
        </div>

        <div class="card-body pt-4">
            <form action="{{ route('siswa.pendaftaran.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Pendidikan</label>
                        <select name="pendidikan" class="form-select">
                            @foreach(['SMK','SMA','Mahasiswa','Lainnya'] as $item)
                                <option value="{{ $item }}"
                                    {{ $pendaftaran->pendidikan == $item ? 'selected' : '' }}>
                                    {{ $item }}
                                </option>
                            @endforeach
                        </select>
                        @error('pendidikan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Sekolah / Universitas</label>
                        <input type="text" name="sekolah_univ"
                               value="{{ $pendaftaran->sekolah_univ }}"
                               class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Jurusan / Program</label>
                        <input type="text" name="jurusan_program"
                               value="{{ $pendaftaran->jurusan_program }}"
                               class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Kelas / Tingkat</label>
                        <input type="text" name="kelas_tingkat"
                               value="{{ $pendaftaran->kelas_tingkat }}"
                               class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">NISN / NIM</label>
                        <input type="text" name="nim_nisn"
                               value="{{ $pendaftaran->nim_nisn }}"
                               class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">No HP</label>
                        <input type="text" name="phone"
                               value="{{ $pendaftaran->phone }}"
                               class="form-control">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Link CV / Portofolio</label>
                        <input type="url" name="cv_link"
                               value="{{ $pendaftaran->cv_link }}"
                               class="form-control">
                    </div>

                </div>

                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('home') }}"
                       class="btn btn-light px-4">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                    <button class="btn btn-primary px-4">
                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
