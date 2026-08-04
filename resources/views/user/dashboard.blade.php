@extends('layouts.user')

@section('title', __('dashboard.dashboard'))

@section('content')

<div class="container-fluid py-4 px-4">

    {{-- ═══════════════════════════════
         WELCOME BANNER
    ═══════════════════════════════ --}}
    <div class="card border-0 rounded-4 mb-4 overflow-hidden"
         style="background:linear-gradient(135deg,#4e73df 0%,#6f42c1 100%);">
        <div class="card-body p-4 text-white position-relative">

            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="fw-bold mb-2">
                        {{ __('dashboard.welcome') }}, {{ auth()->user()->getUsername() }} 👋
                    </h2>
                    <p class="mb-0 opacity-75">
                        {{ __('dashboard.welcome_hint') }}
                    </p>
                </div>
                <div class="col-md-4 text-md-end d-none d-md-block">
                    <i class="bi bi-journal-richtext" style="font-size:80px;opacity:0.15;"></i>
                </div>
            </div>

        </div>
    </div>

    {{-- ═══════════════════════════════
         REJECTED BOOKS ALERT
    ═══════════════════════════════ --}}
    @if($book_reasons)
        <div class="alert border-0 rounded-4 shadow-sm mb-4"
             style="background:#fef2f2;border-left:4px solid #ef4444;">
            <div class="d-flex align-items-center gap-3">
                <div class="d-flex align-items-center justify-content-center rounded-circle bg-danger bg-opacity-10"
                     style="width:44px;height:44px;">
                    <i class="fas fa-exclamation-triangle text-danger"></i>
                </div>
                <div class="flex-grow-1">
                    @php
                        $reject_ = "Your $book_reasons book was rejected! due to this ";
                        $rejects = "Your $book_reasons books were rejected";
                    @endphp
                    <a href="{{ route('Rj_reason') }}"
                       class="text-danger fw-bold text-decoration-none">
                        {{ ($book_reasons == 1) ? $reject_ : $rejects }}
                        <i class="bi bi-arrow-{{ in_array(app()->getLocale(), ['ps','dr','fa','ar']) ? 'left' : 'right' }} ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    @endif

    {{-- ═══════════════════════════════
         STATS CARDS
    ═══════════════════════════════ --}}
    <div class="row g-4 mb-4">

        <div class="col-md-4">
            <div class="card stats-card shadow-sm p-4">
                <div class="icon-badge" style="background:linear-gradient(135deg,#dbeafe,#bfdbfe);">
                    <i class="bi bi-book fs-3 text-primary"></i>
                </div>
                <div class="text-center">
                    <p class="text-muted mb-1 small text-uppercase fw-semibold">
                        {{ __('dashboard.total_books') }}
                    </p>
                    <h3 class="fw-bold mb-0">{{ $totalBooks ?? 0 }}</h3>
                    <small class="text-success">
                        <i class="bi bi-arrow-up"></i> {{ __('dashboard.this_month') }}
                    </small>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stats-card shadow-sm p-4">
                <div class="icon-badge" style="background:linear-gradient(135deg,#d1fae5,#a7f3d0);">
                    <i class="bi bi-download fs-3 text-success"></i>
                </div>
                <div class="text-center">
                    <p class="text-muted mb-1 small text-uppercase fw-semibold">
                        {{ __('dashboard.downloads') }}
                    </p>
                    <h3 class="fw-bold mb-0">{{ $downloads ?? 0 }}</h3>
                    <small class="text-primary">
                        <i class="bi bi-graph-up"></i> {{ __('dashboard.active') }}
                    </small>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stats-card shadow-sm p-4">
                <div class="icon-badge" style="background:linear-gradient(135deg,#fee2e2,#fecaca);">
                    <i class="bi bi-heart-fill fs-3 text-danger"></i>
                </div>
                <div class="text-center">
                    <p class="text-muted mb-1 small text-uppercase fw-semibold">
                        {{ __('dashboard.favorites') }}
                    </p>
                    <h3 class="fw-bold mb-0">{{ $favorites ?? 0 }}</h3>
                    <small class="text-danger">
                        <i class="bi bi-heart"></i> {{ __('dashboard.saved') }}
                    </small>
                </div>
            </div>
        </div>

    </div>

    {{-- ═══════════════════════════════
         NAVIGATION CARDS
    ═══════════════════════════════ --}}
    <div class="row g-4 mb-4">

        <div class="col-md-4">
            <div class="card nav-card shadow-sm p-4 h-100">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="rounded-3 d-flex align-items-center justify-content-center"
                         style="width:48px;height:48px;background:#dbeafe;">
                        <i class="bi bi-journal-bookmark fs-4 text-primary"></i>
                    </div>
                    <h5 class="fw-bold mb-0">{{ __('dashboard.my_books') }}</h5>
                </div>
                <p class="text-muted small">{{ __('dashboard.view_books') }}</p>
                <a href="{{ route('user.mybook') }}"
                   class="btn btn-primary w-100 rounded-3 fw-semibold mt-auto">
                    <i class="bi bi-eye me-1"></i>
                    {{ __('message.view') }}
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card nav-card shadow-sm p-4 h-100">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="rounded-3 d-flex align-items-center justify-content-center"
                         style="width:48px;height:48px;background:#fee2e2;">
                        <i class="bi bi-heart-fill fs-4 text-danger"></i>
                    </div>
                    <h5 class="fw-bold mb-0">{{ __('dashboard.favorites') }}</h5>
                </div>
                <p class="text-muted small">{{ __('dashboard.saved_books') }}</p>
                <a href="{{ route('favorites.index') }}"
                   class="btn btn-danger w-100 rounded-3 fw-semibold mt-auto">
                    <i class="bi bi-heart me-1"></i>
                    {{ __('message.view') }}
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card nav-card shadow-sm p-4 h-100">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="rounded-3 d-flex align-items-center justify-content-center"
                         style="width:48px;height:48px;background:#d1fae5;">
                        <i class="bi bi-download fs-4 text-success"></i>
                    </div>
                    <h5 class="fw-bold mb-0">{{ __('dashboard.downloads') }}</h5>
                </div>
                <p class="text-muted small">{{ __('dashboard.downloaded_books') }}</p>
                <a href="{{ route('user.downloads.index') }}"
                   class="btn btn-success w-100 rounded-3 fw-semibold mt-auto">
                    <i class="bi bi-download me-1"></i>
                    {{ __('message.view') }}
                </a>
            </div>
        </div>

    </div>

    {{-- ═══════════════════════════════
         QUICK ACTIONS
    ═══════════════════════════════ --}}
    <div class="d-flex flex-column flex-sm-row gap-2 mb-4">
        <a href="{{ route('user.books.create') }}"
           class="btn btn-success rounded-3 fw-semibold px-4">
            <i class="bi bi-plus-circle me-1"></i>
            {{ __('dashboard.add_record') }}
        </a>
        <a href="{{ URL('user/books') }}"
           class="btn btn-warning rounded-3 fw-semibold px-4">
            <i class="bi bi-gear me-1"></i>
            {{ __('dashboard.manage_books') }}
        </a>
    </div>

    {{-- ═══════════════════════════════
         MONTHLY CHART
    ═══════════════════════════════ --}}
    <div class="card border-0 rounded-4 shadow-sm p-4 mb-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h5 class="fw-bold mb-1">
                    📊 {{ __('dashboard.upload_books') }}
                </h5>
                <p class="text-muted small mb-0">
                    {{ __('dashboard.chart_hint') }}
                </p>
            </div>
            <div class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2">
                <i class="bi bi-calendar"></i> {{ date('Y') }}
            </div>
        </div>
        <canvas id="booksChart" height="100"></canvas>
    </div>

</div>

@endsection

@section('scripts')
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
                label: "{{ __('dashboard.uploaded_books') }}",
                data: data,
                backgroundColor: 'rgba(78, 115, 223, 0.8)',
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1e293b',
                    padding: 12,
                    cornerRadius: 8,
                    titleFont: { size: 13 },
                    bodyFont: { size: 13 },
                    callbacks: {
                        label: (ctx) => "📚 {{ __('dashboard.uploaded_books') }}: " + ctx.raw
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0,0,0,0.05)' },
                    ticks: { color: '#94a3b8' }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#94a3b8' }
                }
            }
        }
    });
</script>
@endsection