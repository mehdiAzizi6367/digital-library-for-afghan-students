@extends('layouts.app')

@section('content')

<meta charset="UTF-8">
<title>{{ $book->title_en }}</title>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script>
    pdfjsLib.GlobalWorkerOptions.workerSrc =
        "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js";
</script>

{{-- Font Awesome (if not already in layout) --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    :root {
        --primary: #667eea;
        --primary-dark: #764ba2;
        --bg-light: #f0f2f5;
        --bg-dark: #1a1a2e;
        --surface-light: #ffffff;
        --surface-dark: #16213e;
        --text-light: #2d3436;
        --text-dark: #e0e0e0;
        --shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        --radius: 16px;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* ==========================================
       READER WRAPPER
    ========================================== */
    .reader-wrapper {
        background: var(--bg-light);
        min-height: 100vh;
        padding: 20px 0;
        transition: var(--transition);
    }

    .reader-wrapper.dark-mode {
        background: var(--bg-dark);
        color: var(--text-dark);
    }

    /* ==========================================
       TOP BAR
    ========================================== */
    .top-bar {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border-radius: var(--radius);
        padding: 15px 25px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        box-shadow: 0 4px 20px rgba(102, 126, 234, 0.4);
    }

    .book-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .book-info .thumb {
        width: 45px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .book-info .title {
        color: white;
        font-weight: 700;
        font-size: 1.1rem;
        margin: 0;
        max-width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .book-info .author {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.85rem;
        margin: 0;
    }

    .top-actions {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    /* ==========================================
       CONTROL BUTTONS
    ========================================== */
    .btn-reader {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 10px 16px;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
        white-space: nowrap;
    }

    .btn-reader:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .btn-reader:active {
        transform: scale(0.96);
    }

    .btn-glass {
        background: rgba(255, 255, 255, 0.15);
        color: white;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .btn-glass:hover {
        background: rgba(255, 255, 255, 0.25);
        color: white;
    }

    .btn-surface {
        background: var(--surface-light);
        color: var(--text-light);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .dark-mode .btn-surface {
        background: var(--surface-dark);
        color: var(--text-dark);
    }

    .btn-surface:hover {
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
        color: var(--text-light);
    }

    .dark-mode .btn-surface:hover {
        color: var(--text-dark);
    }

    .btn-gradient {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
    }

    .btn-gradient:hover {
        color: white;
        box-shadow: 0 4px 16px rgba(102, 126, 234, 0.4);
    }

    .btn-success-custom {
        background: linear-gradient(135deg, #00b894, #00cec9);
        color: white;
    }

    .btn-success-custom:hover {
        color: white;
        box-shadow: 0 4px 16px rgba(0, 184, 148, 0.4);
    }

    .btn-icon {
        width: 42px;
        height: 42px;
        padding: 0;
        border-radius: 12px;
        font-size: 1rem;
    }

    /* ==========================================
       TOOLBAR
    ========================================== */
    .toolbar {
        background: var(--surface-light);
        border-radius: var(--radius);
        padding: 12px 20px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
        box-shadow: var(--shadow);
        transition: var(--transition);
    }

    .dark-mode .toolbar {
        background: var(--surface-dark);
    }

    .toolbar-group {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .toolbar-divider {
        width: 1px;
        height: 30px;
        background: #e0e0e0;
        margin: 0 8px;
    }

    .dark-mode .toolbar-divider {
        background: #333;
    }

    .page-indicator {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        padding: 6px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    /* ==========================================
       PROGRESS BAR
    ========================================== */
    .progress-wrapper {
        margin-bottom: 15px;
    }

    .progress-bar-custom {
        height: 6px;
        background: #e9ecef;
        border-radius: 10px;
        overflow: hidden;
        position: relative;
    }

    .dark-mode .progress-bar-custom {
        background: #2d3436;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--primary), var(--primary-dark), #e84393);
        border-radius: 10px;
        transition: width 0.4s ease;
        position: relative;
    }

    .progress-fill::after {
        content: '';
        position: absolute;
        right: 0;
        top: -3px;
        width: 12px;
        height: 12px;
        background: white;
        border: 3px solid var(--primary-dark);
        border-radius: 50%;
    }

    .progress-text {
        text-align: center;
        font-size: 0.75rem;
        color: #999;
        margin-top: 5px;
        font-weight: 600;
    }

    .dark-mode .progress-text {
        color: #777;
    }

    /* ==========================================
       PDF CANVAS AREA
    ========================================== */
    .pdf-container {
        background: var(--surface-light);
        border-radius: var(--radius);
        padding: 20px;
        box-shadow: var(--shadow);
        display: flex;
        justify-content: center;
        align-items: flex-start;
        min-height: 500px;
        overflow: auto;
        transition: var(--transition);
        position: relative;
    }

    .dark-mode .pdf-container {
        background: var(--surface-dark);
    }

    .dark-mode .pdf-container canvas {
        filter: invert(1) hue-rotate(180deg);
    }

    #pdf-render {
        max-width: 100%;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    /* ==========================================
       SEARCH BAR
    ========================================== */
    .search-bar {
        background: var(--surface-light);
        border-radius: var(--radius);
        padding: 15px 20px;
        margin-top: 15px;
        box-shadow: var(--shadow);
        display: flex;
        gap: 10px;
        align-items: center;
        transition: var(--transition);
    }

    .dark-mode .search-bar {
        background: var(--surface-dark);
    }

    .search-input {
        flex: 1;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 10px 16px;
        font-size: 0.9rem;
        transition: var(--transition);
        outline: none;
        background: transparent;
        color: var(--text-light);
    }

    .dark-mode .search-input {
        border-color: #333;
        color: var(--text-dark);
    }

    .search-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.15);
    }

    .search-input::placeholder {
        color: #aaa;
    }

    /* ==========================================
       KEYBOARD SHORTCUTS TOOLTIP
    ========================================== */
    .shortcuts-panel {
        background: var(--surface-light);
        border-radius: var(--radius);
        padding: 20px;
        margin-top: 15px;
        box-shadow: var(--shadow);
        display: none;
        transition: var(--transition);
    }

    .dark-mode .shortcuts-panel {
        background: var(--surface-dark);
    }

    .shortcuts-panel.show {
        display: block;
        animation: fadeIn 0.3s ease;
    }

    .shortcut-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .dark-mode .shortcut-item {
        border-color: #2d3436;
    }

    .shortcut-item:last-child {
        border: none;
    }

    .kbd {
        background: #f0f0f0;
        padding: 3px 10px;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 700;
        font-family: monospace;
    }

    .dark-mode .kbd {
        background: #2d3436;
    }

    /* ==========================================
       LOADING SPINNER
    ========================================== */
    .loader {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }

    .spinner {
        width: 50px;
        height: 50px;
        border: 4px solid rgba(102, 126, 234, 0.2);
        border-top: 4px solid var(--primary);
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
        margin: 0 auto 15px;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ==========================================
       RTL SUPPORT
    ========================================== */
    [dir="rtl"] .top-bar,
    [dir="rtl"] .toolbar,
    [dir="rtl"] .search-bar,
    [dir="rtl"] .toolbar-group {
        flex-direction: row-reverse;
    }

    [dir="rtl"] .book-info {
        flex-direction: row-reverse;
        text-align: right;
    }

    [dir="rtl"] .top-actions {
        flex-direction: row-reverse;
    }

    [dir="rtl"] .shortcut-item {
        flex-direction: row-reverse;
    }

    [dir="rtl"] .progress-fill::after {
        right: auto;
        left: 0;
    }

    [dir="rtl"] .btn-reader {
        flex-direction: row-reverse;
    }

    /* ==========================================
       FULLSCREEN
    ========================================== */
    .reader-wrapper.fullscreen-mode {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 9999;
        overflow-y: auto;
        padding: 15px;
    }

    /* ==========================================
       TOAST NOTIFICATION
    ========================================== */
    .toast-notification {
        position: fixed;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%) translateY(100px);
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.9rem;
        z-index: 99999;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        white-space: nowrap;
    }

    .toast-notification.show {
        transform: translateX(-50%) translateY(0);
    }

    /* ==========================================
       RESPONSIVE
    ========================================== */
    @media (max-width: 768px) {
        .top-bar {
            padding: 12px 15px;
            border-radius: 12px;
        }

        .book-info .title {
            max-width: 150px;
            font-size: 0.95rem;
        }

        .toolbar {
            padding: 10px 12px;
            justify-content: center;
        }

        .toolbar-divider {
            display: none;
        }

        .pdf-container {
            padding: 10px;
            border-radius: 12px;
        }

        .search-bar {
            flex-direction: column;
        }

        .search-input {
            width: 100%;
        }

        .btn-reader span.btn-text {
            display: none;
        }

        .btn-reader {
            padding: 10px 12px;
        }

        .shortcuts-panel {
            display: none !important;
        }
    }

    @media (max-width: 480px) {
        .book-info .thumb {
            display: none;
        }

        .top-actions {
            width: 100%;
            justify-content: center;
        }

        .toolbar {
            gap: 6px;
        }

        .btn-icon {
            width: 38px;
            height: 38px;
        }
    }
</style>

<div class="reader-wrapper" id="readerWrapper" dir="{{ app()->getLocale() == 'ar' || app()->getLocale() == 'fa' || app()->getLocale() == 'ur' ? 'rtl' : 'ltr' }}">
    <div class="container-fluid px-md-4">

        {{-- ========================
             TOP BAR
        ========================= --}}
        <div class="top-bar">
            <div class="book-info">
                <img src="{{ asset('storage/' . $book->thumbnail) }}"
                     alt="{{ $book->title_en }}"
                     class="thumb">
                <div>
                    <p class="title">{{ $book->getTitleAttribute() }}</p>
                    <p class="author">
                        <i class="fas fa-pen-nib me-1"></i>{{ $book->author }}
                    </p>
                </div>
            </div>

            <div class="top-actions">
                @auth
                    <a href="{{ route('books.download', $book->id) }}"
                       class="btn-reader btn-glass"
                       title="Download">
                        <i class="fas fa-cloud-arrow-down"></i>
                        <span class="btn-text">{{ __('Download') }}</span>
                    </a>
                @endauth

                <button class="btn-reader btn-glass btn-icon"
                        id="toggleDir"
                        title="Toggle RTL/LTR">
                    <i class="fas fa-right-left"></i>
                </button>

                <button class="btn-reader btn-glass btn-icon"
                        id="darkMode"
                        title="Dark Mode">
                    <i class="fas fa-moon" id="darkIcon"></i>
                </button>

                <button class="btn-reader btn-glass btn-icon"
                        id="fullscreenBtn"
                        title="Fullscreen">
                    <i class="fas fa-expand" id="fsIcon"></i>
                </button>
            </div>
        </div>

        {{-- ========================
             TOOLBAR
        ========================= --}}
        <div class="toolbar">

            {{-- Navigation --}}
            <div class="toolbar-group">
                <button class="btn-reader btn-surface btn-icon" id="firstPage" title="First Page">
                    <i class="fas fa-angles-left"></i>
                </button>
                <button class="btn-reader btn-surface btn-icon" id="prev" title="Previous Page">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <span class="page-indicator">
                    <span id="page-num">1</span> / <span id="page-count">1</span>
                </span>

                <button class="btn-reader btn-surface btn-icon" id="next" title="Next Page">
                    <i class="fas fa-chevron-right"></i>
                </button>
                <button class="btn-reader btn-surface btn-icon" id="lastPage" title="Last Page">
                    <i class="fas fa-angles-right"></i>
                </button>
            </div>

            <div class="toolbar-divider"></div>

            {{-- Zoom --}}
            <div class="toolbar-group">
                <button class="btn-reader btn-surface btn-icon" id="zoomOut" title="Zoom Out">
                    <i class="fas fa-minus"></i>
                </button>
                <span class="page-indicator" id="zoomLevel">100%</span>
                <button class="btn-reader btn-surface btn-icon" id="zoomIn" title="Zoom In">
                    <i class="fas fa-plus"></i>
                </button>
                <button class="btn-reader btn-surface btn-icon" id="zoomReset" title="Reset Zoom">
                    <i class="fas fa-rotate-right"></i>
                </button>
            </div>

            <div class="toolbar-divider"></div>

            {{-- Extras --}}
            <div class="toolbar-group">
                <button class="btn-reader btn-surface btn-icon" id="shortcutsToggle" title="Keyboard Shortcuts">
                    <i class="fas fa-keyboard"></i>
                </button>
            </div>
        </div>

        {{-- ========================
             PROGRESS BAR
        ========================= --}}
        <div class="progress-wrapper">
            <div class="progress-bar-custom">
                <div class="progress-fill" id="readingProgress" style="width: 0%"></div>
            </div>
            <p class="progress-text" id="progressText">0% completed</p>
        </div>

        {{-- ========================
             PDF VIEWER
        ========================= --}}
        <div class="pdf-container" id="pdfContainer">
            <div class="loader" id="loader">
                <div class="spinner"></div>
                <p style="font-weight:600; color:#999;">Loading PDF...</p>
            </div>
            <canvas id="pdf-render"></canvas>
        </div>

        {{-- ========================
             SEARCH BAR
        ========================= --}}
        <div class="search-bar">
            <i class="fas fa-search" style="color: var(--primary); font-size: 1.1rem;"></i>
            <input type="text"
                   id="searchText"
                   class="search-input"
                   placeholder="{{ __('Search in this book...') }}">
            <button class="btn-reader btn-gradient" id="searchBtn">
                <i class="fas fa-magnifying-glass"></i>
                <span class="btn-text">{{ __('Search') }}</span>
            </button>
        </div>

        {{-- ========================
             KEYBOARD SHORTCUTS
        ========================= --}}
        <div class="shortcuts-panel" id="shortcutsPanel">
            <h6 style="font-weight:700; margin-bottom:12px;">
                <i class="fas fa-keyboard me-2" style="color:var(--primary)"></i>
                Keyboard Shortcuts
            </h6>
            <div class="shortcut-item">
                <span>Previous Page</span>
                <span><span class="kbd">←</span></span>
            </div>
            <div class="shortcut-item">
                <span>Next Page</span>
                <span><span class="kbd">→</span></span>
            </div>
            <div class="shortcut-item">
                <span>Zoom In</span>
                <span><span class="kbd">+</span></span>
            </div>
            <div class="shortcut-item">
                <span>Zoom Out</span>
                <span><span class="kbd">-</span></span>
            </div>
            <div class="shortcut-item">
                <span>Toggle Dark Mode</span>
                <span><span class="kbd">D</span></span>
            </div>
            <div class="shortcut-item">
                <span>Fullscreen</span>
                <span><span class="kbd">F</span></span>
            </div>
            <div class="shortcut-item">
                <span>First Page</span>
                <span><span class="kbd">Home</span></span>
            </div>
            <div class="shortcut-item">
                <span>Last Page</span>
                <span><span class="kbd">End</span></span>
            </div>
        </div>

    </div>
</div>

{{-- ========================
     TOAST
========================= --}}
<div class="toast-notification" id="toast"></div>

<script>
    /* ==========================================
       VARIABLES
    ========================================== */
    const url = @json(asset('storage/' . rawurlencode($book->file_path)));
    const canvas = document.getElementById('pdf-render');
    const ctx = canvas.getContext('2d');
    const wrapper = document.getElementById('readerWrapper');

    let pdfDoc = null,
        pageNum = 1,
        scale = 1.4,
        baseScale = 1.4,
        isRendering = false;

    /* ==========================================
       TOAST
    ========================================== */
    function showToast(msg) {
        const toast = document.getElementById('toast');
        toast.textContent = msg;
        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 2500);
    }

    /* ==========================================
       RENDER PAGE
    ========================================== */
    function renderPage(num) {
        if (isRendering) return;
        isRendering = true;

        pdfDoc.getPage(num).then(page => {
            const viewport = page.getViewport({ scale });

            canvas.width = viewport.width;
            canvas.height = viewport.height;

            const renderCtx = {
                canvasContext: ctx,
                viewport: viewport
            };

            page.render(renderCtx).promise.then(() => {
                isRendering = false;
            });

            document.getElementById('page-num').textContent = num;

            // Progress
            let percent = Math.round((num / pdfDoc.numPages) * 100);
            document.getElementById('readingProgress').style.width = percent + '%';
            document.getElementById('progressText').textContent = percent + '% completed';

            // Zoom level display
            let zoomPercent = Math.round((scale / baseScale) * 100);
            document.getElementById('zoomLevel').textContent = zoomPercent + '%';

            // Save to localStorage
            localStorage.setItem('lastPage_' + url, num);
        });
    }

    /* ==========================================
       LOAD PDF
    ========================================== */
    pdfjsLib.getDocument(url).promise.then(pdf => {
        pdfDoc = pdf;
        document.getElementById('page-count').textContent = pdfDoc.numPages;

        // Restore last page
        let saved = localStorage.getItem('lastPage_' + url);
        if (saved) {
            pageNum = parseInt(saved);
            showToast('📖 Resumed from page ' + pageNum);
        }

        // Hide loader
        document.getElementById('loader').style.display = 'none';

        renderPage(pageNum);
    }).catch(err => {
        document.getElementById('loader').innerHTML =
            '<i class="fas fa-exclamation-triangle" style="font-size:3rem; color:#e74c3c; margin-bottom:15px;"></i>' +
            '<p style="font-weight:600; color:#e74c3c;">Failed to load PDF</p>';
    });

    /* ==========================================
       NAVIGATION
    ========================================== */
    document.getElementById('prev').onclick = () => {
        if (pageNum > 1) { pageNum--; renderPage(pageNum); }
    };

    document.getElementById('next').onclick = () => {
        if (pdfDoc && pageNum < pdfDoc.numPages) { pageNum++; renderPage(pageNum); }
    };

    document.getElementById('firstPage').onclick = () => {
        pageNum = 1;
        renderPage(pageNum);
        showToast('⏮ First page');
    };

    document.getElementById('lastPage').onclick = () => {
        if (pdfDoc) {
            pageNum = pdfDoc.numPages;
            renderPage(pageNum);
            showToast('⏭ Last page');
        }
    };

    /* ==========================================
       ZOOM
    ========================================== */
    document.getElementById('zoomIn').onclick = () => {
        scale += 0.2;
        renderPage(pageNum);
    };

    document.getElementById('zoomOut').onclick = () => {
        if (scale > 0.4) {
            scale -= 0.2;
            renderPage(pageNum);
        }
    };

    document.getElementById('zoomReset').onclick = () => {
        scale = baseScale;
        renderPage(pageNum);
        showToast('🔄 Zoom reset');
    };

    /* ==========================================
       DARK MODE
    ========================================== */
    document.getElementById('darkMode').onclick = () => {
        wrapper.classList.toggle('dark-mode');
        const icon = document.getElementById('darkIcon');
        const isDark = wrapper.classList.contains('dark-mode');

        icon.className = isDark ? 'fas fa-sun' : 'fas fa-moon';
        showToast(isDark ? '🌙 Dark mode ON' : '☀️ Light mode ON');

        localStorage.setItem('darkMode', isDark);
    };

    // Restore dark mode
    if (localStorage.getItem('darkMode') === 'true') {
        wrapper.classList.add('dark-mode');
        document.getElementById('darkIcon').className = 'fas fa-sun';
    }

    /* ==========================================
       FULLSCREEN
    ========================================== */
    document.getElementById('fullscreenBtn').onclick = () => {
        wrapper.classList.toggle('fullscreen-mode');
        const icon = document.getElementById('fsIcon');
        const isFS = wrapper.classList.contains('fullscreen-mode');

        icon.className = isFS ? 'fas fa-compress' : 'fas fa-expand';
        showToast(isFS ? '🖥 Fullscreen ON' : '🖥 Fullscreen OFF');
    };

    /* ==========================================
       RTL / LTR TOGGLE
    ========================================== */
    document.getElementById('toggleDir').onclick = () => {
        const current = wrapper.getAttribute('dir');
        const newDir = current === 'rtl' ? 'ltr' : 'rtl';

        wrapper.setAttribute('dir', newDir);
        showToast('📐 Direction: ' + newDir.toUpperCase());

        localStorage.setItem('readerDir', newDir);
    };

    // Restore direction
    const savedDir = localStorage.getItem('readerDir');
    if (savedDir) {
        wrapper.setAttribute('dir', savedDir);
    }

    /* ==========================================
       SEARCH
    ========================================== */
    document.getElementById('searchBtn').onclick = doSearch;
    document.getElementById('searchText').addEventListener('keydown', (e) => {
        if (e.key === 'Enter') doSearch();
    });

    async function doSearch() {
        let keyword = document.getElementById('searchText').value.trim().toLowerCase();
        if (!keyword) {
            showToast('⚠️ Enter a search term');
            return;
        }

        showToast('🔎 Searching...');

        for (let i = 1; i <= pdfDoc.numPages; i++) {
            let page = await pdfDoc.getPage(i);
            let text = await page.getTextContent();
            let content = text.items.map(t => t.str.toLowerCase()).join(' ');

            if (content.includes(keyword)) {
                pageNum = i;
                renderPage(pageNum);
                showToast('✅ Found on page ' + i);
                return;
            }
        }

        showToast('❌ Not found in this book');
    }

    /* ==========================================
       KEYBOARD SHORTCUTS
    ========================================== */
    document.addEventListener('keydown', (e) => {
        if (e.target.tagName === 'INPUT') return;

        switch (e.key) {
            case 'ArrowLeft':
                document.getElementById('prev').click();
                break;
            case 'ArrowRight':
                document.getElementById('next').click();
                break;
            case '+':
            case '=':
                document.getElementById('zoomIn').click();
                break;
            case '-':
                document.getElementById('zoomOut').click();
                break;
            case 'd':
            case 'D':
                document.getElementById('darkMode').click();
                break;
            case 'f':
            case 'F':
                document.getElementById('fullscreenBtn').click();
                break;
            case 'Home':
                document.getElementById('firstPage').click();
                break;
            case 'End':
                document.getElementById('lastPage').click();
                break;
        }
    });

    document.getElementById('shortcutsToggle').onclick = () => {
        document.getElementById('shortcutsPanel').classList.toggle('show');
    };

</script>

@endsection