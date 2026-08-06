@extends('layouts.app')

@section('content')

<style>
/* ── Search ── */
.search-wrapper {
    position: relative;
    max-width: 600px;
    margin: 0 auto 3rem;
}

.search-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    background: white;
    border-radius: 10px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.12);
    z-index: 1000;
    overflow: hidden;
    border: 1px solid #eee;
}

.search-item {
    padding: 12px 16px;
    border-bottom: 1px solid #f0f0f0;
    cursor: pointer;
    transition: background .2s;
}

.search-item:last-child {
    border-bottom: none;
}

.search-item:hover {
    background: #f8f9fa;
}

.search-title {
    font-weight: 600;
    font-size: 14px;
    color: #222;
}

.search-author {
    font-size: 12px;
    color: #888;
    margin-top: 2px;
}

/* ── Book Card ── */
.book-card {
    border-radius: 14px;
    overflow: hidden;
    transition: transform .3s, box-shadow .3s;
    border: none;
}

.book-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 30px rgba(0,0,0,0.12);
}

.book-card .card-img-top {
    height: 220px;
    object-fit: cover;
}

/* ── Search Input ── */
#searchInput:focus {
    box-shadow: none;
    border-color: #86b7fe;
}

/* ── No results ── */
.empty-state {
    padding: 60px 20px;
    text-align: center;
    color: #aaa;
}

.empty-state i {
    font-size: 50px;
    margin-bottom: 15px;
    display: block;
}
</style>

<div class="container py-5">

    {{-- ── PAGE TITLE ── --}}
    <h2 class="text-center fw-bold mb-5">
        <i class="fa-solid fa-book me-2"></i>
        {{ __('dashboard.total_books') }}
    </h2>

    {{-- ── SEARCH ── --}}
    <div class="search-wrapper">
        <form action="{{ route('search.page') }}" method="GET" id="searchForm">
            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                <input
                    type="text"
                    id="searchInput"
                    class="form-control p-3 border-0"
                    name="query"
                    placeholder="{{ __('message.search_placeholder') }}"
                    autocomplete="off"
                    minlength="2">

                <button
                    class="btn btn-primary px-4"
                    type="submit"
                    id="searchBtn"
                    disabled>
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>

            <div id="searchResults" class="search-dropdown mt-1"></div>
        </form>
    </div>

    {{-- ── ADMIN PANEL BUTTON (Role Check) ── --}}
    @auth
        @if(auth()->user()->role === 'admin')
            <div class="text-end mb-4">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-danger">
                    <i class="fa-solid fa-shield-halved me-1"></i>
                    Admin Panel
                </a>
            </div>
        @endif
    @endauth

    {{-- ── BOOKS GRID ── --}}
    <div class="row g-4">

        @forelse($books as $book)

            @php
                $isFavorite = $book->favorites->contains('user_id', auth()->id());
            @endphp

            <div class="col-sm-6 col-md-4 col-lg-3">

                <div class="card book-card h-100 shadow-sm">

                    {{-- Thumbnail --}}
                    <img
                        src="{{ asset('storage/' . $book->thumbnail) }}"
                        class="card-img-top"
                        alt="{{ $book->title_en }}">

                    <div class="card-body d-flex flex-column text-center px-3 py-3">

                        {{-- Title --}}
                        <h6 class="fw-bold mb-1">
                            {{ Str::limit(
                                $book->{'title_' . app()->getLocale()} ?? $book->title_en,
                                25
                            ) }}
                        </h6>

                        {{-- Author --}}
                        <small class="text-muted mb-1">
                            <i class="fa-solid fa-user me-1"></i>
                            {{ $book->author }}
                        </small>

                        {{-- Category --}}
                        <small class="text-muted mb-3">
                            <i class="fa-solid fa-tag me-1"></i>
                            {{ $book->category->getname() }}
                        </small>

                        {{-- ── Action Buttons ── --}}
                        <div class="mt-auto d-flex gap-2">

                            {{-- Read --}}
                            <a href="{{ route('books.read', $book->id) }}"
                               class="btn btn-primary btn-sm flex-fill"
                               title="Read">
                                <i class="fa-solid fa-book-open"></i>
                            </a>

                            {{-- Favorite --}}
                            <form
                                action="{{ route('books.favorite', $book->id) }}"
                                method="POST"
                                class="flex-fill">
                                @csrf
                                <button
                                    type="submit"
                                    class="btn btn-sm w-100 {{ $isFavorite ? 'btn-warning' : 'btn-outline-danger' }}"
                                    title="{{ $isFavorite ? 'Remove Favorite' : 'Add Favorite' }}">
                                    <i class="fa-solid {{ $isFavorite ? 'fa-heart-crack' : 'fa-heart' }}"></i>
                                </button>
                            </form>

                            {{-- Download --}}
                            <a href="{{ route('books.download', $book->id) }}"
                               class="btn btn-success btn-sm flex-fill"
                               title="Download">
                                <i class="fa-solid fa-download"></i>
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">
                <div class="empty-state">
                    <i class="fa-solid fa-book-open"></i>
                    <h5 class="text-muted">No books found.</h5>
                </div>
            </div>

        @endforelse

    </div>

    {{-- ── Pagination ── --}}
    <div class="mt-5 d-flex justify-content-center">
        {{ $books->links() }}
    </div>

</div>

@include('footer.footer')

<script>
document.addEventListener('DOMContentLoaded', function () {

    const input     = document.getElementById('searchInput');
    const results   = document.getElementById('searchResults');
    const searchBtn = document.getElementById('searchBtn');
    const form      = document.getElementById('searchForm');

    // ── 1. Enable / Disable search button ──────────────────────────
    input.addEventListener('input', function () {
        const val = input.value.trim();

        // Enable button only when 2+ chars
        searchBtn.disabled = val.length < 2;

        // Clear dropdown if input is too short
        if (val.length < 2) {
            results.innerHTML = '';
        }
    });

    // ── 2. Block form submit if empty ──────────────────────────────
    form.addEventListener('submit', function (e) {
        if (input.value.trim().length < 2) {
            e.preventDefault();
        }
    });

    // ── 3. Close dropdown on outside click ────────────────────────
    document.addEventListener('click', function (e) {
        if (!input.contains(e.target) && !results.contains(e.target)) {
            results.innerHTML = '';
        }
    });

    // ── 4. Live search dropdown ────────────────────────────────────
    let timeout;

    input.addEventListener('keyup', function () {
        clearTimeout(timeout);

        const query = input.value.trim();

        if (query.length < 2) {
            results.innerHTML = '';
            return;
        }

        timeout = setTimeout(() => {

            fetch(`/search-books?query=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(data => {

                    if (data.length === 0) {
                        results.innerHTML = `
                            <div class="search-item text-muted">
                                <i class="fa-solid fa-circle-xmark me-2"></i>
                                No results found.
                            </div>`;
                        return;
                    }

                    results.innerHTML = data.map(book => `
                        <div class="search-item">
                            <a href="/books/${book.id}"
                               style="text-decoration:none;color:inherit;">
                                <div class="search-title">${escapeHtml(book.title)}</div>
                                <div class="search-author">
                                    <i class="fa-solid fa-user me-1"></i>
                                    ${escapeHtml(book.author)}
                                </div>
                            </a>
                        </div>
                    `).join('');

                })
                .catch(() => {
                    results.innerHTML = `
                        <div class="search-item text-danger">
                            <i class="fa-solid fa-triangle-exclamation me-2"></i>
                            Something went wrong.
                        </div>`;
                });

        }, 300);
    });

    // ── 5. Escape HTML to prevent XSS ─────────────────────────────
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.appendChild(document.createTextNode(text));
        return div.innerHTML;
    }

});
</script>

@endsection