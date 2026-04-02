@extends('layouts.app')
<style>
    .star {
    cursor: pointer;
    font-size: 20px;
}
.star:hover {
    transform: scale(1.2);
}
.card:hover {
    transform: translateY(-5px);
    transition: 0.3s ease;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}
</style>
@section('content')
<div class="container py-5">
<h2 class="text-center fw-bold mb-5">My Favorite Books new</h2>
<div class="row g-4">
@foreach($favorites as $fav)
<div class="col-md-3">
    <div class="card shadow-sm h-100 d-flex flex-column">
        <!-- Fixed Image -->
        <img src="{{ asset('/storage/'.$fav->book->thumbnail) }}" 
             class="card-img-top"
             style="height:200px; object-fit:cover;">
        <div class="card-body text-center d-flex flex-column">
            <!-- ratting books -->
            <div class="rating" data-book="{{ $fav->book->id }}">
                <span class="star" data-value="1">⭐</span>
                <span class="star" data-value="2">⭐</span>
                <span class="star" data-value="3">⭐</span>
                <span class="star" data-value="4">⭐</span>
                <span class="star" data-value="5">⭐</span>
            </div>

            <!-- count rating -->
            @php
                $avg = round($fav->book->ratings->avg('rating'), 1);
            @endphp
            <p>Ratted:{{ $avg ?? 'No rating yet' }} {{ ($avg>1)?'times': 'time' }}</p>
            <!-- Title -->
            <h5 class="card-title" style="min-height:50px;">
                {{ Str::limit($fav->book->title, 40) }}
            </h5>
            <!-- Author -->
            <p class="text-muted mb-3">
                {{ $fav->book->author }}
            </p>

            <!-- Buttons at bottom -->
            <div class="mt-auto">

                <!-- Read Button (optional but recommended) -->
                <a href="{{ route('books.read', $fav->book->id) }}" 
                   class="btn btn-primary w-100 mb-2">
                   Read Book
                </a>

                <!-- Remove Favorite -->
                <form action="{{ route('favorites.destroy', $fav->book->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger w-100">
                        💔 Remove Favorite
                    </button>
                </form>

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
