 
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ in_array(app()->getLocale(), ['ps','fa']) ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <title>Admin - @yield('title')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('all.css') }}">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
            overflow: hidden;
        }

        /* SIDEBAR */
        .sidebar {
            width: 230px;
            background: #212529;
            position: fixed;
            top: 0;
            bottom: 0;
            transition: all 0.3s ease-in-out;
        }

        .sidebar.collapsed {
            margin-left: -250px;
        }

        [dir="rtl"] .sidebar.collapsed {
            margin-right: -230px;
        }

        /* CONTENT */
        .content {
            width: 100%;
            margin-left: 250px;
            margin-top: 60px;
            height: calc(100vh - 60px);
            overflow-y: auto;
            transition: all 0.3s ease-in-out;
        }

        [dir="rtl"] .content {
            margin-left: 0;
            margin-right: 230px;
        }

        /* TOPBAR */
        .topbar {
            position: fixed;
            top: 0;
            left: 250px;
            right: 0;
            height: 60px;
            background: #fff;
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
            z-index: 1000;
            transition: all 0.3s ease-in-out;
        }

        [dir="rtl"] .topbar {
            left: 0;
            right: 250px;
        }

        /* COLLAPSE EFFECT */
        .sidebar.collapsed ~ .content {
            margin-left: 0;
        }

        [dir="rtl"] .sidebar.collapsed ~ .content {
            margin-right: 0;
        }

        .sidebar.collapsed ~ .content .topbar {
            left: 0;
        }

        [dir="rtl"] .sidebar.collapsed ~ .content .topbar {
            right: 0;
        }

        /* ICON ANIMATION */
        #toggleIcon {
            transition: transform 0.3s ease;
        }

        #toggleIcon.rotate {
            transform: rotate(180deg);
        }
        /* OVERLAY (mobile background) */
.overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    z-index: 999;
    display: none;
}

/* SHOW overlay */
.overlay.active {
    display: block;
}

/* MOBILE MODE */
@media (max-width: 992px) {

    .sidebar {
        margin-left: -250px;
        z-index: 1000;
    }
    .admin_d{
        visibility:hidden;
    }

    [dir="rtl"] .sidebar {
        margin-right: -250px;
    }

    /* Show sidebar */
    .sidebar.mobile-show {
        margin-left: 0;
    }

    [dir="rtl"] .sidebar.mobile-show {
        margin-right: 0;
    }

    /* Content full width */
    .content {
        margin-left: 0 !important;
        margin-right: 0 !important;
    }

    .topbar {
        left: 0 !important;
        right: 0 !important;
    }
}
    </style>
</head>

<body class="d-flex">

<!-- Sidebar -->
<div id="sidebar" class="sidebar text-white p-3">
    <h4 class="text-center mb-4">📚 {{ __('message.admin') }}</h4>

    <ul class="nav flex-column">
        <li>
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i> {{ __('message.dashboard') }}
            </a>
        </li>
        <li>
            <a class="nav-link" data-bs-toggle="collapse" href="#booksMenu">
                <i class="bi bi-book me-2"></i> {{ __('dashboard.manage_books') }}
            </a>
            <div class="collapse {{ request()->routeIs('admin.books.*') ? 'show' : '' }}" id="booksMenu">
                <ul class="nav flex-column ms-3">
                    <li>
                        <a href="{{ route('admin.books.index') }}"
                           class="nav-link {{ request()->routeIs('admin.books.index') ? 'active' : '' }}">
                            {{ __('dashboard.total_books') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.books.create') }}"
                           class="nav-link {{ request()->routeIs('admin.books.create') ? 'active' : '' }}">
                            {{ __('message.add_record') }}
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- USERS -->
        <li class="mb-2">
            <a class="nav-link text-white" data-bs-toggle="collapse" href="#usersMenu">
                <i class="bi bi-people me-1"></i> {{ __('dashboard.manage_users') }}
            </a>

            <div class="collapse {{ request()->routeIs('admin.users.*') ? 'show' : '' }}" id="usersMenu">
                <ul class="nav flex-column ms-3">
                    <li>
                        <a href="{{ route('admin.users.index') }}"
                           class="nav-link text-white {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                            {{ __('dashboard.all_users') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.create') }}"
                           class="nav-link text-white {{ request()->routeIs('admin.users.create*') ? 'active' : '' }}">
                            {{ __('dashboard.add_user') }}
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li>
            <a href="{{ route('admin.books.pending') }}"
               class="nav-link {{ request()->routeIs('admin.books.pending') ? 'active' : '' }}">
                <i class="bi bi-hourglass-split me-2"></i>
                {{ __('dashboard.pending_books') }}
            </a>
        </li>

        <li>
            <a href="{{ route('admin.categories.index') }}"
               class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="bi bi-tags me-2"></i>
                {{ __('message.categories') }}
            </a>
        </li>

        <li>
            <a href="{{ route('admin.reports.index') }}"
               class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                <i class="bi bi-bar-chart-line me-2"></i>
                {{ __('dashboard.report') }}
            </a>
        </li>

        <li class="mt-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-danger w-100">
                    <i class="bi bi-box-arrow-right me-1"></i>
                    {{ __('message.logout') }}
                </button>
            </form>
        </li>

    </ul>
</div>


<!-- Content -->
<div id="overlay" class="overlay"></div>
<div class="content">

    <!-- Topbar -->
    <div class="topbar d-flex justify-content-between align-items-center">

        <div class="d-flex align-items-center gap-2">
            <button id="toggleBtn" class="btn btn-outline-primary">
                <i id="toggleIcon" class="fas fa-bars"></i>
            </button>

            <a href="{{ route('home') }}" class="btn btn-light">
                <i class="fas fa-home"></i>
            </a>

            <h1 class="h5 mb-0 ms-2">
                {{ __('message.admin_dashboard') }}
            </h1>
        </div>
        
        <div class="d-flex align-items-center " id="admin_d">
            <div class="d-flex align-items-center">
             <span> <i class="fas fa-user"></i><sup >
             <a href="{{ route('admin.users.index') }}" class="text-white badge bg-danger text-decoration-none">
                 {{ ($newUser ?? '0' ) ? $newUser ?? '0' :'0'}}</a>
            </span>
           </sup>
    <span><i class="fas fa-bell ms-2"></i>    </span><small> <sup style="cursor: pointer" class="py-1 badge bg-danger">
        <a href="{{ route('admin.books.pending') }}"
         class="text-white text-decoration-none" title="Pending books" >
            {{ ($notifications ?? 0)? $notifications?? 0:'No pending book'}}</a>
        </sup></small>
            </div>
         

            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle ms-2" data-bs-toggle="dropdown">
                  {{ auth()->user()->getUsername() }}
                </button>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <!-- Page Content -->
   
        @yield('content')
    </div>

</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    });
</script>

</body>
</html>