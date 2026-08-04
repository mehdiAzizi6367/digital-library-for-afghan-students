  
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
