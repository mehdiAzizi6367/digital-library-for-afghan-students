<!-- ─── Footer ──────────────────────────────────────────────── -->
 <link rel="stylesheet" href="{{ asset('footer.css') }}">
<footer class="footer-main text-white pt-5 pb-0">
    <div class="container">
        <div class="row g-5">

            <!-- About Column -->
            <div class="col-md-4">
                <h4 class="footer-title">{{ ($setting->{'hero_title_'.app()->getLocale()}) ?? " " }}</h4>
                <p id="moreText" class="footer-description">
                    {{($setting->{'hero_description_'.app()->getLocale()}) ?? "" }}
                </p>
                <button id="toggleBtn" class="btn-read-more mb-4">
                    Learn More
                </button>

                <div class="d-flex gap-3 flex-wrap">
                    <a href="#" class="social-icon social-facebook" aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-icon social-youtube" aria-label="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="https://github.com/mehdiAzizi6367" class="social-icon social-github" aria-label="GitHub">
                        <i class="fab fa-github"></i>
                    </a>
                    <a href="https://wa.me/message/BB2KIIABW4MEA1" class="social-icon social-whatsapp" aria-label="WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>

            <!-- Categories Column -->
            <div class="col-md-4">
                <h4 class="footer-title">{{ __('message.categories') }}</h4>
                <ul class="list-unstyled mb-3">
                    @foreach ($categories as $index => $category)
                        <li class="category-item {{ $index >= 4 ? 'd-none extra-category' : '' }}">
                            <a href="{{ route('categories.show', $category->id) }}" class="footer-link">
                                <span class="footer-link-icon">
                                    <i class="bi bi-bookmark-fill"></i>
                                </span>
                                {{ $category->getname() ?? 0 }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                @if(count($categories) > 4)
                    <button id="toggleCategories" class="btn-more-categories">
                        <i class="bi bi-chevron-down me-1"></i> More
                    </button>
                @endif
            </div>

            <!-- Quick Links Column -->
            <div class="col-md-4">
                <h4 class="footer-title">{{ __('message.quick_links') }}</h4>
                <ul class="list-unstyled">
                    <li>
                        <a href="/" class="footer-link">
                            <span class="footer-link-icon">
                                <i class="bi bi-house-fill"></i>
                            </span>
                            {{ __('message.home') }}
                        </a>
                    </li>
                    <li>
                        <a href="/about" class="footer-link">
                            <span class="footer-link-icon">
                                <i class="bi bi-info-circle-fill"></i>
                            </span>
                            {{ __('message.about') }}
                        </a>
                    </li>
                    <li>
                        <a href="/contact" class="footer-link">
                            <span class="footer-link-icon">
                                <i class="bi bi-envelope-fill"></i>
                            </span>
                            {{ __('message.contact') }}
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        <hr style="border-color:rgba(255,255,255,0.08); margin-top:2.5rem; margin-bottom:0;">
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom py-3">
        <div class="container">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">

                <!-- Copyright -->
                <div class="text-center text-md-start">
                    <small style="color:#64748b;">
                        © {{ date('Y') }} {{ __('message.site_title') }} — All Rights Reserved
                    </small>
                </div>

                <!-- Developers -->
                <div class="d-flex flex-wrap gap-2 justify-content-center">

                    <!-- Developer 1 -->
                    <div class="developer-info">
                        <div class="developer-avatar">S</div>
                        <div>
                            <div class="developer-name">Sami Azizi</div>
                            <div class="developer-role">Full Stack Developer</div>
                        </div>
                    </div>

                 

                </div>

            </div>
        </div>
    </div>
</footer>

<!-- ─── Scroll to Top Button ────────────────────────────────── -->
<button class="scroll-top-btn" id="scrollTopBtn" aria-label="Scroll to top">
    <i class="bi bi-chevron-up"></i>
</button>

<!-- ─── Scripts ─────────────────────────────────────────────── -->
<script src="{{ asset('footer.js') }}"></script>