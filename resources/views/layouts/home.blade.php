<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Woka Academy')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        :root {
            --midnight: #0a0a1a;
            --deep-space: #121230;
            --cosmic-purple: #7b68ee;
            --nebula-blue: #4361ee;
            --starlight: #e0e0ff;
            --galaxy-gray: #2a2a3a;
            --accent-glow: #9d4edd;
            --transition-smooth: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-quick: all 0.3s ease;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--midnight) 0%, var(--deep-space) 100%);
            color: var(--starlight);
            overflow-x: hidden;
            position: relative;
        }

        /* Animated Background Elements */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(circle at 20% 80%, rgba(123, 104, 238, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(67, 97, 238, 0.08) 0%, transparent 50%);
            z-index: -1;
            animation: nebulaPulse 20s ease-in-out infinite alternate;
        }

        /* Monster Animation Overlay */
        #monster-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(10, 10, 26, 0.95);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        #monster-animation.active {
            opacity: 1;
            visibility: visible;
        }

        .monster-container {
            position: relative;
            width: 300px;
            height: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .monster-image {
            object-fit: contain;
            animation: monsterAppear 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) forwards,
                monsterFloat 2s ease-in-out 0.8s infinite;
            transform-origin: center;
            opacity: 0;
            transform: scale(0.5) rotate(-10deg);
        }

        .monster-glow {
            position: absolute;
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, var(--accent-glow) 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(40px);
            opacity: 0;
            animation: glowPulse 2s ease-in-out infinite;
            z-index: -1;
        }

        .monster-text {
            position: absolute;
            bottom: -60px;
            color: var(--starlight);
            font-size: 24px;
            font-weight: 600;
            text-align: center;
            opacity: 0;
            animation: textFadeIn 0.5s ease-out 0.5s forwards;
            background: linear-gradient(135deg, var(--cosmic-purple), var(--accent-glow));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 20px rgba(157, 78, 221, 0.3);
        }

        @keyframes monsterAppear {
            0% {
                opacity: 0;
                transform: scale(0.5) rotate(-10deg);
            }

            50% {
                opacity: 1;
                transform: scale(1.1) rotate(5deg);
            }

            100% {
                opacity: 1;
                transform: scale(1) rotate(0deg);
            }
        }

        @keyframes monsterFloat {

            0%,
            100% {
                transform: translateY(0) scale(1);
            }

            50% {
                transform: translateY(-20px) scale(1.05);
            }
        }

        @keyframes glowPulse {

            0%,
            100% {
                opacity: 0.5;
                transform: scale(1);
            }

            50% {
                opacity: 0.8;
                transform: scale(1.1);
            }
        }

        @keyframes textFadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .wrapper {
            max-width: 1200px;
            margin: auto;
            padding: 40px 30px;
            position: relative;
            z-index: 1;
        }

        /* NAVBAR */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 80px;
            padding: 20px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            animation: slideDown 0.8s ease-out;
        }

        .brand {
            font-size: 24px;
            font-weight: 700;
            background: linear-gradient(135deg, var(--cosmic-purple), var(--accent-glow));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
            transition: var(--transition-quick);
        }

        .brand::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--cosmic-purple), var(--accent-glow));
            transition: var(--transition-smooth);
        }

        .brand:hover::after {
            width: 100%;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-menu a {
            margin-left: 20px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            color: rgba(224, 224, 255, 0.7);
            padding: 8px 16px;
            border-radius: 12px;
            transition: var(--transition-smooth);
            position: relative;
            overflow: hidden;
        }

        .nav-menu a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: var(--transition-smooth);
        }

        .nav-menu a:hover::before {
            left: 100%;
        }

        .nav-menu a:hover,
        .nav-menu a.active {
            color: #fff;
            background: rgba(255, 255, 255, 0.05);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(123, 104, 238, 0.2);
        }

        .login-btn {
            background: linear-gradient(135deg, var(--cosmic-purple), var(--nebula-blue));
            color: white !important;
            padding: 10px 24px;
            border-radius: 14px;
            font-size: 13px;
            font-weight: 600;
            border: none;
            position: relative;
            overflow: hidden;
            transition: var(--transition-smooth);
            box-shadow: 0 8px 20px rgba(123, 104, 238, 0.3);
        }

        .login-btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%);
            transform-origin: 50% 50%;
        }

        .login-btn:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 15px 30px rgba(123, 104, 238, 0.4);
        }

        .login-btn:active::after {
            animation: ripple 1s ease-out;
        }

        /* USER DROPDOWN */
        .user-dropdown details {
            position: relative;
            margin-left: 20px;
        }

        .user-dropdown summary {
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            color: var(--starlight);
            list-style: none;
            padding: 10px 20px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 14px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: var(--transition-smooth);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .user-dropdown summary:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .user-dropdown summary::-webkit-details-marker {
            display: none;
        }

        .dropdown-content {
            position: absolute;
            right: 0;
            top: calc(100% + 10px);
            background: var(--galaxy-gray);
            color: var(--starlight);
            border-radius: 16px;
            min-width: 200px;
            box-shadow:
                0 20px 40px rgba(0, 0, 0, 0.3),
                0 0 0 1px rgba(255, 255, 255, 0.05);
            overflow: hidden;
            opacity: 0;
            transform: translateY(-10px) scale(0.95);
            transform-origin: top right;
            transition: var(--transition-smooth);
            backdrop-filter: blur(10px);
            z-index: 1000;
        }

        .user-dropdown details[open] .dropdown-content {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        .dropdown-content a,
        .dropdown-content button {
            padding: 14px 20px;
            width: 100%;
            background: none;
            border: none;
            text-align: left;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
            color: var(--starlight);
            display: flex;
            align-items: center;
            gap: 10px;
            transition: var(--transition-quick);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .dropdown-content a:hover,
        .dropdown-content button:hover {
            background: rgba(255, 255, 255, 0.08);
            padding-left: 25px;
        }

        .dropdown-content button {
            color: #ff6b6b;
        }

        .dropdown-content button:hover {
            background: rgba(255, 107, 107, 0.1);
        }

        /* HERO */
        .hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 60px;
            position: relative;
            animation: fadeInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
            opacity: 0;
        }

        .hero-text {
            max-width: 520px;
            position: relative;
            z-index: 2;
        }

        .hero-text small {
            font-size: 13px;
            font-weight: 600;
            color: var(--cosmic-purple);
            letter-spacing: 2px;
            text-transform: uppercase;
            display: block;
            margin-bottom: 15px;
            opacity: 0;
            animation: fadeInUp 0.8s 0.2s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        .hero-text h1 {
            font-size: 48px;
            font-weight: 700;
            margin: 14px 0;
            line-height: 1.2;
            background: linear-gradient(135deg, #fff, var(--starlight));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            opacity: 0;
            animation: fadeInUp 0.8s 0.4s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        .hero-text p {
            font-size: 15px;
            line-height: 1.7;
            color: rgba(224, 224, 255, 0.8);
            margin-bottom: 34px;
            opacity: 0;
            animation: fadeInUp 0.8s 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        .btn-main {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: linear-gradient(135deg, var(--cosmic-purple), var(--accent-glow));
            color: white;
            padding: 15px 32px;
            border-radius: 16px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            box-shadow:
                0 8px 25px rgba(123, 104, 238, 0.3),
                0 0 0 1px rgba(255, 255, 255, 0.1);
            transition: var(--transition-smooth);
            position: relative;
            overflow: hidden;
            opacity: 0;
            animation: fadeInUp 0.8s 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        .btn-main::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: var(--transition-smooth);
        }

        .btn-main:hover::before {
            left: 100%;
        }

        .btn-main:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow:
                0 15px 35px rgba(123, 104, 238, 0.4),
                0 0 0 1px rgba(255, 255, 255, 0.15);
        }

        .hero-image {
            transition: var(--transition-smooth);
            position: relative;
            z-index: 1;
        }

        .hero-image img {
            max-width: 420px;
            width: 100%;
            border-radius: 24px;
            box-shadow:
                0 25px 50px rgba(0, 0, 0, 0.4),
                0 0 0 1px rgba(255, 255, 255, 0.05);
            transition: var(--transition-smooth);
            filter: brightness(1.1) contrast(1.05);
            opacity: 0;
            animation: fadeInUp 0.8s 1s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        .hero-image::after {
            content: '';
            position: absolute;
            top: 10px;
            left: 10px;
            right: 10px;
            bottom: 10px;
            border-radius: 24px;
            background: linear-gradient(135deg, var(--cosmic-purple), transparent 70%);
            filter: blur(20px);
            opacity: 0.3;
            z-index: -1;
            transition: var(--transition-smooth);
        }

        .hero-image:hover::after {
            opacity: 0.5;
            transform: scale(1.05);
        }

        .hero-image img:hover {
            transform: scale(1.05) rotate(1deg);
        }

        /* ANIMATIONS */
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(40px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideDown {
            0% {
                opacity: 0;
                transform: translateY(-30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes nebulaPulse {
            0% {
                transform: scale(1);
                opacity: 0.8;
            }

            100% {
                transform: scale(1.1);
                opacity: 1;
            }
        }

        @keyframes ripple {
            0% {
                transform: scale(0, 0);
                opacity: 0.5;
            }

            20% {
                transform: scale(25, 25);
                opacity: 0.5;
            }

            100% {
                opacity: 0;
                transform: scale(40, 40);
            }
        }

        /* Floating particles */
        .floating-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: floatParticle 20s infinite linear;
        }

        @keyframes floatParticle {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }

        /* Responsive */
        @media (max-width: 900px) {
            .hero {
                flex-direction: column;
                text-align: center;
                gap: 40px;
            }

            .hero-image {
                margin-top: 28px;
                order: -1;
            }

            .hero-text h1 {
                font-size: 36px;
            }

            .nav-menu {
                gap: 5px;
            }

            .nav-menu a {
                margin-left: 10px;
                padding: 6px 12px;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 20px;
                margin-bottom: 40px;
            }

            .nav-menu {
                flex-wrap: wrap;
                justify-content: center;
            }
        }

        /* Overlay full screen */
        #monster-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(10, 10, 26, 0.85);
            backdrop-filter: blur(8px);
            transition: opacity 0.6s ease, visibility 0.6s ease;
            display: none;
            /* hidden default */
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        /* Show animation */
        #monster-animation.active {
            display: flex;
            visibility: visible;
        }

        /* Container untuk monster */
        .monster-container {
            text-align: center;
            animation: fadeIn 0.5s ease-out;
        }

        /* Monster image */
        .monster-image {
            width: 80vw;
            /* responsive */
            max-width: 800px;
            /* maksimal 700px */
            height: auto;
            animation: bounce 1s infinite alternate;
        }

        /* Glow efek */
        .monster-glow {
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(157, 78, 221, 0.4) 0%, transparent 70%);
            filter: blur(50px);
            animation: glowPulse 2s ease-in-out infinite alternate;
            z-index: -1;
        }

        @keyframes glowPulse {
            0% {
                transform: scale(0.9);
                opacity: 0.6;
            }

            50% {
                transform: scale(1.1);
                opacity: 0.85;
            }

            100% {
                transform: scale(0.9);
                opacity: 0.6;
            }
        }


        /* Text under monster */
        .monster-text {
            margin-top: 20px;
            font-size: 2rem;
            color: #fff;
            font-weight: bold;
            text-shadow: 0 0 10px #000;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes bounce {
            from {
                transform: translateY(0);
            }

            to {
                transform: translateY(-20px);
            }
        }

        /* Floating particles */
        .floating-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 999;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 50%;
            animation-name: float;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }

        @keyframes float {
            0% {
                transform: translateY(0);
                opacity: 1;
            }

            100% {
                transform: translateY(-100vh);
                opacity: 0;
            }
        }

        @keyframes monsterEnter {
            0% {
                opacity: 0;
                transform: scale(0.5) rotate(-15deg);
            }

            50% {
                opacity: 1;
                transform: scale(1.2) rotate(10deg);
            }

            100% {
                opacity: 1;
                transform: scale(1) rotate(0deg);
            }
        }

        @keyframes monsterExit {
            0% {
                opacity: 1;
                transform: scale(1) rotate(0deg);
            }

            100% {
                opacity: 0;
                transform: scale(0.5) rotate(20deg);
            }
        }

        .monster-image {
            animation: monsterEnter 1s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }

        @keyframes textFadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes textFadeOut {
            from {
                opacity: 1;
                transform: translateY(0);
            }

            to {
                opacity: 0;
                transform: translateY(20px);
            }
        }

        .monster-text {
            animation: textFadeIn 0.8s ease-out 0.8s forwards;
        }
    </style>
</head>

<body @if(session('login_success')) data-login-success="true" @endif>
    <!-- Monster Animation Overlay -->
    <div id="monster-animation">
        <div class="monster-container">
            <div class="monster-glow"></div>
            <img src="{{ asset('assets/monster-halo.png') }}" alt="Monster" class="monster-image">
        </div>
    </div>

    <!-- Floating Particles -->
    <div class="floating-particles" id="particles"></div>

    <div class="wrapper">
        <!-- NAVBAR -->
        <div class="navbar">
            <div class="brand">Woka Academy</div>
            <div class="nav-menu">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('pricelist') }}" class="{{ request()->is('pricelist') ? 'active' : '' }}">Pricelist</a>
                <a href="{{ route('about') }}" class="{{ request()->is('about') ? 'active' : '' }}">About Us</a>

                @guest
                <a href="{{ route('login') }}" class="login-btn">Login</a>
                @endguest

                @auth
                <div class="user-dropdown">
                    <details>
                        <summary>
                            {{ Auth::user()->name }}
                            <i class="bi bi-chevron-down"></i>
                        </summary>
                        <div class="dropdown-content">
                            <a href="{{ route('siswa.profile') }}">
                                <i class="bi bi-person"></i> Profile
                            </a>
                            <a href="{{ route('siswa.riwayat') }}">
                                <i class="bi bi-clock-history"></i> Riwayat
                            </a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </div>
                    </details>
                </div>
                @endauth
            </div>
        </div>

        <!-- HERO hanya di Home -->
        @yield('content')
    </div>

    <script>
        // =========================
        // CREATE FLOATING PARTICLES
        // =========================
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            if (!particlesContainer) return;

            const particleCount = 15;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';

                const size = Math.random() * 4 + 1;
                const posX = Math.random() * 100;
                const duration = Math.random() * 20 + 10;
                const delay = Math.random() * 20;

                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${posX}vw`;
                particle.style.animationDuration = `${duration}s`;
                particle.style.animationDelay = `${delay}s`;

                particlesContainer.appendChild(particle);
            }
        }

        // =========================
        // MONSTER ANIMATION CONTROL
        // =========================
        function showMonsterAnimation() {
            const overlay = document.getElementById('monster-animation');
            if (!overlay) return;

            const monster = overlay.querySelector('.monster-image');
            const text = overlay.querySelector('.monster-text');

            // tampilkan overlay
            overlay.classList.add('active');

            // tunggu 3 detik
            setTimeout(() => {

                // animasi keluar monster
                if (monster) {
                    monster.style.animation = 'monsterExit 1s forwards';
                }

                // animasi keluar teks
                if (text) {
                    text.style.animation = 'textFadeOut 0.8s forwards';
                }

                // fade out overlay (JANGAN reset opacity ke 1)
                overlay.style.opacity = '0';

                // setelah animasi selesai
                setTimeout(() => {
                    overlay.classList.remove('active');
                    overlay.style.opacity = ''; // reset ke CSS default

                    // redirect SETELAH overlay benar-benar hilang
                    // window.location.href = "{{ route('home') }}";
                }, 1000);

            }, 3000);
        }

        // =========================
        // INIT
        // =========================
        document.addEventListener('DOMContentLoaded', function() {
            createParticles();

            const loginSuccess = document.body.dataset.loginSuccess;
            if (loginSuccess === "true") {
                showMonsterAnimation();
            }
        });
    </script>
</body>

</html>