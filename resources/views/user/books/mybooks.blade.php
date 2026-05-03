@extends('layouts.app')
<style>
     .card:hover {
    transform: translateY(-5px);
    transition: 0.3s;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}
.star {
   cursor: pointer;
   font-size: 20px;
}
.star:hover {
    transform: scale(1.2);
}
</style>
@section('content')
 <div class="container py-5">
    <h2 class="fw-bold mb-4 text-center">{{ __('dashboard.my_books') }}</h2>
    <div class="row g-4">
    @foreach($books as $book)
    <div class="col-md-3">
        <div class="card shadow-sm h-100 d-flex flex-column">
            <!-- Fixed Image -->
            <img src="{{ asset('/storage/'.$book->thumbnail) }}" class="card-img-top"
                style="height:200px; object-fit:cover; object-position:center;">
            <div class="card-body text-center d-flex flex-column">
                <div class="rating" data-book="{{ $book->id }}">
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
                <!-- Title -->
                <h5 class="card-title h4" style="min-height:50px;">
                    {{ Str::limit($book->getTitleAttribute(), 40) }}
                </h5>
                <!-- Author -->
                <p class="text-muted mb-2">
                    {{ $book->author }}
                </p>
                <!-- Buttons -->
                <div class="mt-auto">
                    <a href="{{ route('books.read',$book->id) }}" 
                    class="btn btn-primary w-100 mb-2">
                    {{ __('message.read') }}
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
                    ⬇️ {{ __('dashboard.downloads') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    </div>
 </div>
<script>
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