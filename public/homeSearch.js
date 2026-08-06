  
    const input   = document.getElementById("searchInput");
    const results = document.getElementById("searchResults");

    if (input) {

        document.addEventListener("click", function(e) {
            if (!input.contains(e.target) && !results.contains(e.target)) {
                results.innerHTML = "";
            }
        });

        input.addEventListener("keyup", function() {
            let query = this.value;

            if (query.length < 2) {
                results.innerHTML = "";
                return;
            }

            fetch(`{{ url('/search-books') }}?query=` + encodeURIComponent(query))
                .then(res => res.json())
                .then(data => {
                    let html = "";

                    if (data.length === 0) {
                        html = `<div class="search-item text-muted">No results found</div>`;
                    } else {
                        data.forEach(book => {
                            html += `
                                <div class="search-item">
                                    <a href="/books/${book.id}" style="text-decoration:none;color:#1a237e;">
                                        <div class="fw-semibold">${book.title}</div>
                                        <div class="text-muted small">${book.author}</div>
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
     AOS.init({
        duration: 800,
        once: true,
        easing: 'ease-out-cubic',
        offset: 70
    });


    AOS.init({
        duration: 800,
        once: true,
        easing: 'ease-out-cubic',
        offset: 80
    });

document.addEventListener('DOMContentLoaded', function () {

    const input   = document.getElementById('searchInput');
    const btn     = document.getElementById('searchBtn');
    const results = document.getElementById('searchResults');
    const form    = document.getElementById('searchForm');

    // ── 1. Enable / Disable Button ─────────────────────────────────
    function toggleBtn() {
        btn.disabled = input.value.trim().length < 2;
    }

    toggleBtn();
    input.addEventListener('input', toggleBtn);

    // ── 2. Block form submit if empty ──────────────────────────────
    form.addEventListener('submit', function (e) {
        if (input.value.trim().length < 2) {
            e.preventDefault();
        }
    });

    // ── 3. Close dropdown on outside click ────────────────────────
    document.addEventListener('click', function (e) {
        if (!input.contains(e.target) && !results.contains(e.target)) {
            results.innerHTML = '';
        }
    });

    // ── 4. Live Search Dropdown ────────────────────────────────────
  
    // ── 5. Prevent XSS ────────────────────────────────────────────
    function escapeHtml(text) {
        const d = document.createElement('div');
        d.appendChild(document.createTextNode(text));
        return d.innerHTML;
    }

});
