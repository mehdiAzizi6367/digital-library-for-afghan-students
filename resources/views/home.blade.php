<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ in_array(app()->getLocale(), ['ps']) ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('message.site_title') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="{{ asset('all.css') }}">



</head>

<body>

    {{-- ─── Navbar ─────────────────────────────────────────── --}}
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm sticky-top">
        <div class="container">

            <a class="navbar-brand fw-bold d-flex align-items-center" href="/">
                <img src="{{ asset('uploads/'.$setting->logo) }}" width="45" height="45" class="me-2">
            </a>

            <button class="navbar-toggler border-0" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                @foreach ($users as $user)
                    @php global $user; @endphp
                @endforeach

                <ul class="navbar-nav mx-auto fw-bold gap-1">

                    <li class="nav-item">
                        <a class="nav-link text-white" href="/">
                            <i class="fas fa-home me-1"></i>
                            {{ __('message.home') }}
                        </a>
                    </li>

                    @auth
                        @if(auth()->user()->role == 'admin' || auth()->user()->role == 'user' && $user->is_active)
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ url('allbooks') }}">
                                    <i class="bi bi-book me-1"></i>
                                    {{ __('message.books') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#cateSection">
                                    <i class="fas fa-tags me-1"></i>
                                    {{ __('message.categories') }}
                                </a>
                            </li>
                        @endif
                    @endauth

                    <li class="nav-item">
                        <a class="nav-link text-white" href="#aboutSection">
                            <i class="fas fa-info-circle me-1"></i>
                            {{ __('message.about') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="#contact">
                            <i class="fas fa-phone me-1"></i>
                            {{ __('message.contact') }}
                        </a>
                    </li>

                </ul>

                <div class="d-flex align-items-center gap-2">

                    @guest
                        <a href="{{ route('login') }}" class="btn btn-light btn-sm">
                            {{ __('message.login') }}
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-warning btn-sm">
                            {{ __('message.register') }}
                        </a>
                    @endguest

                    @auth
                        @php
                            $dashboardRoute = auth()->user()->role == 'admin' ? 'admin.dashboard' : 'user.dashboard';
                        @endphp
                        <a href="{{ route($dashboardRoute) }}" class="btn btn-light btn-sm">
                            {{ __('message.dashboard') }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button class="btn btn-warning btn-sm">
                                {{ __('message.logout') }}
                            </button>
                        </form>
                    @endauth

                    <x-translator></x-translator>

                </div>

            </div>
        </div>
    </nav>

    {{-- ─── Hero Section ───────────────────────────────────── --}}
    <section class="hero-section text-white text-center d-flex align-items-center py-5">
        <div class="container position-relative" style="z-index:2;">

            <div class="mb-3">
                <span class="badge px-3 py-2 rounded-pill fw-semibold"
                      style="background:rgba(255,255,255,0.15); font-size:0.85rem; letter-spacing:1px;">
                    📚 {{ app()->getLocale() =='en'?'Afghan Digital Library': 'ډیجیټل کتابتون' }}
                </span>
            </div>

            <h2 class="display-5 fw-bold mb-3">
                {{ ($setting->{'hero_title_'.app()->getLocale()}) }}
            </h2>

            <p class="lead mb-4">
                {{ ($setting->{'hero_description_'.app()->getLocale()}) }}
            </p>

            @auth
                <a href="{{ route('allbooks') }}"
                   class="btn btn-warning btn-lg px-5 py-3 fw-bold shadow-lg"
                   style="border-radius:14px;">
                    <i class="bi bi-book me-2"></i>
                    {{ __('message.browse_books') }}
                </a>
            @endauth

        </div>
    </section>

    {{-- ─── Search Section ─────────────────────────────────── --}}

    <div class="container">
        <div class="search-wrapper">
            <p class="text-center text-muted small fw-semibold mb-3 text-uppercase letter-spacing-1">
                🔍 {{ __('message.search_placeholder') }}
            </p>
            <form action="/search" method="GET" id="searchForm">
                <div class="col-md-7 position-relative mx-auto">
                    <div class="input-group shadow-sm">
                        <input
                            type="text"
                            id="searchInput"
                            name="query"
                            class="form-control"
                            placeholder="{{ __('message.search_placeholder') }}">
                        <button class="btn btn-primary search-btn">
                            <i class="bi bi-search me-1"></i>
                            {{ __('message.search') }}
                        </button>
                    </div>
                    <div id="searchResults" class="search-dropdown"></div>
                </div>
            </form>
        </div>
    </div>


    {{-- ─── Categories Section ─────────────────────────────── --}}

<section class="categories-modern-section py-5" id="cateSection">
    <div class="container position-relative">

        <div class="text-center mb-5" data-aos="fade-up">
            <h3 class="section-title">{{ __('message.browse_categories') }}</h3>
        </div>

        <div class="row g-4">
            @foreach($categories as $category)
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 100 }}">
                <a href="{{ route('categories.show', $category->id) }}" class="category-modern-link">
                    <div class="card shadow-sm text-center p-4 h-100 category-modern-card">

                        <div class="category-arrow">
                            <i class="bi bi-arrow-up-right"></i>
                        </div>

                        <div class="category-icon-wrap">
                            <i class="bi bi-book"></i>
                        </div>

                        <h5 class="category-modern-title">
                            {{ $category->getname() }}
                        </h5>

                        <div class="category-count-badge">
                            <i class="bi bi-journal-bookmark"></i>
                                                    
                            <span>{{ $category->books_count ?? 0 }} {{ __('message.books') }}</span>
                        </div>

                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <div class="mt-2">
            {{$categories->links()}}

        </div>

    </div>
</section>

    {{-- ─── Latest Books ────────────────────────────────────── --}}
  <section class="latest-books-section py-5">
     <div class="container position-relative">

        <div class="text-center mb-5" data-aos="fade-up">
            <h3 class="section-title">{{ __('message.latest_books') }}</h3>
        </div>

        <div class="row g-4">
            @foreach($books as $book)
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 100 }}">
                @if(auth()->guest())
                    <a href="{{ route('books.show', $book->id) }}" class="book-card-link">
                        <div class="card latest-book-card shadow-sm h-100">
                            <div class="book-cover-wrap">
                                <img src="{{ asset('/storage/'.$book->thumbnail) }}"
                                     class="card-img-top"
                                     alt="{{ $book->getTitleAttribute() }}">
                            </div>
                            <div class="card-body text-center d-flex flex-column">
                                <h5 class="card-title mb-2">
                                    {{ Str::limit($book->getTitleAttribute(), 12, '...') }}
                                </h5>
                                <p class="text-muted mb-3">{{ $book->author }}</p>
                                <span class="btn btn-view-modern w-100 mt-auto">
                                    {{ __('message.view') }}
                                </span>
                            </div>
                        </div>
                    </a>
                @else
                    <div class="card latest-book-card shadow-sm h-100">
                        <div class="book-cover-wrap">
                            <img src="{{ asset('/storage/'.$book->thumbnail) }}"
                                 class="card-img-top"
                                 alt="{{ $book->getTitleAttribute() }}">
                        </div>
                        <div class="card-body text-center d-flex flex-column">
                            <h5 class="card-title mb-2">
                                {{ Str::limit($book->getTitleAttribute(), 12, '...') }}
                            </h5>
                            <p class="text-muted mb-3">{{ $book->author }}</p>
                            <a href="{{ route('books.show', $book->id) }}"
                               class="btn btn-view-modern w-100 mt-auto">
                                {{ __('message.view') }}
                            </a>
                        </div>
                    </div>
                @endif
            </div>
            @endforeach
        </div>

    </div>
</section>
  

    {{-- ─── Contact Section ─────────────────────────────────── --}}
    <section id="contact" class="contact-section py-5">
        <div class="container">

            <div class="text-center mb-5">
                <h2 class="section-title">{{ __('message.contact') }}</h2>
                <p class="text-muted mt-3 mx-auto" style="max-width:540px;">
                    {{ __('message.message') }}
                </p>
            </div>

            <div class="row g-4">

                {{-- Contact Form --}}
                <div class="col-md-7">
                    <div class="card contact-card p-4">
                        <div class="contact-card-header-bar mb-4"
                             style="height:5px;background:linear-gradient(90deg,#1a237e,#ffd54f);border-radius:4px;"></div>
                        <h4 class="fw-bold mb-4" style="color:#1a237e;">
                            <i class="bi bi-envelope-paper me-2"></i>
                            {{ __('message.send_message') }}
                        </h4>
                        <form action="{{ route('contact') }}" method="POST">
                            @csrf
                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small text-muted text-uppercase">
                                        {{ __('message.name') }}
                                        <sup class="text-danger">*</sup>
                                    </label>
                                    <input type="text" class="form-control" name="name"
                                           placeholder="{{ __('message.name') }}"
                                           value="{{ old('name') }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small text-muted text-uppercase">
                                        {{ __('message.email') }}
                                        <sup class="text-danger">*</sup>
                                    </label>
                                    <input type="email" class="form-control" name="email"
                                           placeholder="{{ __('message.email') }}"
                                           value="{{ old('email') }}">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold small text-muted text-uppercase">
                                        {{ __('message.book_title') }}
                                        <sup class="text-danger">*</sup>
                                    </label>
                                    <input type="text" class="form-control" name="subject"
                                           placeholder="{{ __('message.book_title') }}"
                                           value="{{ old('subject') }}">
                                    @error('subject')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold small text-muted text-uppercase">
                                        {{ __('message.send_message') }}
                                        <sup class="text-danger">*</sup>
                                    </label>
                                    <textarea class="form-control" rows="5" name="message"
                                              placeholder="{{ __('message.send_message') }}"
                                              value="{{ old('message') }}"></textarea>
                                    @error('message')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary btn-submit w-100 text-white">
                                        <i class="bi bi-send me-2"></i>
                                        {{ __('message.send_message') }}
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

                {{-- Contact Info --}}
                <div class="col-md-5">
                    <div class="card contact-card p-4 h-100">
                        <div class="contact-card-header-bar mb-4"
                             style="height:5px;background:linear-gradient(90deg,#ffd54f,#1a237e);border-radius:4px;"></div>
                        <h4 class="fw-bold mb-4" style="color:#1a237e;">
                            <i class="bi bi-person-lines-fill me-2"></i>
                            {{ __('message.contact') }}
                        </h4>

                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="bi bi-envelope-fill"></i>
                            </div>
                            <div>
                                <small class="text-muted fw-semibold d-block">{{ __('message.email') }}</small>
                                <a href="mailto:samiaziziazizi6367@gmail.com"
                                   class="text-decoration-none fw-semibold"
                                   style="color:#3949ab;font-size:0.9rem;">
                                    samiaziziazizi6367@gmail.com
                                </a>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <div>
                                <small class="text-muted fw-semibold d-block">{{ __('message.mobile') }}</small>
                                <span class="fw-semibold" style="font-size:0.9rem;">+93 770216367</span>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <div>
                                <small class="text-muted fw-semibold d-block">{{ __('message.mobile') }}</small>
                                <span class="fw-semibold" style="font-size:0.9rem;">+93 731777395</span>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="bi bi-envelope-fill"></i>
                            </div>
                            <div>
                                <small class="text-muted fw-semibold d-block">{{ __('message.email') }}</small>
                                <a href="mailto:maaznaizi2001@gmail.com"
                                   class="text-decoration-none fw-semibold"
                                   style="color:#3949ab;font-size:0.9rem;">
                                    maaznaizi2001@gmail.com
                                </a>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <div>
                                <small class="text-muted fw-semibold d-block">{{ __('message.mobile') }}</small>
                                <span class="fw-semibold" style="font-size:0.9rem;">+93 784763743</span>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <div>
                                <small class="text-muted fw-semibold d-block">{{ __('message.address') }}</small>
                                <span class="fw-semibold" style="font-size:0.9rem;">
                                    Jalalabad, Nangarhar, Afghanistan
                                </span>
                            </div>
                        </div>

                        <div class="mt-3 p-3 rounded-3" style="background:#f0f2ff;">
                            <p class="text-muted mb-0 small">
                                <i class="bi bi-clock me-1" style="color:#3949ab;"></i>
                                Our team will respond to your message as soon as possible.
                            </p>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
      {{-- ─── About Section ──────────────────────────────────── --}}
    <section id="aboutSection" class="py-5">
        <div class="container">
            <div class="about-section">

                <div class="text-center mb-5">
                    <h2 class="section-title">{{ app()->getlocale() =='en'? 'About  Digital Library':'د ډیجیټل کتابتون په اړه' }}</h2>
                    <p class="text-muted mt-3 mx-auto text-justify" style="max-width:640px; font-size:1.05rem;">
                        {{ ($setting->{'about_digital_library_'.app()->getLocale()}) }}
                    </p>
                </div>

                <div class="row g-4">

                    <div class="col-md-6">
                        <div class="about-card">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="d-flex align-items-center justify-content-center rounded-3"
                                     style="width:44px;height:44px;background:#e8eaf6;color:#3949ab;font-size:1.3rem;">
                                    🎯
                                </div>
                                <h4 class="fw-bold mb-0" style="color:#1a237e;">{{app()->getlocale()=='en'? 'Our Mission & Vision': 'زموږ لید لوری!'}}</h4>
                            </div>
                            <p class="text-muted mb-0" style="line-height:1.8;">
                                {{ ($setting->{'mission_vision_'.app()->getLocale()}) }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="about-card">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="d-flex align-items-center justify-content-center rounded-3"
                                     style="width:44px;height:44px;background:#e8eaf6;color:#3949ab;font-size:1.3rem;">
                                    📖
                                </div>
                                <h4 class="fw-bold mb-0" style="color:#1a237e;">{{ app()->getlocale()=='en'? 'Why This Library?':'ددې کتابتون هدف؟'}}</h4>
                            </div>
                            <p class="text-muted mb-0" style="line-height:1.8;">
                                {{ ($setting->{'purpose_'.app()->getLocale()}) }}
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- ─── Footer ──────────────────────────────────────────── --}}
    @include('footer.footer')
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AJAX Search Script -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

   <script src="{{ asset('homeSearch.js') }}"></script>
</body>
</html>