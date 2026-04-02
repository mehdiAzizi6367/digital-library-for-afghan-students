<style>
.search-dropdown{
    position:absolute;
    top:100%;
    left:0;
    width:100%;
    background:white;
    border-radius:8px;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
    z-index:1000;
    overflow:hidden;
}

.search-item{
    padding:12px 15px;
    border-bottom:1px solid #eee;
    cursor:pointer;
}

.search-item:hover{
    background:#f8f9fa;
}

.search-title{
    font-weight:bold;
}

.search-author{
    font-size:13px;
    color:gray;
}
.card:hover {
    transform: translateY(-5px);
    transition: 0.3s;
}
.star {
   cursor: pointer;
   font-size: 20px;
}
.star:hover {
    transform: scale(1.2);
}
</style>
@extends('layouts.app')
@section('content')
<div class="container py-5">
    <h2 class="text-center fw-bold mb-5">{{ __('dashboard.total_books') }}</h2>
    {{-- Search form --}}
   <div class="col-md-12 position-relative mx-auto mt-4" style="margin-bottom: 100px;">
        <form action="/search" method="GET">
            <div class="col-md-6 position-relative mx-auto mt-4">
                <div class="input-group">
                    <input type="text"   id="searchInput" placeholder="{{ __('message.search_placeholder') }}"  name="query" autocomplete="off"  class="form-control p-3">
                    <button class="btn btn-primary" style="border-radius:10px;" >{{ __('message.search') }}</button>
                </div>
                <!-- Suggestions -->
                <div id="searchResults" class="search-dropdown"></div>
            </div>
        </form>
    </div>
    {{-- Books grid --}}
    <div class="row g-4">
       @forelse ($books as $book)
        <div class="col-md-3">
             <div class="card shadow-sm h-100 d-flex flex-column">

            <!-- Fixed Image -->
            <img src="{{ asset('storage/'.$book->thumbnail) }}" 
                    class="card-img-top"
                    style="height:200px; object-fit:cover;">

            <div class="card-body text-center d-flex flex-column">
                    <div class="rating" data-book="{{$book->id }}">
                     <span class="star" data-value="1">⭐</span>
                     <span class="star" data-value="2">⭐</span>
                     <span class="star" data-value="3">⭐</span>
                     <span class="star" data-value="4">⭐</span>
                     <span class="star" data-value="5">⭐</span>
                </div>
             <!-- count rating -->
            @php
                $avg = round($book->ratings->avg('rating'), 1);
            @endphp
            <p>Ratted:{{ $avg ?? 'No rating yet' }} {{ ($avg>1)?'times': 'time' }}</p>
            <!-- Title (fixed height) -->
              <h5 class="card-title h4" style="min-height:30px;">
                  {{ Str::limit($book->{'title_' . app()->getLocale()} ?? $book->title_en,20) }}
                 </h5>

                <!-- Author -->
                <p class="text-muted">
                     <small>Author: {{ $book->author }}</small>
                </p>

                <!-- Push buttons to bottom -->
                <div class="mt-auto">

                    <a href="{{ route('books.read',$book->id) }}" 
                        class="btn btn-primary w-100 mb-2">
                        Read More
                    </a>

                    @php
                        $isFavorite = \App\Models\Favorite::where('user_id', auth()->id())
                            ->where('book_id', $book->id)
                            ->exists();
                    @endphp

                    <form action="{{ route('books.favorite', $book->id) }}" method="POST">
                        @csrf
                        <button type="submit" 
                            class="btn {{ $isFavorite ? 'btn-warning' : 'btn-danger' }} w-100 mb-2">
                            {{ $isFavorite ? '💔 Remove Favorite' : '❤️ Add Favorite' }}
                        </button>
                    </form>

                    <a href="{{ route('books.download', $book->id) }}" 
                        class="btn btn-success w-100">
                      {{ __('dashboard.downloads') }}
                    </a>

                </div>
            </div>
             </div>
        </div>
        @empty
            <p class="text-center">No books found.</p>
        @endforelse 
    </div>
    {{-- Pagination --}}
    <div class="mt-4">
        {{ $books->links() }}
    </div>
</div>
{{-- footer inlcude --}}
 @include('footer.footer')
<script src="{{ asset('bootstrap.bundle.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  {{-- Ajax  --}}
<script>
    const input = document.getElementById("searchInput");
    const results = document.getElementById("searchResults");
    document.addEventListener("click", function(e) {
    if (!input.contains(e.target) && !results.contains(e.target)) {
        results.innerHTML = "";
    }
    });
    input.addEventListener("keyup", function(){
    let query = this.value;
    if(query.length < 2){
        results.innerHTML = "";
       return ;
    }
    fetch(`/search-books?query=` + encodeURIComponent(query))
    .then(res => res.json())
    .then(data => {
        let html = "";
        if(data.length === 0){
            html = `<div class="search-item">No results found</div>`;
        }
        data.forEach(book => {
            html += `
            <div class="search-item">
                <a href="/books/${book.id}" style="text-decoration:none;color:black;">
                    <div class="search-title">${book.title}</div>
                    <div class="search-author">${book.author}</div>
                </a>
            </div>
            `;
        });
        results.innerHTML = html;
    });
});

  // ratting js
    document.querySelectorAll('.rating .star').forEach(star => {
    star.addEventListener('click', function () {
        let rating = this.dataset.value;
        let bookId = this.parentElement.dataset.book;
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
            alert('Rating submitted ⭐');
        });

    });

});

</script>
@endsection 