
    // Toggle Description
    const btn = document.getElementById('toggleBtn');
    const moreText = document.getElementById('moreText');

    btn.addEventListener('click', function () {
        if (moreText.style.display === 'none') {
            moreText.style.display = 'block';
            btn.innerText = 'Show Less';
        } else {
            moreText.style.display = 'none';
            btn.innerText = 'Learn More';
        }
    });

    // Toggle Categories
    document.getElementById('toggleCategories')?.addEventListener('click', function () {
        let hiddenItems = document.querySelectorAll('.extra-category');
        hiddenItems.forEach(item => {
            item.classList.toggle('d-none');
        });
        if (this.textContent.trim() === 'More') {
            this.innerHTML = '<i class="bi bi-chevron-up me-1"></i> Less';
        } else {
            this.innerHTML = '<i class="bi bi-chevron-down me-1"></i> More';
        }
    });

    // Scroll to Top
    const scrollBtn = document.getElementById('scrollTopBtn');

    window.addEventListener('scroll', function () {
        if (window.scrollY > 400) {
            scrollBtn.style.display = 'flex';
        } else {
            scrollBtn.style.display = 'none';
        }
    });

    scrollBtn.addEventListener('click', function () {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
