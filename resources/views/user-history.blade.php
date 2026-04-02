@extends('layouts.app')
<style>
    .card:hover{
        transform: translateY(-5px);
        transition: 0.3s;
    }
    .star
    {
        cursor: pointer;
        font-size: 20px;
    }
    .star:hover
    {
      transform: scale(1.3);
    }
</style>
@section('content')
<div class="container py-5">
    <h2 class="text-center fw-bold mb-5">📚 {{ __('dashboard.history') }}</h2>

    <!-- Favorites Section -->
    <h3 class="mb-4">❤️ {{ __('dashboard.favorite_books') }}</h3>
    <div class="row g-4 mb-5">
        @forelse($userFavorites as $fav)
        <div class="col-md-3">
            <div class="card shadow-sm h-100 d-flex flex-column">
                <img src="{{ asset('storage/'.$fav->book->thumbnail) }}" style="height: 200px; object-fit:cover;" class="card-img-top">
                <!-- count rating -->
                <div class="card-body text-center">
                        <div class="rating" data-book="{{$fav->book->id }}">
                        <span class="star" data-value="1">⭐</span>
                        <span class="star" data-value="2">⭐</span>
                        <span class="star" data-value="3">⭐</span>
                        <span class="star" data-value="4">⭐</span>
                        <span class="star" data-value="5">⭐</span>
                         </div>
                    @php
                        $avg = round($fav->book->ratings->avg('rating'), 1);
                    @endphp
                    <p>Ratted:{{ $avg ?? 'No rating yet' }} {{ ($avg>1)?'times': 'time' }}</p>
                    <h5 class="card-title">{{ $fav->book->title }}</h5>
                    <p class="text-muted">{{ $fav->book->author }}</p>
                    <p class="text-secondary small">Added: {{ $fav->created_at->format('d M Y, H:i') }}</p>
                    <form action="{{ route('books.favorite', $fav->book->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger w-100">Remove Favorite</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <p class="text-center text-muted">No favorites yet.</p>
        @endforelse
    </div>


    <!-- Downloads Section -->
    <h3 class="mb-4">📥 {{ __('dashboard.download_books') }}</h3>
    <div class="row g-4">
        @forelse($userDownloads as $download)
        <div class="col-md-3">
            <div class="card shadow-sm  h-100 d-flex flex-column">
                <img src="{{ asset('/storage/'.$download->book->thumbnail) }}" style="height: 200px; object-fit:cover;" class="card-img-top">
                <div class="card-body text-center">
                        <div class="rating" data-book="{{$download->book->id }}">
                        <span class="star" data-value="1">⭐</span>
                        <span class="star" data-value="2">⭐</span>
                        <span class="star" data-value="3">⭐</span>
                        <span class="star" data-value="4">⭐</span>
                        <span class="star" data-value="5">⭐</span>
                    </div>
                        <!-- count rating -->
                        @php
                            $avg = round($download->book->ratings->avg('rating'), 1);
                        @endphp
                        <p>Ratted:{{ $avg ?? 'No rating yet' }} {{ ($avg>1)?'times': 'time' }}</p>
                    <h5 class="card-title">{{ $download->book->title }}</h5>
                    <p class="text-muted">{{ $download->book->author }}</p>
                    <p class="text-secondary small">Downloaded: {{ $download->created_at->format('d M Y, H:i') }}</p>
                    <form action="{{ route('books.download',$download->book->id) }}" method="GET">
                        @csrf
                        <button class="btn btn-success w-100">📥 Download Again</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <p class="text-center text-muted">No downloads yet.</p>
        @endforelse
    </div>
</div>
@include('footer.footer')

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