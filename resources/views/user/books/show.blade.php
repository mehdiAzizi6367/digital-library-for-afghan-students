@extends('layouts.app')

@section('content')
<div class="container py-5">

    <div class="row">
        <!-- LEFT: Thumbnail -->
        <div class="col-md-4">
            <div class="card shadow-sm" style="height: 100%;">
              <img src="{{ $book->thumbnail ? asset('storage/'.$book->thumbnail) : asset('image/banner.png') }}">
            </div>
        </div>
        <!-- RIGHT: Book Info -->
        <div class="col-md-8"  >
            <div class="card shadow-sm p-4">

                <!-- Title (Localization) -->
                <h2 class="fw-bold mb-3">
                   {{ __('message.book_title') }} :  {{ $book->getTitle()}}
                </h2>

                <!-- Author -->
                <p><strong>{{ __('message.author') }} : </strong> {{ $book->author }}</p>

                <!-- ISBN -->
                <p class="my-3"><strong>{{ __('message.isbn') }}</strong> : {{ $book->isbn ?? 'N/A' }}</p>

                <!-- Category -->
                <p class="my-3"><strong>{{ __('message.categories') }}: </strong> {{ $book->category->getname() ?? 'N/A' }}</p>

                <!-- Status -->
                <p class="my-3">
                    <strong>{{ __('message.status') }} : </strong>
                    @if($book->status == 'approved')
                        <span class="badge bg-success p-2">{{ __('message.status_approved') }}</span>
                    @elseif($book->status == 'pending')
                        <span class="badge bg-warning">{{ __('message.status_pending') }}</span>
                    @else
                        <span class="badge bg-danger">{{ __('message.status_rejected') }}</span>
                    @endif
                </p>

                <!-- Rejection Reason -->
                @if($book->status == 'rejected')
                    <div class="alert alert-danger">
                        <strong>Reason:</strong> {{ $book->rejection_reason }}
                    </div>
                @endif  
                     <!-- Description -->
        
                    <h4 class="fw-bold my-3">{{__('message.description') }}</h4>
                    <p>
                        {{ $book->getDescription()}}
                    </p>
    
                <!-- Buttons -->
                <div class="mt-4 ">
                    <a href="{{ asset('storage/'.$book->file_path) }}" 
                       class="btn btn-success me-2" target="_blank">
                        📖 {{ __('message.read') }}
                    </a>

                    <a href="{{ route('books.download', $book->id) }}" 
                       class="btn btn-primary">
                        ⬇ {{ __('dashboard.downloads') }}
                    </a>
                </div>

            </div>
        </div>
    </div>

   

</div>
@endsection