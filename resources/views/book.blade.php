@extends('layouts.app') 

@section('content') 
<style>
    /* Global Overrides & Smoothness */
    body {
        background-color: #f8fafc;
        color: #334155;
    }

    /* Modern Dropdown Search */
    .search-dropdown {
        position: absolute;
        top: calc(100% + 8px);
        left: 0;
        width: 100%;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 12px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        overflow: hidden;
        border: 1px solid rgba(226, 232, 240, 0.8);
    }
    
    .search-item {
        padding: 14px 20px;
        border-bottom: 1px solid #f1f5f9;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .search-item:last-child {
        border-bottom: none;
    }
    
    .search-item:hover {
        background: #f1f5f9;
        padding-left: 24px;
    }
    
    .search-title {
        font-weight: 600;
        color: #1e293b;
        font-size: 15px;
    }
    
    .search-author {
        font-size: 13px;
        color: #64748b;
        margin-top: 2px;
    }

    /* Enhanced Premium Cards */
    .book-card {
        border-radius: 16px;
        overflow: hidden;
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease;
        background: #ffffff;
        border: 1px solid #e2e8f0 !important;
    }
    
    .book-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;
    }

    .image-container {
        position: relative;
        overflow: hidden;
        border-radius: 16px 16px 0 0;
    }

    .book-card img {
        transition: transform 0.5s ease;
    }

    .book-card:hover img {
        transform: scale(1.05);
    }

    /* Average Rating Badge */
    .avg-rating-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(4px);
        padding: 4px 10px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 13px;
        color: #eab308;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* Interactive Buttons */
    .btn-action {
        border-radius: 10px;
        padding: 8px 12px;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .btn-action:hover {
        transform: translateY(-1px);
    }
</style>

<div class="container py-5">
    <!-- Header Title -->
    <h2 class="text-center fw-extrabold text-dark mb-4 d-flex align-items-center justify-content-center gap-3">
        <i class="fa-solid fa-book text-primary"></i> 
        <span>{{ __('dashboard.total_books') }}</span>
    </h2>

    {{-- SEARCH BAR --}}
    <div class="col-md-6 position-relative mx-auto mb-5">
        <form action="/search" method="GET">
            <div class="input-group shadow-sm rounded-3 overflow-hidden border">
                <input type="text" id="searchInput" class="form-control border-0 p-3 bg-white" name="query" placeholder="{{ __('message.search_placeholder') }}" autocomplete="off" style="box-shadow: none;">
                <button class="btn btn-primary px-4">
                    <i class="fa-solid fa-magnifying-glass fs-5"></i>
                </button>
            </div>
            <div id="searchResults" class="search-dropdown" style="display: none;"></div>
        </form>
    </div>

    {{-- BOOKS GRID --}}
    <div class="row g-4">
        @forelse ($books as $book)
            @php
                $avg = round($book->ratings->avg('rating'), 1);
                $isFavorite = $book->favorites->where('user_id', auth()->id())->count();
            @endphp
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card book-card h-100 shadow-sm border-0">
                    
                    {{-- IMAGE & BADGE --}}
                    <div class="image-container">
                        <img src="{{ asset('storage/'.$book->thumbnail) }}" class="card-img-top" style="height:240px; object-fit:cover;" alt="Book Thumbnail">
                        <div class="avg-rating-badge">
                            <i class="fa-solid fa-star"></i> {{ $avg ?: '0.0' }}
                        </div>
                    </div>

                    <div class="card-body d-flex flex-column p-4">
                        {{-- CATEGORY --}}
                        <div class="mb-2">
                            <span class="badge bg-light text-primary border px-2 py-1d-inline-flex align-items-center gap-1">
                                <i class="fa-solid fa-tag"></i> {{ $book->category->getname() }}
                            </span>
                        </div>

                        {{-- TITLE --}}
                        <h5 class="fw-bold text-dark mb-1 text-truncate" title="{{ $book->{'title_' . app()->getLocale()} ?? $book->title_en }}">
                            {{ Str::limit($book->{'title_' . app()->getLocale()} ?? $book->title_en, 22) }}
                        </h5>

                        {{-- AUTHOR --}}
                        <p class="text-muted small mb-4">
                            <i class="fa-solid fa-user-feather me-1"></i> {{ $book->author }}
                        </p>

                        {{-- ACTION BUTTONS --}}
                        <div class="mt-auto d-flex gap-2">
                            <!-- Read Button -->
                            <a href="{{ route('books.read', $book->id) }}" class="btn btn-primary btn-action w-100 d-flex align-items-center justify-content-center" title="Read Book">
                                <i class="fa-solid fa-book-open"></i>
                            </a>
                            
                            <!-- Favorite Button -->
                            <form action="{{ route('books.favorite', $book->id) }}" method="POST" class="w-100">
                                @csrf
                                <button class="btn btn-action w-100 d-flex align-items-center justify-content-center {{ $isFavorite ? 'btn-warning text-white' : 'btn-outline-danger' }}">
                                    <i class="fa-solid {{ $isFavorite ? 'fa-heart-crack' : 'fa-heart' }}"></i>
                                </button>
                            </form>
                            
                            <!-- Download Button -->
                            <a href="{{ route('books.download', $book->id) }}" class="btn btn-success btn-action w-100 d-flex align-items-center justify-content-center" title="Download Book">
                                <i class="fa-solid fa-download"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 py-5 text-center">
                <div class="text-muted mb-3"><i class="fa-regular fa-folder-open fs-1"></i></div>
                <p class="text-secondary fw-medium">No books found.</p>
            </div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    <div class="d-flex justify-content-center mt-5">
        {{ $books->links() }}
    </div>
</div>

@include('footer.footer')

{{-- SCRIPTS --}}
<script>
    // SEARCH BAR FUNCTIONALITY
    const input = document.getElementById("searchInput");
    const results = document.getElementById("searchResults");

    document.addEventListener("click", function(e) {
        if (!input.contains(e.target) && !results.contains(e.target)) {
            results.style.display = "none";
            results.innerHTML = "";
        }
    });

    let timeout;
    input.addEventListener("keyup", function() {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            let query = input.value;
            if (query.length < 2) {
                results.style.display = "none";
                results.innerHTML = "";
                return;
            }
            
            fetch(`/search-books?query=` + encodeURIComponent(query))
                .then(res => res.json())
                .then(data => {
                    let html = "";
                    results.style.display = "block";
                    
                    if (data.length === 0) {
                        html = `<div class="search-item text-center text-muted">No results found</div>`;
                    } else {
                        data.forEach(book => {
                            html += `
                                <div class="search-item">
                                    <a href="/books/${book.id}" style="text-decoration:none; display:block;">
                                        <div class="search-title">${book.title}</div>
                                        <div class="search-author"><i class="fa-solid fa-user fa-sm me-1"></i> ${book.author}</div>
                                    </a>
                                </div>`;
                        });
                    }
                    results.innerHTML = html;
                });
        }, 300);
    });
</script>
@endsection
