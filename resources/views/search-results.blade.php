@extends('layouts.app')

@section('content')

<style>
/* ── Hero Search Banner ── */
.search-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 50px 0 40px;
    margin-bottom: 50px;
    color: white;
}

.search-hero h2 {
    font-size: 2rem;
    font-weight: 700;
}

.search-hero p {
    opacity: 0.85;
    font-size: 1rem;
}

.search-badge {
    background: rgba(255,255,255,0.2);
    border: 1px solid rgba(255,255,255,0.35);
    color: white;
    padding: 5px 16px;
    border-radius: 50px;
    font-size: 14px;
    display: inline-block;
    margin-top: 10px;
    backdrop-filter: blur(6px);
}

/* ── Re-search bar ── */
.re-search-form .input-group {
    max-width: 520px;
    margin: 0 auto;
    border-radius: 50px;
    overflow: hidden;
    box-shadow: 0 6px 25px rgba(0,0,0,0.15);
}

.re-search-form input {
    border: none;
    padding: 14px 20px;
    font-size: 15px;
}

.re-search-form input:focus {
    box-shadow: none;
}

.re-search-form button {
    padding: 0 28px;
    border-radius: 0;
    font-size: 15px;
}

/* ── Book Card ── */
.book-card-wrap {
    border-radius: 16px;
    overflow: hidden;
    transition: transform .3s ease, box-shadow .3s ease;
    background: white;
    box-shadow: 0 4px 15px rgba(0,0,0,0.07);
    height: 100%;
    border: none;
}

.book-card-wrap:hover {
    transform: translateY(-8px);
    box-shadow: 0 16px 35px rgba(0,0,0,0.13);
}

.book-cover-wrap {
    position: relative;
    overflow: hidden;
    height: 220px;
}

.book-cover-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .4s ease;
}

.book-card-wrap:hover .book-cover-wrap img {
    transform: scale(1.06);
}

/* Overlay on hover */
.book-overlay {
    position: absolute;
    inset: 0;
    background: rgba(102, 126, 234, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity .3s ease;
}

.book-card-wrap:hover .book-overlay {
    opacity: 1;
}

.book-overlay span {
    color: white;
    font-weight: 600;
    font-size: 15px;
    border: 2px solid white;
    padding: 8px 22px;
    border-radius: 50px;
    letter-spacing: 0.5px;
}

/* Card Body */
.book-card-body {
    padding: 16px;
    text-align: center;
}

.book-title {
    font-weight: 700;
    font-size: 15px;
    color: #222;
    margin-bottom: 5px;
}

.book-author {
    font-size: 13px;
    color: #999;
    margin-bottom: 12px;
}

.book-author i {
    margin-right: 4px;
}

.btn-view {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border: none;
    border-radius: 50px;
    padding: 8px 0;
    font-size: 13px;
    font-weight: 600;
    width: 100%;
    transition: opacity .25s;
}

.btn-view:hover {
    opacity: 0.88;
    color: white;
}

/* ── Empty State ── */
.empty-state {
    text-align: center;
    padding: 80px 20px;
}

.empty-icon {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    background: linear-gradient(135deg, #f5f7fa, #e8ecf1);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px;
    font-size: 45px;
    color: #b0b8c1;
}

.empty-state h4 {
    font-weight: 700;
    color: #333;
    margin-bottom: 10px;
}

.empty-state p {
    color: #aaa;
    font-size: 15px;
    max-width: 380px;
    margin: 0 auto 25px;
}

.btn-go-home {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border: none;
    border-radius: 50px;
    padding: 11px 32px;
    font-weight: 600;
    font-size: 14px;
    transition: opacity .25s;
    text-decoration: none;
    display: inline-block;
}

.btn-go-home:hover {
    opacity: 0.88;
    color: white;
}

/* ── Results Count ── */
.results-meta {
    font-size: 14px;
    color: #888;
    margin-bottom: 28px;
}

.results-meta span {
    color: #667eea;
    font-weight: 700;
}
</style>

{{-- ── SEARCH HERO BANNER ── --}}
<div class="search-hero">
    <div class="container text-center">
        <p class="mb-2 opacity-75 text-uppercase fw-semibold" style="letter-spacing:1px;font-size:13px;">
            <i class="fa-solid fa-magnifying-glass me-1"></i>
            {{ __('message.search_result') }}
        </p>

        <h2 class="mb-0">
            "{{ $query }}"
        </h2>

        @if($books->count() > 0)
            <div class="search-badge mt-3">
                <i class="fa-solid fa-book me-1"></i>
                {{ $books->total() }} {{ __('message.books_found') ?? 'Books Found' }}
            </div>
        @endif

        {{-- Re-search inside hero --}}
        <div class="re-search-form mt-4">
            <form action="{{ route('search.page') }}" method="GET">
                <div class="input-group">
                    <input
                        type="text"
                        name="query"
                        class="form-control"
                        value="{{ $query }}"
                        placeholder="{{ __('message.search_placeholder') }}"
                        autocomplete="off"
                        id="heroSearch">
                    <button class="btn btn-dark" type="submit" id="heroSearchBtn">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

{{-- ── MAIN CONTENT ── --}}
<div class="container pb-5">

    @if($books->count() > 0)

        {{-- Results Meta --}}
        <p class="results-meta">
            {{ __('Showing') }}
            <span>{{ $books->firstItem() }}–{{ $books->lastItem() }}</span>
            {{ __('of') }}
            <span>{{ $books->total() }}</span>
            {{ __('results for') }}
            "<strong>{{ $query }}</strong>"
        </p>

        {{-- ── BOOKS GRID ── --}}
        <div class="row g-4">

            @foreach($books as $book)

                <div class="col-6 col-md-3"
                     data-aos="fade-up"
                     data-aos-delay="{{ ($loop->index % 4) * 100 }}">

                    {{-- Single card for both guest & auth (cleaner) --}}
                    <a href="{{ route('books.show', $book->id) }}"
                       class="text-decoration-none">

                        <div class="book-card-wrap">

                            {{-- Cover + Overlay --}}
                            <div class="book-cover-wrap">
                                <img
                                    src="{{ asset('storage/' . $book->thumbnail) }}"
                                    alt="{{ $book->getTitleAttribute() }}"
                                    loading="lazy">

                                <div class="book-overlay">
                                    <span>
                                        <i class="fa-solid fa-eye me-2"></i>
                                        {{ __('message.view') }}
                                    </span>
                                </div>
                            </div>

                            {{-- Body --}}
                            <div class="book-card-body">

                                <div class="book-title">
                                    {{ Str::limit($book->getTitleAttribute(), 20, '...') }}
                                </div>

                                <div class="book-author">
                                    <i class="fa-solid fa-user"></i>
                                    {{ $book->author }}
                                </div>

                                @if($book->category)
                                    <span class="badge rounded-pill mb-3"
                                          style="background:rgba(102,126,234,0.12);
                                                 color:#667eea;
                                                 font-size:11px;">
                                        <i class="fa-solid fa-tag me-1"></i>
                                        {{ $book->category->getname() }}
                                    </span>
                                @endif

                                <a href="{{ route('books.show', $book->id) }}"
                                   class="btn-view d-block mt-2">
                                    <i class="fa-solid fa-book-open me-1"></i>
                                    {{ __('message.view') }}
                                </a>

                            </div>

                        </div>

                    </a>

                </div>

            @endforeach

        </div>

        {{-- ── Pagination ── --}}
        <div class="mt-5 d-flex justify-content-center">
            {{ $books->appends(['query' => $query])->links() }}
        </div>

    @else

        {{-- ── EMPTY STATE ── --}}
        <div class="empty-state" data-aos="fade-up">

            <div class="empty-icon">
                <i class="fa-solid fa-book-open"></i>
            </div>

            <h4>{{ __('No Results Found') }}</h4>

            <p>
                {{ __('We couldn\'t find any books matching') }}
                "<strong>{{ $query }}</strong>".
                {{ __('Try different keywords.') }}
            </p>

            {{-- Suggestions --}}
            <div class="mb-4">
                <p class="text-muted fw-semibold mb-2" style="font-size:13px;">
                    {{ __('Suggestions') }}:
                </p>
                <ul class="list-unstyled text-muted" style="font-size:13px;">
                    <li><i class="fa-solid fa-circle-dot me-2 text-primary" style="font-size:8px;"></i>{{ __('Check your spelling') }}</li>
                    <li><i class="fa-solid fa-circle-dot me-2 text-primary" style="font-size:8px;"></i>{{ __('Try more general keywords') }}</li>
                    <li><i class="fa-solid fa-circle-dot me-2 text-primary" style="font-size:8px;"></i>{{ __('Search by author name') }}</li>
                </ul>
            </div>

            <a href="{{ route('home') }}" class="btn-go-home">
                <i class="fa-solid fa-house me-2"></i>
                {{ __('Back to Home') }}
            </a>

        </div>

    @endif

</div>

@include('footer.footer')

<script>
// Disable search button if input empty
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('heroSearch');
    const btn   = document.getElementById('heroSearchBtn');

    function toggle() {
        btn.disabled = input.value.trim().length < 2;
    }

    toggle(); // run on load
    input.addEventListener('input', toggle);

    // Block form submit
    input.closest('form').addEventListener('submit', function (e) {
        if (input.value.trim().length < 2) e.preventDefault();
    });
});
</script>

@endsection