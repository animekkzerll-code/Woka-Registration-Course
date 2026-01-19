@extends('layouts.home')

@section('title', 'Pendaftaran Siswa')

@section('content')
<div class="container-sm py-4">

    {{-- ALERT --}}
    @if(session('error'))
    <div class="alert alert-warning">{{ session('error') }}</div>
    @endif

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('siswa.pendaftaran.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Paket</label>
                    <select id="nama_paket" class="form-select" required>
                        <option value="">-- Pilih Paket --</option>
                        @foreach($pakets as $nama => $items)
                        <option value="{{ $nama }}"
                            {{ ($paketDipilih ?? '') == $nama ? 'selected' : '' }}>
                            {{ $nama }}
                        </option>
                        @endforeach
                    </select>
                </div>  
                <div class="mb-3">
                    <label class="form-label fw-semibold">Jenis Paket</label>
                    <div class="toggle-wrapper mt-2">
                        <button type="button"
                            class="btn-toggle {{ ($jenisDipilih ?? '') == 'reguler' ? 'active' : '' }}"
                            data-jenis="reguler">
                            Reguler
                            <button type="button"
                                class="btn-toggle {{ ($jenisDipilih ?? '') == 'group' ? 'active' : '' }}"
                                data-jenis="group">
                                Privat Group
                            </button>

                    </div>

                    <input type="hidden" name="jenis" id="jenis"
                        value="{{ $jenisDipilih }}">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Harga</label>
                    <input type="text" id="hargaView" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Durasi</label>
                    <input type="text" id="durasiView" class="form-control" readonly>
                </div>

                <input type="hidden" name="paket_id" id="paket_id">


                <hr>

                {{-- =======================
    DATA SISWA
======================= --}}
                <div class="mb-3">
                    <label>Pendidikan</label>
                    <select name="pendidikan" class="form-select" required>
                        <option value="">-- Pilih --</option>
                        <option>SMK</option>
                        <option>SMA</option>
                        <option>Mahasiswa</option>
                        <option>Lainnya</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Sekolah / Universitas</label>
                    <input type="text" name="sekolah_univ" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Jurusan / Program</label>
                    <input type="text" name="jurusan_program" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Kelas / Tingkat</label>
                    <input type="text" name="kelas_tingkat" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>NISN / NIM</label>
                    <input type="text" name="nim_nisn" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>No HP</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>CV / Portofolio (opsional)</label>
                    <input type="url" name="cv_link" class="form-control">
                </div>

                <div class="text-end">
                    <button class="btn btn-primary">
                        <i class="bi bi-send"></i> Kirim Pendaftaran
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

{{-- =======================
    SCRIPT
======================= --}}
<script>
    const paketData = @json($pakets);

    document.querySelectorAll('.btn-toggle').forEach(btn => {
        btn.addEventListener('click', function() {

            document.querySelectorAll('.btn-toggle')
                .forEach(b => b.classList.remove('active'));

            this.classList.add('active');
            document.getElementById('jenis').value = this.dataset.jenis;

            updateHarga();
        });
    });

    document.getElementById('nama_paket')
        .addEventListener('change', updateHarga);

    function updateHarga() {
        const namaPaket = document.getElementById('nama_paket').value;
        const jenis = document.getElementById('jenis').value;

        if (!namaPaket || !jenis) return;

        const data = paketData[namaPaket]
            ?.find(p => p.jenis === jenis);

        if (!data) return;

        document.getElementById('hargaView').value =
            'Rp ' + Number(data.harga).toLocaleString('id-ID');

        document.getElementById('durasiView').value =
            data.durasi;


        document.getElementById('paket_id').value = data.id;
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (
            document.getElementById('nama_paket').value &&
            document.getElementById('jenis').value
        ) {
            updateHarga();
        }
    });
</script>

@endsection