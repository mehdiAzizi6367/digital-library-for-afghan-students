@extends('layouts.admin')

@section('title','Reports')

@section('content')
<div class="container-fluid">
    <h1>{{ __('dashboard.report') }}</h1>
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('dashboard.download_per_book') }}</div>
                <div class="card-body">
                    <canvas id="downloadsChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('dashboard.download_per_favorite') }}</div>
                <div class="card-body">
                    <canvas id="favoritesChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Downloads Chart
    const ctxDownloads = document.getElementById('downloadsChart').getContext('2d');
    const downloadsChart = new Chart(ctxDownloads, {
        type: 'bar',
        data: {
            labels: {!! json_encode($downloadsData['labels']) !!},
            datasets: [{
                label: 'Downloads',
                data: {!! json_encode($downloadsData['data']) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.7)'
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    // Favorites Chart
    const ctxFavorites = document.getElementById('favoritesChart').getContext('2d');
    const favoritesChart = new Chart(ctxFavorites, {
        type: 'bar',
        data: {
            labels: {!! json_encode($favoritesData['labels']) !!},
            datasets: [{
                label: 'Favorites',
                data: {!! json_encode($favoritesData['data']) !!},
                backgroundColor: 'rgba(255, 99, 132, 0.7)'
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });
</script>
@endsection