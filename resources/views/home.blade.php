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
     {{-- ─── About Section ──────────────────────────────────── --}}
 <style>
/* ── Section Background ── */
#aboutSection {
    background: linear-gradient(160deg, #f0f4ff 0%, #faf5ff 50%, #f0f4ff 100%);
    position: relative;
    overflow: hidden;
}

/* Decorative blobs */
#aboutSection::before {
    content: '';
    position: absolute;
    top: -100px;
    left: -100px;
    width: 350px;
    height: 350px;
    background: radial-gradient(circle, rgba(102,126,234,0.12) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
}

#aboutSection::after {
    content: '';
    position: absolute;
    bottom: -120px;
    right: -80px;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(118,75,162,0.1) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
}

/* ── Section Title ── */
#aboutSection .section-title {
    font-size: 2.2rem;
    font-weight: 800;
    background: linear-gradient(135deg, #667eea, #764ba2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    position: relative;
    display: inline-block;
}

/* Underline decoration */
#aboutSection .section-title::after {
    content: '';
    display: block;
    width: 70px;
    height: 4px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 10px;
    margin: 12px auto 0;
}

/* ── Description Text ── */
#aboutSection .text-muted.text-justify {
    color: #666 !important;
    line-height: 1.9;
    font-size: 1.05rem;
}

/* ── About Container ── */
.about-section {
    position: relative;
    z-index: 1;
}

/* ── About Card ── */
.about-card {
    background: white;
    border-radius: 20px;
    padding: 32px 28px;
    height: 100%;
    border: 1px solid rgba(102, 126, 234, 0.1);
    box-shadow: 0 8px 30px rgba(102, 126, 234, 0.08);
    transition: transform 0.35s ease, box-shadow 0.35s ease;
    position: relative;
    overflow: hidden;
}

/* Card top accent line */
.about-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 20px 20px 0 0;
}

/* Card hover glow */
.about-card::after {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: 20px;
    background: linear-gradient(135deg,
        rgba(102,126,234,0.04),
        rgba(118,75,162,0.04));
    opacity: 0;
    transition: opacity 0.35s ease;
    pointer-events: none;
}

.about-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 50px rgba(102, 126, 234, 0.18);
}

.about-card:hover::after {
    opacity: 1;
}

/* ── Icon Box ── */
.about-card .rounded-3 {
    width: 52px !important;
    height: 52px !important;
    background: linear-gradient(135deg,
        rgba(102,126,234,0.15),
        rgba(118,75,162,0.15)) !important;
    color: #667eea !important;
    font-size: 1.5rem !important;
    border-radius: 14px !important;
    transition: transform 0.3s ease, background 0.3s ease;
    flex-shrink: 0;
}

.about-card:hover .rounded-3 {
    transform: rotate(-6deg) scale(1.1);
    background: linear-gradient(135deg,
        rgba(102,126,234,0.25),
        rgba(118,75,162,0.25)) !important;
}

/* ── Card Title ── */
.about-card h4 {
    font-size: 1.15rem !important;
    font-weight: 700 !important;
    color: #2d1b6e !important;
    letter-spacing: -0.2px;
}

/* ── Card Text ── */
.about-card .text-muted {
    color: #777 !important;
    line-height: 1.85 !important;
    font-size: 0.97rem;
}

/* ── Stat chips (decorative) ── */
.about-stat {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: linear-gradient(135deg, #667eea11, #764ba211);
    border: 1px solid rgba(102,126,234,0.2);
    border-radius: 50px;
    padding: 5px 14px;
    font-size: 13px;
    font-weight: 600;
    color: #667eea;
    margin: 4px;
}
</style>


</head>

<body>

    {{-- ─── Navbar ─────────────────────────────────────────── --}}
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm sticky-top">
        <div class="container">

            <a class="navbar-brand fw-bold d-flex align-items-center" href="/">
                        <img src="{{ asset('uploads/' . optional($setting)->logo) }}"
                            width="45"
                            height="45"
                            class="me-2">
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
                      @if( auth()->user()->role == 'admin' || (auth()->user()->role == 'user' && auth()->user()->is_active)
                            
                                    
                                )
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
               @php
                    $locale = app()->getLocale();
                    $heroTitle = $setting?->{'hero_title_'.$locale} ?? 'Afghan Digital Library';
                @endphp

                <h2 class="display-5 fw-bold mb-3">
                    {{ $heroTitle }}
                </h2>
            </h2>

            <p class="lead mb-4">
                {{ ($setting->{'hero_description_'.app()->getLocale()}) ?? " No description" }}
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
            <style>
/* ── Wrapper ── */
.search-wrapper {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 50px 30px;
    border-radius: 24px;
    box-shadow: 0 20px 60px rgba(102, 126, 234, 0.35);
    position: relative;
    overflow: hidden;
}

/* Background decoration circles */
.search-wrapper::before {
    content: '';
    position: absolute;
    top: -60px;
    right: -60px;
    width: 220px;
    height: 220px;
    background: rgba(255,255,255,0.08);
    border-radius: 50%;
}

.search-wrapper::after {
    content: '';
    position: absolute;
    bottom: -80px;
    left: -40px;
    width: 280px;
    height: 280px;
    background: rgba(255,255,255,0.06);
    border-radius: 50%;
}

/* ── Label text ── */
.search-wrapper p {
    color: rgba(255,255,255,0.85) !important;
    font-size: 13px;
    letter-spacing: 1.5px;
    position: relative;
    z-index: 1;
}

/* ── Input Group ── */
.search-wrapper .input-group {
    border-radius: 50px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0,0,0,0.2) !important;
    position: relative;
    z-index: 1;
}

.search-wrapper .form-control {
    border: none;
    padding: 16px 24px;
    font-size: 15px;
    color: #333;
    background: white;
    border-radius: 0 !important;
    outline: none;
    box-shadow: none !important;
}

.search-wrapper .form-control::placeholder {
    color: #bbb;
    font-size: 14px;
}

.search-wrapper .form-control:focus {
    background: #fafafa;
    box-shadow: none !important;
    border: none !important;
}

/* ── Search Button ── */
.search-wrapper .search-btn {
    background: linear-gradient(135deg, #f093fb, #f5576c);
    border: none;
    padding: 16px 30px;
    font-size: 14px;
    font-weight: 600;
    color: white;
    border-radius: 0 !important;
    transition: all 0.3s ease;
    white-space: nowrap;
    letter-spacing: 0.5px;
}

.search-wrapper .search-btn:hover:not(:disabled) {
    background: linear-gradient(135deg, #e97cf3, #e04458);
    transform: scale(1.03);
    color: white;
}

.search-wrapper .search-btn:disabled {
    background: linear-gradient(135deg, #ccc, #bbb);
    cursor: not-allowed;
    opacity: 0.7;
}

/* ── Dropdown ── */
.search-dropdown {
    position: absolute;
    top: calc(100% + 8px);
    left: 0;
    width: 100%;
    background: white;
    border-radius: 16px;
    box-shadow: 0 16px 45px rgba(0,0,0,0.15);
    z-index: 9999;
    overflow: hidden;
    border: 1px solid rgba(0,0,0,0.06);
    animation: fadeSlideDown 0.2s ease;
}

@keyframes fadeSlideDown {
    from { opacity: 0; transform: translateY(-8px); }
    to   { opacity: 1; transform: translateY(0); }
}

.search-dropdown:empty {
    display: none;
}

/* Dropdown Items */
.search-dropdown .search-item {
    padding: 13px 18px;
    border-bottom: 1px solid #f5f5f5;
    cursor: pointer;
    transition: background 0.2s;
    display: flex;
    align-items: center;
    gap: 12px;
}

.search-dropdown .search-item:last-child {
    border-bottom: none;
}

.search-dropdown .search-item:hover {
    background: #f8f0ff;
}

.search-dropdown .search-item .search-icon {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 14px;
    flex-shrink: 0;
}

.search-dropdown .search-item .search-title {
    font-weight: 600;
    font-size: 14px;
    color: #222;
}

.search-dropdown .search-item .search-author {
    font-size: 12px;
    color: #999;
    margin-top: 2px;
}

/* No results */
.search-dropdown .no-result {
    padding: 20px;
    text-align: center;
    color: #bbb;
    font-size: 14px;
}

.search-dropdown .no-result i {
    display: block;
    font-size: 28px;
    margin-bottom: 8px;
}

/* ── Position relative fix ── */
.col-md-7.position-relative {
    z-index: 2;
}
</style>

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
                        placeholder="{{ __('message.search_placeholder') }}"
                        autocomplete="off">
                    <button
                        class="btn btn-primary search-btn"
                        type="submit"
                        id="searchBtn"
                        disabled>
                        <i class="bi bi-search me-1"></i>
                        {{ __('message.search') }}
                    </button>
                </div>
                <div id="searchResults" class="search-dropdown"></div>
            </div>
        </form>
    </div>
</div>
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
 <!-- about section  -->

<section id="aboutSection" class="py-5">
    <div class="container">
        <div class="about-section">

            {{-- ── HEADER ── --}}
            <div class="text-center mb-5" data-aos="fade-up">

                {{-- Decorative label --}}
                <span class="about-stat mb-3">
                    <i class="bi bi-stars"></i>
                    {{ app()->getLocale() == 'en' ? 'Know More About Us' : 'زموږ په اړه نور معلومات' }}
                </span>

                <h2 class="section-title mt-3">
                    {{ app()->getLocale() == 'en'
                        ? 'About Digital Library'
                        : 'د ډیجیټل کتابتون په اړه' }}
                </h2>

                <p class="text-muted mt-3 mx-auto text-justify"
                   style="max-width:640px; font-size:1.05rem;">
                    {{ $setting->{'about_digital_library_' . app()->getLocale()} ?? 'No text yet!' }}
                </p>

                {{-- Decorative stats row --}}
                <div class="mt-4 d-flex flex-wrap justify-content-center gap-2">
                    <span class="about-stat">
                        📚 {{ app()->getLocale() == 'en' ? 'Free Access' : 'وړیا لاسرسی' }}
                    </span>
                    <span class="about-stat">
                        🌐 {{ app()->getLocale() == 'en' ? 'Multi Language' : 'ډیری ژبې' }}
                    </span>
                    <span class="about-stat">
                        🔒 {{ app()->getLocale() == 'en' ? 'Secure Platform' : 'خوندي پلیټ فارم' }}
                    </span>
                    <span class="about-stat">
                        📖 {{ app()->getLocale() == 'en' ? 'Rich Content' : 'بډایه منځپانګه' }}
                    </span>
                </div>

            </div>

            {{-- ── CARDS ── --}}
            <div class="row g-4">

                {{-- Mission & Vision --}}
                <div class="col-md-6" data-aos="fade-right" data-aos-delay="100">
                    <div class="about-card">

                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="d-flex align-items-center justify-content-center rounded-3"
                                 style="width:44px;height:44px;background:#e8eaf6;
                                        color:#3949ab;font-size:1.3rem;">
                                🎯
                            </div>
                            <h4 class="fw-bold mb-0" style="color:#1a237e;">
                                {{ app()->getLocale() == 'en'
                                    ? 'Our Mission & Vision'
                                    : 'زموږ لید لوری!' }}
                            </h4>
                        </div>

                        <p class="text-muted mb-0" style="line-height:1.8;">
                            {{ $setting->{'mission_vision_' . app()->getLocale()} ?? 'No text yet!' }}
                        </p>

                        {{-- Bottom tag --}}
                        <div class="mt-4 pt-3" style="border-top:1px dashed #e8eaf6;">
                            <span class="about-stat" style="font-size:12px;">
                                🎯 {{ app()->getLocale() == 'en' ? 'Purpose Driven' : 'موخه لرونکی' }}
                            </span>
                        </div>

                    </div>
                </div>

                {{-- Why This Library --}}
                <div class="col-md-6" data-aos="fade-left" data-aos-delay="200">
                    <div class="about-card">

                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="d-flex align-items-center justify-content-center rounded-3"
                                 style="width:44px;height:44px;background:#e8eaf6;
                                        color:#3949ab;font-size:1.3rem;">
                                📖
                            </div>
                            <h4 class="fw-bold mb-0" style="color:#1a237e;">
                                {{ app()->getLocale() == 'en'
                                    ? 'Why This Library?'
                                    : 'ددې کتابتون هدف؟' }}
                            </h4>
                        </div>

                        <p class="text-muted mb-0" style="line-height:1.8;">
                            {{ $setting->{'purpose_' . app()->getLocale()} ?? 'No text yet!' }}
                        </p>

                        {{-- Bottom tag --}}
                        <div class="mt-4 pt-3" style="border-top:1px dashed #e8eaf6;">
                            <span class="about-stat" style="font-size:12px;">
                                💡 {{ app()->getLocale() == 'en' ? 'Knowledge First' : 'پوهه لومړی' }}
                            </span>
                        </div>

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