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
        /* ===== NAVBAR ===== */
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
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .navbar-brand i {
            color: #f0a500;
        }

        /* Nav Links */
        .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            font-weight: 500;
            padding: 6px 12px !important;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .nav-link:hover {
            color: #f0a500 !important;
            background: rgba(255, 255, 255, 0.08);
        }

        /* ===== LANGUAGE SWITCHER ===== */
        .language-switcher .dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            padding: 6px 14px;
            color: #fff !important;
            font-size: 0.85rem;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.3s;
        }

        .language-switcher .dropdown-toggle:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .language-switcher .dropdown-toggle::after {
            display: none;
        }

        .language-switcher .dropdown-menu {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            padding: 8px;
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

        .language-switcher .dropdown-item.active-lang {
            background: #e8f0fe;
            color: #1a1a2e;
            font-weight: 600;
        }

        /* ===== PROFILE DROPDOWN ===== */
        .profile-dropdown .dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            padding: 5px 14px 5px 5px;
            color: #fff !important;
            text-decoration: none;
            transition: background 0.3s;
        }

        .profile-dropdown .dropdown-toggle:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .profile-dropdown .dropdown-toggle::after {
            display: none;
        }

        .profile-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #f0a500, #e63946);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.85rem;
            color: #fff;
            text-transform: uppercase;
            flex-shrink: 0;
        }

        .profile-name {
            font-size: 0.875rem;
            font-weight: 500;
            color: #fff;
        }

        .profile-chevron {
            font-size: 0.7rem;
            opacity: 0.7;
            color: #fff;
        }

        /* Profile Dropdown Menu */
        .profile-dropdown .dropdown-menu {
            border: none;
            border-radius: 14px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            padding: 8px;
            min-width: 220px;
            margin-top: 10px !important;
        }

        .profile-user-info {
            padding: 10px 12px 8px;
        }

        .profile-user-info .user-name {
            font-weight: 700;
            font-size: 0.95rem;
            color: #1a1a2e;
        }

        .profile-user-info .user-email {
            font-size: 0.78rem;
            color: #6c757d;
            margin-top: 2px;
        }

        .profile-dropdown .dropdown-item {
            border-radius: 8px;
            padding: 9px 12px;
            font-size: 0.875rem;
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

        .profile-dropdown .dropdown-item i {
            font-size: 1rem;
            width: 20px;
            text-align: center;
        }

        .logout-btn {
            width: 100%;
            text-align: start;
            border: none;
            background: none;
            color: #e63946 !important;
        }

        .logout-btn:hover {
            background: #fff0f1 !important;
            color: #e63946 !important;
        }

        .dropdown-divider {
            margin: 6px 0;
            opacity: 0.1;
        }

        /* ===== GUEST BUTTONS ===== */
        .btn-login {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #fff !important;
            border-radius: 50px;
            padding: 6px 18px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-login:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .btn-register {
            background: #f0a500;
            border: none;
            color: #1a1a2e !important;
            border-radius: 50px;
            padding: 6px 18px;
            font-size: 0.85rem;
            font-weight: 700;
            transition: all 0.3s;
        }

        .btn-register:hover {
            background: #e09400;
        }

        /* Mobile Toggle */
        .navbar-toggler {
            border: none;
            padding: 4px 8px;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        /* ===== PAGE HEADER ===== */
        .page-header {
            background: #fff;
            border-bottom: 1px solid #e9ecef;
            padding: 18px 0;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">

        {{-- ============================= NAVBAR ============================= --}}
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid px-4">

                {{-- ===== LOGO / BRAND ===== --}}
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fas fa-book-open"></i>
                    {{ config('app.name', 'Library') }}
                </a>

                {{-- ===== MOBILE TOGGLE ===== --}}
                <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#mainNavbar"
                    aria-controls="mainNavbar"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="bi bi-list text-white fs-3"></i>
                </button>

            </div>
            
                {{-- ===== COLLAPSIBLE CONTENT ===== --}}
                <div class="collapse navbar-collapse" id="mainNavbar">

                    {{-- ===== CENTER NAV LINKS (auto margin both sides) ===== --}}
              

                    {{-- ===== RIGHT SIDE: Language + Profile/Guest ===== --}}
                    <ul class="navbar-nav align-items-center gap-2 mb-2 mb-lg-0">

                        {{-- ----- Language Switcher ----- --}}
                        <li class="nav-item dropdown language-switcher">
                            <a class="dropdown-toggle" href="#"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="bi bi-translate"></i>
                                {{ strtoupper(app()->getLocale()) }}
                                <i class="bi bi-chevron-down profile-chevron ms-1"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item {{ app()->getLocale() == 'en' ? 'active-lang' : '' }}"
                                        href="{{ url('lang/en') }}">
                                        🇺🇸 &nbsp; English
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ app()->getLocale() == 'ps' ? 'active-lang' : '' }}"
                                        href="{{ url('lang/ps') }}">
                                        🇦🇫 &nbsp; پښتو
                                    </a>
                                </li>
                            
                            </ul>
                        </li>

                        {{-- ----- Profile Dropdown (Authenticated) ----- --}}
                        @auth
                        <li class="nav-item dropdown profile-dropdown">
                            <a class="dropdown-toggle" href="#"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">

                                {{-- Avatar Circle with First Letter --}}
                                <div class="profile-avatar">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>

                                {{-- Username (hidden on small screens) --}}
                                <span class="profile-name d-none d-md-inline">
                                    {{ Auth::user()->name }}
                                </span>

                                {{-- Arrow --}}
                                <i class="bi bi-chevron-down profile-chevron"></i>
                            </a>

                            {{-- Dropdown Menu --}}
                            <ul class="dropdown-menu dropdown-menu-end">

                                {{-- User Info --}}
                                <li>
                                    <div class="profile-user-info">
                                        <div class="user-name">{{ Auth::user()->name }}</div>
                                        <div class="user-email">{{ Auth::user()->email }}</div>
                                    </div>
                                </li>

                                <li><hr class="dropdown-divider"></li>

                                {{-- Profile --}}
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="bi bi-person-circle text-primary"></i>
                                        {{ __('My Profile') }}
                                    </a>
                                </li>

                            

                                <li><hr class="dropdown-divider"></li>

                                {{-- Logout --}}
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item logout-btn">
                                            <i class="bi bi-box-arrow-right text-danger"></i>
                                            {{ __('Logout') }}
                                        </button>
                                    </form>
                                </li>

                            </ul>
                        </li>
                        @endauth

                        {{-- ----- Guest Buttons ----- --}}
                        @guest
                        <li class="nav-item">
                            <a class="btn-login" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-1"></i>
                                {{ __('Login') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn-register" href="{{ route('register') }}">
                                <i class="bi bi-person-plus me-1"></i>
                                {{ __('Register') }}
                            </a>
                        </li>
                        @endguest

                    </ul>
                    {{-- ===== END RIGHT SIDE ===== --}}

                </div>
                {{-- ===== END COLLAPSIBLE ===== --}}
        </nav>
        {{-- ============================= END NAVBAR ============================= --}}

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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>