@extends('layouts.user')

@section('content')

<style>
    /* ═════════════════════════════════════════
       FAVORITES LIBRARY STYLES
    ═════════════════════════════════════════ */

    .favorites-page {
        background: linear-gradient(180deg, #f8f9fd 0%, #eef1f8 100%);
        min-height: 100vh;
    }

    /* ── Hero Header ── */
    .favorites-hero {
        background: linear-gradient(135deg, #1e293b 0%, #334155 40%, #475569 100%);
        border-radius: 1.5rem;
        position: relative;
        overflow: hidden;
    }
    .favorites-hero::before {
        content: '';
        position: absolute;
        top: -60px;
        right: -60px;
        width: 220px;
        height: 220px;
        background: rgba(255,255,255,0.04);
        border-radius: 50%;
    }
    .favorites-hero::after {
        content: '';
        position: absolute;
        bottom: -40px;
        left: -40px;
        width: 160px;
        height: 160px;
        background: rgba(255,255,255,0.03);
        border-radius: 50%;
    }

    /* ── Book Card ── */
    .book-card {
        background: #fff;
        border: none;
        border-radius: 1.25rem;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
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
    .book-cover-wrapper::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 60px;
        background: linear-gradient(to top, rgba(0,0,0,0.3), transparent);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .book-card:hover .book-cover-wrapper::after {
        opacity: 1;
    }

    .book-cover {
        width: 100%;
        height: 260px;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    .book-card:hover .book-cover {
        transform: scale(1.08);
    }

    /* ── Favorite Badge ── */
    .fav-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        width: 36px;
        height: 36px;
        background: rgba(239, 68, 68, 0.9);
        backdrop-filter: blur(8px);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 14px;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        z-index: 5;
        animation: heartbeat 2s infinite;
    }
    @keyframes heartbeat {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.15); }
    }

    /* ── Rating Badge ── */
    .rating-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: rgba(0,0,0,0.7);
        backdrop-filter: blur(8px);
        color: #fbbf24;
        font-size: 12px;
        font-weight: 700;
        padding: 5px 10px;
        border-radius: 20px;
        z-index: 5;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* ── Star Rating ── */
    .star-rating {
        display: flex;
        justify-content: center;
        gap: 4px;
        margin-bottom: 10px;
    }
    .star-btn {
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
        font-size: 22px;
        transition: all 0.2s ease;
        filter: grayscale(1) opacity(0.3);
    }
    .star-btn.active,
    .star-btn:hover {
        filter: grayscale(0) opacity(1);
        transform: scale(1.3);
    }
    .star-btn:hover ~ .star-btn {
        filter: grayscale(1) opacity(0.3);
        transform: scale(1);
    }
    .star-rating:hover .star-btn {
        filter: grayscale(0) opacity(1);
        transform: scale(1.1);
    }
    .star-rating:hover .star-btn:hover ~ .star-btn {
        filter: grayscale(1) opacity(0.3);
        transform: scale(1);
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
    }
    .rating-toast.show {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
    }

    /* ── Book Info ── */
    .book-title {
        font-size: 15px;
        font-weight: 700;
        color: #1e293b;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 42px;
    }
    .book-author {
        font-size: 13px;
        color: #94a3b8;
        font-weight: 500;
    }

    /* ── Action Buttons ── */
    .btn-read {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        border: none;
        border-radius: 12px;
        padding: 10px;
        font-weight: 700;
        font-size: 13px;
        color: #fff;
        transition: all 0.25s ease;
        letter-spacing: 0.02em;
    }
    .btn-read:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.35);
        color: #fff;
    }

    .btn-remove-fav {
        background: #fef2f2;
        border: 1.5px solid #fecaca;
        border-radius: 12px;
        padding: 10px;
        font-weight: 600;
        font-size: 13px;
        color: #dc2626;
        transition: all 0.25s ease;
    }
    .btn-remove-fav:hover {
        background: #dc2626;
        border-color: #dc2626;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(220, 38, 38, 0.3);
    }

    /* ── Quick View Overlay ── */
    .quick-view-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 16px;
        background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 100%);
        transform: translateY(100%);
        transition: transform 0.3s ease;
        z-index: 4;
        display: flex;
        justify-content: center;
    }
    .book-card:hover .quick-view-overlay {
        transform: translateY(0);
    }
    .btn-quick-view {
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255,255,255,0.3);
        color: #fff;
        border-radius: 10px;
        padding: 8px 20px;
        font-size: 12px;
        font-weight: 600;
        transition: all 0.2s ease;
    }
    .btn-quick-view:hover {
        background: rgba(255,255,255,0.35);
        color: #fff;
    }

    /* ── Empty State ── */
    .empty-state-card {
        background: #fff;
        border-radius: 1.5rem;
        border: 2px dashed #e2e8f0;
        padding: 60px 30px;
        text-align: center;
    }
    .empty-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #fef2f2, #fee2e2);
        border-radius: 1.5rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 36px;
        margin-bottom: 20px;
    }

    /* ── Scroll Animations ── */
    .scroll-animate {
        opacity: 0;
        transform: translateY(40px);
        transition: all 0.7s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .scroll-animate.visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* Staggered delays */
    .scroll-delay-1 { transition-delay: 0.05s; }
    .scroll-delay-2 { transition-delay: 0.10s; }
    .scroll-delay-3 { transition-delay: 0.15s; }
    .scroll-delay-4 { transition-delay: 0.20s; }
    .scroll-delay-5 { transition-delay: 0.25s; }
    .scroll-delay-6 { transition-delay: 0.30s; }
    .scroll-delay-7 { transition-delay: 0.35s; }
    .scroll-delay-8 { transition-delay: 0.40s; }

    /* ── Stats Pill ── */
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

    /* ── Responsive ── */
    @media (max-width: 576px) {
        .book-cover { height: 200px; }
        .favorites-hero { border-radius: 1rem; }
    }
</style>

<div class="favorites-page py-4 py-md-5">
    <div class="container">

        {{-- ═══════════════════════════════════════════
             HERO HEADER
        ═══════════════════════════════════════════ --}}
        <div class="favorites-hero shadow-lg mb-5 scroll-animate">
            <div class="position-relative p-4 p-lg-5" style="z-index:2;">

                <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-4">
                    <div class="text-white">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <div class="d-flex align-items-center justify-content-center rounded-3"
                                 style="width:48px; height:48px; background:rgba(239,68,68,0.2);">
                                <i class="fas fa-heart text-danger" style="font-size:20px;"></i>
                            </div>
                            <div>
                                <span class="small text-white-50 d-block" style="font-size:11px; letter-spacing:0.1em; text-transform:uppercase;">
                                    {{ __('message.my_collection') ?? 'My Collection' }}
                                </span>
                                <h2 class="fw-bold mb-0 text-white" style="line-height:1.2;">
                                    {{ __('message.my_favorites') ?? 'My Favorite Books' }}
                                </h2>
                            </div>
                        </div>
                        <p class="text-white-50 mb-0 small" style="max-width:480px;">
                            {{ __('message.favorites_description') ?? 'Your personal reading collection — all the books you love, in one place.' }}
                        </p>
                    </div>

                    {{-- Stats --}}
                    <div class="d-flex flex-wrap gap-3">
                        <div class="stats-pill">
                            <div class="stats-pill-icon bg-danger bg-opacity-25">
                                <i class="fas fa-heart text-danger"></i>
                            </div>
                            <div>
                                <div class="stats-pill-value">{{ $favorites->count() }}</div>
                                <div class="stats-pill-label">{{ __('message.total_favorites') ?? 'Favorites' }}</div>
                            </div>
                        </div>

                        <div class="stats-pill">
                            <div class="stats-pill-icon bg-warning bg-opacity-25">
                                <i class="fas fa-star text-warning"></i>
                            </div>
                            <div>
                                @php
                                    $globalAvg = $favorites->count() > 0
                                        ? round($favorites->avg(fn($f) => $f->book->ratings->avg('rating')), 1)
                                        : 0;
                                @endphp
                                <div class="stats-pill-value">{{ $globalAvg }}</div>
                                <div class="stats-pill-label">{{ __('message.avg_rating') ?? 'Avg Rating' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- ═══════════════════════════════════════════
             BOOKS GRID
        ═══════════════════════════════════════════ --}}
        @if($favorites->count() > 0)
            <div class="row g-4">
                @foreach($favorites as $index => $fav)
                    @php
                        $avg = round($fav->book->ratings->avg('rating'), 1);
                        $userRating = $fav->book->ratings->where('user_id', auth()->id())->first()?->rating ?? 0;
                        $delayClass = 'scroll-delay-' . (($index % 8) + 1);
                    @endphp

                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="book-card card h-100 scroll-animate {{ $delayClass }}">

                            {{-- Cover Image --}}
                            <div class="book-cover-wrapper">
                                <img src="{{ asset('/storage/'.$fav->book->thumbnail) }}"
                                     class="book-cover"
                                     alt="{{ $fav->book->getTitleAttribute() }}"
                                     loading="lazy">

                                {{-- Favorite Heart Badge --}}
                                <div class="fav-badge">
                                    <i class="fas fa-heart"></i>
                                </div>

                                {{-- Rating Badge --}}
                                @if($avg > 0)
                                    <div class="rating-badge">
                                        <i class="fas fa-star"></i>
                                        {{ $avg }}
                                    </div>
                                @endif

                                {{-- Quick View Overlay --}}
                                <div class="quick-view-overlay">
                                    <a href="{{ route('books.read', $fav->book->id) }}"
                                       class="btn btn-quick-view">
                                        <i class="fas fa-book-open me-1"></i>
                                        {{ __('message.read') ?? 'Read Now' }}
                                    </a>
                                </div>
                            </div>

                            {{-- Card Body --}}
                            <div class="card-body p-3 d-flex flex-column">

                                {{-- Star Rating --}}
                                <div class="star-rating" data-book="{{ $fav->book->id }}">
                                    @for($i = 1; $i <= 5; $i++)
                                        <button type="button"
                                                class="star-btn {{ $i <= $userRating ? 'active' : '' }}"
                                                data-value="{{ $i }}"
                                                title="{{ $i }} star">
                                            ⭐
                                        </button>
                                    @endfor
                                </div>

                                {{-- Rating Info --}}
                                <div class="text-center mb-2">
                                    <span class="small" style="color:#94a3b8; font-size:11px;">
                                        @if($avg > 0)
                                            <i class="fas fa-star text-warning" style="font-size:10px;"></i>
                                            {{ $avg }}
                                            <span class="mx-1">•</span>
                                            {{ $fav->book->ratings->count() }}
                                            {{ $fav->book->ratings->count() > 1 ? 'ratings' : 'rating' }}
                                        @else
                                            {{ __('message.no_rating') ?? 'No rating yet' }}
                                        @endif
                                    </span>
                                </div>

                                {{-- Title --}}
                                <h6 class="book-title">
                                    {{ Str::limit($fav->book->getTitleAttribute(), 40) }}
                                </h6>

                                {{-- Author --}}
                                <p class="book-author mb-3">
                                    <i class="fas fa-pen-nib me-1" style="font-size:10px;"></i>
                                    {{ $fav->book->author }}
                                </p>

                                {{-- Buttons --}}
                                <div class="mt-auto d-grid gap-2">
                                    <a href="{{ route('books.read', $fav->book->id) }}"
                                       class="btn btn-read">
                                        <i class="fas fa-book-open me-1"></i>
                                        {{ __('message.read') ?? 'Read Book' }}
                                    </a>

                                    <form action="{{ route('favorites.destroy', $fav->book->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-remove-fav w-100"
                                                onclick="return confirm('{{ __('message.confirm_remove_fav') ?? 'Remove from favorites?' }}')">
                                            <i class="fas fa-heart-broken me-1"></i>
                                            {{ __('message.remove_favorite') ?? 'Remove' }}
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        @else

            {{-- ═══════════════════════════════
                 EMPTY STATE
            ═══════════════════════════════ --}}
            <div class="scroll-animate">
                <div class="empty-state-card">
                    <div class="empty-icon">💔</div>
                    <h4 class="fw-bold mb-2">{{ __('message.no_favorites') ?? 'No Favorites Yet' }}</h4>
                    <p class="text-muted mb-4" style="max-width:400px; margin:0 auto;">
                        {{ __('message.no_favorites_hint') ?? 'Start exploring books and add your favorites to build your personal library.' }}
                    </p>
                    <a href="{{ route('books.index') ?? '#' }}"
                       class="btn btn-read px-4 py-2">
                        <i class="fas fa-compass me-2"></i>
                        {{ __('message.explore_books') ?? 'Explore Books' }}
                    </a>
                </div>
            </div>

        @endif

    </div>
</div>

{{-- Rating Toast Notification --}}
<div class="rating-toast" id="ratingToast">
    <i class="fas fa-star text-warning me-2"></i>
    <span id="ratingToastText">Rating submitted!</span>
</div>

{{-- ═══════════════════════════════════════════
     SCRIPTS
═══════════════════════════════════════════ --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ═══ SCROLL ANIMATION (Intersection Observer) ═══ */
    const observerOptions = {
        root: null,
        rootMargin: '0px 0px -60px 0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.scroll-animate').forEach(el => {
        observer.observe(el);
    });

    /* ═══ STAR RATING SYSTEM ═══ */
    const ratingToast = document.getElementById('ratingToast');
    const ratingToastText = document.getElementById('ratingToastText');

    function showToast(message) {
        ratingToastText.textContent = message;
        ratingToast.classList.add('show');
        setTimeout(() => {
            ratingToast.classList.remove('show');
        }, 2500);
    }

    document.querySelectorAll('.star-rating').forEach(ratingContainer => {
        const stars = ratingContainer.querySelectorAll('.star-btn');
        const bookId = ratingContainer.dataset.book;

        stars.forEach((star, index) => {
            // Hover effect
            star.addEventListener('mouseenter', () => {
                stars.forEach((s, i) => {
                    if (i <= index) {
                        s.classList.add('active');
                    } else {
                        s.classList.remove('active');
                    }
                });
            });

            // Click to rate
            star.addEventListener('click', () => {
                const rating = star.dataset.value;

                // Visual feedback
                stars.forEach((s, i) => {
                    if (i <= index) {
                        s.classList.add('active');
                        s.style.transform = 'scale(1.4)';
                        setTimeout(() => {
                            s.style.transform = '';
                        }, 200);
                    } else {
                        s.classList.remove('active');
                    }
                });

                // Send to server
                fetch(`/books/${bookId}/rate`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ rating: rating })
                })
                .then(res => res.json())
                .then(data => {
                    showToast(`⭐ Rated ${rating} star${rating > 1 ? 's' : ''}!`);
                })
                .catch(() => {
                    showToast('❌ Rating failed. Try again.');
                });
            });
        });

        // Reset stars on mouse leave
        ratingContainer.addEventListener('mouseleave', () => {
            const currentRating = ratingContainer.querySelector('.star-btn[data-current]')?.dataset.value || 0;
            stars.forEach((s, i) => {
                const starVal = parseInt(s.dataset.value);
                if (starVal <= currentRating) {
                    s.classList.add('active');
                } else {
                    s.classList.remove('active');
                }
            });
        });
    });
});
</script>

@endsection