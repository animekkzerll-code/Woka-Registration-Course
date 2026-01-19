@extends('layouts.home')

@section('title', 'Profile Siswa')

@section('content')
<section class="profile-section py-5 dark-night-bg">
    <div class="cursor-glow"></div>
    
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge-gradient mb-3">PROFIL SISWA</span>
            <h2 class="fw-bold text-white mb-3">Informasi Akun Anda</h2>
            <p class="text-light-muted">
                Data pribadi dan informasi akun
            </p>
        </div>
        <div class="profile-card-simple dark-card glass-morphism">
            <div class="row g-0 align-items-center">
                
                <div class="col-md-3 text-center p-4">
                    <div class="avatar-simple">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="mt-3">
                        <span class="badge-role">
                            {{ auth()->user()->role ?? 'Siswa' }}
                        </span>
                    </div>
                </div>
                <div class="col-md-9 p-4">
                    <div class="profile-details">
                        {{-- NAMA & EMAIL --}}
                        <div class="mb-4">
                            <h3 class="fw-bold text-white mb-1">{{ auth()->user()->name }}</h3>
                            <p class="text-gradient-blue mb-0">{{ auth()->user()->email }}</p>
                        </div>

                        {{-- INFORMASI DETAIL --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-item mb-3">
                                    <div class="info-label">
                                        <i class="bi bi-person-fill me-2"></i>
                                        Nama Lengkap
                                    </div>
                                    <div class="info-value">{{ auth()->user()->name }}</div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="info-item mb-3">
                                    <div class="info-label">
                                        <i class="bi bi-envelope-fill me-2"></i>
                                        Email
                                    </div>
                                    <div class="info-value">{{ auth()->user()->email }}</div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="info-item mb-3">
                                    <div class="info-label">
                                        <i class="bi bi-shield-check me-2"></i>
                                        Role Akun
                                    </div>
                                    <div class="info-value">{{ auth()->user()->role ?? 'Siswa' }}</div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="info-item mb-3">
                                    <div class="info-label">
                                        <i class="bi bi-calendar-check me-2"></i>
                                        Bergabung
                                    </div>
                                    <div class="info-value">
                                        {{ auth()->user()->created_at->format('d F Y') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ACTION BUTTONS --}}
                        <div class="action-buttons-simple mt-4 pt-3 border-top border-light-10">
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <a href="{{ route('home') }}" class="btn btn-back">
                                        <i class="bi bi-arrow-left me-2"></i>Kembali ke Beranda
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('logout') }}" 
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                       class="btn btn-logout-simple">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- FOOTER NOTE --}}
        <div class="text-center mt-5 pt-3">
            <p class="text-light-muted small">
                <i class="bi bi-info-circle me-1"></i>
                Untuk mengubah data profil, hubungi administrator
            </p>
        </div>

    </div>
</section>

{{-- =======================
CUSTOM SCRIPTS SEDERHANA
======================= --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Efek cursor glow
    document.addEventListener('mousemove', (e) => {
        const glow = document.querySelector('.cursor-glow');
        const section = document.querySelector('.profile-section');

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
});
</script>

{{-- =======================
CUSTOM STYLES - SIMPLE
======================= --}}
<style>
/* =======================
GENERAL
======================= */
.profile-section {
    position: relative;
    overflow: hidden;
    min-height: 100vh;
}

.dark-night-bg {
    background: radial-gradient(circle at top, #0f172a, #020617);
}

.text-light-muted {
    color: #94a3b8;
}

.border-light-10 {
    border-color: rgba(255, 255, 255, 0.1) !important;
}

.text-gradient-blue {
    background: linear-gradient(135deg, #60a5fa, #2563eb);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
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
PROFILE CARD SIMPLE
======================= */
.profile-card-simple {
    position: relative;
    z-index: 1;
    background: linear-gradient(145deg, rgba(15, 23, 42, 0.8), rgba(2, 6, 23, 0.95));
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(15px);
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5),
                0 0 0 1px rgba(59, 130, 246, 0.1);
    overflow: hidden;
    transition: all 0.3s ease;
}

.profile-card-simple:hover {
    box-shadow: 0 25px 60px rgba(0, 0, 0, 0.6),
                0 0 0 1px rgba(59, 130, 246, 0.15);
}

/* =======================
AVATAR SIMPLE
======================= */
.avatar-simple {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: linear-gradient(135deg, #3b82f6, #8b5cf6);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 48px;
    font-weight: bold;
    margin: 0 auto;
    border: 4px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);
}

.badge-role {
    display: inline-block;
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: white;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
    box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
}

/* =======================
PROFILE DETAILS
======================= */
.info-item {
    padding: 12px;
    background: rgba(30, 41, 59, 0.2);
    border-radius: 10px;
    border: 1px solid rgba(255, 255, 255, 0.05);
    transition: all 0.3s ease;
}

.info-item:hover {
    background: rgba(30, 41, 59, 0.4);
    border-color: rgba(59, 130, 246, 0.2);
}

.info-label {
    color: #94a3b8;
    font-size: 0.85rem;
    margin-bottom: 5px;
    display: flex;
    align-items: center;
}

.info-label i {
    color: #60a5fa;
    font-size: 1rem;
}

.info-value {
    color: #fff;
    font-weight: 500;
    font-size: 1rem;
}

/* =======================
ACTION BUTTONS SIMPLE
======================= */
.action-buttons-simple {
    padding-top: 20px;
}

.btn {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 12px 20px;
    border-radius: 10px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    width: 100%;
}

.btn-back {
    background: rgba(59, 130, 246, 0.1);
    color: #60a5fa;
    border-color: rgba(59, 130, 246, 0.3);
}

.btn-back:hover {
    background: rgba(59, 130, 246, 0.2);
    color: #93c5fd;
    border-color: rgba(59, 130, 246, 0.5);
}

.btn-logout-simple {
    background: rgba(239, 68, 68, 0.1);
    color: #f87171;
    border-color: rgba(239, 68, 68, 0.3);
}

.btn-logout-simple:hover {
    background: rgba(239, 68, 68, 0.2);
    color: #fca5a5;
    border-color: rgba(239, 68, 68, 0.5);
}

/* =======================
BADGE GRADIENT HEADER
======================= */
.badge-gradient {
    display: inline-block;
    background: linear-gradient(135deg, #3b82f6, #8b5cf6);
    color: white;
    padding: 8px 20px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
}

/* =======================
RESPONSIVE
======================= */
@media (max-width: 768px) {
    .profile-card-simple .row {
        flex-direction: column;
    }
    
    .avatar-simple {
        width: 100px;
        height: 100px;
        font-size: 40px;
        margin-bottom: 20px;
    }
    
    .action-buttons-simple .col-md-6 {
        width: 100%;
        margin-bottom: 10px;
    }
    
    .btn {
        margin-bottom: 10px;
    }
}
</style>
@endsection