@extends('layouts.app')

@section('content')

<meta charset="UTF-8">
<title>{{ $book->title_en }}</title>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script>
pdfjsLib.GlobalWorkerOptions.workerSrc =
"https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js";
</script>

<style>
/* =========================
   DARK MODE
========================= */
.dark-reader {
    background: #121212;
    color: white;
}
.dark-reader canvas {
    filter: invert(1) hue-rotate(180deg);
}

/* =========================
   RESPONSIVE CONTROLS
========================= */
.control-bar {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.control-bar button,
.control-bar a {
    flex: 1;
    min-width: 110px;
}

/* =========================
   MOBILE FIXES
========================= */
@media (max-width: 768px) {

    canvas {
        width: 100% !important;
        height: auto !important;
    }

    .control-bar {
        flex-direction: column;
    }

    .control-bar button,
    .control-bar a {
        width: 100%;
    }

    #searchText {
        width: 100% !important;
    }

    .thumb-box {
        display: none;
    }
}
</style>

<div class="container py-3">

    {{-- CONTROLS --}}
    <div class="control-bar mb-3">

        <button id="prev" class="btn btn-secondary">
            ⬅ Prev
        </button>

        <button id="next" class="btn btn-secondary">
            Next ➡
        </button>

        <button id="zoomIn" class="btn btn-info">
            🔍+
        </button>

        <button id="zoomOut" class="btn btn-info">
            🔍-
        </button>

        <button id="darkMode" class="btn btn-dark">
            🌙 Dark
        </button>

        @auth
            <a href="{{ route('books.download', $book->id) }}"
               class="btn btn-success">
                ⬇ Download
            </a>
        @endauth

    </div>

    {{-- PROGRESS --}}
    <div class="progress mb-3">
        <div id="readingProgress" class="progress-bar"></div>
    </div>

    <div class="row">

        {{-- PDF VIEWER --}}
        <div class="col-md-10 col-12">
            <canvas id="pdf-render"
                    class="w-100 border rounded"></canvas>

            <p class="mt-2 text-center">
                Page <span id="page-num"></span> /
                <span id="page-count"></span>
            </p>
        </div>

        {{-- THUMBNAIL (hidden on mobile) --}}
        <div class="col-md-2 thumb-box">
            <img src="{{ asset('storage/'.$book->thumbnail) }}"
                 class="img-fluid rounded shadow-sm">
        </div>

    </div>

    {{-- SEARCH --}}
    <div class="mt-3">
        <input type="text"
               id="searchText"
               class="form-control w-50 d-inline"
               placeholder="Search in book...">

        <button id="searchBtn" class="btn btn-primary">
            Search
        </button>
    </div>

</div>

<script>
const url = @json(asset('storage/' . rawurlencode($book->file_path)));

let pdfDoc = null,
pageNum = 1,
scale = 1.4;

const canvas = document.getElementById('pdf-render');
const ctx = canvas.getContext('2d');

/* =========================
   RENDER PAGE
========================= */
function renderPage(num){
    pdfDoc.getPage(num).then(page => {

        const viewport = page.getViewport({ scale });

        canvas.width = viewport.width;
        canvas.height = viewport.height;

        page.render({
            canvasContext: ctx,
            viewport: viewport
        });

        document.getElementById('page-num').textContent = num;

        let percent = (num / pdfDoc.numPages) * 100;
        document.getElementById('readingProgress').style.width = percent + "%";

        localStorage.setItem('lastPage_'+url, num);
    });
}

/* =========================
   LOAD PDF
========================= */
pdfjsLib.getDocument(url).promise.then(pdf => {
    pdfDoc = pdf;
    document.getElementById('page-count').textContent = pdfDoc.numPages;

    let saved = localStorage.getItem('lastPage_'+url);
    if(saved) pageNum = parseInt(saved);

    renderPage(pageNum);
});

/* =========================
   CONTROLS
========================= */
document.getElementById('prev').onclick = () => {
    if(pageNum > 1) renderPage(--pageNum);
};

document.getElementById('next').onclick = () => {
    if(pageNum < pdfDoc.numPages) renderPage(++pageNum);
};

document.getElementById('zoomIn').onclick = () => {
    scale += 0.2;
    renderPage(pageNum);
};

document.getElementById('zoomOut').onclick = () => {
    if(scale > 0.4){
        scale -= 0.2;
        renderPage(pageNum);
    }
};

document.getElementById('darkMode').onclick = () => {
    document.body.classList.toggle('dark-reader');
};

/* =========================
   SEARCH
========================= */
document.getElementById('searchBtn').onclick = async () => {
    let keyword = document.getElementById('searchText').value.toLowerCase();

    for(let i=1;i<=pdfDoc.numPages;i++){
        let page = await pdfDoc.getPage(i);
        let text = await page.getTextContent();

        let content = text.items.map(t => t.str.toLowerCase()).join(" ");

        if(content.includes(keyword)){
            pageNum = i;
            renderPage(pageNum);
            alert("Found on page " + i);
            break;
        }
    }
};
</script>

@endsection