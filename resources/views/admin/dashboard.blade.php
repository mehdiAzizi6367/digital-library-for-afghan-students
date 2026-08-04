@extends('layouts.admin')

@section('title', __('message.dashboard'))

{{-- ═══════════════ STYLES ═══════════════ --}}

<style>
    /* ═══════════ Welcome Card ═══════════ */
    .welcome-card {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
        position: relative;
        overflow: hidden;
    }

    .welcome-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
    }

    .welcome-card::after {
        content: '';
        position: absolute;
        bottom: -30%;
        right: 10%;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }

    /* ═══════════ Alert Soft ═══════════ */
    .alert-soft-success {
        background: rgba(16, 185, 129, 0.08);
        color: #065f46;
        padding: 14px 18px;
        transition: all 0.2s ease;
    }

    .alert-soft-success:hover {
        background: rgba(16, 185, 129, 0.14);
        color: #065f46;
    }

    .alert-soft-warning {
        background: rgba(245, 158, 11, 0.08);
        color: #92400e;
        padding: 14px 18px;
        transition: all 0.2s ease;
    }

    .alert-soft-warning:hover {
        background: rgba(245, 158, 11, 0.14);
        color: #92400e;
    }

    .alert-icon-wrap {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    /* ═══════════ Stat Cards ═══════════ */
    .stat-card {
        background: #fff;
        border: 1px solid rgba(0, 0, 0, 0.04);
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
        transition: all 0.25s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    }

    .stat-label {
        font-size: 13px;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-value {
        font-size: 28px;
        font-weight: 800;
        color: #111827;
        line-height: 1.2;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }

    .stat-footer {
        border-top: 1px solid rgba(0, 0, 0, 0.04);
        padding-top: 8px;
    }

    /* ═══════════ Overview Items ═══════════ */
    .overview-item {
        background: #f9fafb;
        transition: all 0.2s ease;
    }

    .overview-item:hover {
        background: #f3f4f6;
    }

    .overview-icon {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    /* ═══════════ Book Thumb Mini ═══════════ */
    .book-thumb-mini {
        width: 36px;
        height: 46px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* ═══════════ Quick Actions ═══════════ */
    .quick-action-card {
        background: #f9fafb;
        border: 1px solid rgba(0, 0, 0, 0.04);
        transition: all 0.25s ease;
    }

    .quick-action-card:hover {
        background: #f0f2ff;
        border-color: rgba(99, 102, 241, 0.15);
        transform: translateY(-3px);
        box-shadow: 0 4px 16px rgba(99, 102, 241, 0.1);
    }

    .quick-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    /* ═══════════ Table ═══════════ */
    .table > thead > tr > th {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6b7280;
        border: none;
        padding: 12px 16px;
    }

    .table > tbody > tr > td {
        padding: 12px 16px;
        border-bottom: 1px solid #f3f4f6;
        vertical-align: middle;
    }

    .table > tbody > tr:last-child > td {
        border-bottom: none;
    }

    /* ═══════════ Chart Container ═══════════ */
    .chart-container {
        position: relative;
        height: 280px;
        width: 100%;
    }

    /* ═══════════ Mobile Adjustments ═══════════ */
    @media (max-width: 768px) {
        .stat-value {
            font-size: 22px;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            font-size: 18px;
        }

        .stat-label {
            font-size: 11px;
        }

        .welcome-card h3 {
            font-size: 18px;
        }
    }
</style>


{{-- ═══════════════ CONTENT ═══════════════ --}}
@section('content')
<div class="container-fluid py-2">

    {{-- ═══════════════ WELCOME SECTION ═══════════════ --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="welcome-card p-4 rounded-4">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h3 class="fw-bold text-white mb-1">
                            {{ __('dashboard.welcome_back') }}, {{ auth()->user()->getUsername() }}! 👋
                        </h3>
                        <p class="text-white-50 mb-0">
                            {{ __('dashboard.welcome_message') }}
                        </p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                        <span class="badge bg-white bg-opacity-25 text-white px-3 py-2 rounded-3">
                            <i class="bi bi-calendar3 me-1"></i>
                            {{ now()->format('l, M d, Y') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════ ALERT NOTIFICATIONS ═══════════════ --}}
    @if(($newUser ?? 0) > 0)
        <a href="{{ route('admin.users.index') }}"
           class="alert alert-soft-success d-flex align-items-center
                  justify-content-between text-decoration-none mb-3 rounded-3 border-0">
            <div class="d-flex align-items-center gap-2">
                <div class="alert-icon-wrap bg-success bg-opacity-10 rounded-circle p-2">
                    <i class="bi bi-person-plus-fill text-success"></i>
                </div>
                <div>
                    <strong>{{ $newUser }}</strong>
                    {{ ($newUser == 1)
                        ? __('dashboard.new_user_registered')
                        : __('dashboard.new_users_registered') }}
                </div>
            </div>
            <span class="badge bg-success rounded-pill px-3">{{ $newUser }}</span>
        </a>
    @endif

    @if(($notifications ?? 0) > 0)
        <a href="{{ route('admin.books.pending') }}"
           class="alert alert-soft-warning d-flex align-items-center
                  justify-content-between text-decoration-none mb-3 rounded-3 border-0">
            <div class="d-flex align-items-center gap-2">
                <div class="alert-icon-wrap bg-warning bg-opacity-10 rounded-circle p-2">
                    <i class="bi bi-clock-history text-warning"></i>
                </div>
                <div>
                    <strong>{{ $notifications }}</strong>
                    {{ ($notifications == 1)
                        ? __('dashboard.book_pending')
                        : __('dashboard.books_pending') }}
                </div>
            </div>
            <span class="badge bg-warning text-dark rounded-pill px-3">
                {{ $notifications }}
            </span>
        </a>
    @endif

    {{-- ═══════════════ STATISTICS CARDS ═══════════════ --}}
    <div class="row g-3 mb-4">

        {{-- Total Books --}}
        <div class="col-6 col-xl-3">
            <div class="stat-card rounded-4 p-3 h-100">
                <div class="d-flex align-items-start justify-content-between">
                    <div>
                        <p class="stat-label mb-1">{{ __('dashboard.total_books') }}</p>
                        <h2 class="stat-value mb-0">{{ number_format($books ?? 0) }}</h2>
                    </div>
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-journal-richtext"></i>
                    </div>
                </div>
                <div class="stat-footer mt-2">
                    <small class="text-muted">
                        <i class="bi bi-database me-1"></i>
                        {{ __('dashboard.in_library') }}
                    </small>
                </div>
            </div>
        </div>

        {{-- Total Users --}}
        <div class="col-6 col-xl-3">
            <div class="stat-card rounded-4 p-3 h-100">
                <div class="d-flex align-items-start justify-content-between">
                    <div>
                        <p class="stat-label mb-1">{{ __('dashboard.all_users') }}</p>
                        <h2 class="stat-value mb-0">{{ number_format($users ?? 0) }}</h2>
                    </div>
                    <div class="stat-icon bg-success bg-opacity-10 text-success">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
                <div class="stat-footer mt-2">
                    <small class="text-muted">
                        <i class="bi bi-person-check me-1"></i>
                        {{ __('dashboard.registered') }}
                    </small>
                </div>
            </div>
        </div>

        {{-- Downloads --}}
        <div class="col-6 col-xl-3">
            <div class="stat-card rounded-4 p-3 h-100">
                <div class="d-flex align-items-start justify-content-between">
                    <div>
                        <p class="stat-label mb-1">{{ __('dashboard.downloads') }}</p>
                        <h2 class="stat-value mb-0">{{ number_format($downloads ?? 0) }}</h2>
                    </div>
                    <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-download"></i>
                    </div>
                </div>
                <div class="stat-footer mt-2">
                    <small class="text-muted">
                        <i class="bi bi-arrow-down-circle me-1"></i>
                        {{ __('dashboard.total_downloads') }}
                    </small>
                </div>
            </div>
        </div>

        {{-- Favorites --}}
        <div class="col-6 col-xl-3">
            <div class="stat-card rounded-4 p-3 h-100">
                <div class="d-flex align-items-start justify-content-between">
                    <div>
                        <p class="stat-label mb-1">{{ __('dashboard.favorites') }}</p>
                        <h2 class="stat-value mb-0">{{ number_format($favorites ?? 0) }}</h2>
                    </div>
                    <div class="stat-icon bg-danger bg-opacity-10 text-danger">
                        <i class="bi bi-heart-fill"></i>
                    </div>
                </div>
                <div class="stat-footer mt-2">
                    <small class="text-muted">
                        <i class="bi bi-bookmark-heart me-1"></i>
                        {{ __('dashboard.saved_by_users') }}
                    </small>
                </div>
            </div>
        </div>

    </div>

    {{-- ═══════════════ CHART + SYSTEM OVERVIEW ═══════════════ --}}
    <div class="row g-3 mb-4">

        {{-- Downloads Chart --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <h5 class="fw-bold mb-0">
                                <i class="bi bi-bar-chart-fill text-primary me-2"></i>
                                {{ __('dashboard.download_analytics') }}
                            </h5>
                            <small class="text-muted">
                                {{ __('dashboard.downloads_per_book') }}
                            </small>
                        </div>
                    </div>

                    {{-- Fixed: use a wrapper div with fixed height --}}
                    <div class="chart-container">
                        <canvas id="downloadsChart"></canvas>
                    </div>

                </div>
            </div>
        </div>

        {{-- System Overview --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-activity text-success me-2"></i>
                        {{ __('dashboard.system_overview') }}
                    </h5>

                    <div class="d-flex flex-column gap-3">

                        {{-- Pending Books --}}
                        <div class="overview-item d-flex align-items-center
                                    justify-content-between p-3 rounded-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="overview-icon bg-warning bg-opacity-10
                                            text-warning rounded-circle">
                                    <i class="bi bi-hourglass-split"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold small">
                                        {{ __('dashboard.pending_books') }}
                                    </div>
                                    <small class="text-muted">
                                        {{ __('dashboard.awaiting_approval') }}
                                    </small>
                                </div>
                            </div>
                            <span class="badge {{ ($notifications ?? 0) > 0
                                ? 'bg-warning text-dark'
                                : 'bg-success' }} rounded-pill px-3">
                                {{ $notifications ?? 0 }}
                            </span>
                        </div>

                        {{-- New Users --}}
                        <div class="overview-item d-flex align-items-center
                                    justify-content-between p-3 rounded-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="overview-icon bg-info bg-opacity-10
                                            text-info rounded-circle">
                                    <i class="bi bi-person-plus"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold small">
                                        {{ __('dashboard.new_users') }}
                                    </div>
                                    <small class="text-muted">
                                        {{ __('dashboard.recently_joined') }}
                                    </small>
                                </div>
                            </div>
                            <span class="badge {{ ($newUser ?? 0) > 0
                                ? 'bg-info'
                                : 'bg-secondary' }} rounded-pill px-3">
                                {{ $newUser ?? 0 }}
                            </span>
                        </div>

                        {{-- Categories --}}
                        <div class="overview-item d-flex align-items-center
                                    justify-content-between p-3 rounded-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="overview-icon bg-primary bg-opacity-10
                                            text-primary rounded-circle">
                                    <i class="bi bi-tags"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold small">
                                        {{ __('message.categories') }}
                                    </div>
                                    <small class="text-muted">
                                        {{ __('dashboard.book_categories') }}
                                    </small>
                                </div>
                            </div>
                            <span class="badge bg-primary rounded-pill px-3">
                                {{ $categories ?? 0 }}
                            </span>
                        </div>

                        {{-- Library Status --}}
                        <div class="overview-item d-flex align-items-center
                                    justify-content-between p-3 rounded-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="overview-icon bg-success bg-opacity-10
                                            text-success rounded-circle">
                                    <i class="bi bi-check-circle"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold small">
                                        {{ __('dashboard.library_status') }}
                                    </div>
                                    <small class="text-muted">
                                        {{ __('dashboard.system_health') }}
                                    </small>
                                </div>
                            </div>
                            <span class="badge bg-success rounded-pill px-3">
                                {{ __('dashboard.online') }}
                            </span>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- ═══════════════ RECENT BOOKS TABLE ═══════════════ --}}
    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">

                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <h5 class="fw-bold mb-0">
                                <i class="bi bi-clock-history text-primary me-2"></i>
                                {{ __('message.latest_books') }}
                            </h5>
                            <small class="text-muted">
                                {{ __('dashboard.recently_added_books') }}
                            </small>
                        </div>
                        <a href="{{ route('admin.books.index') }}"
                           class="btn btn-sm btn-outline-primary rounded-3">
                            <i class="bi bi-arrow-right me-1"></i>
                            {{ __('dashboard.view_all') }}
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr class="table-light">
                                    <th>{{ __('message.table_hash') }}</th>
                                    <th>{{ __('message.table_title') }}</th>
                                    <th>{{ __('message.table_author') }}</th>
                                    <th>{{ __('message.table_category') }}</th>
                                    <th>{{ __('message.table_uploaded') }}</th>
                                    <th>{{ __('message.table_status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentBooks as $book)
                                    <tr>
                                        <td>
                                            <span class="badge bg-light text-dark rounded-pill">
                                                #{{ $book->id }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="book-thumb-mini rounded-2
                                                            bg-primary bg-opacity-10
                                                            d-flex align-items-center
                                                            justify-content-center">
                                                    @if($book->thumbnail)
                                                        <img src="{{ asset('/storage/'.$book->thumbnail) }}"
                                                             alt="{{ $book->getTitleAttribute() }}"
                                                             class="rounded-2"
                                                             style="width:36px;height:46px;object-fit:cover;">
                                                    @else
                                                        <i class="bi bi-journal-text text-primary"></i>
                                                    @endif
                                                </div>
                                                <div class="fw-semibold small">
                                                    {{ Str::limit($book->getTitleAttribute(), 40) }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-muted small">{{ $book->author }}</td>
                                        <td>
                                            <span class="badge bg-primary bg-opacity-10
                                                         text-primary rounded-pill">
                                                {{ $book->category->getname() ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="text-muted small">
                                            <i class="bi bi-person me-1"></i>
                                            {{ $book->user->name ?? '-' }}
                                        </td>
                                        <td>
                                            @if($book->status === 'approved')
                                                <span class="badge bg-success bg-opacity-10
                                                             text-success rounded-pill">
                                                    <i class="bi bi-check-circle me-1"></i>
                                                    {{ __('dashboard.approved') }}
                                                </span>
                                            @elseif($book->status === 'pending')
                                                <span class="badge bg-warning bg-opacity-10
                                                             text-warning rounded-pill">
                                                    <i class="bi bi-clock me-1"></i>
                                                    {{ __('dashboard.pending') }}
                                                </span>
                                            @else
                                                <span class="badge bg-danger bg-opacity-10
                                                             text-danger rounded-pill">
                                                    <i class="bi bi-x-circle me-1"></i>
                                                    {{ __('dashboard.rejected') }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-5">
                                            <i class="bi bi-inbox fs-2 d-block mb-2 opacity-50"></i>
                                            {{ __('dashboard.no_recent_books') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════ QUICK ACTIONS ═══════════════ --}}
    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-lightning-fill text-warning me-2"></i>
                        {{ __('dashboard.quick_actions') }}
                    </h5>
                    <div class="row g-3">

                        <div class="col-6 col-md-3">
                            <a href="{{ route('admin.books.create') }}"
                               class="quick-action-card d-flex flex-column
                                      align-items-center text-center p-3
                                      rounded-4 text-decoration-none">
                                <div class="quick-icon bg-primary bg-opacity-10
                                            text-primary rounded-circle mb-2">
                                    <i class="bi bi-plus-lg"></i>
                                </div>
                                <small class="fw-semibold text-dark">
                                    {{ __('message.add_record') }}
                                </small>
                            </a>
                        </div>

                        <div class="col-6 col-md-3">
                            <a href="{{ route('admin.users.create') }}"
                               class="quick-action-card d-flex flex-column
                                      align-items-center text-center p-3
                                      rounded-4 text-decoration-none">
                                <div class="quick-icon bg-success bg-opacity-10
                                            text-success rounded-circle mb-2">
                                    <i class="bi bi-person-plus"></i>
                                </div>
                                <small class="fw-semibold text-dark">
                                    {{ __('dashboard.add_user') }}
                                </small>
                            </a>
                        </div>

                        <div class="col-6 col-md-3">
                            <a href="{{ route('admin.books.pending') }}"
                               class="quick-action-card d-flex flex-column
                                      align-items-center text-center p-3
                                      rounded-4 text-decoration-none">
                                <div class="quick-icon bg-warning bg-opacity-10
                                            text-warning rounded-circle mb-2">
                                    <i class="bi bi-hourglass-split"></i>
                                </div>
                                <small class="fw-semibold text-dark">
                                    {{ __('dashboard.pending_books') }}
                                </small>
                            </a>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

{{-- ═══════════════ SCRIPTS ═══════════════ --}}
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const ctx = document.getElementById('downloadsChart');

        if (!ctx) return;

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($downloadsPerBookData['labels'] ?? []),
                datasets: [{
                    label: '{{ __("dashboard.downloads_per_book") }}',
                    data: @json($downloadsPerBookData['data'] ?? []),
                    backgroundColor: function (context) {
                        const chart = context.chart;
                        const { ctx: c, chartArea } = chart;
                        if (!chartArea) return 'rgba(99, 102, 241, 0.6)';
                        const gradient = c.createLinearGradient(
                            0, chartArea.bottom, 0, chartArea.top
                        );
                        gradient.addColorStop(0, 'rgba(99, 102, 241, 0.2)');
                        gradient.addColorStop(1, 'rgba(99, 102, 241, 0.8)');
                        return gradient;
                    },
                    borderColor: 'rgba(99, 102, 241, 1)',
                    borderWidth: 2,
                    borderRadius: 8,
                    borderSkipped: false,
                    barThickness: 24,
                    maxBarThickness: 32,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        titleFont: { size: 13, weight: '600' },
                        bodyFont: { size: 12 },
                        padding: 12,
                        cornerRadius: 10,
                        displayColors: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0,0,0,0.04)',
                        },
                        ticks: {
                            font: { size: 12, weight: '500' },
                            color: '#9ca3af',
                            padding: 8,
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                        },
                        ticks: {
                            font: { size: 11, weight: '500' },
                            color: '#9ca3af',
                            maxRotation: 45,
                            padding: 4,
                        }
                    }
                }
            }
        });

    });
</script>
@endsection