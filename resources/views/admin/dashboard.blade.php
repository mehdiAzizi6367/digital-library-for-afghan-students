@extends('layouts.admin')

@section('title','Dashboard')
<link rel="stylesheet" href="{{ asset('all.css') }}">
@section('content')

<div class="container-fluid">
    <!-- Dashboard Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">{{ __('message.admin_dashboard') }}</h1>
        <div class="dropdown">
            <button class="btn btn-light position-relative" type="button" data-bs-toggle="dropdown">
                🔔 {{ __('message.notitifacation') }}
                <span class="badge bg-danger">
                    {{ auth()->user()->unreadNotifications->count() }}
                </span>
            </button>
            <!-- notification arean -->
            <div class="dropdown-menu dropdown-menu-end p-3" style="width: 320px; max-height: 400px; overflow-y: auto;">
                @forelse(auth()->user()->unreadNotifications->take(5) as $notification)
                <div class="mb-3 border-bottom pb-2">
                    <strong>{{ $notification->data['title'] }}</strong><br>
                    <small>{{ $notification->data['message'] }}</small>

                    @if(isset($notification->data['reason']))
                    <br>
                    <small class="text-danger">
                        Reason: {{ $notification->data['reason'] }}
                    </small>
                    @endif

                    @if(isset($notification->data['url']))
                    <br>
                    <a href="{{ $notification->data['url'] }}" class="btn btn-sm btn-primary mt-1">
                        {{ __('message.view') }}
                    </a>
                    @endif
                </div>
                @empty
                <p class="text-center">No new notifications</p>
                @endforelse

            </div>
        </div>
        <a href="{{ route('home') }}" class="btn btn-primary">
            <i class="fas fa-home" title="Back"></i>
        </a>
    </div>
    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ __('dashboard.total_books') }}</h5>
                     <i class="bi bi-book " style="font-size: 2rem;"></i>
                    <h2 class="card-text">{{ $books ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ __('dashboard.all_users') }}</h5>
                    <i class="bi bi-" style="font-size: 2rem;"></i>
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
                       <i class="bi bi-star fs-2 text-danger"></i>
                    <h2 class="card-text">{{ $favorites ?? 0 }}</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Charts Section -->
    <div class="row">
        <!-- Books Uploaded Per Month (Line Chart) -->
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">{{ __('dashboard.downloaded_books') }}</div>
                <div class="card-body">
                    <canvas id="booksMonthChart"></canvas>
                </div>
            </div>
        </div>
        <!-- User Roles Distribution (Pie Chart) -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">User Roles Distribution</div>
                <div class="card-body">
                    <canvas id="rolesChart"></canvas>

                </div>
            </div>
        </div>
    </div>
    <!-- Recent Books Table -->
    <div class="card">
        <div class="card-header">{{ __('message.latest_books') }}</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Uploaded By</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentBooks as $book)
                    <tr>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Books Uploaded Per Month (Line Chart)
const ctxBooksMonth = document.getElementById('booksMonthChart').getContext('2d');
const booksMonthChart = new Chart(ctxBooksMonth, {
    type: 'line',
    data: {
        labels: {
            !!json_encode($booksPerMonthData['labels'] ?? []) !!
        },
        datasets: [{
            label: 'Books Uploaded',
            data: {
                !!json_encode($booksPerMonthData['data'] ?? []) !!
            },
            backgroundColor: 'rgba(54, 162, 235, 0.3)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 2,
            fill: true,
            tension: 0.3
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                stepSize: 1
            }
        }
    }
});

// User Roles Pie Chart
const ctxRoles = document.getElementById('rolesChart').getContext('2d');
const rolesChart = new Chart(ctxRoles, {
    type: 'pie',
    data: {
        labels: {
            !!json_encode($rolesData['labels'] ?? []) !!
        },
        datasets: [{
            label: 'User Roles',
            data: {
                !!json_encode($rolesData['data'] ?? []) !!
            },
            backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545']
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});
</script>
@endsection