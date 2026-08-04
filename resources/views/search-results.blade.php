@extends('layouts.app')

@section('content')
<div class="container py-5">
     <h3 class="mb-4">  {{ __('message.search_result') }} "{{ $query }}" </h3>
     @if($books->count() > 0)
    <section class="latest-books-section py-5">
               <div class="container position-relative">
                       {{ __('Book') }}
                    <div class="text-center mb-5" data-aos="fade-up">
                         <h3 class="section-title">{{ __('message.latest_books') }}</h3>
                    </div>

                    <div class="row g-4">
                         @foreach($books as $book)
                         <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 100 }}">
                              @if(auth()->guest())
                                   <a href="{{ route('books.show', $book->id) }}" class="book-card-link">
                                   <div class="card latest-book-card shadow-sm h-100">
                                        <div class="book-cover-wrap">
                                             <img src="{{ asset('/storage/'.$book->thumbnail) }}"
                                                  class="card-img-top"
                                                  alt="{{ $book->getTitleAttribute() }}">
                                        </div>
                                        <div class="card-body text-center d-flex flex-column">
                                             <h5 class="card-title mb-2">
                                                  {{ Str::limit($book->getTitleAttribute(), 12, '...') }}
                                             </h5>
                                             <p class="text-muted mb-3">{{ $book->author }}</p>
                                             <span class="btn btn-view-modern w-100 mt-auto">
                                                  {{ __('message.view') }}
                                             </span>
                                        </div>
                                   </div>
                                   </a>
                              @else
                                   <div class="card latest-book-card shadow-sm h-100">
                                   <div class="book-cover-wrap">
                                        <img src="{{ asset('/storage/'.$book->thumbnail) }}"
                                             class="card-img-top"
                                             alt="{{ $book->getTitleAttribute() }}">
                                   </div>
                                   <div class="card-body text-center d-flex flex-column">
                                        <h5 class="card-title mb-2">
                                             {{ Str::limit($book->getTitleAttribute(), 12, '...') }}
                                        </h5>
                                        <p class="text-muted mb-3">{{ $book->author }}</p>
                                        <a href="{{ route('books.show', $book->id) }}"
                                             class="btn btn-view-modern w-100 mt-auto">
                                             {{ __('message.view') }}
                                        </a>
                                   </div>
                                   </div>
                              @endif
                         </div>
                         @endforeach
                    </div>

               </div>
               </section>
     @else
          <div class="alert alert-warning">
          No books found for "{{ $query }}"
          </div>
     @endif
</div>
@endsection