<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ in_array(app()->getLocale(), ['ps','fa']) ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <title>Admin - @yield('title')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

     <link rel="stylesheet" href="{{ asset('bootstrap.css') }}">
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            overflow-x: hidden;
            background: #f4f6f9;
        }

        .sidebar {
            width: 250px;
            background: #212529;
            transition: all 0.3s;
        }

        .sidebar.collapsed {
            margin-left: -250px;
        }

        .sidebar .nav-link {
            color: #adb5bd;
            padding: 10px;
            border-radius: 6px;
        }

        .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.1);
            color: #fff;
        }

        .sidebar .nav-link.active {
            background: #0d6efd;
            color: #fff;
        }

        .content {
            width: 100%;
        }

        .topbar {
            background: #fff;
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>

<body class="d-flex">


<!-- Sidebar -->
<div id="sidebar" class="sidebar text-white min-vh-100 p-3">

    <h4 class="text-center mb-4">📚 Admin</h4>

    <ul class="nav flex-column">

        <!-- Dashboard -->
        <li>
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
               <i class="bi bi-speedometer2 me-2"></i> {{ __('message.dashboard') }}
            </a>
        </li>

        <!-- Books -->
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
        <!-- Users Menu -->
          <li class="nav-item mb-2">
             <a class="nav-link text-white" data-bs-toggle="collapse" href="#usersMenu" role="button" aria-expanded="{{ request()->routeIs('admin.users.*') ? 'true' : 'false' }}"> <i class="bi bi-people me-1"></i> {{ __('dashboard.manage_users') }} </a> <div class="collapse {{ request()->routeIs('admin.users.*') ? 'show' : '' }}" id="usersMenu"> <ul class="nav flex-column ms-3"> <li class="nav-item">
             <a href="{{ route('admin.users.index') }}" class="nav-link text-white {{ request()->routeIs('admin.users.index') ? 'active' : '' }}"> {{ __('dashboard.all_users')}} </a> </li> <li class="nav-item"> <a href="{{ route('admin.users.create') }}" class="nav-link text-white {{ request()->routeIs('admin.users.create*')}} ? 'active' : '' }}"> {{ __('dashboard.add_user') }} </a> </li> </ul> </div> </li>

        <!-- Pending Books -->
        <li>
            <a href="{{ route('admin.books.pending') }}"
               class="nav-link {{ request()->routeIs('admin.books.pending') ? 'active' : '' }}">
               <i class="bi bi-hourglass-split me-2"></i>
               {{ __('dashboard.pending_books') }}
            </a>
        </li>

        <!-- Categories -->
        <li>
            <a href="{{ route('admin.categories.index') }}"
               class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
               <i class="bi bi-tags me-2"></i>
               {{ __('message.categories') }}
            </a>
        </li>

        <!-- Reports -->
        <li>
            <a href="{{ route('admin.reports.index') }}"
               class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
               <i class="bi bi-bar-chart-line me-2"></i>
               {{ __('dashboard.report') }}
            </a>
        </li>

        <!-- Logout -->
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
<div class="content">

    <!-- Topbar -->
    <div class="topbar d-flex justify-content-between align-items-center">

        <!-- Toggle -->
        <button id="toggleBtn" class="btn btn-outline-primary">
            <i class="bi bi-list"></i>
        </button>

        <!-- User -->
        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown">
                <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
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

    <!-- Page Content -->
    <div class="p-4">
        @yield('content')
    </div>

</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const toggleBtn = document.getElementById('toggleBtn');
    const sidebar = document.getElementById('sidebar');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
    });
</script>

</body>
</html>