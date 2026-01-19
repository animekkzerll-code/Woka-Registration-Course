@extends('layouts.app')

@section('title', 'Manajemen Pricelist')

@section('content')

<div class="container-fluid py-4">
    <div class="dashboard-header mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-1">Manajemen Pricelist</h4>
            <span class="text-secondary">Kelola paket kursus & harga</span>
        </div>
        <a href="{{ route('admin.pricelist.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Paket
        </a>
    </div>
    
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow border-0">
        <div class="card-header bg-white">
            <h6 class="mb-0 fw-semibold">
                <i class="bi bi-tags"></i> Data Pricelist
            </h6>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Paket</th>
                        <th>Jenis</th>
                        <th>Durasi</th>
                        <th>Jumlah Sesi</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pricelists as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $item->nama_paket }}</td>
                        <td>
                            <span class="badge bg-secondary">{{ ucfirst($item->jenis) }}</span>
                        </td>
                        <td>{{ $item->durasi }}</td>
                        <td>{{ $item->jumlah_sesi ?? '-' }}</td>
                        <td class="fw-bold">Rp {{ number_format($item->harga,0,',','.') }}</td>
                        <td>
                            @if($item->is_active)
                            <span class="badge bg-success">Aktif</span>
                            @else
                            <span class="badge bg-danger">Nonaktif</span>
                            @endif
                        </td>
                        <td>{{ $item->created_at->format('d M Y') }}</td>
                        <td class="text-nowrap">
                            <a href="{{ route('admin.pricelist.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="{{ route('admin.pricelist.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus paket ini?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-4"></i><br>
                            Belum ada data pricelist
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    ```

</div>
@endsection