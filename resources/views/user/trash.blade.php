@extends('layouts.user')

@section('content')

<style>
    /* ═════════════════════════════════════════
       TRASH PAGE STYLES
    ═════════════════════════════════════════ */

    .trash-page {
        background: linear-gradient(180deg, #f8f9fd 0%, #eef1f8 100%);
        min-height: 100vh;
    }

    /* ── Hero Header ── */
    .trash-hero {
        background: linear-gradient(135deg, #1e293b 0%, #374151 40%, #4b5563 100%);
        border-radius: 1.5rem;
        position: relative;
        overflow: hidden;
    }
    .trash-hero::before {
        content: '';
        position: absolute;
        top: -60px;
        right: -60px;
        width: 220px;
        height: 220px;
        background: rgba(239,68,68,0.08);
        border-radius: 50%;
    }
    .trash-hero::after {
        content: '';
        position: absolute;
        bottom: -40px;
        left: -40px;
        width: 160px;
        height: 160px;
        background: rgba(239,68,68,0.05);
        border-radius: 50%;
    }

    /* ── Warning Banner ── */
    .warning-banner {
        background: linear-gradient(135deg, #fef2f2, #fff1f1);
        border: 1.5px solid #fecaca;
        border-left: 5px solid #ef4444;
        border-radius: 1rem;
        padding: 16px 20px;
    }

    /* ── Stats Pills ── */
    .stats-pill {
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255,255,255,0.15);
        border-radius: 14px;
        padding: 12px 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        color: #fff;
    }
    .stats-pill-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }
    .stats-pill-value {
        font-size: 20px;
        font-weight: 800;
        line-height: 1;
    }
    .stats-pill-label {
        font-size: 11px;
        opacity: 0.7;
    }

    /* ── Table Card ── */
    .trash-card {
        border: none;
        border-radius: 1.25rem;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
    }

    /* ── Table ── */
    .trash-table thead th {
        background: #111827;
        color: #fff;
        font-size: .82rem;
        font-weight: 600;
        border: 0 !important;
        white-space: nowrap;
        padding: 1rem .85rem;
        letter-spacing: 0.04em;
    }
    .trash-table tbody td {
        vertical-align: middle;
        padding: .9rem .85rem;
        border-color: #f1f5f9;
    }
    .trash-table tbody tr {
        transition: background 0.2s ease;
    }
    .trash-table tbody tr:hover {
        background: #fef9f9;
    }

    /* ── Status Badge ── */
    .status-pill {
        padding: .4rem .85rem;
        border-radius: 999px;
        font-size: .75rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: .3rem;
    }

    /* ── Action Buttons ── */
    .btn-restore {
        background: #f0fdf4;
        border: 1.5px solid #bbf7d0;
        color: #16a34a;
        border-radius: 10px;
        padding: 6px 14px;
        font-size: 12px;
        font-weight: 700;
        transition: all 0.25s ease;
        white-space: nowrap;
    }
    .btn-restore:hover {
        background: #16a34a;
        border-color: #16a34a;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(22,163,74,0.3);
    }

    .btn-perm-delete {
        background: #fef2f2;
        border: 1.5px solid #fecaca;
        color: #dc2626;
        border-radius: 10px;
        padding: 6px 14px;
        font-size: 12px;
        font-weight: 700;
        transition: all 0.25s ease;
        white-space: nowrap;
    }
    .btn-perm-delete:hover {
        background: #dc2626;
        border-color: #dc2626;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(220,38,38,0.3);
    }

    /* ── Book Title Cell ── */
    .book-title-cell {
        font-weight: 700;
        color: #1e293b;
        font-size: 13.5px;
        display: block;
    }
    .book-id-cell {
        font-size: 11px;
        color: #94a3b8;
        margin-top: 2px;
        display: block;
    }

    /* ── Deleted At Badge ── */
    .deleted-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #dc2626;
        border-radius: 8px;
        padding: 4px 10px;
        font-size: 11px;
        font-weight: 600;
    }

    /* ── Trash Icon Pulse ── */
    .trash-icon-pulse {
        animation: trashPulse 2s infinite;
    }
    @keyframes trashPulse {
        0%, 100% { transform: scale(1) rotate(0deg); }
        25% { transform: scale(1.1) rotate(-5deg); }
        75% { transform: scale(1.1) rotate(5deg); }
    }

    /* ── Empty State ── */
    .empty-state-card {
        background: #fff;
        border-radius: 1.5rem;
        border: 2px dashed #e2e8f0;
        padding: 60px 30px;
        text-align: center;
    }
    .empty-icon-wrap {
        width: 90px;
        height: 90px;
        background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
        border-radius: 1.5rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 38px;
        margin-bottom: 20px;
    }

    /* ── Scroll Animation ── */
    .scroll-animate {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .scroll-animate.visible {
        opacity: 1;
        transform: translateY(0);
    }
    .scroll-delay-1 { transition-delay: 0.05s; }
    .scroll-delay-2 { transition-delay: 0.10s; }
    .scroll-delay-3 { transition-delay: 0.15s; }

    @media (max-width: 767.98px) {
        .trash-table { min-width: 860px; }
        .trash-hero { border-radius: 1rem; }
    }
</style>

<div class="trash-page py-4 py-md-5">
    <div class="container">

        {{-- ═══════════════════════════════════════════
             HERO HEADER
        ═══════════════════════════════════════════ --}}
        <div class="trash-hero shadow-lg mb-4 scroll-animate">
            <div class="position-relative p-4 p-lg-5" style="z-index:2;">
                <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-4">

                    <div class="text-white">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="d-flex align-items-center justify-content-center rounded-3 flex-shrink-0"
                                 style="width:52px; height:52px; background:rgba(239,68,68,0.2);">
                                <i class="fas fa-trash-alt text-danger trash-icon-pulse" style="font-size:22px;"></i>
                            </div>
                            <div>
                                <span class="d-block text-white-50"
                                      style="font-size:10px; letter-spacing:0.12em; text-transform:uppercase; font-weight:700;">
                                    Recycle Bin
                                </span>
                                <h2 class="fw-bold mb-0 text-white">
                                    {{ __('message.trashed_books') ?? 'Trashed Books' }}
                                </h2>
                            </div>
                        </div>
                        <p class="text-white-50 mb-0 small" style="max-width:500px;">
                            {{ __('message.trash_description') ?? 'Books you have deleted are stored here. You can restore or permanently delete them.' }}
                        </p>
                    </div>

                    <div class="d-flex flex-wrap gap-3">
                        {{-- Stats --}}
                        <div class="stats-pill">
                            <div class="stats-pill-icon bg-danger bg-opacity-25">
                                <i class="fas fa-trash text-danger"></i>
                            </div>
                            <div>
                                <div class="stats-pill-value">{{ $books->total() }}</div>
                                <div class="stats-pill-label">{{ __('message.trashed') ?? 'Trashed' }}</div>
                            </div>
                        </div>

                        {{-- Back Button --}}
                        <a href="{{ route('user.books.index') }}"
                           class="btn d-flex align-items-center gap-2 px-4 py-2 fw-semibold"
                           style="background:rgba(255,255,255,0.12); border:1px solid rgba(255,255,255,0.2); color:#fff; border-radius:12px; backdrop-filter:blur(8px);">
                            <i class="fas fa-arrow-left" style="font-size:13px;"></i>
                            {{ __('message.back') ?? 'Back to Books' }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════
             WARNING BANNER
        ═══════════════════════════════════════════ --}}
        <div class="warning-banner mb-4 d-flex align-items-start gap-3 scroll-animate scroll-delay-1">
            <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0 bg-danger bg-opacity-10"
                 style="width:42px; height:42px;">
                <i class="fas fa-exclamation-triangle text-danger"></i>
            </div>
            <div>
                <strong class="text-danger d-block mb-1" style="font-size:14px;">
                    <i class="fas fa-ban me-1"></i>
                    {{ __('message.permanent_delete_warning') ?? 'Permanent Delete Warning!' }}
                </strong>
                <p class="text-muted mb-0 small">
                    {{ __('message.trash_notice') ?? 'If you click the Delete button, the book will be permanently removed and cannot be recovered. Use Restore to bring it back.' }}
                </p>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════
             TABLE CARD
        ═══════════════════════════════════════════ --}}
        <div class="card trash-card scroll-animate scroll-delay-2">

            {{-- Card Header --}}
            <div class="card-header bg-white border-0 p-4">
                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="d-flex align-items-center justify-content-center rounded-3"
                             style="width:40px; height:40px; background:#fef2f2;">
                            <i class="fas fa-trash-alt text-danger"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0">
                                {{ __('message.trashed_books') ?? 'Trashed Books' }}
                            </h5>
                            <p class="text-muted small mb-0">
                                {{ __('message.trash_list_hint') ?? 'Restore or permanently delete your books' }}
                            </p>
                        </div>
                    </div>

                    <span class="badge rounded-pill px-3 py-2 fs-6"
                          style="background:#fef2f2; color:#dc2626; border:1px solid #fecaca;">
                        <i class="fas fa-trash me-1" style="font-size:10px;"></i>
                        {{ $books->total() }} {{ __('message.books') ?? 'Books' }}
                    </span>
                </div>
            </div>

            {{-- Table --}}
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table trash-table align-middle mb-0 text-center">
                        <thead>
                            <tr>
                                <th>{{ __('message.table_hash') }}</th>
                                <th class="text-start">{{ __('message.table_title') }}</th>
                                <th>{{ __('message.table_author') }}</th>
                                <th>{{ __('message.table_category') }}</th>
                                <th>{{ __('message.table_status') }}</th>
                                <th>{{ __('message.published_at') }}</th>
                                <th>{{ __('message.table_actions') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($books as $key => $book)
                                @php
                                    $statusClasses = match($book->status) {
                                        'approved', 'published' => 'bg-success-subtle text-success border border-success-subtle',
                                        'pending'               => 'bg-warning-subtle text-warning border border-warning-subtle',
                                        'rejected'              => 'bg-danger-subtle text-danger border border-danger-subtle',
                                        default                 => 'bg-secondary-subtle text-secondary border border-secondary-subtle',
                                    };
                                @endphp

                                <tr>
                                    {{-- ID --}}
                                    <td>
                                        <span class="fw-bold text-danger">#{{ $book->id }}</span>
                                    </td>

                                    {{-- Title --}}
                                    <td class="text-start">
                                        <span class="book-title-cell">
                                            {{ $book->getTitleAttribute() }}
                                        </span>
                                        <span class="book-id-cell">
                                            <i class="fas fa-calendar-times me-1"></i>
                                            {{ __('message.deleted') ?? 'Deleted' }}
                                        </span>
                                    </td>

                                    {{-- Author --}}
                                    <td>
                                        <span class="fw-semibold text-dark" style="font-size:13px;">
                                            {{ $book->author }}
                                        </span>
                                    </td>

                                    {{-- Category --}}
                                    <td>
                                        <span class="badge bg-light text-dark border px-3 py-2 rounded-pill"
                                              style="font-size:11px;">
                                            <i class="fas fa-folder me-1 text-muted" style="font-size:9px;"></i>
                                            {{ $book->category->getname() ?? 'N/A' }}
                                        </span>
                                    </td>

                                    {{-- Status --}}
                                    <td>
                                        <span class="status-pill {{ $statusClasses }}">
                                            {{ ucfirst($book->status ?? 'N/A') }}
                                        </span>
                                    </td>

                                    {{-- Date --}}
                                    <td>
                                        <span class="deleted-badge">
                                            <i class="fas fa-clock"></i>
                                            {{ $book->created_at }}
                                        </span>
                                    </td>

                                    {{-- Actions --}}
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center gap-2">

                                            {{-- Restore Button --}}
                                            <a href="{{ route('book.restore', $book->id) }}"
                                               class="btn-restore">
                                                <i class="fas fa-undo me-1"></i>
                                                {{ __('dashboard.restore') ?? 'Restore' }}
                                            </a>

                                            {{-- Permanent Delete --}}
                                            <form action="{{ route('book.delete', $book->id) }}"
                                                  method="POST"
                                                  class="d-inline-block"
                                                  onsubmit="return confirm('{{ __('message.confirm_delete') }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-perm-delete">
                                                    <i class="fas fa-trash me-1"></i>
                                                    {{ __('message.delete') }}
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="7">
                                        <div class="empty-state-card m-3">
                                            <div class="empty-icon-wrap">🗑️</div>
                                            <h5 class="fw-bold mb-2">
                                                {{ __('message.trash_empty') ?? 'Trash is Empty' }}
                                            </h5>
                                            <p class="text-muted mb-4 small" style="max-width:360px; margin:0 auto;">
                                                {{ __('message.trash_empty_hint') ?? 'No books have been deleted yet. Your trash bin is clean!' }}
                                            </p>
                                            <a href="{{ route('user.books.index') }}"
                                               class="btn btn-success px-4 py-2 rounded-3 fw-semibold">
                                                <i class="fas fa-book me-2"></i>
                                                {{ __('message.back') ?? 'Back to Books' }}
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════
             PAGINATION
        ═══════════════════════════════════════════ --}}
        <div class="d-flex justify-content-center mt-4 scroll-animate scroll-delay-3">
            {{ $books->links() }}
        </div>

    </div>
</div>

{{-- ═══════════════════════════════════════════
     SCROLL ANIMATION SCRIPT
═══════════════════════════════════════════ --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ═══ SCROLL ANIMATION ═══ */
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, {
        root: null,
        rootMargin: '0px 0px -50px 0px',
        threshold: 0.1
    });

    document.querySelectorAll('.scroll-animate').forEach(el => {
        observer.observe(el);
    });

    /* ═══ ROW ANIMATION ON LOAD ═══ */
    document.querySelectorAll('.trash-table tbody tr').forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateX(-20px)';
        row.style.transition = `all 0.4s ease ${index * 0.08}s`;

        setTimeout(() => {
            row.style.opacity = '1';
            row.style.transform = 'translateX(0)';
        }, 300 + (index * 80));
    });

});
</script>

@endsection