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
    transition: 0.3s;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}
</style>
@section('content')
<div class="container py-5">
   <h2 class="text-center fw-bold mb-5">My Downloaded Books</h2>
   <div class="row g-4">
      @foreach($downloads as $download)
      <div class="col-md-3">
         <div class="card shadow-sm h-100 d-flex flex-column">

            <!-- Fixed Image -->
            <img src="{{ asset('/storage/'.$download->book->thumbnail) }}" 
                  class="card-img-top"
                  style="height:200px; object-fit:cover;">

            <div class="card-body text-center d-flex flex-column">
               <div class="rating" data-book="{{ $download->book->id }}">
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
                  <!-- Title -->
                  <h3 class="card-title" style="min-height:50px;">
                     {{ Str::limit($download->book->getTitle(), 40) }}
                  </h3>

                  
                  <!-- Author -->
                  <p class="text-muted mb-3">
                     {{ $download->book->author }}
                  </p>

                  <!-- Button at bottom -->
                  <div class="mt-auto">
                     <a href="{{ route('books.download', $download->book->id) }}" 
                        class="btn btn-success w-100">
                        ⬇️ Download Again
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
           
               alert('thinks from your feedback👍❤️');
        });
    });
});
</script>
@endsection