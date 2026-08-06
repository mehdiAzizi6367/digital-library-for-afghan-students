@extends('layouts.app')


<style>
    /* ===== Book Detail Page ===== */
    .book-detail-page {
        min-height: 100vh;
        background: linear-gradient(135deg, #f8f9ff 0%, #f0f2ff 50%, #e8ecff 100%);
    }

    /* ===== Hero Banner ===== */
    .book-hero-banner {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        padding: 60px 0 120px;
        position: relative;
        overflow: hidden;
    }

    .book-hero-banner::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at 20% 50%, rgba(99, 102, 241, 0.12) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(139, 92, 246, 0.10) 0%, transparent 40%);
    }

    .hero-shape {
        position: absolute;
        border-radius: 50%;
        background: white;
        opacity: 0.04;
    }

    .hero-shape:nth-child(1) {
        width: 400px; height: 400px;
        top: -150px; right: -80px;
        animation: floatShape 7s ease-in-out infinite;
    }

    .hero-shape:nth-child(2) {
        width: 250px; height: 250px;
        bottom: -100px; left: 5%;
        animation: floatShape 9s ease-in-out infinite reverse;
    }

    .hero-shape:nth-child(3) {
        width: 180px; height: 180px;
        top: 30%; left: 50%;
        animation: floatShape 6s ease-in-out infinite 2s;
    }

    @keyframes floatShape {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(8deg); }
    }

    .hero-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.88rem;
        color: rgba(255,255,255,0.5);
        margin-bottom: 24px;
    }

    .hero-breadcrumb a {
        color: rgba(255,255,255,0.5);
        text-decoration: none;
        transition: color 0.2s;
    }

    .hero-breadcrumb a:hover { color: #a5b4fc; }

    .hero-breadcrumb .separator { font-size: 0.7rem; }

    .hero-breadcrumb .current { color: #a5b4fc; font-weight: 600; }

    .hero-category-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(99, 102, 241, 0.2);
        border: 1px solid rgba(99, 102, 241, 0.35);
        padding: 6px 16px;
        border-radius: 50px;
        color: #a5b4fc;
        font-size: 0.82rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        margin-bottom: 16px;
    }

    .hero-title {
        font-size: 2.4rem;
        font-weight: 800;
        color: white;
        line-height: 1.25;
        margin-bottom: 12px;
        letter-spacing: -0.5px;
    }

    .hero-author {
        display: flex;
        align-items: center;
        gap: 10px;
        color: rgba(255,255,255,0.6);
        font-size: 1rem;
        font-weight: 500;
        margin-bottom: 24px;
    }

    .hero-author-avatar {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        color: white;
        font-weight: 700;
        flex-shrink: 0;
    }

    .hero-badges {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 18px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: 0.3px;
    }

    .status-badge.approved {
        background: rgba(16, 185, 129, 0.15);
        border: 1px solid rgba(16, 185, 129, 0.3);
        color: #6ee7b7;
    }

    .status-badge.pending {
        background: rgba(245, 158, 11, 0.15);
        border: 1px solid rgba(245, 158, 11, 0.3);
        color: #fcd34d;
    }

    .status-badge.rejected {
        background: rgba(239, 68, 68, 0.15);
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: #fca5a5;
    }

    .status-badge .dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        animation: pulseDot 2s ease-in-out infinite;
    }

    .approved .dot { background: #10b981; }
    .pending .dot  { background: #f59e0b; }
    .rejected .dot { background: #ef4444; }

    @keyframes pulseDot {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.4); opacity: 0.7; }
    }

    /* ===== Book Cover Card ===== */
    .book-cover-sticky {
        position: sticky;
        top: 24px;
    }

    .book-cover-card {
        background: white;
        border-radius: 24px;
        padding: 24px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.12);
        text-align: center;
    }

    .book-cover-wrapper {
        position: relative;
        display: inline-block;
        margin-bottom: 20px;
    }

    .book-cover-img {
        width: 100%;
        max-width: 220px;
        aspect-ratio: 2/3;
        object-fit: cover;
        border-radius: 14px;
        box-shadow:
            0 25px 50px rgba(0,0,0,0.2),
            4px 4px 0 rgba(99,102,241,0.15);
        transition: transform 0.4s ease, box-shadow 0.4s ease;
    }

    .book-cover-img:hover {
        transform: scale(1.03) translateY(-4px) rotate(-1deg);
        box-shadow: 0 35px 70px rgba(0,0,0,0.25), 8px 8px 0 rgba(99,102,241,0.2);
    }

    .cover-glow {
        position: absolute;
        inset: -10px;
        border-radius: 18px;
        background: linear-gradient(135deg, rgba(99,102,241,0.15), rgba(139,92,246,0.1));
        z-index: -1;
        filter: blur(15px);
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .book-cover-wrapper:hover .cover-glow { opacity: 1; }

    /* Action Buttons */
    .action-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 13px 20px;
        border-radius: 14px;
        font-weight: 700;
        font-size: 0.95rem;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: none;
        cursor: pointer;
        width: 100%;
        margin-bottom: 10px;
    }

    .btn-read {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        box-shadow: 0 6px 20px rgba(16,185,129,0.3);
    }

    .btn-read:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(16,185,129,0.4);
        color: white;
    }

    .btn-download {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: white;
        box-shadow: 0 6px 20px rgba(99,102,241,0.3);
    }

    .btn-download:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(99,102,241,0.4);
        color: white;
    }

    .action-btn i {
        font-size: 1.1rem;
        transition: transform 0.3s ease;
    }

    .btn-read:hover i { transform: rotate(5deg) scale(1.1); }
    .btn-download:hover i { transform: translateY(3px); }

    /* Quick Stats */
    .quick-stats {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #f1f5f9;
    }

    .stat-item {
        background: #f8faff;
        border-radius: 12px;
        padding: 14px 10px;
        text-align: center;
        border: 1px solid #e8ecff;
    }

    .stat-item .stat-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 8px;
        font-size: 0.9rem;
    }

    .stat-item .stat-label {
        font-size: 0.72rem;
        color: #94a3b8;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .stat-item .stat-value {
        font-size: 0.88rem;
        font-weight: 700;
        color: #1e293b;
    }

    /* ===== Detail Card ===== */
    .detail-card {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 8px 40px rgba(0,0,0,0.07);
        border: 1px solid rgba(0,0,0,0.04);
    }

    /* Info Row */
    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .info-item {
        padding: 22px 28px;
        display: flex;
        align-items: flex-start;
        gap: 14px;
        border-right: 1px solid #f1f5f9;
        transition: background 0.2s ease;
    }

    .info-item:last-child { border-right: none; }

    .info-item:hover { background: #fafbff; }

    .info-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .icon-purple { background: rgba(99,102,241,0.1); color: #6366f1; }
    .icon-blue   { background: rgba(59,130,246,0.1); color: #3b82f6; }
    .icon-green  { background: rgba(16,185,129,0.1); color: #10b981; }
    .icon-orange { background: rgba(245,158,11,0.1); color: #f59e0b; }
    .icon-pink   { background: rgba(236,72,153,0.1); color: #ec4899; }
    .icon-teal   { background: rgba(20,184,166,0.1); color: #14b8a6; }

    .info-content .info-label {
        font-size: 0.75rem;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 4px;
    }

    .info-content .info-value {
        font-size: 0.97rem;
        font-weight: 600;
        color: #1e293b;
        line-height: 1.4;
    }

    /* Rejection Alert */
    .rejection-alert {
        margin: 20px 28px;
        padding: 16px 20px;
        background: linear-gradient(135deg, #fff1f2, #ffe4e6);
        border: 1px solid #fecdd3;
        border-radius: 14px;
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }

    .rejection-alert .alert-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #ef4444, #dc2626);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .rejection-alert .alert-label {
        font-size: 0.78rem;
        font-weight: 700;
        color: #ef4444;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .rejection-alert .alert-reason {
        font-size: 0.95rem;
        color: #9f1239;
        font-weight: 500;
        line-height: 1.5;
    }

    /* Description Section */
    .description-section {
        padding: 28px;
    }

    .section-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
    }

    .section-header .section-icon {
        width: 44px;
        height: 44px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.1rem;
        box-shadow: 0 4px 15px rgba(99,102,241,0.3);
        flex-shrink: 0;
    }

    .section-header h4 {
        font-size: 1.1rem;
        font-weight: 800;
        color: #1e293b;
        margin: 0;
        letter-spacing: -0.3px;
    }

    .description-text {
        font-size: 0.97rem;
        color: #475569;
        line-height: 1.85;
        font-weight: 400;
        border-left: 3px solid #e0e7ff;
        padding-left: 18px;
        margin: 0;
    }

    /* ===== Main Content Layout ===== */
    .main-layout {
        margin-top: -60px;
        padding-bottom: 80px;
        position: relative;
        z-index: 2;
    }

    /* ===== Responsive ===== */
    @media (max-width: 991px) {
        .book-cover-sticky { position: static; }
        .hero-title { font-size: 1.8rem; }
        .info-grid { grid-template-columns: 1fr; }
        .info-item { border-right: none; border-bottom: 1px solid #f1f5f9; }
        .info-item:last-child { border-bottom: none; }
    }

    @media (max-width: 767px) {
        .book-hero-banner { padding: 40px 0 90px; }
        .hero-title { font-size: 1.5rem; }
        .book-cover-card { padding: 18px; }
        .action-btn { padding: 11px 16px; font-size: 0.88rem; }
        .description-section { padding: 20px; }
        .info-item { padding: 16px 20px; }
        .quick-stats { gap: 8px; }
        .detail-card { border-radius: 18px; }
    }
</style>


@section('content')
<div class="book-detail-page">

    {{-- ===== Hero Banner ===== --}}
    <div class="book-hero-banner">
        <div class="hero-shape"></div>
        <div class="hero-shape"></div>
        <div class="hero-shape"></div>

        <div class="container position-relative" style="z-index: 2; ">

            {{-- Breadcrumb --}}
            <div class="hero-breadcrumb" data-aos="fade-right" data-aos-duration="500">
                <a href="{{ url('/') }}"><i class="fas fa-home"></i></a>
                <span class="separator"><i class="fas fa-chevron-right"></i></span>
                <a href="#">{{ __('message.books') ?? 'Books' }}</a>
                <span class="separator"><i class="fas fa-chevron-right"></i></span>
                <span class="current">
                    {{ Str::limit($book->getTitleAttribute(), 25, '...') }}
                </span>
            </div>

            {{-- Category Tag --}}
            <div data-aos="fade-up" data-aos-delay="100" data-aos-duration="500" >
                <span class="hero-category-tag">
                    <i class="fas fa-tag"></i>
                    {{ $book->category->getname() ?? 'General' }}
                </span>
            </div>

            {{-- Title --}}
            <h1 class="hero-title" data-aos="fade-up" data-aos-delay="150" data-aos-duration="600">
                {{ $book->getTitleAttribute() }}
            </h1>

            {{-- Author --}}
            <div class="hero-author" data-aos="fade-up" data-aos-delay="200" data-aos-duration="500">
                <div class="hero-author-avatar">
                    {{ strtoupper(substr($book->author, 0, 1)) }}
                </div>
                <span>{{ $book->author }}</span>
            </div>

            {{-- Status Badge --}}
            <div class="hero-badges" data-aos="fade-up" data-aos-delay="250" data-aos-duration="500">
                @if($book->status == 'approved')
                    <span class="status-badge approved">
                        <span class="dot"></span>
                        <i class="fas fa-check-circle"></i>
                        {{ __('message.status_approved') }}
                    </span>
                @elseif($book->status == 'pending')
                    <span class="status-badge pending">
                        <span class="dot"></span>
                        <i class="fas fa-clock"></i>
                        {{ __('message.status_pending') }}
                    </span>
                @else
                    <span class="status-badge rejected">
                        <span class="dot"></span>
                        <i class="fas fa-times-circle"></i>
                        {{ __('message.status_rejected') }}
                    </span>
                @endif
            </div>

        </div>
    </div>

    {{-- ===== Main Content ===== --}}
    <div class="main-layout" >
        <div class="container">
            <div class="row g-4">

                {{-- ===== LEFT: Book Cover ===== --}}
                <div class="col-lg-4" data-aos="fade-right" data-aos-duration="700" data-aos-delay="100">
                    <div class="book-cover-sticky">
                        <div class="book-cover-card">

                            {{-- Cover Image --}}
                            <div class="book-cover-wrapper">
                                <div class="cover-glow"></div>
                                <img src="{{ $book->thumbnail
                                    ? asset('storage/'.$book->thumbnail)
                                    : asset('image/banner.png') }}"
                                     class="book-cover-img"
                                     alt="{{ $book->getTitleAttribute() }}"
                                     loading="lazy">
                            </div>

                            {{-- Action Buttons --}}
                            <a href="{{ asset('storage/'.$book->file_path) }}"
                               class="action-btn btn-read"
                               target="_blank">
                                <i class="fas fa-book-open"></i>
                                {{ __('message.read') }}
                            </a>

                            <a href="{{ route('books.download', $book->id) }}"
                               class="action-btn btn-download">
                                <i class="fas fa-download"></i>
                                {{ __('dashboard.downloads') }}
                            </a>

                            {{-- Quick Stats --}}
                            <div class="quick-stats">
                                <div class="stat-item">
                                    <div class="stat-icon icon-green">
                                        <i class="fas fa-folder-open"></i>
                                    </div>
                                    <div class="stat-label">{{ __('message.categories') }}</div>
                                    <div class="stat-value">
                                        {{ Str::limit($book->category->getname() ?? 'N/A', 10) }}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- ===== RIGHT: Book Details ===== --}}
                <div class="col-lg-8" data-aos="fade-left" data-aos-duration="700" data-aos-delay="150">
                    <div class="detail-card">

                        {{-- Info Grid --}}
                        <div class="info-grid">

                            <div class="info-item" data-aos="fade-up" data-aos-delay="200">
                                <div class="info-icon icon-purple">
                                    <i class="fas fa-book"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">{{ __('message.book_title') }}</div>
                                    <div class="info-value">{{ $book->getTitleAttribute() }}</div>
                                </div>
                            </div>

                            <div class="info-item" data-aos="fade-up" data-aos-delay="250">
                                <div class="info-icon icon-blue">
                                    <i class="fas fa-pen-nib"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">{{ __('message.author') }}</div>
                                    <div class="info-value">{{ $book->author }}</div>
                                </div>
                            </div>

                            <div class="info-item" data-aos="fade-up" data-aos-delay="350">
                                <div class="info-icon icon-orange">
                                    <i class="fas fa-folder-open"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">{{ __('message.categories') }}</div>
                                    <div class="info-value">{{ $book->category->getname() ?? 'N/A' }}</div>
                                </div>
                            </div>

                            <div class="info-item" data-aos="fade-up" data-aos-delay="400">
                                <div class="info-icon icon-green">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">{{ __('message.status') }}</div>
                                    <div class="info-value">
                                        @if($book->status == 'approved')
                                            <span style="color:#10b981; font-weight:700;">
                                                ● {{ __('message.status_approved') }}
                                            </span>
                                        @elseif($book->status == 'pending')
                                            <span style="color:#f59e0b; font-weight:700;">
                                                ● {{ __('message.status_pending') }}
                                            </span>
                                        @else
                                            <span style="color:#ef4444; font-weight:700;">
                                                ● {{ __('message.status_rejected') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- Rejection Reason --}}
                        @if($book->status == 'rejected')
                            <div class="rejection-alert" data-aos="fade-up" data-aos-delay="400">
                                <div class="alert-icon">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div>
                                    <div class="alert-label">
                                        {{ __('message.rejection_reason') ?? 'Rejection Reason' }}
                                    </div>
                                    <div class="alert-reason">{{ $book->rejection_reason }}</div>
                                </div>
                            </div>
                        @endif

                        {{-- Description --}}
                        <div class="description-section" data-aos="fade-up" data-aos-delay="450">
                            <div class="section-header">
                                <div class="section-icon">
                                    <i class="fas fa-align-left"></i>
                                </div>
                                <h4>{{ __('message.description') }}</h4>
                            </div>
                            <p class="description-text">
                                {{ $book->getDescription() }}
                            </p>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 600,
        easing: 'ease-out-cubic',
        once: true,
        offset: 40
    });

    // Lazy image fade-in
    document.querySelectorAll('.book-cover-img').forEach(img => {
        img.style.opacity = '0';
        img.style.transition = 'opacity 0.6s ease';
        if (img.complete) {
            img.style.opacity = '1';
        } else {
            img.addEventListener('load', () => img.style.opacity = '1');
            img.addEventListener('error', () => {
                img.style.opacity = '1';
                img.src = "{{ asset('image/banner.png') }}";
            });
        }
    });
</script>
@endsection