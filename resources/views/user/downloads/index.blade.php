@extends('layouts.user')

@section('content')

<style>
    /* ═════════════════════════════════════════
       DOWNLOADS LIBRARY STYLES
    ═════════════════════════════════════════ */

    .downloads-page {
        background: linear-gradient(180deg, #f0fdf4 0%, #ecfdf5 100%);
        min-height: 100vh;
    }

    /* ── Hero Header ── */
    .downloads-hero {
        background: linear-gradient(135deg, #064e3b 0%, #065f46 40%, #047857 100%);
        border-radius: 1.5rem;
        position: relative;
        overflow: hidden;
    }
    .downloads-hero::before {
        content: '';
        position: absolute;
        top: -60px;
        right: -60px;
        width: 220px;
        height: 220px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
    }
    .downloads-hero::after {
        content: '';
        position: absolute;
        bottom: -40px;
        left: -40px;
        width: 160px;
        height: 160px;
        background: rgba(255,255,255,0.03);
        border-radius: 50%;
    }

    /* ── Stats Pills ── */
    .stats-pill {
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255,255,255,0.15);
        border-radius: 14px;
        padding: 12px 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        color: #fff;
    }
    .stats-pill-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }
    .stats-pill-value {
        font-size: 20px;
        font-weight: 800;
        line-height: 1;
    }
    .stats-pill-label {
        font-size: 11px;
        opacity: 0.7;
    }

    /* ── Book Card ── */
    .book-card {
        background: #fff;
        border: none;
        border-radius: 1.25rem;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        height: 100%;
    }
    .book-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.12);
    }

    /* ── Book Cover ── */
    .book-cover-wrapper {
        position: relative;
        overflow: hidden;
        background: #f1f5f9;
    }
    .book-cover {
        width: 100%;
        height: 240px;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    .book-card:hover .book-cover {
        transform: scale(1.08);
    }

    /* ── Download Badge ── */
    .download-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        width: 36px;
        height: 36px;
        background: rgba(16,185,129,0.9);
        backdrop-filter: blur(8px);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 14px;
        box-shadow: 0 4px 12px rgba(16,185,129,0.4);
        z-index: 5;
        animation: downloadPulse 2.5s infinite;
    }
    @keyframes downloadPulse {
        0%, 100% { transform: scale(1) translateY(0); }
        50% { transform: scale(1.15) translateY(-2px); }
    }

    /* ── Rating Badge on Cover ── */
    .rating-cover-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: rgba(0,0,0,0.65);
        backdrop-filter: blur(8px);
        color: #fbbf24;
        font-size: 11px;
        font-weight: 700;
        padding: 5px 10px;
        border-radius: 20px;
        z-index: 5;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* ── Quick Download Overlay ── */
    .quick-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 16px;
        background: linear-gradient(to top, rgba(0,0,0,0.65) 0%, transparent 100%);
        transform: translateY(100%);
        transition: transform 0.3s ease;
        z-index: 4;
        display: flex;
        justify-content: center;
    }
    .book-card:hover .quick-overlay {
        transform: translateY(0);
    }
    .btn-quick {
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255,255,255,0.3);
        color: #fff;
        border-radius: 10px;
        padding: 8px 20px;
        font-size: 12px;
        font-weight: 600;
        transition: all 0.2s ease;
        text-decoration: none;
    }
    .btn-quick:hover {
        background: rgba(255,255,255,0.35);
        color: #fff;
    }

    /* ── Star Rating ── */
    .star-rating {
        display: flex;
        justify-content: center;
        gap: 4px;
        margin-bottom: 8px;
    }
    .star-btn {
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
        font-size: 20px;
        transition: all 0.2s ease;
        filter: grayscale(1) opacity(0.3);
        line-height: 1;
    }
    .star-btn.active,
    .star-btn:hover {
        filter: grayscale(0) opacity(1);
        transform: scale(1.3);
    }
    .star-rating:hover .star-btn {
        filter: grayscale(0) opacity(1);
    }
    .star-rating:hover .star-btn:hover ~ .star-btn {
        filter: grayscale(1) opacity(0.3);
        transform: scale(1);
    }

    /* ── Book Info ── */
    .book-title {
        font-size: 14px;
        font-weight: 700;
        color: #1e293b;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 40px;
        margin-bottom: 6px;
    }
    .book-author {
        font-size: 12px;
        color: #94a3b8;
        font-weight: 500;
        margin-bottom: 12px;
    }
    .rating-info {
        font-size: 11px;
        color: #94a3b8;
        margin-bottom: 12px;
    }

    /* ── Download Button ── */
    .btn-download-again {
        background: linear-gradient(135deg, #10b981, #059669);
        border: none;
        border-radius: 12px;
        padding: 11px;
        font-weight: 700;
        font-size: 13px;
        color: #fff;
        transition: all 0.25s ease;
        position: relative;
        overflow: hidden;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
    }
    .btn-download-again::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
        transition: left 0.5s ease;
    }
    .btn-download-again:hover::before {
        left: 100%;
    }
    .btn-download-again:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16,185,129,0.4);
        color: #fff;
    }

    /* ── Download Count Badge ── */
    .download-count {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        color: #16a34a;
        border-radius: 8px;
        padding: 3px 10px;
        font-size: 11px;
        font-weight: 600;
        margin-bottom: 12px;
    }

    /* ── Rating Toast ── */
    .rating-toast {
        position: fixed;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%) translateY(100px);
        background: #1e293b;
        color: #fff;
        padding: 12px 24px;
        border-radius: 14px;
        font-size: 14px;
        font-weight: 600;
        z-index: 9999;
        opacity: 0;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        white-space: nowrap;
    }
    .rating-toast.show {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
    }

    /* ── Empty State ── */
    .empty-state-card {
        background: #fff;
        border-radius: 1.5rem;
        border: 2px dashed #d1fae5;
        padding: 60px 30px;
        text-align: center;
    }
    .empty-icon-wrap {
        width: 90px;
        height: 90px;
        background: linear-gradient(135deg, #f0fdf4, #dcfce7);
        border-radius: 1.5rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 38px;
        margin-bottom: 20px;
    }

    /* ── Scroll Animation ── */
    .scroll-animate {
        opacity: 0;
        transform: translateY(40px);
        transition: all 0.7s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .scroll-animate.visible {
        opacity: 1;
        transform: translateY(0);
    }
    .scroll-delay-1 { transition-delay: 0.05s; }
    .scroll-delay-2 { transition-delay: 0.10s; }
    .scroll-delay-3 { transition-delay: 0.15s; }
    .scroll-delay-4 { transition-delay: 0.20s; }
    .scroll-delay-5 { transition-delay: 0.25s; }
    .scroll-delay-6 { transition-delay: 0.30s; }
    .scroll-delay-7 { transition-delay: 0.35s; }
    .scroll-delay-8 { transition-delay: 0.40s; }

    @media (max-width: 576px) {
        .book-cover { height: 190px; }
        .downloads-hero { border-radius: 1rem; }
    }
</style>

<div class="downloads-page py-4 py-md-5">
    <div class="container">

        {{-- ═══════════════════════════════════════════
             HERO HEADER
        ═══════════════════════════════════════════ --}}
        <div class="downloads-hero shadow-lg mb-5 scroll-animate">
            <div class="position-relative p-4 p-lg-5" style="z-index:2;">
                <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-4">

                    <div class="text-white">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="d-flex align-items-center justify-content-center rounded-3 flex-shrink-0"
                                 style="width:52px; height:52px; background:rgba(255,255,255,0.12);">
                                <i class="fas fa-download text-white" style="font-size:22px;"></i>
                            </div>
                            <div>
                                <span class="d-block text-white-50"
                                      style="font-size:10px; letter-spacing:0.12em; text-transform:uppercase; font-weight:700;">
                                    My Library
                                </span>
                                <h2 class="fw-bold mb-0 text-white">
                                    My Downloaded Books
                                </h2>
                            </div>
                        </div>
                        <p class="text-white-50 mb-0 small" style="max-width:480px;">
                            All the books you have downloaded — available to read and download again anytime.
                        </p>
                    </div>

                    {{-- Stats --}}
                    <div class="d-flex flex-wrap gap-3">
                        <div class="stats-pill">
                            <div class="stats-pill-icon bg-success bg-opacity-25">
                                <i class="fas fa-download text-success"></i>
                            </div>
                            <div>
                                <div class="stats-pill-value">{{ count($downloads) }}</div>
                                <div class="stats-pill-label">Downloaded</div>
                            </div>
                        </div>

                        <div class="stats-pill">
                            <div class="stats-pill-icon bg-warning bg-opacity-25">
                                <i class="fas fa-star text-warning"></i>
                            </div>
                            <div>
                                @php
                                    $globalAvg = count($downloads) > 0
                                        ? round(collect($downloads)->avg(fn($d) => $d->book->ratings->avg('rating')), 1)
                                        : 0;
                                @endphp
                                <div class="stats-pill-value">{{ $globalAvg ?: 'N/A' }}</div>
                                <div class="stats-pill-label">Avg Rating</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════
             BOOKS GRID
        ═══════════════════════════════════════════ --}}
        @if(count($downloads) > 0)
            <div class="row g-4">
                @foreach($downloads as $index => $download)
                    @php
                        $avg = round($download->book->ratings->avg('rating'), 1);
                        $userRating = $download->book->ratings->where('user_id', auth()->id())->first()?->rating ?? 0;
                        $delayClass = 'scroll-delay-' . (($index % 8) + 1);
                    @endphp

                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="book-card scroll-animate {{ $delayClass }}">

                            {{-- Cover --}}
                            <div class="book-cover-wrapper">
                                <img src="{{ asset('/storage/'.$download->book->thumbnail) }}"
                                     class="book-cover"
                                     alt="{{ $download->book->getTitleAttribute() }}"
                                     loading="lazy">

                                {{-- Download Badge --}}
                                <div class="download-badge">
                                    <i class="fas fa-check"></i>
                                </div>

                                {{-- Rating Badge --}}
                                @if($avg > 0)
                                    <div class="rating-cover-badge">
                                        <i class="fas fa-star"></i>
                                        {{ $avg }}
                                    </div>
                                @endif

                                {{-- Quick Download Overlay --}}
                                <div class="quick-overlay">
                                    <a href="{{ route('books.download', $download->book->id) }}"
                                       class="btn-quick">
                                        <i class="fas fa-download me-1"></i>
                                        Download Again
                                    </a>
                                </div>
                            </div>

                            {{-- Card Body --}}
                            <div class="card-body p-3 d-flex flex-column text-center">

                                {{-- Star Rating --}}
                                <div class="star-rating" data-book="{{ $download->book->id }}">
                                    @for($i = 1; $i <= 5; $i++)
                                        <button type="button"
                                                class="star-btn {{ $i <= $userRating ? 'active' : '' }}"
                                                data-value="{{ $i }}">
                                            ⭐
                                        </button>
                                    @endfor
                                </div>

                                {{-- Rating Info --}}
                                <div class="rating-info">
                                    @if($avg > 0)
                                        <i class="fas fa-star text-warning" style="font-size:10px;"></i>
                                        {{ $avg }}
                                        <span class="mx-1">•</span>
                                        {{ $download->book->ratings->count() }}
                                        {{ $download->book->ratings->count() > 1 ? 'ratings' : 'rating' }}
                                    @else
                                        No rating yet
                                    @endif
                                </div>

                                {{-- Title --}}
                                <div class="book-title">
                                    {{ Str::limit($download->book->getTitleAttribute(), 40) }}
                                </div>

                                {{-- Author --}}
                                <div class="book-author">
                                    <i class="fas fa-pen-nib me-1" style="font-size:10px;"></i>
                                    {{ $download->book->author }}
                                </div>

                                {{-- Downloaded Badge --}}
                                <div class="d-flex justify-content-center mb-2">
                                    <span class="download-count">
                                        <i class="fas fa-check-circle"></i>
                                        Downloaded
                                    </span>
                                </div>

                                {{-- Download Again Button --}}
                                <div class="mt-auto">
                                    <a href="{{ route('books.download', $download->book->id) }}"
                                       class="btn-download-again">
                                        <i class="fas fa-download"></i>
                                        Download Again
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        @else

            {{-- Empty State --}}
            <div class="scroll-animate">
                <div class="empty-state-card">
                    <div class="empty-icon-wrap">📥</div>
                    <h4 class="fw-bold mb-2">No Downloads Yet</h4>
                    <p class="text-muted mb-4 small" style="max-width:380px; margin:0 auto;">
                        You haven't downloaded any books yet. Explore our library and start downloading!
                    </p>
                    <a href="{{ route('books.index') ?? '#' }}"
                       class="btn btn-success px-4 py-2 rounded-3 fw-semibold">
                        <i class="fas fa-compass me-2"></i>
                        Explore Books
                    </a>
                </div>
            </div>

        @endif

    </div>
</div>

{{-- Rating Toast --}}
<div class="rating-toast" id="ratingToast">
    <i class="fas fa-star text-warning me-2"></i>
    <span id="ratingToastText">Thanks for your feedback! 👍❤️</span>
</div>

{{-- ═══════════════════════════════════════════
     SCRIPTS
═══════════════════════════════════════════ --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ═══ SCROLL ANIMATION ═══ */
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, {
        root: null,
        rootMargin: '0px 0px -60px 0px',
        threshold: 0.1
    });

    document.querySelectorAll('.scroll-animate').forEach(el => {
        observer.observe(el);
    });

    /* ═══ TOAST NOTIFICATION ═══ */
    const ratingToast   = document.getElementById('ratingToast');
    const ratingToastTx = document.getElementById('ratingToastText');

    function showToast(message) {
        ratingToastTx.textContent = message;
        ratingToast.classList.add('show');
        setTimeout(() => ratingToast.classList.remove('show'), 2800);
    }

    /* ═══ STAR RATING ═══ */
    document.querySelectorAll('.star-rating').forEach(container => {
        const stars  = container.querySelectorAll('.star-btn');
        const bookId = container.dataset.book;

        stars.forEach((star, index) => {

            // Hover effect
            star.addEventListener('mouseenter', () => {
                stars.forEach((s, i) => {
                    s.style.filter = i <= index
                        ? 'grayscale(0) opacity(1)'
                        : 'grayscale(1) opacity(0.3)';
                });
            });

            // Click to rate
            star.addEventListener('click', () => {
                const rating = star.dataset.value;

                stars.forEach((s, i) => {
                    if (i <= index) {
                        s.classList.add('active');
                        s.style.filter = 'grayscale(0) opacity(1)';
                        s.style.transform = 'scale(1.4)';
                        setTimeout(() => s.style.transform = '', 250);
                    } else {
                        s.classList.remove('active');
                        s.style.filter = 'grayscale(1) opacity(0.3)';
                    }
                });

                // Send rating
                fetch(`/books/${bookId}/rate`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ rating: rating })
                })
                .then(res => res.json())
                .then(() => {
                    showToast(`⭐ Rated ${rating} star${rating > 1 ? 's' : ''}! Thanks for your feedback! 👍❤️`);
                })
                .catch(() => {
                    showToast('❌ Rating failed. Please try again.');
                });
            });
        });

        // Reset on mouse leave
        container.addEventListener('mouseleave', () => {
            stars.forEach(s => {
                const isActive = s.classList.contains('active');
                s.style.filter = isActive
                    ? 'grayscale(0) opacity(1)'
                    : 'grayscale(1) opacity(0.3)';
                s.style.transform = '';
            });
        });
    });

    /* ═══ CARD ROW STAGGER ═══ */
    document.querySelectorAll('.book-card').forEach((card, i) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = `all 0.5s ease ${i * 0.08}s`;
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 200 + (i * 80));
    });

});
</script>

@endsection