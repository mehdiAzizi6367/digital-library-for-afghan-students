@extends('layouts.app')

@section('content')

<style>
.search-dropdown{
    position:absolute;
    top:100%;
    left:0;
    width:100%;
    background:white;
    border-radius:10px;
    box-shadow:0 6px 20px rgba(0,0,0,0.1);
    z-index:1000;
    overflow:hidden;
}

.search-item{
    padding:12px 15px;
    border-bottom:1px solid #eee;
    cursor:pointer;
    transition:0.2s;
}
.search-item:hover{ background:#f8f9fa; }

.search-title{ font-weight:600; }
.search-author{ font-size:13px; color:gray; }

/* Card */
.book-card{
    border-radius:12px;
    overflow:hidden;
    transition:0.3s;
}
.book-card:hover{
    transform:translateY(-6px);
    box-shadow:0 12px 25px rgba(0,0,0,0.15);
}

/* Stars */
.star{
    cursor:pointer;
    font-size:18px;
    color:#ccc;
    transition:0.2s;
}

.star:hover{
    transform:scale(1.2);
    color:gold;
}

.star.active{
    color:gold;
}
</style>

<div class="container py-5">

    <h2 class="text-center fw-bold mb-5">
        <i class="fa-solid fa-book"></i> {{ __('dashboard.total_books') }}
    </h2>

    {{-- SEARCH --}}
    <div class="col-md-6 position-relative mx-auto mb-5">
        <form action="/search" method="GET">
            <div class="input-group">
                <input type="text" id="searchInput"
                    class="form-control p-3"
                    name="query"
                    placeholder="{{ __('message.search_placeholder') }}"
                    autocomplete="off">

                <button class="btn btn-primary">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>

            <div id="searchResults" class="search-dropdown"></div>
        </form>
    </div>

    {{-- BOOKS --}}
    <div class="row g-4">

    @forelse ($books as $book)

        @php
            $avg = round($book->ratings->avg('rating'), 1);
            $userRating = $book->ratings->first()->rating ?? 0;
            $isFavorite = $book->favorites->where('user_id', auth()->id())->count();
        @endphp

        <div class="col-md-3">
            <div class="card book-card h-100 shadow-sm border-0">

                {{-- IMAGE --}}
                <img src="{{ asset('storage/'.$book->thumbnail) }}"
                     class="card-img-top"
                     style="height:200px; object-fit:cover;">

                <div class="card-body d-flex flex-column text-center">

                    {{-- ⭐ RATING (RESTORED + AJAX) --}}
                    <div class="rating mb-2"
                         data-book="{{ $book->id }}"
                         data-rating="{{ $userRating }}">

                        @for($i=1; $i<=5; $i++)
                            <i class="fa-star star fa
                                {{ $i <= $userRating ? 'fa-solid active' : 'fa-regular' }}"
                                data-value="{{ $i }}"></i>
                        @endfor

                    </div>

                    <small class="text-muted mb-2">
                        ⭐ {{ $avg ?? 0 }}
                    </small>

                    {{-- TITLE --}}
                    <h6 class="fw-bold">
                        {{ Str::limit($book->{'title_' . app()->getLocale()} ?? $book->title_en, 25) }}
                    </h6>

                    {{-- AUTHOR --}}
                    <small class="text-muted">
                        <i class="fa-solid fa-user"></i> {{ $book->author }}
                    </small>

                    {{-- CATEGORY --}}
                    <small class="text-muted mb-2">
                        <i class="fa-solid fa-tag"></i> {{ $book->category->getname() }}
                    </small>

                    {{-- BUTTONS --}}
                    <div class="mt-auto d-flex gap-2">

                        <a href="{{ route('books.read',$book->id) }}"
                           class="btn btn-primary btn-sm w-100">
                            <i class="fa-solid fa-book-open"></i>
                        </a>

                        <form action="{{ route('books.favorite', $book->id) }}"
                              method="POST" class="w-100">
                            @csrf
                            <button class="btn btn-sm w-100 {{ $isFavorite ? 'btn-warning' : 'btn-danger' }}">
                                <i class="fa-solid {{ $isFavorite ? 'fa-heart-crack' : 'fa-heart' }}"></i>
                            </button>
                        </form>

                        <a href="{{ route('books.download', $book->id) }}"
                           class="btn btn-success btn-sm w-100">
                            <i class="fa-solid fa-download"></i>
                        </a>

                    </div>

                </div>
            </div>
        </div>

    @empty
        <p class="text-center">No books found.</p>
    @endforelse

    </div>

    {{-- PAGINATION --}}
    <div class="mt-4">
        {{ $books->links() }}
    </div>

</div>

@include('footer.footer')

{{-- SCRIPTS --}}
<script>

// SEARCH
const input = document.getElementById("searchInput");
const results = document.getElementById("searchResults");

document.addEventListener("click", function(e){
    if(!input.contains(e.target) && !results.contains(e.target)){
        results.innerHTML = "";
    }
});

let timeout;
input.addEventListener("keyup", function(){

    clearTimeout(timeout);

    timeout = setTimeout(() => {

        let query = input.value;

        if(query.length < 2){
            results.innerHTML = "";
            return;
        }

        fetch(`/search-books?query=` + encodeURIComponent(query))
        .then(res => res.json())
        .then(data => {

            let html = "";

            if(data.length === 0){
                html = `<div class="search-item">No results</div>`;
            }

            data.forEach(book => {
                html += `
                <div class="search-item">
                    <a href="/books/${book.id}" style="text-decoration:none;color:black;">
                        <div class="search-title">${book.title}</div>
                        <div class="search-author">${book.author}</div>
                    </a>
                </div>`;
            });

            results.innerHTML = html;
        });

    }, 300);
});


// ⭐ RATING SYSTEM (FIXED + AJAX + PERSISTENCE)

document.querySelectorAll('.rating').forEach(box => {

    const stars = box.querySelectorAll('.star');
    let currentRating = box.dataset.rating;
    const bookId = box.dataset.book;

    // RESTORE ON LOAD
    stars.forEach(star => {
        let val = star.dataset.value;

        if(val <= currentRating){
            star.classList.add('fa-solid','active');
            star.classList.remove('fa-regular');
        }
    });

    // CLICK EVENT
    stars.forEach(star => {
        star.addEventListener('click', function(){

            let rating = this.dataset.value;

            fetch(`/books/${bookId}/rate`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ rating })
            });

            // UI UPDATE
            stars.forEach(s => {
                let val = s.dataset.value;

                if(val <= rating){
                    s.classList.add('fa-solid','active');
                    s.classList.remove('fa-regular');
                } else {
                    s.classList.add('fa-regular');
                    s.classList.remove('fa-solid','active');
                }
            });

            box.dataset.rating = rating;

        });
    });

});

</script>

@endsection