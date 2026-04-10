<!-- Statistics -->
<style>
    .quick_links ul li a:hover{
       transform: translateX(-5px);
       transition: all 0.3s ease-in-out;
       background-color: blue;
       font-size: 2rem;
     
    }
    .categories ul li a:hover{
       transform: translateX(-5px);
       transition: all 0.3s ease-in-out;
       background-color: blue;
  
    }
    .social_media a:hover{
     transform: translateX(-5px);
       transition: all 0.3s ease-in-out;
       font-size: 3rem;
       
    }
   

    
</style>
<section class="bg-primary text-white py-5">
    <div class="container text-center">
        <div class="row g-4">

            <div class="col-6 col-md-3">
                <h3 class="fw-bold">{{ $Books ?? '0' }}+</h3>
                <p>{{ __('message.books') }}</p>
            </div>

            <div class="col-6 col-md-3">
                <h3 class="fw-bold">{{ $Students ?? '0' }}+</h3>
                <p>{{ __('dashboard.all_users') }}</p>
            </div>

            <div class="col-6 col-md-3">
                <h3 class="fw-bold">{{ $Categories ?? '0' }}+</h3>
                <p>{{ __('message.categories') }}</p>
            </div>

            <div class="col-6 col-md-3">
                <h3 class="fw-bold">{{ $Downloads ?? '0' }}+</h3>
                <p>{{ __('dashboard.download_books') }}</p>
            </div>

        </div>
    </div>
</section>

<!-- Footer -->
<footer class="container-fluid footer bg-dark text-white pt-5 pb-3">
    <div class="container">
        <div class="row g-4">

            <!-- About -->
            <div class="col-md-4 social_media">
                <h4 class="mb-3 h2">{{ __('message.hero_title') }}</h4>
                <p style="line-height: 2rem;">{{ __('message.hero_description') }}</p>

                <div class="d-flex gap-3">
                    <a href="#" class="text-white"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>

            <!-- Categories -->
            <div class="col-md-4 categories">
                <h4 class="mb-3 h2 text-center">{{ __('message.categories') }}</h4>
                <ul class="list-unstyled">
                    @foreach ($categories as $category)
                        <li class="mb-2">
                            <a href="{{ route('categories.show', $category->id) }}" class="text-white text-decoration-none " style="line-height:1px;">
                                {{ $category->getname() ?? 0}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Quick Links -->
            <div class="col-md-4 quick_links">
                <h4 class="mb-3 h2">{{ __('message.quick_links') }}</h4>
                <ul class="list-unstyled">
                    <li><a href="/" class="text-white text-decoration-none">{{ __('message.home') }}</a></li>
                    <li><a href="/about" class="text-white text-decoration-none">{{ __('message.about') }}</a></li>
                    <li><a href="/contact" class="text-white text-decoration-none">{{ __('message.contact') }}</a></li>
                </ul>
            </div>

        </div>

        <hr class="bg-light mt-4">

        <div class="text-center small">
            © {{ date('Y') }} {{ __('message.site_title') }} - All Rights Reserved
        </div>
    </div>
</footer>