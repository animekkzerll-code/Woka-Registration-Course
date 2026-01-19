<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login | Woka Academy</title>

    <!-- Modern Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #818cf8;
            --secondary: #8b5cf6;
            --accent: #06b6d4;
            --dark: #0f172a;
            --darker: #020617;
            --dark-bg: #0a0a1a;
            --card-bg: rgba(15, 23, 42, 0.8);
            --light: #f8fafc;
            --gray-100: #1e293b;
            --gray-200: #334155;
            --gray-300: #475569;
            --gray-400: #94a3b8;
            --gray-500: #cbd5e1;
            --success: #10b981;
            --error: #f87171;
            --glow: rgba(99, 102, 241, 0.4);
            --radius-sm: 8px;
            --radius: 12px;
            --radius-lg: 16px;
            --radius-xl: 24px;
            --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.3);
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.4);
            --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.5);
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.6);
            --glow-shadow: 0 0 20px var(--glow);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, var(--darker) 0%, var(--dark-bg) 50%, #1e1b4b 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated cosmic background */
        .cosmic-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
            overflow: hidden;
        }

        .star {
            position: absolute;
            background: white;
            border-radius: 50%;
            animation: twinkle var(--duration) infinite var(--delay);
        }

        .shooting-star {
            position: absolute;
            background: linear-gradient(90deg, transparent, white);
            border-radius: 2px;
            transform: rotate(45deg);
            animation: shoot var(--shoot-duration) linear var(--shoot-delay);
        }

        @keyframes twinkle {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 1; }
        }

        @keyframes shoot {
            0% {
                transform: translateX(-100px) translateY(-100px) rotate(45deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateX(100vw) translateY(100vh) rotate(45deg);
                opacity: 0;
            }
        }

        /* Nebula effect */
        .nebula {
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: 
                radial-gradient(circle at 20% 80%, rgba(99, 102, 241, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(139, 92, 246, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(6, 182, 212, 0.1) 0%, transparent 50%);
            filter: blur(40px);
            animation: nebulaFlow 20s ease-in-out infinite alternate;
        }

        @keyframes nebulaFlow {
            0% {
                transform: translate(0, 0) scale(1);
                filter: blur(40px);
            }
            50% {
                transform: translate(20px, -20px) scale(1.1);
                filter: blur(30px);
            }
            100% {
                transform: translate(-20px, 20px) scale(0.9);
                filter: blur(40px);
            }
        }

        /* Main container with glass morphism */
        .login-container {
            display: flex;
            width: 100%;
            max-width: 1000px;
            min-height: 600px;
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(99, 102, 241, 0.2);
            border-radius: var(--radius-xl);
            overflow: hidden;
            box-shadow: 
                var(--shadow-lg),
                0 0 40px rgba(99, 102, 241, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            animation: 
                slideUp 0.8s ease-out,
                containerGlow 4s ease-in-out infinite;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes containerGlow {
            0%, 100% {
                box-shadow: 
                    var(--shadow-lg),
                    0 0 40px rgba(99, 102, 241, 0.2),
                    inset 0 1px 0 rgba(255, 255, 255, 0.1);
            }
            50% {
                box-shadow: 
                    var(--shadow-lg),
                    0 0 60px rgba(99, 102, 241, 0.3),
                    inset 0 1px 0 rgba(255, 255, 255, 0.1);
            }
        }

        /* Left side - Brand/Info */
        .login-side {
            flex: 1;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.2), rgba(139, 92, 246, 0.2));
            color: white;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        .login-side::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 30% 20%, rgba(255, 255, 255, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 70% 80%, rgba(255, 255, 255, 0.03) 0%, transparent 50%);
            animation: sideGlow 8s ease-in-out infinite alternate;
        }

        @keyframes sideGlow {
            from {
                opacity: 0.5;
            }
            to {
                opacity: 1;
            }
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 40px;
            position: relative;
        }

        .brand-logo {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 20px;
            color: white;
            box-shadow: 
                0 0 20px var(--glow),
                var(--shadow);
            animation: logoFloat 3s ease-in-out infinite;
        }

        @keyframes logoFloat {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        .brand-text {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 28px;
            font-weight: 800;
            background: linear-gradient(135deg, white, var(--primary-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .side-content {
            max-width: 400px;
            position: relative;
        }

        .side-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 20px;
            line-height: 1.2;
            background: linear-gradient(135deg, white, var(--primary-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: textGlow 2s ease-in-out infinite alternate;
        }

        @keyframes textGlow {
            from {
                text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
            }
            to {
                text-shadow: 0 0 20px rgba(99, 102, 241, 0.5);
            }
        }

        .side-subtitle {
            font-size: 16px;
            color: var(--gray-400);
            line-height: 1.6;
            margin-bottom: 30px;
        }

        /* Right side - Login Form */
        .login-form-container {
            flex: 1;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: rgba(15, 23, 42, 0.4);
            position: relative;
        }

        .form-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .form-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 28px;
            font-weight: 700;
            color: white;
            margin-bottom: 8px;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
        }

        .form-subtitle {
            color: var(--gray-400);
            font-size: 15px;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 24px;
            animation: slideIn 0.6s ease-out forwards;
            opacity: 0;
            transform: translateX(20px);
        }

        @keyframes slideIn {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .input-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: var(--gray-500);
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            font-size: 18px;
            transition: all 0.3s ease;
            z-index: 1;
        }

        .form-input {
            width: 100%;
            padding: 14px 16px 14px 50px;
            font-size: 15px;
            font-family: 'Inter', sans-serif;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: var(--radius);
            background: rgba(15, 23, 42, 0.6);
            color: white;
            transition: all 0.3s ease;
            outline: none;
            position: relative;
        }

        .form-input:hover {
            border-color: var(--primary-light);
            box-shadow: 0 0 15px rgba(99, 102, 241, 0.2);
        }

        .form-input:focus {
            border-color: var(--primary);
            box-shadow: 
                0 0 20px rgba(99, 102, 241, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        .form-input:focus + .input-icon {
            color: var(--primary);
            transform: translateY(-50%) scale(1.1);
        }

        .form-input::placeholder {
            color: var(--gray-400);
        }

        /* Error states */
        .error-message {
            display: block;
            font-size: 13px;
            color: var(--error);
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
            animation: shake 0.5s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .input-error {
            border-color: var(--error) !important;
            animation: errorGlow 0.5s ease;
        }

        @keyframes errorGlow {
            0%, 100% { box-shadow: 0 0 10px rgba(248, 113, 113, 0.3); }
            50% { box-shadow: 0 0 20px rgba(248, 113, 113, 0.5); }
        }

        /* Alert Box */
        .alert {
            padding: 12px 16px;
            border-radius: var(--radius);
            font-size: 14px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideDown 0.3s ease-out, alertGlow 2s ease-in-out infinite;
            backdrop-filter: blur(10px);
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

        @keyframes alertGlow {
            0%, 100% { box-shadow: 0 0 10px currentColor; }
            50% { box-shadow: 0 0 20px currentColor; }
        }

        .alert-error {
            background: rgba(248, 113, 113, 0.1);
            color: var(--error);
            border: 1px solid rgba(248, 113, 113, 0.3);
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        /* Form Options */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0 30px;
            font-size: 14px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            color: var(--gray-400);
        }

        .remember-me input {
            width: 16px;
            height: 16px;
            accent-color: var(--primary);
            cursor: pointer;
        }

        .forgot-password {
            color: var(--primary-light);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .forgot-password::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 1px;
            background: var(--primary-light);
            transition: width 0.3s ease;
        }

        .forgot-password:hover {
            color: white;
        }

        .forgot-password:hover::after {
            width: 100%;
        }

        /* Submit Button */
        .submit-btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            border-radius: var(--radius);
            font-size: 15px;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
            z-index: -1;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 
                var(--shadow-md),
                0 0 30px rgba(99, 102, 241, 0.4);
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .submit-btn i {
            font-size: 18px;
            transition: transform 0.3s ease;
        }

        .submit-btn:hover i {
            transform: translateX(5px);
        }

        /* Register Link */
        .register-link {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: var(--gray-400);
        }

        .register-link a {
            color: var(--primary-light);
            text-decoration: none;
            font-weight: 600;
            margin-left: 5px;
            transition: all 0.3s ease;
            position: relative;
        }

        .register-link a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 1px;
            background: var(--primary-light);
            transition: width 0.3s ease;
        }

        .register-link a:hover {
            color: white;
        }

        .register-link a:hover::after {
            width: 100%;
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            margin: 30px 0;
            color: var(--gray-400);
            font-size: 14px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        }

        .divider span {
            padding: 0 15px;
        }

        /* Social Login */
        .social-login {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 20px;
        }

        .social-btn {
            padding: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: var(--radius);
            background: rgba(15, 23, 42, 0.6);
            color: var(--gray-500);
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .social-btn:hover {
            border-color: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 
                0 5px 15px rgba(0, 0, 0, 0.3),
                0 0 15px rgba(99, 102, 241, 0.2);
        }

        /* Loading animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 900px) {
            .login-container {
                flex-direction: column;
                max-width: 500px;
            }
            
            .login-side {
                padding: 40px 30px;
            }
            
            .login-form-container {
                padding: 40px 30px;
            }
            
            .social-login {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .login-container {
                border-radius: var(--radius-lg);
            }
            
            .login-side,
            .login-form-container {
                padding: 30px 20px;
            }
            
            .brand-text {
                font-size: 24px;
            }
            
            .side-title {
                font-size: 24px;
            }
            
            .form-title {
                font-size: 24px;
            }
        }

        /* Floating particles */
        .particle {
            position: absolute;
            background: radial-gradient(circle, var(--primary) 0%, transparent 70%);
            border-radius: 50%;
            opacity: 0;
            animation: floatParticle var(--duration) ease-in-out infinite;
        }

        @keyframes floatParticle {
            0% {
                transform: translateY(0) translateX(0);
                opacity: 0;
            }
            10% {
                opacity: 0.5;
            }
            90% {
                opacity: 0.5;
            }
            100% {
                transform: translateY(-100px) translateX(20px);
                opacity: 0;
            }
        }
    </style>
</head>

<body>
    <!-- Cosmic Background -->
    <div class="cosmic-bg" id="cosmicBg"></div>
    <div class="nebula"></div>

    <!-- Main container -->
    <div class="login-container">
        <!-- Left side - Brand/Info -->
        <div class="login-side">
            <div class="brand">
                <div class="brand-logo">W</div>
                <div class="brand-text">Woka Academy</div>
            </div>
            
            <div class="side-content">
                <h1 class="side-title">Welcome Back</h1>
                <p class="side-subtitle">sign up now to continue your course enrollment online on our website</p>
            </div>
        </div>

        <!-- Right side - Login Form -->
        <div class="login-form-container">
            <div class="form-header">
                <h2 class="form-title">Sign In</h2>
                <p class="form-subtitle">Enter your credentials to access your account</p>
            </div>

            @if($errors->any())
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                {{ $errors->first() }}
            </div>
            @endif

            @if(session('status'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                <div class="form-group" style="animation-delay: 0.1s">
                    <label class="input-label">Email Address</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" 
                               name="email" 
                               class="form-input @error('email') input-error @enderror" 
                               placeholder="you@example.com" 
                               value="{{ old('email') }}" 
                               required
                               autofocus>
                    </div>
                    @error('email')
                    <span class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="form-group" style="animation-delay: 0.2s">
                    <label class="input-label">Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" 
                               name="password" 
                               class="form-input @error('password') input-error @enderror" 
                               placeholder="Enter your password" 
                               required>
                    </div>
                    @error('password')
                    <span class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        <span>Remember me</span>
                    </label>
                    <a href="#" class="forgot-password">
                        Forgot password?
                    </a>
                </div>

                <button type="submit" class="submit-btn" id="submitBtn">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Sign In</span>
                </button>

                <div class="register-link">
                    Don't have an account?
                    <a href="{{ route('register') }}">Create account</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Create cosmic background
        
        function createShootingStar() {
            const container = document.getElementById('cosmicBg');
            const star = document.createElement('div');
            star.className = 'shooting-star';
            
            const left = Math.random() * 20;
            const top = Math.random() * 20;
            const duration = 1 + Math.random();
            const delay = Math.random() * 2;
            const length = 50 + Math.random() * 100;
            const opacity = 0.5 + Math.random() * 0.5;
            
            star.style.width = `${length}px`;
            star.style.height = '2px';
            star.style.left = `${left}%`;
            star.style.top = `${top}%`;
            star.style.opacity = opacity;
            star.style.setProperty('--shoot-duration', `${duration}s`);
            star.style.setProperty('--shoot-delay', `${delay}s`);
            
            container.appendChild(star);
            
            setTimeout(() => {
                star.remove();
            }, (duration + delay) * 1000);
        }
        
        function createFloatingParticle() {
            const container = document.getElementById('cosmicBg');
            const particle = document.createElement('div');
            particle.className = 'particle';
            
            const size = 2 + Math.random() * 4;
            const left = Math.random() * 100;
            const duration = 3 + Math.random() * 4;
            const delay = Math.random() * 5;
            
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            particle.style.left = `${left}%`;
            particle.style.bottom = '0';
            particle.style.setProperty('--duration', `${duration}s`);
            particle.style.setProperty('--delay', `${delay}s`);
            
            // Random color
            const colors = ['rgba(99, 102, 241, 0.6)', 'rgba(139, 92, 246, 0.6)', 'rgba(6, 182, 212, 0.6)'];
            particle.style.background = `radial-gradient(circle, ${colors[Math.floor(Math.random() * colors.length)]} 0%, transparent 70%)`;
            
            container.appendChild(particle);
            
            // Remove and recreate after animation
            setTimeout(() => {
                particle.remove();
                createFloatingParticle();
            }, (duration + delay) * 1000);
        }
        
        // Form submission handling
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            const btnText = submitBtn.querySelector('span');
            const btnIcon = submitBtn.querySelector('i');
            
            // Save original content
            const originalText = btnText.textContent;
            const originalIcon = btnIcon.className;
            
            // Show loading state
            btnText.textContent = 'Signing in...';
            btnIcon.className = 'loading';
            submitBtn.disabled = true;
            submitBtn.style.background = 'linear-gradient(135deg, #4f46e5, #3730a3)';
            
            // Add particle effect on submit
            createSubmitParticles(submitBtn);
            
            // Simulate loading for demo (remove in production)
            setTimeout(() => {
                // Restore button
                btnText.textContent = originalText;
                btnIcon.className = originalIcon;
                submitBtn.disabled = false;
                submitBtn.style.background = 'linear-gradient(135deg, var(--primary), var(--primary-dark))';
            }, 2000);
        });
        
        function createSubmitParticles(button) {
            const rect = button.getBoundingClientRect();
            const colors = ['#6366f1', '#8b5cf6', '#06b6d4'];
            
            for (let i = 0; i < 20; i++) {
                const particle = document.createElement('div');
                particle.style.position = 'fixed';
                particle.style.width = '4px';
                particle.style.height = '4px';
                particle.style.background = colors[Math.floor(Math.random() * colors.length)];
                particle.style.borderRadius = '50%';
                particle.style.left = `${rect.left + rect.width / 2}px`;
                particle.style.top = `${rect.top + rect.height / 2}px`;
                particle.style.zIndex = '1000';
                particle.style.pointerEvents = 'none';
                
                document.body.appendChild(particle);
                
                const angle = Math.random() * Math.PI * 2;
                const speed = 2 + Math.random() * 3;
                const distance = 50 + Math.random() * 100;
                
                const animation = particle.animate([
                    {
                        transform: `translate(0, 0) scale(1)`,
                        opacity: 1
                    },
                    {
                        transform: `translate(${Math.cos(angle) * distance}px, ${Math.sin(angle) * distance}px) scale(0)`,
                        opacity: 0
                    }
                ], {
                    duration: 800 + Math.random() * 400,
                    easing: 'cubic-bezier(0.1, 0.8, 0.2, 1)'
                });
                
                animation.onfinish = () => particle.remove();
            }
        }
        
        // Input focus effects
        document.querySelectorAll('.form-input').forEach((input, index) => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('focused');
            });
            
            // Add ripple effect on focus
            input.addEventListener('focus', function(e) {
                const wrapper = this.parentElement;
                const ripple = document.createElement('span');
                ripple.style.position = 'absolute';
                ripple.style.borderRadius = '50%';
                ripple.style.background = 'rgba(99, 102, 241, 0.2)';
                ripple.style.transform = 'scale(0)';
                ripple.style.animation = 'ripple 0.6s linear';
                ripple.style.pointerEvents = 'none';
                
                const size = Math.max(wrapper.offsetWidth, wrapper.offsetHeight);
                ripple.style.width = `${size}px`;
                ripple.style.height = `${size}px`;
                ripple.style.left = `${e.offsetX - size / 2}px`;
                ripple.style.top = `${e.offsetY - size / 2}px`;
                
                wrapper.appendChild(ripple);
                
                setTimeout(() => ripple.remove(), 600);
            });
        });
        
        // Add CSS for ripple effect
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
        
        // Password visibility toggle
        const passwordInput = document.querySelector('input[name="password"]');
        if (passwordInput) {
            const wrapper = passwordInput.parentElement;
            const toggle = document.createElement('i');
            toggle.className = 'fas fa-eye input-icon';
            toggle.style.left = 'auto';
            toggle.style.right = '16px';
            toggle.style.cursor = 'pointer';
            toggle.style.zIndex = '2';
            
            toggle.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.className = type === 'password' ? 'fas fa-eye input-icon' : 'fas fa-eye-slash input-icon';
                this.style.left = 'auto';
                this.style.right = '16px';
            });
            
            wrapper.appendChild(toggle);
        }
        
        // Initialize on load
        document.addEventListener('DOMContentLoaded', () => {
            createCosmicBackground();
            
            // Animate form elements sequentially
            const formGroups = document.querySelectorAll('.form-group');
            formGroups.forEach((group, index) => {
                setTimeout(() => {
                    group.style.animation = 'slideIn 0.6s ease-out forwards';
                }, 100 + index * 100);
            });
            
            // Add hover effect to submit button
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.addEventListener('mouseenter', () => {
                createButtonHoverParticles(submitBtn);
            });
        });
        
        function createButtonHoverParticles(button) {
            const rect = button.getBoundingClientRect();
            const colors = ['#6366f1', '#8b5cf6', '#06b6d4'];
            
            for (let i = 0; i < 5; i++) {
                const particle = document.createElement('div');
                particle.style.position = 'absolute';
                particle.style.width = '6px';
                particle.style.height = '6px';
                particle.style.background = colors[Math.floor(Math.random() * colors.length)];
                particle.style.borderRadius = '50%';
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.top = `${Math.random() * 100}%`;
                particle.style.zIndex = '1';
                particle.style.pointerEvents = 'none';
                particle.style.filter = 'blur(1px)';
                
                button.appendChild(particle);
                
                const animation = particle.animate([
                    {
                        transform: 'scale(0) translateY(0)',
                        opacity: 1
                    },
                    {
                        transform: 'scale(1) translateY(-20px)',
                        opacity: 0
                    }
                ], {
                    duration: 600 + Math.random() * 400,
                    easing: 'cubic-bezier(0.1, 0.8, 0.2, 1)'
                });
                
                animation.onfinish = () => particle.remove();
            }
        }
    </script>
</body>
</html>