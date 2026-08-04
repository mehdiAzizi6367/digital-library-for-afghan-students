@extends('layouts.admin')

@section('title', __('dashboard.total_books'))

<style>
    /* ═══════════ Page Header ═══════════ */
    .page-header {
        background: linear-gradient(135deg, #3b82f6 0%, #6366f1 50%, #8b5cf6 100%);
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -15%;
        width: 220px;
        height: 220px;
        background: rgba(255, 255, 255, 0.07);
        border-radius: 50%;
    }

    .page-header::after {
        content: '';
        position: absolute;
        bottom: -40%;
        left: 5%;
        width: 140px;
        height: 140px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }

    /* ═══════════ Stat Mini Cards ═══════════ */
    .stat-mini {
        background: #fff;
        border: 1px solid rgba(0, 0, 0, 0.04);
        border-radius: 14px;
        padding: 16px;
        transition: all 0.25s ease;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
    }

    .stat-mini:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.07);
    }

    .stat-mini-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .stat-mini-value {
        font-size: 22px;
        font-weight: 800;
        color: #111827;
        line-height: 1;
    }

    .stat-mini-label {
        font-size: 12px;
        font-weight: 600;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    /* ═══════════ Search + Filter Bar ═══════════ */
    .filter-bar {
        background: #fff;
        border: 1px solid rgba(0, 0, 0, 0.04);
        border-radius: 14px;
        padding: 16px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.03);
    }

    .search-input {
        border: 1.5px solid #e5e7eb;
        border-radius: 10px;
        padding: 9px 14px 9px 38px;
        font-size: 14px;
        transition: all 0.2s;
        background: #f9fafb;
    }

    .search-input:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        background: #fff;
    }

    .search-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 15px;
    }

    [dir="rtl"] .search-icon {
        left: auto;
        right: 12px;
    }

    [dir="rtl"] .search-input {
        padding: 9px 38px 9px 14px;
    }

    .filter-select {
        border: 1.5px solid #e5e7eb;
        border-radius: 10px;
        padding: 9px 14px;
        font-size: 13px;
        background: #f9fafb;
        color: #374151;
        transition: all 0.2s;
    }

    .filter-select:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    /* ═══════════ Table Card ═══════════ */
    .table-card {
        background: #fff;
        border: 1px solid rgba(0, 0, 0, 0.04);
        border-radius: 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }

    /* ═══════════ Custom Table ═══════════ */
    .modern-table thead th {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: #6b7280;
        background: #f9fafb;
        border: none;
        padding: 14px 16px;
        white-space: nowrap;
    }

    .modern-table tbody td {
        padding: 12px 16px;
        border-bottom: 1px solid #f3f4f6;
        vertical-align: middle;
        font-size: 14px;
        color: #374151;
    }

    .modern-table tbody tr {
        transition: background 0.15s ease;
    }

    .modern-table tbody tr:hover {
        background: #f9fafb;
    }

    .modern-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* ═══════════ Book Row Info ═══════════ */
    .book-row-thumb {
        width: 38px;
        height: 50px;
        border-radius: 8px;
        object-fit: cover;
        border: 1.5px solid #e5e7eb;
        flex-shrink: 0;
    }

    .book-row-placeholder {
        width: 38px;
        height: 50px;
        border-radius: 8px;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .book-row-title {
        font-weight: 600;
        color: #111827;
        font-size: 14px;
        line-height: 1.3;
    }

    .book-row-author {
        font-size: 12px;
        color: #9ca3af;
    }

    /* ═══════════ Status Badge ═══════════ */
    .status-badge {
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        white-space: nowrap;
    }

    .status-approved {
        background: rgba(16, 185, 129, 0.1);
        color: #059669;
    }

    .status-pending {
        background: rgba(245, 158, 11, 0.1);
        color: #d97706;
    }

    .status-rejected {
        background: rgba(239, 68, 68, 0.1);
        color: #dc2626;
    }

    /* ═══════════ Action Buttons ═══════════ */
    .action-btn {
        width: 34px;
        height: 34px;
        border: none;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        transition: all 0.2s;
        cursor: pointer;
    }

    .action-btn-edit {
        background: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
    }

    .action-btn-edit:hover {
        background: #3b82f6;
        color: #fff;
    }

    .action-btn-delete {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }

    .action-btn-delete:hover {
        background: #ef4444;
        color: #fff;
    }

    .action-btn-view {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    .action-btn-view:hover {
        background: #10b981;
        color: #fff;
    }

    /* ═══════════ Alert ═══════════ */
    .alert-soft-success {
        background: rgba(16, 185, 129, 0.08);
        border: 1px solid rgba(16, 185, 129, 0.15);
        color: #065f46;
        border-radius: 12px;
        padding: 14px 18px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        font-weight: 500;
    }

    /* ═══════════ Add Button ═══════════ */
    .btn-add-book {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border: none;
        color: #fff;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 13px;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
        white-space: nowrap;
    }

    .btn-add-book:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(99, 102, 241, 0.3);
        color: #fff;
    }

    /* ═══════════ Empty State ═══════════ */
    .empty-state {
        padding: 60px 20px;
        text-align: center;
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
        font-size: 32px;
        color: #d1d5db;
    }

    /* ═══════════ Breadcrumb ═══════════ */
    .page-breadcrumb {
        font-size: 13px;
    }

    .page-breadcrumb a {
        color: #6b7280;
        text-decoration: none;
        transition: color 0.2s;
    }

    .page-breadcrumb a:hover {
        color: #6366f1;
    }

    /* ═══════════ Pagination ═══════════ */
    .pagination-wrap .pagination {
        gap: 4px;
    }

    .pagination-wrap .page-link {
        border-radius: 8px;
        border: 1.5px solid #e5e7eb;
        font-size: 13px;
        font-weight: 600;
        padding: 6px 12px;
        color: #374151;
    }

    .pagination-wrap .page-item.active .page-link {
        background: #6366f1;
        border-color: #6366f1;
    }

    /* ═══════════ Mobile Cards ═══════════ */
    .mobile-book-card {
        background: #fff;
        border: 1px solid rgba(0, 0, 0, 0.05);
        border-radius: 14px;
        padding: 14px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
        transition: all 0.2s;
    }

    .mobile-book-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    /* ═══════════ Responsive ═══════════ */
    .desktop-table {
        display: block;
    }

    .mobile-cards {
        display: none;
    }

    @media (max-width: 768px) {
        .desktop-table {
            display: none;
        }

        .mobile-cards {
            display: block;
        }

        .stat-mini-value {
            font-size: 18px;
        }

        .stat-mini-icon {
            width: 38px;
            height: 38px;
            font-size: 16px;
        }

        .stat-mini {
            padding: 12px;
        }

        .page-header h4 {
            font-size: 18px;
        }
    }
</style>


@section('content')
<div class="container-fluid py-2">

    {{-- ═══════════ BREADCRUMB ═══════════ --}}
    <nav class="page-breadcrumb mb-3">
        <a href="{{ route('admin.dashboard') }}">
            <i class="bi bi-house me-1"></i>{{ __('message.dashboard') }}
        </a>
        <span class="mx-2 text-muted">/</span>
        <span class="text-dark fw-semibold">{{ __('dashboard.total_books') }}</span>
    </nav>

    {{-- ═══════════ ALERT ═══════════ --}}
    @if(session('success'))
        <div class="alert-soft-success mb-3">
            <i class="bi bi-check-circle-fill text-success fs-5"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- ═══════════ PAGE HEADER ═══════════ --}}
    <div class="page-header p-4 rounded-4 mb-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="bg-white bg-opacity-25 rounded-3 p-2 d-flex align-items-center justify-content-center"
                     style="width:46px;height:46px;">
                    <i class="bi bi-journal-richtext text-white fs-4"></i>
                </div>
                <div>
                    <h4 class="fw-bold text-white mb-0">{{ __('dashboard.total_books') }}</h4>
                    <small class="text-white-50">{{ __('dashboard.manage_all_books') }}</small>
                </div>
            </div>
            <a href="{{ route('admin.books.create') }}" class="btn-add-book">
                <i class="bi bi-plus-lg"></i>
                {{ __('message.add_record') }}
            </a>
        </div>
    </div>

    {{-- ═══════════ STATS CARDS ═══════════ --}}
    <div class="row g-3 mb-4">

        {{-- All Books --}}
        <div class="col-6 col-lg-3">
            <div class="stat-mini">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-mini-icon bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-journal-richtext"></i>
                    </div>
                    <div>
                        <div class="stat-mini-value">{{ number_format($books->total()) }}</div>
                        <div class="stat-mini-label">{{ __('dashboard.all_books') }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Approved --}}
        <div class="col-6 col-lg-3">
            <div class="stat-mini">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-mini-icon bg-success bg-opacity-10 text-success">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div>
                        <div class="stat-mini-value">{{ number_format($approvedCount ?? 0) }}</div>
                        <div class="stat-mini-label">{{ __('dashboard.approved') }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pending --}}
        <div class="col-6 col-lg-3">
            <div class="stat-mini">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-mini-icon bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-clock-fill"></i>
                    </div>
                    <div>
                        <div class="stat-mini-value">{{ number_format($pendingCount ?? 0) }}</div>
                        <div class="stat-mini-label">{{ __('dashboard.pending') }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Rejected --}}
        <div class="col-6 col-lg-3">
            <div class="stat-mini">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-mini-icon bg-danger bg-opacity-10 text-danger">
                        <i class="bi bi-x-circle-fill"></i>
                    </div>
                    <div>
                        <div class="stat-mini-value">{{ number_format($rejectedCount ?? 0) }}</div>
                        <div class="stat-mini-label">{{ __('dashboard.rejected') }}</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- ═══════════ SEARCH + FILTER ═══════════ --}}
    <div class="filter-bar mb-4">
        <form method="GET" action="{{ route('admin.books.index') }}" id="filterForm">
            <div class="row g-3 align-items-end">
                {{-- Search --}}
                <div class="col-12 col-md-4">
                    <label class="small fw-semibold text-muted mb-1">
                        <i class="bi bi-search me-1"></i>{{ __('dashboard.search') }}
                    </label>
                    <div class="position-relative">
                      
                        <input type="text"
                               name="search"
                               class="form-control search-input"
                               value="{{ request('search') }}"
                               placeholder="{{ __('dashboard.search_books_placeholder') }}">
                    </div>
                </div>

                {{-- Status Filter --}}
                <div class="col-6 col-md-3">
                    <label class="small fw-semibold text-muted mb-1">
                        <i class="bi bi-funnel me-1"></i>{{ __('message.table_status') }}
                    </label>
                    <select name="status" class="form-select filter-select" onchange="this.form.submit()">
                        <option value="">{{ __('dashboard.all_statuses') }}</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>
                            {{ __('dashboard.approved') }}
                        </option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                            {{ __('dashboard.pending') }}
                        </option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>
                            {{ __('dashboard.rejected') }}
                        </option>
                    </select>
                </div>

                {{-- Category Filter --}}
                <div class="col-6 col-md-3">
                    <label class="small fw-semibold text-muted mb-1">
                        <i class="bi bi-tags me-1"></i>{{ __('message.table_category') }}
                    </label>
                    <select name="category" class="form-select filter-select" onchange="this.form.submit()">
                        <option value="">{{ __('dashboard.all_categories') }}</option>
                        @foreach($categories ?? [] as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->getname() }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Search Button --}}
                <div class="col-12 col-md-2">
                    <button type="submit" class="btn btn-primary rounded-3 w-100 fw-semibold"
                            style="padding: 9px;">
                        <i class="bi bi-search me-1"></i>{{ __('dashboard.search') }}
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- ═══════════ DESKTOP TABLE ═══════════ --}}
    <div class="desktop-table">
        <div class="table-card">
            @if($books->count() > 0)
                <div class="table-responsive">
                    <table class="table modern-table mb-0">
                        <thead>
                            <tr>
                                <th>{{ __('message.table_hash') }}</th>
                                <th>{{ __('message.table_title') }}</th>
                                <th>{{ __('message.table_category') }}</th>
                                <th>{{ __('message.table_uploaded') }}</th>
                                <th>{{ __('message.table_status') }}</th>
                                <th class="text-center">{{ __('message.table_actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($books as $book)
                                <tr>
                                    {{-- ID --}}
                                    <td>
                                        <span class="badge bg-light text-dark rounded-pill fw-bold">
                                            #{{ $book->id }}
                                        </span>
                                    </td>

                                    {{-- Title + Author + Thumb --}}
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            @if($book->thumbnail)
                                                <img src="{{ asset('storage/'.$book->thumbnail) }}"
                                                     alt="{{ $book->getTitleAttribute() }}"
                                                     class="book-row-thumb">
                                            @else
                                                <div class="book-row-placeholder">
                                                    <i class="bi bi-journal text-muted"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="book-row-title">
                                                    {{ Str::limit($book->getTitleAttribute(), 45) }}
                                                </div>
                                                <div class="book-row-author">
                                                    <i class="bi bi-person me-1"></i>
                                                    {{ $book->author }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Category --}}
                                    <td>
                                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill">
                                            {{ Str::limit($book->category->getname(), 15) ?? '-' }}
                                        </span>
                                    </td>

                                    {{-- Uploaded By --}}
                                    <td class="text-muted small">
                                        <i class="bi bi-person-circle me-1"></i>
                                        {{ $book->user->name ?? '-' }}
                                    </td>

                                    {{-- Status --}}
                                    <td>
                                        @if($book->status === 'approved')
                                            <span class="status-badge status-approved">
                                                <i class="bi bi-check-circle-fill"></i>
                                                {{ __('dashboard.approved') }}
                                            </span>
                                        @elseif($book->status === 'pending')
                                            <span class="status-badge status-pending">
                                                <i class="bi bi-clock-fill"></i>
                                                {{ __('dashboard.pending') }}
                                            </span>
                                        @else
                                            <span class="status-badge status-rejected">
                                                <i class="bi bi-x-circle-fill"></i>
                                                {{ __('dashboard.rejected') }}
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Actions --}}
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center gap-2">
                                            {{-- View --}}
                                            <a href="{{ route('books.read', $book->id) }}"
                                               class="action-btn action-btn-view"
                                               title="{{ __('dashboard.view') }}">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>

                                            {{-- Edit --}}
                                            <a href="{{ route('admin.books.edit', $book) }}"
                                               class="action-btn action-btn-edit"
                                               title="{{ __('message.edit') }}">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>

                                            {{-- Delete --}}
                                            <form action="{{ route('admin.books.destroy', $book) }}"
                                                  method="POST"
                                                  class="d-inline m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        onclick="return confirm('{{ __('message.confirm_delete') }}')"
                                                        class="action-btn action-btn-delete"
                                                        title="{{ __('message.delete') }}">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                {{-- Empty State --}}
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="bi bi-journal-x"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-1">{{ __('dashboard.no_books_found') }}</h5>
                    <p class="text-muted small mb-3">{{ __('dashboard.no_books_found_hint') }}</p>
                    <a href="{{ route('admin.books.create') }}" class="btn-add-book">
                        <i class="bi bi-plus-lg"></i>
                        {{ __('message.add_record') }}
                    </a>
                </div>
            @endif
        </div>
    </div>

    {{-- ═══════════ MOBILE CARDS ═══════════ --}}
    <div class="mobile-cards">
        @forelse($books as $book)
            <div class="mobile-book-card mb-3">
                <div class="d-flex gap-3">
                    {{-- Thumb --}}
                    @if($book->thumbnail)
                        <img src="{{ asset('storage/'.$book->thumbnail) }}"
                             alt="{{ $book->getTitleAttribute() }}"
                             class="book-row-thumb"
                             style="width:50px;height:65px;">
                    @else
                        <div class="book-row-placeholder" style="width:50px;height:65px;">
                            <i class="bi bi-journal text-muted"></i>
                        </div>
                    @endif

                    {{-- Info --}}
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <div class="book-row-title mb-1">
                                    {{ Str::limit($book->getTitleAttribute(), 35) }}
                                </div>
                                <div class="book-row-author mb-1">
                                    <i class="bi bi-person me-1"></i>{{ $book->author }}
                                </div>
                            </div>
                            <span class="badge bg-light text-dark rounded-pill fw-bold small">
                                #{{ $book->id }}
                            </span>
                        </div>

                        <div class="d-flex align-items-center gap-2 mt-1 flex-wrap">
                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill"
                                  style="font-size:11px;">
                                {{ Str::limit($book->category->getname(), 15) ?? '-' }}
                            </span>

                            @if($book->status === 'approved')
                                <span class="status-badge status-approved" style="font-size:10px;padding:3px 8px;">
                                    <i class="bi bi-check-circle-fill"></i>
                                    {{ __('dashboard.approved') }}
                                </span>
                            @elseif($book->status === 'pending')
                                <span class="status-badge status-pending" style="font-size:10px;padding:3px 8px;">
                                    <i class="bi bi-clock-fill"></i>
                                    {{ __('dashboard.pending') }}
                                </span>
                            @else
                                <span class="status-badge status-rejected" style="font-size:10px;padding:3px 8px;">
                                    <i class="bi bi-x-circle-fill"></i>
                                    {{ __('dashboard.rejected') }}
                                </span>
                            @endif
                        </div>

                        {{-- Mobile Actions --}}
                        <div class="d-flex gap-2 mt-2 pt-2 border-top">
                            <a href="{{ route('books.read', $book->id) }}"
                               class="action-btn action-btn-view" style="width:30px;height:30px;">
                                <i class="bi bi-eye-fill" style="font-size:12px;"></i>
                            </a>
                            <a href="{{ route('admin.books.edit', $book) }}"
                               class="action-btn action-btn-edit" style="width:30px;height:30px;">
                                <i class="bi bi-pencil-fill" style="font-size:12px;"></i>
                            </a>
                            <form action="{{ route('admin.books.destroy', $book) }}"
                                  method="POST" class="d-inline m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('{{ __('message.confirm_delete') }}')"
                                        class="action-btn action-btn-delete"
                                        style="width:30px;height:30px;">
                                    <i class="bi bi-trash3-fill" style="font-size:12px;"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="bi bi-journal-x"></i>
                </div>
                <h5 class="fw-bold text-dark mb-1">{{ __('dashboard.no_books_found') }}</h5>
                <p class="text-muted small mb-3">{{ __('dashboard.no_books_found_hint') }}</p>
                <a href="{{ route('admin.books.create') }}" class="btn-add-book">
                    <i class="bi bi-plus-lg"></i>
                    {{ __('message.add_record') }}
                </a>
            </div>
        @endforelse
    </div>

    {{-- ═══════════ PAGINATION ═══════════ --}}
    @if($books->hasPages())
        <div class="pagination-wrap d-flex justify-content-center mt-4">
            {{ $books->withQueryString()->links() }}
        </div>
    @endif

    {{-- ═══════════ RESULTS INFO ═══════════ --}}
    <div class="text-center mt-2 mb-4">
        <small class="text-muted">
            {{ __('dashboard.showing') }}
            <strong>{{ $books->firstItem() ?? 0 }}</strong> –
            <strong>{{ $books->lastItem() ?? 0 }}</strong>
            {{ __('dashboard.of') }}
            <strong>{{ $books->total() }}</strong>
            {{ __('dashboard.results') }}
        </small>
    </div>

</div>
@endsection