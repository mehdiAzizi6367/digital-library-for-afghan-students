@extends('layouts.admin')

@section('title','Dashboard')
<link rel="stylesheet" href="{{ asset('all.css') }}">
@section('content')
<div class="container-fluid">
    <!-- Dashboard Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
    </div>
    <div class="d-flex flex-column gap-2">
    <!-- New Users Alert -->
     @if ($newUser==0)

     @else
        <a href="{{ route('admin.users.index') }}" class="alert alert-success text-decoration-none d-flex align-items-center justify-content-between">
            <div>
                <i class="fas fa-user me-2"></i>
            {{ $newUser }}  {{ ($newUser==1)? "New user ragestered!":'New users ragestered!'}}
            </div>
            <span class="badge bg-light text-dark rounded-pill">
                {{ $newUser ?? "0" }}
            </span>
        </a>
     @endif     
    <!-- Pending Books Alert -->
     @if ($notifications==0)
     @else
        <a href="{{ route('admin.books.pending') }}" class="alert alert-warning text-decoration-none d-flex align-items-center justify-content-between">
            <div>
                <i class="fas fa-book me-2"></i>
                {{ $notifications }}  {{ ($notifications== 1)?" book is pending!": " books are pinding!" }} 
            </div>
            <span class="badge bg-dark rounded-pill">
                {{ $notifications ?? "0" }}
            </span>
        </a>
     @endif
</div>
    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ __('dashboard.total_books') }}</h5>
                     <i class="fas fa-book-open " style="font-size: 2rem;"></i>
                    <h2 class="card-text">{{ $books ?? 0 }}</h2>
                </div>
            </div>
        </div>
       
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ __('dashboard.all_users') }}</h5>
                    <i class="fas fa-user" style="font-size: 2rem;"></i>
                    <h2 class="card-text">{{ $users ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ __('dashboard.downloads') }}</h5>
                     <i class="bi bi-download fs-2 text-success"></i>
                    <h2 class="card-text">{{ $downloads ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ __('dashboard.favorites') }}</h5>
                        <i class="fas fa-heart fs-2"></i> Favorite
                    <h2 class="card-text">{{ $favorites ?? 0 }}</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Charts Section -->
        <div class="p-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">📊 Book Downloads</h5>
                <canvas id="downloadsChart"></canvas>
            </div>
        </div>
    <!-- Recent Books Table -->
    <div class="card">
        <div class="card-header">{{ __('message.latest_books') }}</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>{{ __('message.table_hash') }}</th>
                        <th>{{ __('message.table_title') }}</th>
                        <th>{{ __('message.table_author') }}</th>
                        <th>{{ __('message.table_category') }}</th>
                        <th>{{ __('message.table_uploaded') }}</th>
                        <th>{{ __('message.table_status') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentBooks as $book)
                    <tr>
                        <td>{{ $book->id }}</td>
                        <td>{{ $book->getTitle()}}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->category->getname() ?? '-' }}</td>
                        <td>{{ $book->user->name ?? '-' }}</td>
                        <td>{{ $book->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    const ctx = document.getElementById('downloadsChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($downloadsPerBookData['labels'] ?? []),
                datasets: [{
                    label: 'Downloads per Book',
                    data: @json($downloadsPerBookData['data'] ?? []),
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
</script>
@endsection