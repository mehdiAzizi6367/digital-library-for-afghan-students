@extends('layouts.app')
<style>
    .star{
        cursor: pointer;
        font-size: 20px;
    }
    .star:hover{
        transform: scale(1.2);
    }
    .card:hover
    {
        transform: translateY(-5px);
        transition: 0.3s;
        box-shadow: 0px 0px 10px lightblue;
    }
</style>
@section('content')

<div class="container py-5">
    <h2 class="fw-bold mb-4 text-center">
        {{ $category->name }} Books
    </h2>

    <div class="row g-4">
        @foreach($category->books as $book)
            <div class="col-md-3">
                <div class="card shadow-sm h-100 d-flex flex-column">
                    <img src="{{ asset('storage/'.$book->thumbnail) }}" class="card-img-top" style="height:200px; object-fit:cover;">
                    <div class="card-body text-center">
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
                        <h6 class="card-title h4">{{ $book->title }}</h6>
                        <p class="text-muted">{{ $book->author }}</p>

                        <a href="{{ route('books.read', $book->id) }}" 
                           class="btn btn-primary w-100">
                           View
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<script>
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