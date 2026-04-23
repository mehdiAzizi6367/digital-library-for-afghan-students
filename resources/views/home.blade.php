<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ in_array(app()->getLocale(), ['ps','fa']) ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('message.site_title') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('bootstrap.css') }}">         
    <link rel="stylesheet" href="{{ asset('style.css') }}">         
    <link rel="stylesheet" href="{{ asset('all.css') }}">
    <style>
        .card:hover { transform: translateY(-5px); box-shadow: 0px 0px 10px gray; }
        .card { cursor: pointer; }
        .search-dropdown { position: absolute; z-index: 1000; width: 100%; background: #fff; border: 1px solid #ddd; max-height: 250px; overflow-y: auto; }
        .search-item { padding: 8px; border-bottom: 1px solid #eee; }
        .search-item:hover { background-color: #f1f1f1; }
    </style>
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="/">
            <img src="{{ asset('storage/logo.png') }}" width="45" height="45" class="me-2">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Center Menu -->
            <ul class="navbar-nav mx-auto fw-bold">
                <li class="nav-item"><a class="nav-link text-white" href="/"><i class="fas fa-home"></i> {{ __('message.home') }}</a></li>
                @auth
                    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'user')
                        <li class="nav-item"><a class="nav-link text-white" href="{{ url('allbooks') }}"> <i class="bi bi-book me-1"></i> {{ __('message.books') }}</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="#cateSection"> <i class="fas fa-tags me-1"></i>{{ __('message.categories') }}</a></li>
                    @endif
                @endauth
                <li class="nav-item"><a class="nav-link text-white" href="/about">    <i class="fas fa-info-circle me-2"></i>{{ __('message.about') }}</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="/contact"><i class="fas fa-phone ms-2"></i> {{ __('message.contact') }}</a></li>
            </ul>

            <!-- Right Side -->
            <div class="d-flex align-items-center">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-light me-2">{{ __('message.login') }}</a>
                    <a href="{{ route('register') }}" class="btn btn-warning me-2">{{ __('message.register') }}</a>
                @endguest

                @auth
                    @php $dashboardRoute = auth()->user()->role == 'admin' ? 'admin.dashboard' : 'user.dashboard'; @endphp
                    <a href="{{ route($dashboardRoute) }}" class="btn btn-light ms-2">{{ __('message.dashboard') }}</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-warning ms-2">{{ __('message.logout') }}</button>
                    </form>
                @endauth
               <x-translator></x-translator>
            </div>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero-section text-white text-center d-flex align-items-center py-5">
    <div class="container">
        <h2 class="display-5 fw-bold mb-3">{{ __('message.hero_title') }}</h2>
        <p class="lead mb-4">{{ __('message.hero_subtitle') }}</p>
        <small class="d-block mb-4">{{ __('message.hero_description') }}</small>
        @auth
            <a href="{{ route('allbooks') }}" class="btn btn-warning btn-lg">{{ __('message.browse_books') }}</a>
        @endauth
    </div>
</section>

<!-- Search Section -->
@auth
<div class="col-md-12 position-relative mx-auto mt-4 mb-5">
    <form action="/search" method="GET" id="searchForm">
        <div class="col-md-6 position-relative mx-auto mt-4">
            <div class="input-group">
                <input type="text" id="searchInput" name="query" class="form-control p-3" style="border-radius: 5px;" placeholder="{{ __('message.search_placeholder') }}">
                <button class="btn btn-primary  " style=" border-radius: 10px;" >{{ __('message.search') }}</button>
            </div>
            <!-- Suggestions -->
            <div id="searchResults" class="search-dropdown"></div>
        </div>
    </form>
</div>
@endauth
<!-- Categories Section -->
@if(auth()->check())
<section class="bg-white py-5" id="cateSection">
    <div class="container">
        <h3 class="text-center fw-bold mb-5">{{ __('message.browse_categories') }}</h3>
        <div class="row g-4">
            @foreach($categories as $category)
                <div class="col-6 col-md-3">
                    <a href="{{ route('categories.show', $category->id) }}" class="text-decoration-none">
                        <div class="card border-0 shadow-sm text-center p-4 h-100 category-card">
                            <div class="mb-3"><i class="bi bi-book fs-1 text-primary"></i></div>
                            <h5 class="fw-bold text-dark">{{ $category->getname() }}</h5>
                            <small class="text-muted">{{ $category->books_count ?? 0 }} {{ __('message.books') }}</small>
                        </div>
                    </a>
                 </div>
              
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Latest Books -->
<section class="py-5">
    <div class="container">
        <h3 class="text-center fw-bold mb-5">{{ __('message.latest_books') }}</h3>
        <div class="row g-4">
            @foreach($books as $book)
            <div class="col-md-3">
                @if(auth()->guest())
                <a href="{{ route('books.show',$book->id) }}" class="text-decoration-none">
                    <div class="card shadow-sm h-100 d-flex flex-column" style="max-height:600px">
                        <img src="{{ asset('/storage/'.$book->thumbnail) }}" class="card-img-top" style="height:200px; object-fit:cover;">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ Str::limit($book->getTitle(), 10, '...') }}</h5>
                            <p class="text-muted">{{ $book->author }}</p>
                            <a href="{{ route('books.show',$book->id) }}" class="btn btn-primary w-100">{{ __('message.view') }}</a>
                        </div>
                    </div>
                </a>
                @else
                <div class="card shadow-sm h-100 d-flex flex-column">
                    <img src="{{ asset('/storage/'.$book->thumbnail) }}" class="card-img-top" style="height:200px; object-fit:cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ Str::limit($book->getTitle(),10,'.. .')}}</h5>
                        <p class="text-muted">{{ $book->author }}</p>
                        <a href="{{ route('books.show',$book->id) }}" class="btn btn-primary w-100">{{ __('message.view') }}</a>
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Footer -->
@include('footer.footer')

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- AJAX Search Script -->
<script>
const input = document.getElementById("searchInput");
const results = document.getElementById("searchResults");

if (input) {

    document.addEventListener("click", function(e) {
        if (!input.contains(e.target) && !results.contains(e.target)) {
            results.innerHTML = "";
        }
    });

    input.addEventListener("keyup", function() {
        let query = this.value;

        if(query.length < 2){
            results.innerHTML = "";
            return;
        }

        fetch(`{{ url('/search-books') }}?query=` + encodeURIComponent(query))
            .then(res => res.json())
            .then(data => {
                let html = "";

                if(data.length === 0){
                    html = `<div class="search-item">No results</div>`;
                } else {
                    data.forEach(book => {
                        html += `
                        <div class="search-item">
                            <a href="/books/${book.id}" style="text-decoration:none;color:black;">
                                <div>${book.title}</div>
                                <div>${book.author}</div>
                            </a>
                        </div>`;
                    });
                }

                results.innerHTML = html;
            })
            .catch(error => {
                console.error("Search error:", error);
            });
    });

}
</script>

</body>
</html>