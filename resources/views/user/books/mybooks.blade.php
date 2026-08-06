@extends('layouts.user')

@section('title', __('dashboard.my_books'))

@section('content')

<style>
    /* ═════════════════════════════════════════
       PAGE BACKGROUND
    ═════════════════════════════════════════ */
 
    /* ── Favorite Badge (Top Corner) ── */
    .favorite-badge {
        position: absolute;
        top: 12px;
        {{ in_array(app()->getLocale(), ['ps','dr','fa','ar']) ? 'left' : 'right' }}: 12px;
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(6px);
        color: #ef4444;
        width: 32px; height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 3;
    }

    /* ═════════════════════════════════════════
       TOAST NOTIFICATION
    ═════════════════════════════════════════ */
    .toast-notification {
        position: fixed;
        bottom: 30px;
        {{ in_array(app()->getLocale(), ['ps','dr','fa','ar']) ? 'left' : 'right' }}: 30px;
        background: linear-gradient(135deg, #10b981, #059669);
        color: #fff;
        padding: 12px 20px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        display: flex;
        align-items: center;
        gap: 10px;
        transform: translateY(80px);
        opacity: 0;
        transition: all 0.3s ease;
        z-index: 9999;
        font-weight: 600;
        font-size: 14px;
    }
    
    .book-card-modern {
    transition: all 0.25s ease;
    background: #fff;
}

.book-card-modern:hover {
    transform: translateY(-6px);
    box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.08) !important;
}

.book-title {
    min-height: 48px;
    line-height: 1.4;
}

.title-link:hover {
    color: #0d6efd !important;
}

.favorite-toggle {
    width: 42px;
    height: 42px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 0;
}

.favorite-toggle.btn-light {
    background: rgba(255, 255, 255, 0.95);
}

.favorite-toggle.btn-danger {
    background: #dc3545;
}
 
</style>

{{-- CSRF Meta for JS --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="books-page py-4 py-md-5">
    <div class="container">
        {{-- ═══════════════════════════════
             PAGE HEADER
        ═══════════════════════════════ --}}
        <div class="page-header" style="background-color: blue;">
            <div class="header-content text-center text-md-start">
                <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">

                    <div>
                        <div class="header-icon">
                            <i class="fas fa-book-reader text-white" style="font-size:26px;"></i>
                        </div>
                        <h2 class="fw-bold mb-1">{{ __('dashboard.my_books') }}</h2>
                        <p class="mb-0 opacity-75 small">
                            {{ __('dashboard.my_books_hint') }}
                        </p>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('user.books.create') }}"
                           class="btn btn-light rounded-3 fw-semibold px-3 py-2">
                            <i class="fas fa-plus me-1"></i>
                            {{ __('dashboard.add_record') }}
                        </a>
                    </div>

                </div>
            </div>
        </div>

        {{-- ═══════════════════════════════
             BOOKS GRID
        ═══════════════════════════════ --}}
       @if($books->count())
    <div class="row g-4">

        @foreach($books as $book)
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="card book-card-modern h-100 border-0 shadow-sm rounded-4 overflow-hidden">

                    {{-- Cover --}}
                    <div class="position-relative">
                        <a href="{{ route('books.read', $book->id) }}" class="d-block text-decoration-none bg-light" style="aspect-ratio: 3 / 4;">
                            @if($book->thumbnail)
                                <img src="{{ asset('/storage/'.$book->thumbnail) }}"
                                     alt="{{ $book->getTitleAttribute() }}"
                                     class="w-100 h-100"
                                     style="object-fit: cover;">
                            @else
                                <div class="d-flex align-items-center justify-content-center h-100 text-muted">
                                    <i class="fas fa-book" style="font-size: 60px; opacity: 0.25;"></i>
                                </div>
                            @endif
                        </a>

                        {{-- Favorite Toggle --}}
                        <form action="{{ route('books.favorite', $book->id) }}"
                              method="POST"
                              class="position-absolute top-0 end-0 p-3 m-0">
                            @csrf
                            <button type="submit"
                                    class="btn btn-sm rounded-circle shadow-sm favorite-toggle {{ $book->is_favorite ? 'btn-danger text-white' : 'btn-light text-danger' }}"
                                    title="{{ $book->is_favorite ? __('message.remove_favorite') : __('message.add_favorite') }}"
                                    aria-label="{{ $book->is_favorite ? __('message.remove_favorite') : __('message.add_favorite') }}">
                                <i class="fas {{ $book->is_favorite ? 'fa-heart-broken' : 'fa-heart' }}"></i>
                            </button>
                        </form>
                    </div>

                    {{-- Body --}}
                    <div class="card-body d-flex flex-column p-3">
                        <h5 class="book-title fw-semibold text-dark mb-2">
                            <a href="{{ route('books.read', $book->id) }}"
                               class="text-decoration-none text-dark title-link">
                                {{ Str::limit($book->getTitleAttribute(), 55) }}
                            </a>
                        </h5>

                        <p class="text-muted small mb-3">
                            <i class="fas fa-user-edit me-1"></i>
                            {{ $book->author ?? __('message.unknown_author') }}
                        </p>

                        <div class="mt-auto d-grid gap-2">
                            <a href="{{ route('books.read', $book->id) }}"
                               class="btn btn-primary rounded-3 fw-semibold">
                                <i class="fas fa-book-open me-1"></i>
                                {{ __('message.read') }}
                            </a>

                            <a href="{{ route('books.download', $book->id) }}"
                               class="btn btn-outline-secondary rounded-3 fw-semibold">
                                <i class="fas fa-download me-1"></i>
                                {{ __('dashboard.downloads') }}
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach

    </div>

    @if(method_exists($books, 'links'))
        <div class="mt-4 d-flex justify-content-center">
            {{ $books->links() }}
        </div>
    @endif
@else
    <div class="text-center py-5 px-3 rounded-4 border bg-light-subtle">
        <div class="mb-3">
            <i class="fas fa-book text-muted" style="font-size: 60px; opacity: 0.4;"></i>
        </div>
        <h4 class="fw-bold text-dark">{{ __('message.no_books_yet') }}</h4>
        <p class="text-muted mb-4">{{ __('message.no_books_hint') }}</p>
        <a href="{{ route('user.books.create') }}"
           class="btn btn-primary rounded-3 fw-semibold px-4 py-2">
            <i class="fas fa-plus me-1"></i>
            {{ __('dashboard.add_book') }}
        </a>
    </div>
@endif

    </div>
</div>

{{-- ═══════════════════════════════
     TOAST NOTIFICATION
═══════════════════════════════ --}}
<div id="toastNotification" class="toast-notification">
    <i class="fas fa-check-circle"></i>
    <span id="toastMessage">{{ __('message.rating_submitted') }}</span>
</div>

@endsection