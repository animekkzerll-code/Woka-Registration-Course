<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') | WOKA GO!</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/woka.jpg') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/woka.jpg') }}">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f3f4f6;
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            background: #ffffff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
            padding: 25px 10px;
            border-radius: 0 20px 20px 0;
        }

        .sidebar .brand {
            font-size: 22px;
            font-weight: 700;
            padding-left: 20px;
            color: #2d4fa0;
            margin-bottom: 20px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 18px;
            margin: 6px 10px;
            border-radius: 12px;
            color: #333;
            font-size: 15px;
            transition: 0.25s;
            cursor: pointer;
            text-decoration: none;
        }

        .menu-item i {
            font-size: 20px;
            margin-right: 12px;
            color: #2d4fa0;
        }

        .menu-item:hover {
            background: #f0f3ff;
        }

        .menu-active {
            background: #eef0ff;
            font-weight: 600;
        }

        .logout-btn {
            margin-top: 40px;
            background: #ff4f4f;
            color: white;
            border: none;
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
        }

        .logout-btn:hover {
            background: #e84141;
        }

        /* CONTENT */
        .content-area {
            margin-left: 270px;
            padding: 25px;
        }

        .header-box {
            background: #283b63;
            color: #fff;
            padding: 28px 30px;
            border-radius: 20px;
            margin-bottom: 25px;
        }

        .header-box h3 {
            font-weight: 700;
        }

        /* CARD STYLE */
        .dashboard-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">

        <div class="brand">Pendaftaran Online</div>

        {{-- MENU UNTUK ADMIN --}}
  @if(auth()->check() && auth()->user()->role === 'admin')
    <a href="/admin/dashboard" class="menu-item {{ request()->is('admin/dashboard') ? 'menu-active' : '' }}">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="/admin/pendaftar" class="menu-item {{ request()->is('admin/pendaftar/index') ? 'menu-active' : '' }}">
        <i class="bi bi-people"></i> Data Pendaftaran
    </a>
    <a href="/admin/pricelist" class="menu-item {{ request()->is('admin/pricelist') ? 'menu-active' : '' }}">
        <i class="bi bi-people"></i> Pricelist
    </a>
    
@endif

        {{-- MENU UNTUK SISWA --}}
  @if(auth()->check() && auth()->user()->role === 'siswa')
    <a href="/siswa/dashboard" class="menu-item {{ request()->is('siswa/dashboard') ? 'menu-active' : '' }}">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
        
    <a href="/siswa/pendaftaran" class="menu-item {{ request()->is('siswa.pendaftaran.index') ? 'menu-active' : '' }}">
        <i class="bi bi-file-earmark-text"></i> Pendaftaran
    </a>
@endif


        {{-- Logout --}}
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="logout-btn">
                <i class="bi bi-power"></i> Logout
            </button>
        </form>

    </div>


    <!-- MAIN CONTENT -->
    <div class="content-area">
        <div class="header-box">
            <h3>@yield('title')</h3>
        </div>

        @yield('content')
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
