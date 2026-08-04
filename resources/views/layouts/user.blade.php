<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"  dir="{{ in_array(app()->getLocale(), ['ps']) ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
      <link rel="stylesheet" href="{{ asset('bootstrap.css') }}">
      <link rel="stylesheet" href="{{ asset('all.css') }}">
      <link rel="stylesheet" href="{{ asset('style.css') }}">
    <style>
           /* ═════════════════════════════════════════
           SIDEBAR
        ═════════════════════════════════════════ */
        .app-sidebar {
            position: fixed;
            top: 0;
            {{ in_array(app()->getLocale(), ['ps']) ? 'right' : 'left' }}: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            color: #fff;
            z-index: 1050;
            transition: transform 0.3s ease;
            overflow-y: auto;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }
        
        .sidebar-nav-item:hover {
            background: rgba(255,255,255,0.06);
            color: #fff;
            transform: translateX({{ in_array(app()->getLocale(), ['ps','dr','fa','ar']) ? '-' : '' }}4px);
        }
       
        /* Collapsible Sub-menu */
        .sidebar-submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            padding-{{ in_array(app()->getLocale(), ['ps','dr','fa','ar']) ? 'right' : 'left' }}: 20px;
        }
       
        .arrow-icon {
            margin-{{ in_array(app()->getLocale(), ['ps','dr','fa','ar']) ? 'right' : 'left' }}: auto;
            font-size: 11px !important;
            transition: transform 0.3s ease;
        }
        .sidebar-nav-item.open .arrow-icon {
            transform: rotate(180deg);
        }

       
        /* ═════════════════════════════════════════
           MAIN CONTENT
        ═════════════════════════════════════════ */
        .app-main {
            margin-{{ in_array(app()->getLocale(), ['ps','dr','fa','ar']) ? 'right' : 'left' }}: var(--sidebar-width);
            min-height: 100vh;
            transition: margin 0.3s ease;
        }

       
        .topbar-search i {
            position: absolute;
            top: 50%;
            {{ in_array(app()->getLocale(), ['ps','dr','fa','ar']) ? 'left' : 'right' }}: 14px;
            transform: translateY(-50%);
            color: #94a3b8;
        }


        /* ═════════════════════════════════════════
           MOBILE RESPONSIVE
        ═════════════════════════════════════════ */
        @media (max-width: 991px) {
            .app-sidebar {
                transform: translateX({{ in_array(app()->getLocale(), ['ps','dr','fa','ar']) ? '100%' : '-100%' }});
            }
            .app-sidebar.show {
                transform: translateX(0);
            }
            .app-main {
                margin-{{ in_array(app()->getLocale(), ['ps','dr','fa','ar']) ? 'right' : 'left' }}: 0;
            }
            .topbar-toggle {
                display: block;
            }
        }
        .sidebar-nav-item:hover {
            background: rgba(255,255,255,0.06);
            color: #fff;
            transform: translateX({{ in_array(app()->getLocale(), ['ps','dr','fa','ar']) ? '-' : '' }}4px);
        }
       
        /* Collapsible Sub-menu */
        .sidebar-submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            padding-{{ in_array(app()->getLocale(), ['ps','dr','fa','ar']) ? 'right' : 'left' }}: 20px;
        }
       
        .arrow-icon {
            margin-{{ in_array(app()->getLocale(), ['ps','dr','fa','ar']) ? 'right' : 'left' }}: auto;
            font-size: 11px !important;
            transition: transform 0.3s ease;
        }
        .sidebar-nav-item.open .arrow-icon {
            transform: rotate(180deg);
        }

       
        /* ═════════════════════════════════════════
           MAIN CONTENT
        ═════════════════════════════════════════ */
        .app-main {
            margin-{{ in_array(app()->getLocale(), ['ps','dr','fa','ar']) ? 'right' : 'left' }}: var(--sidebar-width);
            min-height: 100vh;
            transition: margin 0.3s ease;
        }

       
        .topbar-search i {
            position: absolute;
            top: 50%;
            {{ in_array(app()->getLocale(), ['ps','dr','fa','ar']) ? 'left' : 'right' }}: 14px;
            transform: translateY(-50%);
            color: #94a3b8;
        }

     

        /* ═════════════════════════════════════════
           MOBILE RESPONSIVE
        ═════════════════════════════════════════ */
        @media (max-width: 991px) {
            .app-sidebar {
                transform: translateX({{ in_array(app()->getLocale(), ['ps','dr','fa','ar']) ? '100%' : '-100%' }});
            }
            .app-sidebar.show {
                transform: translateX(0);
            }
            .app-main {
                margin-{{ in_array(app()->getLocale(), ['ps','dr','fa','ar']) ? 'right' : 'left' }}: 0;
            }
            .topbar-toggle {
                display: block;
            }
        }

    </style>
      @yield('styles')
</head>
<body>

    <!-- ═══════════════════════════════════════════
         SIDEBAR
    ═══════════════════════════════════════════ -->
    <aside class="app-sidebar" id="appSidebar">

        <!-- Header -->
        <div class="sidebar-header">
             <a href="{{ route('home') }}">
                 <div class="sidebar-logo">
                    @php
                        use Illuminate\Support\Str;
                    @endphp

                    {{ Str::substr(config('app.name'), 0, 1) }}
                
                </div>
             </a>
            <div class="sidebar-brand">
                
                {{ config('app.name','Ketabtoon') }}
                <small>{{ __('dashboard.user_panel') }}</small>
            </div>
        </div>

        <!-- User Card -->
        <div class="sidebar-user">
           
                <div class="sidebar-user-avatar">
                    {{ strtoupper(substr(auth()->user()->getUsername() ?? 'U', 0, 2)) }}
                </div>
           
            <div class="sidebar-user-info">
                <div class="sidebar-user-name">
                    {{ auth()->user()->getUsername() }}
                </div>
                <div class="sidebar-user-role">
                    <i class="bi bi-circle-fill text-success" style="font-size:6px;"></i>
                    {{ __('dashboard.online') }}
                </div>
            </div>
        </div>
        
        <!-- MAIN Navigation -->
        <div class="sidebar-label">{{ __('dashboard.main') }}</div>
        <nav class="sidebar-nav">
            
            <a href="{{ route('user.dashboard') ?? '#' }}"
               class="sidebar-nav-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>{{ __('dashboard.dashboard') }}</span>
            </a>

            <!-- Books Collapsible Menu -->
            <div class="sidebar-nav-item" onclick="toggleSubmenu(this)">
                <i class="bi bi-book-half"></i>
                <span>{{ __('dashboard.books') }}</span>
                <i class="bi bi-chevron-down arrow-icon"></i>
            </div>

            <div class="sidebar-submenu">
                <a href="{{ route('user.books.create') }}" class="sidebar-nav-item">
                    <i class="bi bi-plus-circle"></i>
                    <span>{{ __('dashboard.add_book') }}</span>
                </a>
                <a href="{{ URL('user/books') }}" class="sidebar-nav-item">
                    <i class="bi bi-list-check"></i>
                    <span>{{ __('dashboard.manage_books') }}</span>
                </a>
                <a href="{{ route('user.mybook') }}" class="sidebar-nav-item">
                    <i class="bi bi-journal-bookmark"></i>
                    <span>{{ __('dashboard.my_books') }}</span>
                </a>
            </div>

            <a href="{{ route('favorites.index') }}"
               class="sidebar-nav-item {{ request()->routeIs('favorites.*') ? 'active' : '' }}">
                <i class="bi bi-heart-fill text-danger"></i>
                <span>{{ __('dashboard.favorites') }}</span>
            </a>

            <a href="{{ route('user.downloads.index') }}"
               class="sidebar-nav-item {{ request()->routeIs('user.downloads.*') ? 'active' : '' }}">
                <i class="bi bi-download text-success"></i>
                <span>{{ __('dashboard.downloads') }}</span>
            </a>

        </nav>

        <!-- ACCOUNT Section -->
        <div class="sidebar-label">{{ __('dashboard.account') }}</div>
        <nav class="sidebar-nav">
            <a href="{{ route('profile.edit') }}" class="sidebar-nav-item">
                <i class="bi bi-person-circle"></i>
                <span>{{ __('dashboard.profile') }}</span>
            </a>
        
        </nav>

        <!-- Share Button -->
        <div class="sidebar-share" onclick="shareSite()">
            <i class="bi bi-share-fill"></i>
            <h6>{{ __('dashboard.share_site') }}</h6>
            <small>{{ __('dashboard.share_hint') }}</small>
        </div>
        
         <nav class="sidebar-nav ">
            <a href="{{ route('logout') }}" class="sidebar-nav-item bg-danger">
                <i class="bi bi-person-circle"></i>
                <span>{{ __('message.logout') }}</span>
            </a>
        
        </nav>

    </aside>

    <!-- Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <!-- ═══════════════════════════════════════════
         MAIN CONTENT
    ═══════════════════════════════════════════ -->
    <main class="app-main">

        <!-- Top Bar -->
        <div class="app-topbar">
            <button class="topbar-toggle" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>
         
            
            <div class="topbar-search">
                <input type="text" placeholder="{{ __('dashboard.search_placeholder') }}">
                <i class="bi bi-search"></i>
            </div>

            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-light rounded-circle position-relative" style="width:40px;height:40px;">
                    <i class="bi bi-bell"></i>
                    @php
                         $books=App\Models\Book::all();
                    @endphp
                      <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:9px;">
                         
                                   {{ App\Models\Book::where('status','rejected')->count() }}
                         

                      </span>
                  
                </button>
            </div>
        </div>

        <!-- Page Content -->
        @yield('content')

    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('app.js') }}"></script>
     @yield('scripts')
</body>
</html>