@extends('layouts.home')

@section('title', 'Pricelist Kursus')

@section('content')
<section class="pricing-section py-5 dark-night-bg">
    <div class="cursor-glow"></div>

    <div class="container">

        {{-- =======================
        HEADER
        ======================= --}}
        <div class="text-center mb-5">
            <span class="badge-gradient mb-3">PAKET KURSUS</span>
            <h2 class="fw-bold text-white mb-3">Lihat Paket Belajar</h2>
            <p class="text-light-muted">
                Sesuaikan paket belajar dengan kebutuhan dan target kamu
            </p>
        </div>

        {{-- =======================
        TOGGLE
        ======================= --}}
        <div class="toggle-container mb-5">
            <div class="toggle-wrapper">
                <button class="btn-toggle active" data-target="reguler">
                    📚 Reguler
                </button>
                <button class="btn-toggle" data-target="privat">
                    👥 Privat
                </button>
            </div>
        </div>

        {{-- =======================
        REGULER
        ======================= --}}
        <div id="reguler" class="row g-4 justify-content-center paket-list active mb-5">
            @forelse($reguler as $paket)
            <div class="col-md-4">
                <div class="pricing-card dark-card {{ $loop->first ? 'popular-card' : '' }}">

                    @if($loop->first)
                    <div class="badge-popular">🔥 Terlaris</div>
                    @endif

                    <h5 class="fw-bold text-white">{{ $paket->nama_paket }}</h5>
                    <p class="text-light-muted">{{ $paket->durasi }}</p>

                    <h2 class="price-gradient">
                        Rp {{ number_format($paket->harga, 0, ',', '.') }}
                    </h2>

                    <ul class="feature-list mt-3">
                        <li>✓ Materi lengkap</li>
                        <li>✓ Akses kelas</li>
                        <li>✓ Sertifikat</li>
                    </ul>
                    
@auth
<button type="button"
        class="btn-select-package mt-3 btn-daftar"
        data-paket="{{ $paket->id }}">
    Pilih Paket
</button>
@else
<button type="button"
        class="btn-select-package mt-3 btn-login-warning">
    Pilih Paket
</button>
@endauth


                </div>
            </div>
            @empty
            <p class="text-center text-light-muted">
                Paket reguler belum tersedia
            </p>
            @endforelse
        </div>

        {{-- =======================
        PRIVAT / GROUP
        ======================= --}}
        <div id="privat" class="row g-4 justify-content-center paket-list mb-5">
            @forelse($privat as $paket)
            <div class="col-md-4">
                <div class="pricing-card dark-card">

                    <h5 class="fw-bold text-white">
                        {{ ucfirst($paket->jenis) }}
                    </h5>

                    <p class="text-light-muted">
                        {{ $paket->nama_paket }} • {{ $paket->durasi }}
                    </p>

                    <h2 class="price-gradient gold">
                        Rp {{ number_format($paket->harga, 0, ',', '.') }}
                    </h2>

                    <div class="session-badge mt-3">
                        <span>Paket {{ ucfirst($paket->jenis) }}</span>
                    </div>

                    @auth
<button type="button"
        class="btn-gold mt-4 btn-daftar"
        data-paket="{{ $paket->id }}">
    Pilih Paket
</button>
@else
<button type="button"
        class="btn-gold mt-4 btn-login-warning">
    Pilih Paket
</button>
@endauth

                </div>
            </div>
            @empty
            <p class="text-center text-light-muted">
                Paket privat belum tersedia
            </p>
            @endforelse
        </div>

        {{-- =======================
        FAQ
        ======================= --}}
        <div class="faq-section mt-5 pt-5">
            <h4 class="text-white text-center mb-4">❓ Pertanyaan Umum</h4>
            <div class="accordion dark-accordion">
                <div class="accordion-item">
                    <button class="accordion-button">
                        Apa beda reguler & privat?
                    </button>
                    <div class="accordion-body">
                        Reguler belajar bersama kelas, privat fokus personal atau group kecil.
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- =======================
JS TOGGLE
======================= --}}
<script>
    document.querySelectorAll('.btn-toggle').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.btn-toggle')
                .forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            document.querySelectorAll('.paket-list')
                .forEach(list => list.classList.remove('active'));

            document.getElementById(btn.dataset.target)
                .classList.add('active');
        });
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // ❌ BELUM LOGIN
    document.querySelectorAll('.btn-login-warning').forEach(btn => {
        btn.addEventListener('click', function () {
            alert('⚠️ Silakan login terlebih dahulu untuk memilih paket.');
            window.location.href = "{{ route('login') }}";
        });
    });

    // ✅ SUDAH LOGIN
    document.querySelectorAll('.btn-daftar').forEach(btn => {
        btn.addEventListener('click', function () {
            const paketId = this.dataset.paket;

            if (confirm('✅ Paket dipilih. Daftar sekarang?')) {
                window.location.href = "{{ route('siswa.pendaftaran.create') }}?paket=" + paketId;

            }
        });
    });
    document.addEventListener('mousemove', (e) => {
    const glow = document.querySelector('.cursor-glow');
    const section = document.querySelector('.pricing-section');

    if (!glow || !section) return;

    const rect = section.getBoundingClientRect();

    // hanya aktif jika kursor di dalam section
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
STYLE (TETAP PAKAI PUNYA KAMU)
======================= --}}
<style>
/* =======================
GENERAL
======================= */
.dark-night-bg {
    background: radial-gradient(circle at top, #0f172a, #020617);
}

.price-gradient {
    font-size: 2rem;
    font-weight: 800;
    background: linear-gradient(135deg, #60a5fa, #2563eb);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.price-gradient.gold {
    background: linear-gradient(135deg, #facc15, #f59e0b);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.text-light-muted {
    color: #94a3b8;
}

/* =======================
TOGGLE
======================= */
.toggle-container {
    display: flex;
    justify-content: center;
}

.toggle-wrapper {
    background: #020617;
    padding: 6px;
    border-radius: 14px;
    box-shadow: 0 0 0 1px rgba(255,255,255,.05);
}

.btn-toggle {
    padding: 10px 28px;
    border: none;
    background: transparent;
    color: #94a3b8;
    font-weight: 600;
    border-radius: 10px;
    transition: .3s ease;
}

.btn-toggle:hover {
    color: #fff;
}

.btn-toggle.active {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: #fff;
    box-shadow: 0 8px 20px rgba(59,130,246,.4);
}

/* =======================
PAKET LIST
======================= */
.paket-list {
    display: none;
    animation: fadeUp .4s ease;
}

.paket-list.active {
    display: flex;
}

@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(15px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* =======================
CARD
======================= */
.pricing-card {
    background: linear-gradient(180deg, #020617, #020617);
    border-radius: 20px;
    padding: 28px;
    position: relative;
    text-align: center;
    height: 100%;
    transition: .4s ease;
    box-shadow: 0 10px 30px rgba(0,0,0,.4);
}

.pricing-card::after {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: 20px;
    background: linear-gradient(135deg, transparent, rgba(255,255,255,.05));
    opacity: 0;
    transition: .4s ease;
}

.pricing-card:hover {
    transform: translateY(-10px) scale(1.02);
}

.pricing-card:hover::after {
    opacity: 1;
}

/* =======================
POPULAR
======================= */
.popular-card {
    border: 1px solid #3b82f6;
    box-shadow: 0 0 30px rgba(59,130,246,.4);
}

.badge-popular {
    position: absolute;
    top: -12px;
    left: 50%;
    transform: translateX(-50%);
    background: linear-gradient(135deg, #facc15, #f59e0b);
    color: #020617;
    padding: 6px 16px;
    font-size: .8rem;
    font-weight: 700;
    border-radius: 999px;
}

/* =======================
FEATURE
======================= */
.feature-list {
    list-style: none;
    padding: 0;
    margin: 20px 0;
}

.feature-list li {
    color: #cbd5f5;
    margin-bottom: 8px;
    font-size: .95rem;
}

/* =======================
BUTTON
======================= */
.btn-select-package,
.btn-gold {
    width: 100%;
    padding: 12px;
    border-radius: 14px;
    font-weight: 700;
    border: none;
    transition: .3s ease;
}

.btn-select-package {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: #fff;
}

.btn-select-package:hover {
    box-shadow: 0 10px 25px rgba(59,130,246,.5);
    transform: translateY(-2px);
}

.btn-gold {
    background: linear-gradient(135deg, #facc15, #f59e0b);
    color: #020617;
}

.btn-gold:hover {
    box-shadow: 0 10px 25px rgba(250,204,21,.5);
    transform: translateY(-2px);
}

/* =======================
FAQ
======================= */
.dark-accordion .accordion-item {
    background: #020617;
    border-radius: 14px;
    margin-bottom: 12px;
    overflow: hidden;
}

.accordion-button {
    width: 100%;
    padding: 14px 18px;
    background: transparent;
    border: none;
    color: #fff;
    text-align: left;
    font-weight: 600;
}

.accordion-body {
    padding: 14px 18px;
    color: #94a3b8;
}
.pricing-section {
    position: relative;
    overflow: hidden;
}

.cursor-glow {
    position: absolute;
    top: 0;
    left: 0;
    width: 420px;
    height: 420px;
    pointer-events: none;
    background: radial-gradient(
        circle,
    
        rgba(59,130,246,0.25) 0%,
        rgba(59,130,246,0.15) 25%,
        rgba(59,130,246,0.05) 45%,
        transparent 70%
    );
    transform: translate(-50%, -50%);
    opacity: 0;
    transition: opacity .3s ease;
    filter: blur(10px);
}
</style>

@endsection