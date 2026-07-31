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
            <img src="{{ asset('uploads/'.$setting->logo)}}" width="45" height="45" class="me-2">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Center Menu -->
         
              @foreach ($users as $user )
                    @php
                        global $user;
                    @endphp
              
              @endforeach
            <ul class="navbar-nav mx-auto fw-bold">
                <li class="nav-item"><a class="nav-link text-white" href="/"><i class="fas fa-home"></i> {{ __('message.home') }}</a></li>
                      
                @auth
                    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'user' && $user->is_active)
                        <li class="nav-item"><a class="nav-link text-white" href="{{ url('allbooks') }}"> <i class="bi bi-book me-1"></i> {{ __('message.books') }}</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="#cateSection"> <i class="fas fa-tags me-1"></i>{{ __('message.categories') }}</a></li>
                    @endif
                @endauth
                <li class="nav-item"><a class="nav-link text-white" href="#aboutSection" >    <i class="fas fa-info-circle me-2"></i>{{ __('message.about') }}</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#contact"><i class="fas fa-phone ms-2"></i> {{ __('message.contact') }}</a></li>
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
        <h2 class="display-5 fw-bold mb-3">{{$setting->hero_title}}</h2>
        <p class="lead mb-4">{{ $setting->hero_description }}</p>
  
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
                            <h5 class="card-title">{{ Str::limit($book->getTitleAttribute(), 10, '...') }}</h5>
                            <p class="text-muted">{{ $book->author }}</p>
                            <a href="{{ route('books.show',$book->id) }}" class="btn btn-primary w-100">{{ __('message.view') }}</a>
                        </div>
                    </div>
                </a>
                @else
                <div class="card shadow-sm h-100 d-flex flex-column">
                    <img src="{{ asset('/storage/'.$book->thumbnail) }}" class="card-img-top" style="height:200px; object-fit:cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ Str::limit($book->getTitleAttribute(),10,'.. .')}}</h5>
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

<!-- about section  -->
    <section id="aboutSection">
        <div class="container py-5">

        <h2 class="text-center fw-bold mb-4">About Afghan Digital Library</h2>

        <p class="lead text-center mb-5">
        Afghan Digital Library is an online platform designed to provide
        free access to educational books and learning materials for students
        across Afghanistan.
        A Digital Library is an online platform that provides access to books, research materials, and educational resources through the internet. Instead of visiting a physical library, students can search, read, and download books anytime and from anywhere.

        The Afghan Digital Library is designed to help students easily find academic books and learning materials. It collects books from different subjects such as computer science, literature, science, history, and many others.

        This platform aims to support students who may not have easy access to physical libraries. By using a digital system, students can quickly search for books, explore categories, and read materials online.

        The goal of this digital library is to promote education, improve access to knowledge, and support the learning journey of Afghan students.
        </p>

        <div class="row">

        <div class="col-md-6">
            <h4 class="fw-bold">Our Mission & vision</h4>
            <p>
            Our mission is to provide Afghan students with easy and free access to educational books and learning resources through a digital platform. We aim to support students in their academic journey by making knowledge available anytime and anywhere. This digital library helps students discover, read, and download useful books from different subjects in a simple and organized way.<br>
            Our mission is to provide Afghan students with easy and free access to educational books and learning resources through a digital platform. We aim to support students in their academic journey by making knowledge available anytime and anywhere. This digital library helps students discover, read, and download useful books from different subjects in a simple and organized way.
            </p>
        </div>

        <div class="col-md-6">
            <h4 class="fw-bold">Why This Library?</h4>
            <p>
                Many students in Afghanistan face difficulty accessing
                educational resources. This digital library helps students
                find books quickly and learn from anywhere.
            </p>
        </div>

        </div>

        </div>
    </section>
<section id="contact">
    <div class="container py-5">
        <h2 class="text-center fw-bold mb-4">{{ __('message.contact') }}</h2>
        <p class="text-center text-muted mb-5">
        {{ __('message.message') }}
        </p>
        <div class="row g-4">
        <!-- Contact Form -->
        <div class="col-md-7">
            <div class="card shadow-sm p-4">
            <h4 class="fw-bold mb-3">{{ __('message.send_message') }}</h4>
            <form action="{{ route('contact') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">{{ __('message.name') }}<sup class="text-danger fw-bold">*</sup> </label>
                    <input type="text" class="form-control" name="name" placeholder="{{ __('message.name') }}" value="{{ old('name') }}">
                    @error('name') <small  class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('message.email') }} <sup class="text-danger fw-bold">*</sup></label>
                    <input type="email" class="form-control" name="email" placeholder="{{ __('message.email') }}" value="{{ old('email') }}">
                    @error('email') <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('message.book_title') }}<sup class="text-danger fw-bold">*</sup></label>
                    <input type="text" class="form-control" name="subject" placeholder="{{ __('message.book_title') }}"  value="{{ old('subject') }}">
                    @error('subject')<small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('message.send_message') }}<sup class="text-danger fw-bold">*</sup></label>
                    <textarea class="form-control" rows="5" name="message" placeholder="{{ __('message.send_message') }}" value="{{ old('message') }}"></textarea>
                    @error('message') <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button class="btn btn-primary w-100">
                {{ __('message.send_message') }}
                </button>
            </form>
            </div>
        </div>
        <!-- Contact Information -->
        <div class="col-md-5">
        <div class="card shadow-sm p-4">
        <h4 class="fw-bold mb-3">{{ __('message.contact') }}</h4>
        <p><strong >{{ __('message.email') }}:</strong> <a href="mailto:">samiaziziazizi6367@gmail.com</a></p>
        <p><strong>{{ __('message.mobile') }}:</strong> +93 770216367</p>
        <p><strong>{{ __('message.mobile') }}:</strong> +93 731777395</p>
        <p><strong>{{ __('message.email') }}:</strong><a href="mailto:"> maaznaizi2001@gmail.com</a></p>
        <p><strong>{{ __('message.mobile') }}:</strong> +93 784763743</p>
        <p><strong>{{ __('message.address') }}:</strong> Jalalabad, Nangarhar, Afghanistan</p>
        <hr>
        <p class="text-muted">
        Our team will respond to your message as soon as possible.
        </p>
        </div>
        </div>
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