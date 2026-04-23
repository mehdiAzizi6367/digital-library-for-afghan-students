    @extends('layouts.app')

    <style>
     .stats-card:hover,
    .nav-card:hover {
        transform: translateY(-5px);
        transition: 0.3s ease;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .stats-card h3 {
        font-size: 28px;
    }

    .nav-card {
        cursor: pointer;
    }
    </style>
    @section('content')
    <div class="container py-5">
       
        <!-- Welcome & Stats -->
        <h2 class="fw-bold mb-4">
            {{ __('dashboard.welcome') }} , {{ auth()->user()->getUsername() }}
        </h2>
        <div class="container">
            @if(!$book_reasons )
            @else
                <div class="row alert alert-danger">
                    <div class="col-md-12">               
                        <div class="">
                            <span><i class="fas fa-book me-2"></i> </span> 
                            <span style="cursor: pointer" class="py-1  ">
                                @php
                                $reject_="Your $book_reasons book was rejected! due to this ";
                                $rejects= "Your $book_reasons books were rejected";
                                @endphp     
                            <a href="{{route('Rj_reason') }}">
                                {{ ($book_reasons==1) ? $reject_ : $rejects}}   
                            </a>
                            </span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="container py-4">
    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card text-center p-4 shadow-sm border-0 rounded-4 stats-card">
                <div class="mb-2">
                    <i class="bi bi-book fs-1 text-primary"></i>
                </div>
                <h6 class="text-muted">{{ __('dashboard.total_books') }}</h6>
                <h3 class="fw-bold">{{ $totalBooks ?? 0 }}</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center p-4 shadow-sm border-0 rounded-4 stats-card">
                <div class="mb-2">
                    <i class="bi bi-download fs-1 text-success"></i>
                </div>
                <h6 class="text-muted">{{ __('dashboard.downloads') }}</h6>
                <h3 class="fw-bold">{{ $downloads ?? 0 }}</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center p-4 shadow-sm border-0 rounded-4 stats-card">
                <div class="mb-2">
                    <i class="bi bi-heart fs-1 text-danger"></i>
                </div>
                <h6 class="text-muted">{{ __('dashboard.favorites') }}</h6>
                <h3 class="fw-bold">{{ $favorites ?? 0 }}</h3>
            </div>
        </div>
    </div>

    <!-- Navigation Cards -->
    <div class="row g-4">

        <div class="col-md-4">
            <div class="card p-4 shadow-sm border-0 rounded-4 nav-card h-100">
                <div class="mb-3">
                    <i class="bi bi-journal-bookmark fs-2 text-primary"></i>
                </div>
                <h5 class="fw-bold">{{ __('dashboard.my_books') }}</h5>
                <p class="text-muted">
                     {{ __('dashboard.view_books') }}
                </p>
                <a href="{{ route('user.mybook')}}" class="btn btn-primary w-100">{{ __('message.view') }}</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4 shadow-sm border-0 rounded-4 nav-card h-100">
                <div class="mb-3">
                    <i class="bi bi-heart fs-2 text-danger"></i>
                </div>
                <h5 class="fw-bold">{{ __('dashboard.favorites') }}</h5>
                <p class="text-muted">                  
                {{ __('dashboard.saved_books') }}
                </p>
                <a href="{{ route('favorites.index') }}" class="btn btn-danger w-100">{{ __('message.view') }}</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4 shadow-sm border-0 rounded-4 nav-card h-100">
                <div class="mb-3">
                    <i class="bi bi-download fs-2 text-success"></i>
                </div>
                <h5 class="fw-bold">{{ __('dashboard.downloads') }}</h5>
                <p class="text-muted">{{ __('dashboard.downloaded_books') }}
                </p>
                <a href="{{ route('user.downloads.index') }}" class="btn btn-success w-100">{{ __('message.view') }}</a>
            </div>
        </div>
     </div>

</div>
        <!-- Monthly Upload Chart -->
        <a href="{{ route('user.books.create') }}" class="btn btn-success float-right">+ {{ __('dashboard.add_record') }}</a>
        <a href="{{ URL('user/books') }}" class="btn btn-warning">{{ __('dashboard.manage_books') }}</a>
        <div class="card mt-5 p-4 shadow-sm mb-5">
            <h4 class="fw-bold mb-4 text-center">📊 {{ __('dashboard.upload_books') }}</h4>
            <canvas id="booksChart" height="100"></canvas>
        </div>
    </div>
    @include('footer.footer')
    <!-- Chart.js Script -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            let uploads = @json($monthlyUploads);

            let months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
            let data = new Array(12).fill(0);

            uploads.forEach(item => {
                data[item.month - 1] = item.total;
            });

            const ctx = document.getElementById('booksChart');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Uploaded Books',
                        data: data,
                        backgroundColor: '#4e73df'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return "📚 Uploaded Books: " + context.raw;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    @endsection