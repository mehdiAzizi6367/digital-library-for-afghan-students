<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ in_array(app()->getLocale(), ['ps']) ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('dashboard.admin_panel') }} - @yield('title')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('all.css') }}">
    

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 260px;
            --topbar-height: 64px;
            --sidebar-bg: linear-gradient(180deg, #1a1d23 0%, #2d313a 100%);
            --sidebar-hover: rgba(255, 255, 255, 0.08);
            --sidebar-active: rgba(99, 132, 255, 0.2);
            --sidebar-active-border: #6366f1;
            --sidebar-text: #a1a7b5;
            --sidebar-text-active: #ffffff;
            --topbar-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            min-height: 100vh;
            overflow-x: hidden;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: #f0f2f5;
        }

        /* ═══════════════ SIDEBAR ═══════════════ */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            position: fixed;
            top: 0;
            bottom: 0;
            z-index: 1050;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            overflow-y: auto;
            overflow-x: hidden;
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }

        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
        }

        .sidebar.collapsed {
            margin-left: calc(-1 * var(--sidebar-width));
        }

        [dir="rtl"] .sidebar {
            border-right: none;
            border-left: 1px solid rgba(255, 255, 255, 0.05);
        }

        [dir="rtl"] .sidebar.collapsed {
            margin-left: 0;
            margin-right: calc(-1 * var(--sidebar-width));
        }

        /* Sidebar Brand */
        .sidebar-brand {
            padding: 20px 20px 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-brand .brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: #fff;
            flex-shrink: 0;
        }

        .sidebar-brand .brand-text {
            color: #fff;
            font-size: 17px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .sidebar-brand .brand-sub {
            color: var(--sidebar-text);
            font-size: 11px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Sidebar Section Label */
        .sidebar-label {
            padding: 18px 20px 8px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: rgba(255, 255, 255, 0.25);
        }

        /* Sidebar Nav */
        .sidebar .nav-link {
            color: var(--sidebar-text);
            padding: 10px 20px;
            border-radius: 10px;
            margin: 2px 12px;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.2s ease;
            position: relative;
            text-decoration: none;
        }

        .sidebar .nav-link:hover {
            background: var(--sidebar-hover);
            color: var(--sidebar-text-active);
        }

        .sidebar .nav-link.active {
            background: var(--sidebar-active);
            color: var(--sidebar-text-active);
            font-weight: 600;
        }

        .sidebar .nav-link.active::before {
            content: '';
            position: absolute;
            left: -12px;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 60%;
            background: var(--sidebar-active-border);
            border-radius: 0 4px 4px 0;
        }

        [dir="rtl"] .sidebar .nav-link.active::before {
            left: auto;
            right: -12px;
            border-radius: 4px 0 0 4px;
        }

        .sidebar .nav-link .nav-icon {
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        /* Collapse Arrow */
        .sidebar .collapse-toggle::after {
            content: '\F282';
            font-family: 'bootstrap-icons';
            font-size: 12px;
            margin-left: auto;
            transition: transform 0.3s ease;
            color: rgba(255, 255, 255, 0.3);
        }

        [dir="rtl"] .sidebar .collapse-toggle::after {
            margin-left: 0;
            margin-right: auto;
        }

        .sidebar .collapse-toggle[aria-expanded="true"]::after {
            transform: rotate(180deg);
        }

        /* Sub Nav */
        .sidebar .sub-nav .nav-link {
            padding: 8px 20px 8px 54px;
            font-size: 13px;
            margin: 1px 12px;
        }

        [dir="rtl"] .sidebar .sub-nav .nav-link {
            padding: 8px 54px 8px 20px;
        }

        .sidebar .sub-nav .nav-link::before {
            display: none;
        }

        .sidebar .sub-nav .nav-link.active {
            background: var(--sidebar-active);
        }

        .sidebar .sub-nav .nav-link.active::before {
            display: block;
            left: -12px;
        }

        [dir="rtl"] .sidebar .sub-nav .nav-link.active::before {
            left: auto;
            right: -12px;
        }

        /* Badge in Sidebar */
        .sidebar-badge {
            font-size: 10px;
            padding: 3px 7px;
            border-radius: 6px;
            margin-left: auto;
            font-weight: 700;
        }

        [dir="rtl"] .sidebar-badge {
            margin-left: 0;
            margin-right: auto;
        }

        /* ═══════════════ CONTENT ═══════════════ */
        .content {
            width: calc(100% - var(--sidebar-width));
            margin-left: var(--sidebar-width);
            margin-top: var(--topbar-height);
            min-height: calc(100vh - var(--topbar-height));
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 24px;
        }

        [dir="rtl"] .content {
            margin-left: 0;
            margin-right: var(--sidebar-width);
        }

        .sidebar.collapsed~.content {
            margin-left: 0;
            width: 100%;
        }

        [dir="rtl"] .sidebar.collapsed~.content {
            margin-right: 0;
        }

        /* ═══════════════ TOPBAR ═══════════════ */
        .topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: var(--topbar-height);
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            padding: 0 24px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            box-shadow: var(--topbar-shadow);
            z-index: 1040;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        [dir="rtl"] .topbar {
            left: 0;
            right: var(--sidebar-width);
        }

        .sidebar.collapsed~.content .topbar {
            left: 0;
        }

        [dir="rtl"] .sidebar.collapsed~.content .topbar {
            right: 0;
        }

        .topbar .toggle-btn {
            width: 40px;
            height: 40px;
            border: none;
            background: #f0f2f5;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: #374151;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .topbar .toggle-btn:hover {
            background: #e5e7eb;
            color: #111;
        }

        .topbar .page-title {
            font-size: 18px;
            font-weight: 700;
            color: #111827;
            margin: 0;
        }

        /* Topbar Right Section */
        .topbar-right {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .topbar-icon-btn {
            width: 40px;
            height: 40px;
            border: none;
            background: transparent;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: #6b7280;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
            text-decoration: none;
        }

        .topbar-icon-btn:hover {
            background: #f3f4f6;
            color: #111827;
        }

        .topbar-icon-btn .badge-dot {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #ef4444;
            border: 2px solid #fff;
        }

        .topbar-icon-btn .badge-count {
            position: absolute;
            top: 4px;
            right: 2px;
            min-width: 18px;
            height: 18px;
            font-size: 10px;
            font-weight: 700;
            background: #ef4444;
            color: #fff;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 4px;
            border: 2px solid #fff;
        }

        .topbar-divider {
            width: 1px;
            height: 28px;
            background: #e5e7eb;
            margin: 0 4px;
        }

        /* Admin avatar + dropdown */
        .admin-profile-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 12px 6px 6px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            background: #fff;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            color: inherit;
        }

        .admin-profile-btn:hover {
            background: #f9fafb;
            border-color: #d1d5db;
        }

        .admin-avatar {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 14px;
            flex-shrink: 0;
        }

        .admin-info .admin-name {
            font-size: 13px;
            font-weight: 600;
            color: #111827;
            line-height: 1.2;
        }

        .admin-info .admin-role {
            font-size: 11px;
            color: #9ca3af;
            line-height: 1.2;
        }

        /* ═══════════════ OVERLAY ═══════════════ */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1045;
            display: none;
            backdrop-filter: blur(4px);
        }

        .overlay.active {
            display: block;
        }

        /* ═══════════════ SIDEBAR LOGOUT ═══════════════ */
        .sidebar-footer {
            padding: 16px;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
            margin-top: auto;
        }

        .sidebar-footer .btn-logout {
            width: 100%;
            padding: 10px;
            border: 1px solid rgba(239, 68, 68, 0.3);
            background: rgba(239, 68, 68, 0.1);
            color: #fca5a5;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .sidebar-footer .btn-logout:hover {
            background: rgba(239, 68, 68, 0.2);
            color: #fff;
            border-color: rgba(239, 68, 68, 0.5);
        }

        /* ═══════════════ ICON ANIMATION ═══════════════ */
        #toggleIcon {
            transition: transform 0.35s ease;
        }

        #toggleIcon.rotate {
            transform: rotate(180deg);
        }

        /* ═══════════════ MOBILE ═══════════════ */
        @media (max-width: 992px) {
            .sidebar {
                margin-left: calc(-1 * var(--sidebar-width));
            }

            [dir="rtl"] .sidebar {
                margin-right: calc(-1 * var(--sidebar-width));
                margin-left: 0;
            }

            .sidebar.mobile-show {
                margin-left: 0;
            }

            [dir="rtl"] .sidebar.mobile-show {
                margin-right: 0;
            }

            .content {
                width: 100% !important;
                margin-left: 0 !important;
                margin-right: 0 !important;
                padding: 16px;
            }

            .topbar {
                left: 0 !important;
                right: 0 !important;
                padding: 0 16px;
            }

            .admin-info {
                display: none;
            }

            .admin-profile-btn {
                padding: 6px;
            }

            .page-title {
                font-size: 15px !important;
            }
        }

        /* ═══════════════ DROPDOWN MENU STYLE ═══════════════ */
        .dropdown-menu {
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
            padding: 8px;
        }

        .dropdown-menu .dropdown-item {
            border-radius: 8px;
            padding: 8px 14px;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .dropdown-menu .dropdown-item:hover {
            background: #f3f4f6;
        }

        .dropdown-menu .dropdown-divider {
            margin: 4px 0;
        }

        /* Sidebar nav display as flex column full height */
        .sidebar-inner {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            padding: 8px 0;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <div class="sidebar-inner">

            {{-- Brand --}}
            <div class="sidebar-brand">
                <a href="{{ route('home') }}" class="brand-icon text-decoration-none">
                    <i class="fas fa-book-open"></i>
                </a>
                <div>
                    <div class="brand-text">{{ __('dashboard.admin_panel') }}</div>
                    <div class="brand-sub">{{ __('dashboard.management') }}</div>
                </div>
            </div>

            {{-- Navigation --}}
            <div class="sidebar-nav">

                {{-- Main Section --}}
                <div class="sidebar-label">{{ __('dashboard.main_menu') }}</div>

                <ul class="nav flex-column">
                    {{-- Dashboard --}}
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <span class="nav-icon"><i class="bi bi-grid-1x2-fill"></i></span>
                            {{ __('message.dashboard') }}
                        </a>
                    </li>

                    {{-- Books (Collapsible) --}}
                    <li>
                        <a class="nav-link collapse-toggle"
                            data-bs-toggle="collapse"
                            href="#booksMenu"
                            role="button"
                            aria-expanded="{{ request()->routeIs('admin.books.*') ? 'true' : 'false' }}"
                            aria-controls="booksMenu">
                            <span class="nav-icon"><i class="bi bi-journal-richtext"></i></span>
                            {{ __('dashboard.manage_books') }}
                        </a>
                        <div class="collapse {{ request()->routeIs('admin.books.*') ? 'show' : '' }}" id="booksMenu">
                            <ul class="nav flex-column sub-nav">
                                <li>
                                    <a href="{{ route('admin.books.index') }}"
                                        class="nav-link {{ request()->routeIs('admin.books.index') ? 'active' : '' }}">
                                        <span class="nav-icon"><i class="bi bi-collection"></i></span>
                                        {{ __('dashboard.total_books') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.books.create') }}"
                                        class="nav-link {{ request()->routeIs('admin.books.create') ? 'active' : '' }}">
                                        <span class="nav-icon"><i class="bi bi-plus-circle"></i></span>
                                        {{ __('message.add_record') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    {{-- Users (Collapsible) --}}
                    <li>
                        <a class="nav-link collapse-toggle"
                            data-bs-toggle="collapse"
                            href="#usersMenu"
                            role="button"
                            aria-expanded="{{ request()->routeIs('admin.users.*') ? 'true' : 'false' }}"
                            aria-controls="usersMenu">
                            <span class="nav-icon"><i class="bi bi-people-fill"></i></span>
                            {{ __('dashboard.manage_users') }}
                        </a>
                        <div class="collapse {{ request()->routeIs('admin.users.*') ? 'show' : '' }}" id="usersMenu">
                            <ul class="nav flex-column sub-nav">
                                <li>
                                    <a href="{{ route('admin.users.index') }}"
                                        class="nav-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                                        <span class="nav-icon"><i class="bi bi-person-lines-fill"></i></span>
                                        {{ __('dashboard.all_users') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.users.create') }}"
                                        class="nav-link {{ request()->routeIs('admin.users.create*') ? 'active' : '' }}">
                                        <span class="nav-icon"><i class="bi bi-person-plus-fill"></i></span>
                                        {{ __('dashboard.add_user') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>

                {{-- Content Section --}}
                <div class="sidebar-label">{{ __('dashboard.content') }}</div>

                <ul class="nav flex-column">
                    {{-- Pending Books --}}
                    <li>
                        <a href="{{ route('admin.books.pending') }}"
                            class="nav-link {{ request()->routeIs('admin.books.pending') ? 'active' : '' }}">
                            <span class="nav-icon"><i class="bi bi-hourglass-split"></i></span>
                            {{ __('dashboard.pending_books') }}
                            @if(($notifications ?? 0) > 0)
                                <span class="sidebar-badge bg-warning text-dark">{{ $notifications }}</span>
                            @endif
                        </a>
                    </li>

                    {{-- Categories --}}
                    <li>
                        <a href="{{ route('admin.categories.index') }}"
                            class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                            <span class="nav-icon"><i class="bi bi-tags-fill"></i></span>
                            {{ __('message.categories') }}
                        </a>
                    </li>
                </ul>

                {{-- System Section --}}
                <div class="sidebar-label">{{ __('dashboard.system') }}</div>

                <ul class="nav flex-column">
                  

                    {{-- Settings --}}
                    <li>
                        <a href="{{ route('admin.settings.edit') }}"
                            class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                            <span class="nav-icon"><i class="bi bi-gear-fill"></i></span>
                            {{ __('dashboard.setting') }}
                        </a>
                    </li>

                    {{-- Messages --}}
                    <li>
                        <a href="{{ route('admin.contact.message') }}"
                            class="nav-link {{ request()->routeIs('admin.message.*') ? 'active' : '' }}">
                            <span class="nav-icon"><i class="bi bi-chat-dots-fill"></i></span>
                            {{ __('dashboard.message') }}
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Sidebar Footer --}}
            <div class="sidebar-footer">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="bi bi-box-arrow-right"></i>
                        {{ __('message.logout') }}
                    </button>
                </form>
            </div>

        </div>
    </div>

    <!-- Overlay -->
    <div id="overlay" class="overlay"></div>

    <!-- Content -->
    <div class="content">

        <!-- Topbar -->
        <div class="topbar">

            {{-- Left side --}}
            <div class="d-flex align-items-center gap-3">
                <button id="toggleBtn" class="toggle-btn" aria-label="{{ __('dashboard.toggle_sidebar') }}">
                    <i id="toggleIcon" class="bi bi-list"></i>
                </button>
                <h1 class="page-title">
                    {{ __('message.admin_dashboard') }}
                </h1>
            </div>

            {{-- Right side --}}
            <div class="topbar-right">

                {{-- New Users --}}
                <a href="{{ route('admin.users.index') }}"
                    class="topbar-icon-btn"
                    title="{{ __('dashboard.new_users') }}">
                    <i class="bi bi-person-fill"></i>
                    @if(($newUser ?? 0) > 0)
                        <span class="badge-count">{{ $newUser }}</span>
                    @endif
                </a>

                {{-- Pending Notifications --}}
                <a href="{{ route('admin.books.pending') }}"
                    class="topbar-icon-btn"
                    title="{{ __('dashboard.pending_books') }}">
                    <i class="bi bi-bell-fill"></i>
                    @if(($notifications ?? 0) > 0)
                        <span class="badge-count">{{ $notifications }}</span>
                    @endif
                </a>

                <div class="topbar-divider"></div>

                {{-- Admin Profile Dropdown --}}
                <div class="dropdown">
                    <button class="admin-profile-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <div class="admin-avatar">
                            {{ strtoupper(substr(auth()->user()->getUsername(), 0, 1)) }}
                        </div>
                        <div class="admin-info">
                            <div class="admin-name">{{ auth()->user()->getUsername() }}</div>
                            <div class="admin-role">{{ __('dashboard.administrator') }}</div>
                        </div>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.profile.edit') }}">
                                <i class="bi bi-person-circle"></i>
                                {{ __('dashboard.profile') }}
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.settings.edit') }}">
                                <i class="bi bi-gear"></i>
                                {{ __('dashboard.setting') }}
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right"></i>
                                    {{ __('message.logout') }}
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <!-- Page Content -->
        @yield('content')

    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src='{{ asset('bootstrap.bundle.js') }}'></script>
    <script>
        const toggleBtn = document.getElementById('toggleBtn');
        const sidebar = document.getElementById('sidebar');
        const icon = document.getElementById('toggleIcon');
        const overlay = document.getElementById('overlay');

        toggleBtn.addEventListener('click', () => {
            if (window.innerWidth <= 992) {
                sidebar.classList.toggle('mobile-show');
                overlay.classList.toggle('active');
            } else {
                sidebar.classList.toggle('collapsed');
            }
            icon.classList.toggle('rotate');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('mobile-show');
            overlay.classList.remove('active');
            icon.classList.remove('rotate');
        });

        // Close mobile sidebar on window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth > 992) {
                sidebar.classList.remove('mobile-show');
                overlay.classList.remove('active');
            }
        });
    </script>

    @yield('scripts')
</body>

</html>