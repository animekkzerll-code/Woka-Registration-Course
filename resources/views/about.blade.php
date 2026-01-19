@extends('layouts.home')

@section('title', 'About Us | WOKA')

@section('content')
<style>
    :root {
        --woka-primary: #4361ee;
        --woka-secondary: #3a0ca3;
        --woka-accent: #4cc9f0;
        --woka-success: #06d6a0;
        --woka-dark: #1a1a2e;
        --woka-light: #f8f9fa;
        --woka-gradient: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
    }

    .about-hero {
        background: var(--woka-gradient);
        border-radius: 20px;
        color: white;
        overflow: hidden;
        position: relative;
    }

    .about-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,0 L100,0 L100,100 Z" fill="white" opacity="0.05"/></svg>');
    }

    .section-title {
        font-size: 2.25rem;
        font-weight: 800;
        background: var(--woka-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .section-subtitle {
        font-size: 1.1rem;
        color: #64748b;
        font-weight: 500;
    }

    .card-modern {
        border: none;
        border-radius: 16px;
        background: white;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .card-modern:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(67, 97, 238, 0.15);
    }

    .icon-box-modern {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        background: linear-gradient(135deg, var(--woka-primary), var(--woka-secondary));
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        box-shadow: 0 8px 20px rgba(67, 97, 238, 0.3);
    }

    .icon-box-success {
        background: linear-gradient(135deg, #06d6a0, #0cb48a) !important;
    }

    .feature-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(6, 214, 160, 0.1);
        padding: 8px 16px;
        border-radius: 50px;
        margin: 4px;
        transition: all 0.3s ease;
    }

    .feature-badge:hover {
        background: rgba(6, 214, 160, 0.2);
        transform: scale(1.05);
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px;
        background: var(--woka-light);
        border-radius: 12px;
        margin-bottom: 12px;
        transition: all 0.3s ease;
    }

    .contact-item:hover {
        background: white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transform: translateX(5px);
    }

    .contact-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--woka-primary), var(--woka-secondary));
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .highlight-text {
        position: relative;
        display: inline-block;
        font-weight: 600;
        color: var(--woka-primary);
    }

    .highlight-text::after {
        content: '';
        position: absolute;
        bottom: 2px;
        left: 0;
        width: 100%;
        height: 6px;
        background: rgba(67, 97, 238, 0.2);
        z-index: -1;
        border-radius: 3px;
    }

    .stat-box {
        text-align: center;
        padding: 20px;
        background: white;
        border-radius: 16px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        background: var(--woka-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1;
    }

    .stat-label {
        color: #64748b;
        font-size: 0.9rem;
        margin-top: 8px;
        font-weight: 500;
    }

    /* =======================
GLOBAL DARK ADAPTATION
======================= */
    body {
        background: radial-gradient(circle at top, #0f172a, #020617);
        color: #e5e7eb;
    }

    /* =======================
CARD DARK GLASS
======================= */
    .card-modern {
        background: rgba(15, 23, 42, 0.7);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.06);
        box-shadow: 0 20px 40px rgba(0, 0, 0, .6);
    }

    .card-modern:hover {
        box-shadow: 0 30px 60px rgba(67, 97, 238, .35);
    }

    /* =======================
ABOUT HERO GLOW
======================= */
    .about-hero {
        background: linear-gradient(135deg, #1e3a8a, #020617);
        box-shadow: 0 0 80px rgba(59, 130, 246, .35);
    }

    .about-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at top left,
                rgba(59, 130, 246, .25),
                transparent 60%);
        pointer-events: none;
    }

    /* =======================
TEXT COLOR FIX
======================= */
    .section-subtitle,
    .text-muted {
        color: #94a3b8 !important;
    }

    .text-dark {
        color: #e5e7eb !important;
    }

    /* =======================
FEATURE BADGE DARK
======================= */
    .feature-badge {
        background: rgba(59, 130, 246, .08);
        border: 1px solid rgba(59, 130, 246, .15);
    }

    .feature-badge:hover {
        background: rgba(59, 130, 246, .18);
    }

    /* =======================
CONTACT ITEM DARK
======================= */
    .contact-item {
        background: rgba(15, 23, 42, 0.8);
        border: 1px solid rgba(255, 255, 255, .06);
    }

    .contact-item:hover {
        background: rgba(30, 41, 59, 0.9);
    }

    /* =======================
STAT BOX DARK
======================= */
    .stat-box {
        background: rgba(2, 6, 23, .7);
        border: 1px solid rgba(255, 255, 255, .06);
    }

    /* =======================
ICON GLOW
======================= */
    .icon-box-modern,
    .contact-icon {
        box-shadow: 0 0 25px rgba(67, 97, 238, .6);
    }

    /* =======================
BUTTON FIX
======================= */
    .btn-primary {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        border: none;
        box-shadow: 0 10px 25px rgba(59, 130, 246, .5);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 20px 40px rgba(59, 130, 246, .7);
    }
</style>

<div class="container py-5">
    <div class="about-hero p-5 mb-5">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-5 fw-bold mb-3">Tentang WOKA</h1>
                <p class="lead mb-4 opacity-100">
                    <strong>WOKA (Web & Online Kursus Akademi)</strong> adalah lembaga kursus yang berfokus
                    pada pengembangan keterampilan <span class="highlight-text">web development</span> dan
                    teknologi digital. Kami membantu pelajar, mahasiswa, dan masyarakat umum untuk belajar
                    membuat website dan aplikasi web secara
                    <span class="highlight-text">praktis, terarah, dan berbasis proyek</span>.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <div class="stat-box">
                        <div class="stat-number">100+</div>
                        <div class="stat-label">Alumni Sukses</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-number">50+</div>
                        <div class="stat-label">Project Selesai</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-number">98%</div>
                        <div class="stat-label">Kepuasan Peserta</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <div class="icon-box-modern mx-auto mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                    <i class="bi bi-code-slash"></i>
                </div>
                <p class="text-white opacity-90">
                    Di WOKA, peserta tidak hanya belajar teori, tetapi langsung membangun
                    project nyata yang dapat digunakan sebagai <b>portofolio profesional</b>
                    untuk dunia kerja, magang, maupun freelance.
                </p>
            </div>
        </div>
    </div>

    <!-- VISI MISI -->
    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="card-modern h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="icon-box-modern me-3">
                            <i class="bi bi-eye"></i>
                        </div>
                        <div>
                            <h3 class="h4 fw-bold mb-1">Visi Kami</h3>
                            <p class="text-muted mb-0">Arah dan tujuan WOKA</p>
                        </div>
                    </div>
                    <div class="vision-box mt-3">
                        <p class="vision-text">
                            "Menjadi perusahaan yang terkemuka dalam solusi teknologi informasi, memberikan inovasi, kualitas, solusi teknologi dan konsultasi it bagi perusahaan."
                        </p>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card-modern h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="icon-box-modern icon-box-success me-3">
                            <i class="bi bi-flag"></i>
                        </div>
                        <div>
                            <h3 class="h4 fw-bold mb-1">Misi Kami</h3>
                            <p class="text-muted mb-0">Langkah yang kami ambil</p>
                        </div>
                    </div>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3 d-flex align-items-start">
                            <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                            <span class="text-dark">Memberikan solusi teknologi yang inovatif dan berkualitas kepada klien kami.</span>
                        </li>
                        <li class="mb-3 d-flex align-items-start">
                            <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                            <span class="text-dark">Menyediakan layanan administrasi jaringan yang handal dan aman untuk mendukung operasional bisnis klien.</span>
                        </li>
                        <li class="mb-3 d-flex align-items-start">
                            <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                            <span class="text-dark">Mendidik dan melatih individu dan perusahaan dalam penggunaan teknologi komputer, memungkinkan mereka untuk mencapai keunggulan dalam dunia digital.</span>
                        </li>
                        <li class="d-flex align-items-start">
                            <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                            <span class="text-dark">Menyediakan dukungan pelanggan yang unggul, memastikan kepuasan klien dan hubungan jangka panjang yang kuat.    </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- KEUNGGULAN -->
    <div class="card-modern mb-5">
        <div class="card-body p-5">
            <div class="text-center mb-5">
                <h2 class="section-title mb-3">Kenapa Memilih WOKA?</h2>
                <p class="section-subtitle">Keunggulan yang membuat kami berbeda</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="feature-badge">
                        <i class="bi bi-arrow-clockwise text-success"></i>
                        <span class="text-dark">Materi selalu up-to-date dengan teknologi terbaru</span>
                    </div>
                    <div class="feature-badge">
                        <i class="bi bi-people text-success"></i>
                        <span class="text-dark">Cocok untuk pemula tanpa background IT</span>
                    </div>
                    <div class="feature-badge">
                        <i class="bi bi-laptop text-success"></i>
                        <span class="text-dark">Fokus pada praktik langsung & real project</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="feature-badge">
                        <i class="bi bi-award text-success"></i>
                        <span class="text-dark">Sertifikat kelulusan yang diakui industri</span>
                    </div>
                    <div class="feature-badge">
                        <i class="bi bi-chat-dots text-success"></i>
                        <span class="text-dark">Bimbingan project one-on-one dengan mentor</span>
                    </div>
                    <div class="feature-badge">
                        <i class="bi bi-headset text-success"></i>
                        <span class="text-dark">Konsultasi setelah kelas selesai</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- KONTAK -->
    <div class="card-modern">
        <div class="card-body p-5">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h2 class="section-title mb-4">Hubungi Kami</h2>
                    <p class="section-subtitle mb-4">Mari berdiskusi tentang kebutuhan belajar web development Anda</p>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div>
                            <h6 class="text-dark"">Alamat</h6>
                            <p class=" text-dark">Jl. Jambu Kelurahan Tejosari, Metro Timur, Metro, Lampung </p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <div>
                            <h6 class="text-dark"">Telepon/WhatsApp</h6>
                            <p class=" text-dark">085783986968</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <div>
                            <h6 class="text-dark">Email</h6>
                            <p class="text-dark">cv.wokaproject@gmail.com</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="bi bi-instagram"></i>
                        </div>
                        <div>
                            <h6 class="text-dark">Instagram</h6>
                            <p class="text-dark">@wokaprojectid</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 text-center mt-4 mt-lg-0">
                    <div class="icon-box-modern mx-auto" style="width: 100px; height: 100px; font-size: 2.5rem;">
                        <i class="bi bi-chat-heart"></i>
                    </div>
                    <h5 class="mt-4 mb-3 fw-bold">Siap Memulai?</h5>
                    <p class="text-muted">
                        Hubungi kami untuk konsultasi gratis dan informasi kelas terbaru.
                    </p>
                    <a href="#" class="btn btn-primary px-4 py-2 rounded-pill fw-bold">
                        <i class="bi bi-whatsapp me-2"></i> WhatsApp Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modern JavaScript Effects -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add scroll animation
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                }
            });
        }, observerOptions);

        // Observe all cards and sections
        document.querySelectorAll('.card-modern, .about-hero, .section-title').forEach((el) => {
            observer.observe(el);
        });

        // Add hover effect to contact items
        const contactItems = document.querySelectorAll('.contact-item');
        contactItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                const icon = this.querySelector('.contact-icon');
                icon.style.transform = 'rotate(10deg) scale(1.1)';
            });

            item.addEventListener('mouseleave', function() {
                const icon = this.querySelector('.contact-icon');
                icon.style.transform = 'rotate(0deg) scale(1)';
            });
        });
    });
</script>

<!-- Add Animate.css for animations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

@endsection