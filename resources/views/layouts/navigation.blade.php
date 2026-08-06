<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ in_array(app()->getLocale(), ['ps']) ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('all.css') }}" rel="stylesheet">
    <!-- Custom Bootstrap -->
    <link rel="stylesheet" href="{{ asset('bootstrap.css') }}">
    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Navbar Professional Style */
        .navbar {
            background: linear-gradient(135deg, #1a1a2e, #16213e);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.3);
            padding: 10px 20px;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff !important;
            letter-spacing: 1px;
        }

        .navbar-brand i {
            color: #f0a500;
            margin-right: 8px;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: #f0a500 !important;
        }

        /* Profile Dropdown */
        .profile-dropdown .dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            padding: 6px 14px;
            color: #fff !important;
            text-decoration: none;
            transition: background 0.3s;
        }

        .profile-dropdown .dropdown-toggle:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .profile-dropdown .dropdown-toggle::after {
            display: none; /* hide default arrow */
        }

        .profile-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: linear-gradient(135deg, #f0a500, #e63946);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
            color: #fff;
            text-transform: uppercase;
        }

        .profile-name {
            font-size: 0.9rem;
            font-weight: 500;
        }

        .profile-chevron {
            font-size: 0.75rem;
            opacity: 0.7;
        }

        /* Dropdown Menu */
        .profile-dropdown .dropdown-menu {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            padding: 10px;
            min-width: 200px;
            margin-top: 10px;
        }

        .profile-dropdown .dropdown-item {
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 0.9rem;
            font-weight: 500;
            color: #333;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .profile-dropdown .dropdown-item:hover {
            background: #f0f4ff;
            color: #1a1a2e;
        }

        .dropdown-item.logout-btn {
            color: #e63946;
        }

        .dropdown-item.logout-btn:hover {
            background: #fff0f1;
            color: #e63946;
        }

        .dropdown-divider {
            margin: 6px 0;
        }

        /* Language Switcher */
        .language-switcher .dropdown-toggle {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            padding: 6px 14px;
            color: #fff !important;
            font-size: 0.85rem;
            font-weight: 500;
            transition: background 0.3s;
        }

        .language-switcher .dropdown-toggle:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .language-switcher .dropdown-menu {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            padding: 10px;
            min-width: 150px;
        }

        .language-switcher .dropdown-item {
            border-radius: 8px;
            padding: 8px 14px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: background 0.2s;
        }

        .language-switcher .dropdown-item:hover {
            background: #f0f4ff;
        }

        /* Page Header */
        .page-header {
            background: #fff;
            border-bottom: 1px solid #e9ecef;
            padding: 18px 0;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05);
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">

        {{-- ===================== NAVBAR ===================== --}}
        {{-- ===================== NAVBAR ===================== --}}
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid px-4">

        {{-- 
            This group stays together:
            LTR (English): logo + language + profile on the LEFT
            RTL (Pashto):  logo + language + profile on the RIGHT
        --}}
        <div class="navbar-brand-area">

            {{-- Brand / Logo --}}
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-book-open"></i>
                {{ config('app.name', 'Library') }}
            </a>

            {{-- Language + Profile are beside the logo --}}
            <div class="navbar-utilities">

                {{-- ===== Language Switcher ===== --}}
                <div class="dropdown language-switcher">
                    <a class="dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-translate"></i>
                        {{ strtoupper(app()->getLocale()) }}
                    </a>

                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ url('lang/en') }}">
                                🇺🇸 English
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url('lang/ps') }}">
                                🇦🇫 پښتو
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url('lang/fa') }}">
                                🇮🇷 دری
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- ===== User Profile Dropdown ===== --}}
                @auth
                    <div class="dropdown profile-dropdown">
                        <a class="dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">

                            {{-- First letter of the user's name --}}
                            <span class="profile-avatar">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>

                            {{-- Username --}}
                            <span class="profile-name">
                                {{ auth()->user()->name }}
                            </span>

                            <i class="bi bi-chevron-down profile-chevron"></i>
                        </a>

                        <ul class="dropdown-menu">
                            {{-- User information --}}
                            <li class="px-3 py-2">
                                <div class="fw-bold text-dark">
                                    {{ auth()->user()->name }}
                                </div>
                                <small class="text-muted">
                                    {{ auth()->user()->email }}
                                </small>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            {{-- Breeze profile page --}}
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person-circle text-primary"></i>
                                    Profile
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            {{-- Logout must use POST in Laravel Breeze --}}
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <button type="submit" class="dropdown-item logout-btn w-100">
                                        <i class="bi bi-box-arrow-right"></i>
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth

                {{-- Guest user buttons --}}
                @guest
                    <a class="btn btn-outline-light btn-sm rounded-pill px-3"
                        href="{{ route('login') }}">
                        <i class="bi bi-box-arrow-in-right"></i>
                        Login
                    </a>

                    <a class="btn btn-warning btn-sm rounded-pill px-3 text-dark fw-semibold"
                        href="{{ route('register') }}">
                        Register
                    </a>
                @endguest

            </div>
        </div>

        {{-- Mobile menu button --}}
        <button class="navbar-toggler border-0" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#mainNavbar"
            aria-controls="mainNavbar"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="bi bi-list text-white fs-3"></i>
        </button>

        {{-- Navigation links go to the OTHER side --}}
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav navbar-links mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">
                        <i class="bi bi-house"></i>
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-book"></i>
                        Books
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-grid"></i>
                        Categories
                    </a>
                </li>
            </ul>
        </div>

    </div>
</nav>
{{-- ===================== END NAVBAR ===================== --}}
        {{-- ===================== END NAVBAR ===================== --}}

        {{-- Include Navigation (if you have separate file) --}}
        {{-- @include('layouts.navigation') --}}

        {{-- Page Heading --}}
        @isset($header)
            <header class="page-header">
                <div class="container">
                    {{ $header }}
                </div>
            </header>
        @endisset

        {{-- Page Content --}}
        <main>
            @yield('content')
        </main>

    </div>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>