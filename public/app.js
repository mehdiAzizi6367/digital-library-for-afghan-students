
let show=document.querySelector('.show_password');
let hidden=document.querySelector('.hidden');
let password=document.querySelector('#password');
show.addEventListener('click',()=>{
     password.type="text";
    show.style.visibility="hidden";
    hidden.style.visibility="visible";


});
hidden.addEventListener('click',function(){
  password.type="password";
   show.style.visibility="visible";
    hidden.style.visibility="hidden";
});

// confirm input targeting
let confirm=document.querySelector("#password_confirmation");
let checkbox=document.querySelector('.checkbox');
let checkbox1=document.querySelector('.checkbox1');
checkbox.addEventListener('click',function(){
    confirm.type="text";
    this.style.visibility="hidden";
   checkbox1.style.visibility="visible";
});
checkbox1.addEventListener('click',function(){
   confirm.type="password";
   this.style.visibility="hidden";
   checkbox.style.visibility="visible";
});

/* ================== user layouts Js start ====================== */

        /* ═══ Sidebar Toggle ═══ */
        function toggleSidebar() {
            document.getElementById('appSidebar').classList.toggle('show');
            document.getElementById('sidebarOverlay').classList.toggle('show');
        }

        /* ═══ Collapsible Submenu ═══ */
        function toggleSubmenu(el) {
            el.classList.toggle('open');
            const submenu = el.nextElementSibling;
            if (submenu && submenu.classList.contains('sidebar-submenu')) {
                submenu.classList.toggle('open');
            }
        }

        /* ═══ Share Site ═══ */
        async function shareSite() {
            const shareData = {
                title: "{{ config('app.name') }}",
                text: "{{ __('dashboard.share_text') }}",
                url: window.location.origin
            };

            if (navigator.share) {
                try {
                    await navigator.share(shareData);
                } catch (e) {}
            } else {
                await navigator.clipboard.writeText(shareData.url);
                alert("{{ __('dashboard.link_copied') }}");
            }
        }
/* ================== user layouts Js end ====================== */

/* ================== create  Js start ====================== */

document.addEventListener('DOMContentLoaded', function () {

    /* ═══ CATEGORY TOGGLE ═══ */
    const category = document.getElementById('category');
    const otherDiv = document.getElementById('otherCategoryDiv');

    function toggleOther() {
        if (category.value === 'other') {
            otherDiv.classList.add('show');
        } else {
            otherDiv.classList.remove('show');
        }
    }
    category.addEventListener('change', toggleOther);
    toggleOther();

    /* ═══ THUMBNAIL PREVIEW ═══ */
    const thumbnailInput = document.getElementById('thumbnailInput');
    const thumbnailText  = document.getElementById('thumbnailText');
    const thumbnailZone  = document.getElementById('thumbnailZone');
    const imagePreview   = document.getElementById('imagePreview');

    thumbnailInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            thumbnailText.innerHTML = '<i class="fas fa-check-circle text-success"></i> ' + file.name;
            thumbnailZone.classList.add('has-file');

            const reader = new FileReader();
            reader.onload = e => {
                imagePreview.src = e.target.result;
                imagePreview.classList.add('show');
            };
            reader.readAsDataURL(file);
        }
    });

    /* ═══ BOOK FILE PREVIEW ═══ */
    const fileInput = document.getElementById('fileInput');
    const fileText  = document.getElementById('fileText');
    const fileZone  = document.getElementById('fileZone');

    fileInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const sizeMB = (file.size / 1024 / 1024).toFixed(2);
            fileText.innerHTML = '<i class="fas fa-check-circle text-success"></i> ' +
                                 file.name + ' <small class="text-muted">(' + sizeMB + ' MB)</small>';
            fileZone.classList.add('has-file');
        }
    });
});

/* ==================  create Js end ====================== */


/* ==================  ecit book Js end ====================== */

document.addEventListener('DOMContentLoaded', function () {

    /* ═══ THUMBNAIL PREVIEW ═══ */
    const thumbnailInput = document.getElementById('thumbnail');
    const thumbnailText  = document.getElementById('thumbnailText');
    const thumbnailZone  = document.getElementById('thumbnailZone');
    const imagePreview   = document.getElementById('imagePreview');

    if (thumbnailInput) {
        thumbnailInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                thumbnailText.innerHTML = '<i class="fas fa-check-circle text-success"></i> ' + file.name;
                thumbnailZone.classList.add('has-file');

                const reader = new FileReader();
                reader.onload = e => {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.add('show');
                };
                reader.readAsDataURL(file);
            }
        });
    }

    /* ═══ BOOK FILE PREVIEW ═══ */
    const bookFileInput = document.getElementById('bookFile');
    const fileText      = document.getElementById('fileText');
    const fileZone      = document.getElementById('fileZone');

    if (bookFileInput) {
        bookFileInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                // File size in MB
                const sizeMB = (file.size / (1024 * 1024)).toFixed(2);

                // File extension
                const ext = file.name.split('.').pop().toUpperCase();

                // Icon based on type
                let icon = 'fa-file';
                if (ext === 'PDF') icon = 'fa-file-pdf';
                else if (ext === 'DOC' || ext === 'DOCX') icon = 'fa-file-word';

                fileText.innerHTML = `
                    <i class="fas fa-check-circle text-success"></i>
                    ${file.name}
                    <br>
                    <small class="text-muted">
                        <i class="fas ${icon} me-1"></i>${ext} • ${sizeMB} MB
                    </small>
                `;
                fileZone.classList.add('has-file');
            }
        });
    }
});

/* ==================  edit Js end ====================== */


/* ==================  My book Js start ====================== */
document.addEventListener('DOMContentLoaded', function () {

    /* ═══ TOAST HELPER ═══ */
    const toast = document.getElementById('toastNotification');
    const toastMsg = document.getElementById('toastMessage');
    function showToast(msg) {
        toastMsg.textContent = msg;
        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 2500);
    }

    /* ═══ RATING SYSTEM ═══ */
    document.querySelectorAll('.rating').forEach(ratingBox => {
        const stars = ratingBox.querySelectorAll('.star');

        stars.forEach(star => {

            // Hover preview
            star.addEventListener('mouseenter', function () {
                const val = parseInt(this.dataset.value);
                stars.forEach((s, i) => {
                    s.classList.toggle('hover-active', i < val);
                });
            });

            // Reset on leave
            ratingBox.addEventListener('mouseleave', function () {
                stars.forEach(s => s.classList.remove('hover-active'));
            });

            // Click to rate
            star.addEventListener('click', function () {
                const rating = this.dataset.value;
                const bookId = this.parentElement.dataset.book;

                fetch(`/books/${bookId}/rate`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ rating: rating })
                })
                .then(res => res.json())
                .then(data => {
                    // Update active stars visually
                    stars.forEach((s, i) => {
                        s.classList.toggle('active', i < rating);
                    });
                    showToast("⭐ {{ __('message.rating_submitted') }}");
                })
                .catch(err => {
                    showToast("❌ {{ __('message.rating_failed') }}");
                });
            });
        });
    });

});

/* ==================  My book Js end ====================== */
  