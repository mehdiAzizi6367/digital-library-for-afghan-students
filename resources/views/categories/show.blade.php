@extends('layouts.app')
<style>
    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
    }

    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 60px 0 40px;
        margin-bottom: 40px;
        border-radius: 0 0 30px 30px;
        box-shadow: 0 4px 20px rgba(102, 126, 234, 0.4);
    }

    .page-header h2 {
        font-size: 2.5rem;
        font-weight: 800;
        letter-spacing: 1px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    }

    .page-header p {
        font-size: 1rem;
        opacity: 0.85;
    }

    .book-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s ease;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        background: white;
        height: 100%;
    }

    .book-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(102, 126, 234, 0.3);
    }

    .book-card .img-wrapper {
        position: relative;
        overflow: hidden;
    }

    .book-card .img-wrapper img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .book-card:hover .img-wrapper img {
        transform: scale(1.08);
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, transparent 40%, rgba(0,0,0,0.5));
    }

    .badge-category {
        position: absolute;
        top: 12px;
        left: 12px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .card-body {
        padding: 20px;
    }

    .book-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: #2d3436;
        margin-bottom: 5px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .book-author {
        font-size: 0.85rem;
        color: #636e72;
        margin-bottom: 15px;
    }

    .book-author i {
        color: #667eea;
        margin-right: 4px;
    }

    .btn-read {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 10px 20px;
        font-weight: 600;
        font-size: 0.9rem;
        width: 100%;
        transition: all 0.3s ease;
        letter-spacing: 0.5px;
    }

    .btn-read:hover {
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        color: white;
        transform: scale(1.03);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-read i {
        margin-right: 6px;
    }

    .empty-state {
        text-align: center;
        padding: 80px 20px;
        color: #636e72;
    }

    .empty-state i {
        font-size: 5rem;
        color: #b2bec3;
        margin-bottom: 20px;
    }

    .empty-state h4 {
        font-weight: 700;
        color: #2d3436;
    }

    .books-count {
        background: rgba(255,255,255,0.2);
        display: inline-block;
        padding: 5px 16px;
        border-radius: 20px;
        font-size: 0.9rem;
        margin-top: 10px;
        backdrop-filter: blur(5px);
    }

    /* Animate cards on load */
    .book-card-wrapper {
        animation: fadeInUp 0.5s ease forwards;
        opacity: 0;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Stagger animation delay */
    .book-card-wrapper:nth-child(1) { animation-delay: 0.1s; }
    .book-card-wrapper:nth-child(2) { animation-delay: 0.2s; }
    .book-card-wrapper:nth-child(3) { animation-delay: 0.3s; }
    .book-card-wrapper:nth-child(4) { animation-delay: 0.4s; }
    .book-card-wrapper:nth-child(5) { animation-delay: 0.5s; }
    .book-card-wrapper:nth-child(6) { animation-delay: 0.6s; }
    .book-card-wrapper:nth-child(7) { animation-delay: 0.7s; }
    .book-card-wrapper:nth-child(8) { animation-delay: 0.8s; }
</style>


@section('content')

{{-- Page Header --}}
<div class="page-header text-center ">
    <div class="container " >
        <h2 class="text-black ">
            <i class="fas fa-book-open me-2 "></i>
            {{ $category->getname() }}
        </h2>
        <p class="mb-0 text-black">Explore our amazing collection of books</p>
        <span class="books-count text-black">
            <i class="fas fa-layer-group me-1"></i>
            {{ $category->books->count() }} {{ $category->books->count() == 1 ? 'Book' : 'Books' }} Available
        </span>
    </div>
</div>

<div class="container pb-5">

    @if($category->books->count() > 0)
        <div class="row g-4">
            @foreach($category->books as $book)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 book-card-wrapper">
                    <div class="book-card">

                        {{-- Book Image --}}
                        <div class="img-wrapper">
                            <img 
                                src="{{ asset('storage/' . $book->thumbnail) }}" 
                                alt="{{ $book->getTitleAttribute() }}"
                            >
                            <div class="overlay"></div>
                            <span class="badge-category">
                                <i class="fas fa-tag me-1"></i>{{ $category->getname() }}
                            </span>
                        </div>

                        {{-- Book Info --}}
                        <div class="card-body d-flex flex-column">
                            <h6 class="book-title">{{ $book->getTitleAttribute() }}</h6>
                            <p class="book-author">
                                <i class="fas fa-user-pen"></i>{{ $book->author }}
                            </p>

                            <div class="mt-auto">
                                <a href="{{ route('books.read', $book->id) }}" class="btn btn-read">
                                    <i class="fas fa-book-reader"></i>
                                    {{ __('message.view') }}
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

    @else
        {{-- Empty State --}}
        <div class="empty-state">
            <div><i class="fas fa-book-open"></i></div>
            <h4>No Books Found</h4>
            <p>There are no books in this category yet. Check back later!</p>
            <a href="{{ url()->previous() }}" class="btn btn-read mt-3" style="width:auto; display:inline-block; padding: 10px 30px;">
                <i class="fas fa-arrow-left me-2"></i> Go Back
            </a>
        </div>
    @endif

</div>

@endsection