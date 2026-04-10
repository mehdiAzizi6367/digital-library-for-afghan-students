@extends('layouts.app')
<head>
    <meta charset="UTF-8">
    <title>Book Details</title>
</head>
{{-- pdf viewer link --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script> pdfjsLib.GlobalWorkerOptions.workerSrc ="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js";</script>



@section('content')
{{-- custom css --}}
<style>
   
   @media screen and(max-width:768px) {

      #thumbnails
      {
         display: none;
      }
      
   }
   .dark-reader {
      background:#121212;
      color:white;
   }

   .dark-reader canvas {
      filter: invert(1) hue-rotate(180deg);
   }

   .dark-reader .card{
      background:#1e1e1e;
   }
</style>
  
   <div class="container ">
       <div class="row my-4">
            <div class=" col-md-6  m-auto">
               <button id="prev" class="btn btn-secondary">{{ __('message.prev') }}</button>
               <button id="next" class="btn btn-secondary">{{ __('message.next') }}</button>
               <button id="zoomIn" class="btn btn-info">{{ __('message.zommIn')}}+</button>
               <button id="zoomOut" class="btn btn-info">{{ __('message.zommOut') }}-</button>
            </div>
            <div class="col-md-6 mt-3">
               <button id="darkMode" class="btn btn-dark">Dark Mode</button>
               @auth
                  <a href="{{ route('books.download', $book->id) }}" class="btn btn-success">{{ __('dashboard.downloads') }} </a>               
               @endauth
            </div>
      </div>
      <!-- Progress Bar -->
         <div class="progress mb-3">
            <div id="readingProgress" class="progress-bar" role="progressbar" style="width:0%"></div>
         </div>
      <div class="row"> 
         <!-- PDF Viewer -->
            <div class="col-md-10">
               <canvas id="pdf-render" style="width:90%; border:1px solid #ddd;"></canvas>
               <p class="mt-2">
               Page <span id="page-num"></span> of <span id="page-count"></span>
               </p>
            </div>
             <!-- Thumbnails -->
            <div class="col-md-2" style="overflow-y:auto;height: 1050px;">
                  <div id="thumbnails">
                     <img src="{{ $book->thumbnail }}" alt="">
                  </div>
            </div> 
      </div>
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <input type="text" id="searchText" placeholder="Search text..." class="form-control w-25 d-inline">
               <button id="searchBtn" class="btn btn-primary">{{ __('message.search') }}</button>
            </div>
         </div>
      </div>
   </div>
{{-- javascript link for pdf viewer --}}
<script>
      const url = "{{ asset('storage/'.$book->file_path) }}";
      let pdfDoc = null,
      pageNum = 1,
      scale = 1.4;
      const canvas = document.getElementById('pdf-render');
      const ctx = canvas.getContext('2d');
      function renderPage(num){
      pdfDoc.getPage(num).then(page => {
      const viewport = page.getViewport({scale});
      canvas.height = viewport.height;
      canvas.width = viewport.width;
         page.render({
      canvasContext: ctx,
      viewport: viewport
      }).promise;
      document.getElementById('page-num').textContent = num;
      updateProgress();
      localStorage.setItem('lastPage_'+url,num);
      });
      }
      function updateProgress(){
      let percent = (pageNum / pdfDoc.numPages) * 100;
      document.getElementById('readingProgress').style.width = percent + "%";
      }
      document.getElementById('prev').addEventListener('click',()=>{
      if(pageNum<=1) return;
      pageNum--;
      renderPage(pageNum);
      });
      document.getElementById('next').addEventListener('click',()=>{
      if(pageNum>=pdfDoc.numPages) return;
      pageNum++;
      renderPage(pageNum);
      });
      document.getElementById('zoomIn').addEventListener('click',()=>{
      scale += 0.2;
      renderPage(pageNum);
      });
      document.getElementById('zoomOut').addEventListener('click',()=>{
      if(scale <= 0.4) return;
      scale -= 0.2;
      renderPage(pageNum);
      });
      document.getElementById('darkMode').addEventListener('click',()=>{
      document.body.classList.toggle('dark-reader');
      });
      pdfjsLib.getDocument(url).promise.then(pdf => {
      pdfDoc = pdf;
      document.getElementById('page-count').textContent = pdfDoc.numPages;
      let savedPage = localStorage.getItem('lastPage_'+url);
      if(savedPage){
      pageNum = parseInt(savedPage);
      }
      renderPage(pageNum);
      generateThumbnails();
      });
      function generateThumbnails(){
      const container = document.getElementById('thumbnails');
      for(let i=1;i<=pdfDoc.numPages;i++){
      pdfDoc.getPage(i).then(page=>{
      let viewport = page.getViewport({scale:0.2});
      let thumb = document.createElement("canvas");
      let context = thumb.getContext("2d");
      thumb.height = viewport.height;
      thumb.width = viewport.width;
      page.render({
      canvasContext:context,
      viewport:viewport
      });
      thumb.style.cursor="pointer";
      thumb.style.marginBottom="10px";
      thumb.addEventListener("click",()=>{
      pageNum=i;
      renderPage(pageNum);
      });
      container.appendChild(thumb);
      });
      }
      }
      document.getElementById('searchBtn').addEventListener('click', async ()=>{
      let keyword = document.getElementById('searchText').value.toLowerCase();
      for(let i=1;i<=pdfDoc.numPages;i++){
      let page = await pdfDoc.getPage(i);
      let textContent = await page.getTextContent();
      let textItems = textContent.items.map(item=>item.str.toLowerCase());
      let pageText = textItems.join(" ");
      if(pageText.includes(keyword)){
      pageNum=i;
      renderPage(pageNum);
      alert("Found on page "+i);
      break;
      }
      }
      });
</script>

@endsection