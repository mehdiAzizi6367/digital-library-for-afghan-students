@extends('layouts.app')

@section('content')
<div class="container py-5">
     <h3 class="mb-4">  {{ __('message.search_result') }} "{{ $query }}" </h3>
     @if($books->count() > 0)
     <div class="row">
          @foreach($books as $book)
          <div class="col-md-3 mb-4">
          <div class="card shadow-sm">
          <img src="{{ asset('/storage/'.$book->thumbnail) }}"
               class="card-img-top"
               style="height:200px;object-fit:cover;">
          <div class="card-body text-center">
          <h5>{{ $book->title }}</h5>
          <h5>{{ $book->Categories }}</h5>
          <p class="text-muted">
          {{ $book->author }}
          </p>
          <a href="{{ route('books.show',$book->id) }}" class="btn btn-primary w-100">
                View Book
          </a>

          </div>

          </div>

          </div>

          @endforeach

          </div>
     @else
          <div class="alert alert-warning">
          No books found for "{{ $query }}"
          </div>
     @endif
</div>
@endsection