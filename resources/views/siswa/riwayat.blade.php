@extends('layouts.home')

@section('title', 'Riwayat Pendaftaran')

@section('content')
<section class="riwayat-section py-5 blue-night-bg">
    <div class="cursor-glow"></div>
    
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge-gradient mb-3">RIWAYAT PENDAFTARAN</span>
            <h2 class="fw-bold text-white mb-3">Riwayat Pendaftaran Saya</h2>
            <p class="text-light-muted">Lacak status pendaftaran kursus Anda</p>
        </div>

        @if(session('success'))
            <div class="alert-notification success mb-4">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close-notif" onclick="this.parentElement.remove()">
                    <i class="bi bi-x"></i>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert-notification warning mb-4">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close-notif" onclick="this.parentElement.remove()">
                    <i class="bi bi-x"></i>
                </button>
            </div>
        @endif

        @if(session('info'))
            <div class="alert-notification info mb-4">
                <i class="bi bi-info-circle-fill me-2"></i>
                {{ session('info') }}
                <button type="button" class="btn-close-notif" onclick="this.parentElement.remove()">
                    <i class="bi bi-x"></i>
                </button>
            </div>
        @endif

        @if($riwayat->isEmpty())
        
            <div class="empty-state dark-card glass-morphism text-center py-5">
                <div class="empty-icon mb-4">
                    <i class="bi bi-clock-history"></i>
                </div>
                <h4 class="fw-bold text-white mb-2">Belum ada riwayat pendaftaran</h4>
                <p class="text-light-muted mb-4">Silakan lakukan pendaftaran terlebih dahulu</p>
                <a href="{{ route('siswa.pendaftaran.create') }}" class="btn btn-gradient px-4">
                    <i class="bi bi-plus-circle me-2"></i> Daftar Sekarang
                </a>
            </div>
        @else
            
            <div class="riwayat-table dark-card glass-morphism">
                <div class="table-header">
                    <div class="table-info">
                        <span class="text-light-muted">Total Pendaftaran: <strong class="text-white">{{ $riwayat->count() }}</strong></span>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-dark-custom">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pendidikan</th>
                                <th>Sekolah/Universitas</th>
                                <th>Jurusan/Program</th>
                                <th>Kelas/Tingkat</th>
                                <th>Status</th>
                                <th>Tanggal Daftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($riwayat as $item)
                                <tr>
                                    <td class="text-light-muted">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="data-cell">
                                            <i class="bi bi-mortarboard me-2 text-primary-light"></i>
                                            <span class="text-black">{{ $item->pendidikan }}</span>
                                        </div>
                                    </td>
                                    <td class="text-black">{{ $item->sekolah_univ }}</td>
                                    <td class="text-black">{{ $item->jurusan_program }}</td>
                                    <td class="text-black">{{ $item->kelas_tingkat }}</td>
                                    <td>
                                        @if($item->status === 'approved')
                                            <span class="status-badge approved">
                                                <i class="bi bi-check-circle me-1"></i>
                                                Diterima
                                            </span>
                                        @elseif($item->status === 'rejected')
                                            <span class="status-badge rejected">
                                                <i class="bi bi-x-circle me-1"></i>
                                                Ditolak
                                            </span>
                                        @else
                                            <span class="status-badge pending">
                                                <i class="bi bi-clock me-1"></i>
                                                Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="date-cell">
                                            <i class="bi bi-calendar me-2 text-light-muted"></i>
                                            <span class="text-light-muted">{{ $item->tanggal_daftar->format('d M Y') }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('siswa.pendaftaran.detail', $item->id) }}" 
                                           class="btn-action detail">
                                            <i class="bi bi-eye me-1"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</section>

{{-- =======================
CUSTOM STYLES - BLUE NIGHT
======================= --}}
<style>
/* =======================
GENERAL
======================= */
.riwayat-section {
    position: relative;
    overflow: hidden;
    min-height: 100vh;
}

.blue-night-bg {
    background: radial-gradient(circle at top, #0f172a, #020617);
}

.text-light-muted {
    color: #94a3b8;
}

.text-primary-light {
    color: #60a5fa;
}

/* =======================
CURSOR GLOW
======================= */
.cursor-glow {
    position: absolute;
    top: 0;
    left: 0;
    width: 400px;
    height: 400px;
    pointer-events: none;
    background: radial-gradient(
        circle,
        rgba(59,130,246,0.15) 0%,
        rgba(59,130,246,0.08) 25%,
        rgba(59,130,246,0.03) 45%,
        transparent 70%
    );
    transform: translate(-50%, -50%);
    opacity: 0;
    transition: opacity .3s ease;
    filter: blur(40px);
    z-index: 0;
}

/* =======================
HEADER
======================= */
.badge-gradient {
    display: inline-block;
    background: linear-gradient(135deg, #3b82f6, #8b5cf6);
    color: white;
    padding: 8px 24px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
}

/* =======================
NOTIFIKASI
======================= */
.alert-notification {
    padding: 15px 20px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    animation: slideDown 0.3s ease;
    position: relative;
    border-left: 4px solid;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.alert-notification.success {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
    border-color: #10b981;
}

.alert-notification.warning {
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
    border-color: #f59e0b;
}

.alert-notification.info {
    background: rgba(59, 130, 246, 0.1);
    color: #60a5fa;
    border-color: #60a5fa;
}

.btn-close-notif {
    background: none;
    border: none;
    color: currentColor;
    margin-left: auto;
    cursor: pointer;
    padding: 4px;
    border-radius: 4px;
    transition: all 0.2s ease;
}

.btn-close-notif:hover {
    background: rgba(255, 255, 255, 0.1);
}

/* =======================
EMPTY STATE
======================= */
.empty-state {
    padding: 60px 20px;
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
}

.empty-icon {
    font-size: 80px;
    color: #60a5fa;
    margin-bottom: 20px;
    opacity: 0.8;
}

/* =======================
DARK CARD & GLASS MORPHISM
======================= */
.dark-card {
    background: linear-gradient(145deg, rgba(15, 23, 42, 0.8), rgba(2, 6, 23, 0.95));
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.glass-morphism {
    backdrop-filter: blur(15px);
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5),
                0 0 0 1px rgba(59, 130, 246, 0.1);
}

/* =======================
RIWAYAT TABLE
======================= */
.riwayat-table {
    overflow: hidden;
}

.table-header {
    padding: 20px;
    background: rgba(30, 41, 59, 0.5);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.table-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* =======================
TABLE STYLES
======================= */
.table {
    margin: 0;
    border-collapse: separate;
    border-spacing: 0;
    background: transparent;
}

.table thead th {
    background: rgba(30, 41, 59, 0.8);
    padding: 15px;
    font-weight: 600;
    color: #cbd5e1;
    border-bottom: 2px solid rgba(59, 130, 246, 0.2);
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
}

.table tbody td {
    padding: 15px;
    vertical-align: middle;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.table tbody tr {
    transition: all 0.2s ease;
}

.table tbody tr:hover {
    background: rgba(59, 130, 246, 0.05);
}

/* =======================
DATA CELL
======================= */
.data-cell {
    display: flex;
    align-items: center;
}

/* =======================
STATUS BADGE
======================= */
.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
}

.status-badge.approved {
    background: rgba(16, 185, 129, 0.2);
    color: #10b981;
    border: 1px solid rgba(16, 185, 129, 0.3);
}

.status-badge.rejected {
    background: rgba(239, 68, 68, 0.2);
    color: #ef4444;
    border: 1px solid rgba(239, 68, 68, 0.3);
}

.status-badge.pending {
    background: rgba(245, 158, 11, 0.2);
    color: #f59e0b;
    border: 1px solid rgba(245, 158, 11, 0.3);
}

/* =======================
DATE CELL
======================= */
.date-cell {
    display: flex;
    align-items: center;
}

/* =======================
BUTTONS
======================= */
.btn-gradient {
    background: linear-gradient(135deg, #3b82f6, #8b5cf6);
    color: white;
    padding: 12px 24px;
    border-radius: 12px;
    border: none;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
}

.btn-gradient:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
    color: white;
}

.btn-action {
    display: inline-flex;
    align-items: center;
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
}

.btn-action.detail {
    background: rgba(96, 165, 250, 0.2);
    color: #60a5fa;
    border: 1px solid rgba(96, 165, 250, 0.3);
}

.btn-action.detail:hover {
    background: rgba(96, 165, 250, 0.3);
    color: #93c5fd;
    border-color: rgba(96, 165, 250, 0.5);
}

/* =======================
RESPONSIVE
======================= */
@media (max-width: 768px) {
    .table-header {
        flex-direction: column;
        gap: 10px;
    }
    
    .table thead {
        display: none;
    }
    
    .table tbody tr {
        display: block;
        margin-bottom: 15px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 15px;
        background: rgba(15, 23, 42, 0.6);
    }
    
    .table tbody td {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border: none;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }
    
    .table tbody td:last-child {
        border-bottom: none;
        justify-content: flex-start;
    }
    
    .table tbody td::before {
        content: attr(data-label);
        font-weight: 600;
        color: #cbd5e1;
        margin-right: 10px;
    }
    
    /* Tambahkan data-label untuk mobile */
    .table tbody td:nth-child(1)::before { content: "No"; }
    .table tbody td:nth-child(2)::before { content: "Pendidikan"; }
    .table tbody td:nth-child(3)::before { content: "Sekolah"; }
    .table tbody td:nth-child(4)::before { content: "Jurusan"; }
    .table tbody td:nth-child(5)::before { content: "Kelas"; }
    .table tbody td:nth-child(6)::before { content: "Status"; }
    .table tbody td:nth-child(7)::before { content: "Tanggal"; }
    .table tbody td:nth-child(8)::before { content: "Aksi"; }
}


</style>

{{-- =======================
CUSTOM SCRIPTS
======================= --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Cursor glow effect
    document.addEventListener('mousemove', (e) => {
        const glow = document.querySelector('.cursor-glow');
        const section = document.querySelector('.riwayat-section');

        if (!glow || !section) return;

        const rect = section.getBoundingClientRect();

        if (
            e.clientX >= rect.left &&
            e.clientX <= rect.right &&
            e.clientY >= rect.top &&
            e.clientY <= rect.bottom
        ) {
            glow.style.opacity = '1';
            glow.style.left = `${e.clientX - rect.left}px`;
            glow.style.top = `${e.clientY - rect.top}px`;
        } else {
            glow.style.opacity = '0';
        }
    });

    // Auto hide notifikasi
    const alerts = document.querySelectorAll('.alert-notification');
    
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.3s ease';
            alert.style.opacity = '0';
            setTimeout(() => {
                alert.remove();
            }, 300);
        }, 4000);
    });
    
    // Responsive table untuk mobile
    function handleTableResponsive() {
        if (window.innerWidth <= 768) {
            document.querySelectorAll('.table tbody td').forEach(td => {
                const label = td.closest('tr').querySelector('th:nth-child(' + (Array.from(td.parentNode.children).indexOf(td) + 1) + ')');
                if (label) {
                    td.setAttribute('data-label', label.textContent);
                }
            });
        }
    }
    
    handleTableResponsive();
    window.addEventListener('resize', handleTableResponsive);
});
</script>
@endsection