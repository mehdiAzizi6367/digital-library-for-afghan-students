@extends('layouts.user')
@section('content')
<div class="container-fluid py-4 py-lg-5">
    <div class="row justify-content-center">
        <div class="col-12 col-xxl-11">

            {{-- Hero Header --}}
            <div class="books-hero shadow-lg mb-4">
                <div class="position-relative p-4 p-lg-5">
                    <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
                        <div class="text-white">
                            <div class="small text-white-50 mb-2">📚 {{ __('dashboard.my_books') }}</div>
                            <h2 class="fw-bold mb-2">{{ __('dashboard.my_books') }}</h2>
                            <p class="mb-0 text-white-50">
                                {{ __('message.table_title') }} / {{ __('message.table_author') }} / {{ __('message.table_status') }}
                            </p>
                        </div>

                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('book.trash') }}" class="btn btn-light text-danger fw-semibold px-4 py-2 rounded-3 shadow-sm">
                                Trashed
                            </a>

                            <a href="{{ route('user.books.create') }}" class="btn btn-success fw-semibold px-4 py-2 rounded-3 shadow-sm">
                                + {{ __('message.add_record') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Summary Cards --}}
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="card summary-card shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="text-muted small mb-2">{{ __('dashboard.my_books') }}</div>
                            <h3 class="fw-bold mb-1">{{ $userBooks->total() }}</h3>
                            <div class="text-secondary small">{{ __('message.table_title') }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card summary-card shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="text-muted small mb-2">{{ __('message.table_status') }}</div>
                            <h3 class="fw-bold mb-1">{{ $userBooks->count() }}</h3>
                            <div class="text-secondary small">{{ __('message.table_hash') }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card summary-card shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="text-muted small mb-2">{{ __('message.published_at') }}</div>
                            <h3 class="fw-bold mb-1">{{ $userBooks->currentPage() }}</h3>
                            <div class="text-secondary small">Page</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Table Card --}}
            <div class="card books-table-card shadow-sm">
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                        <div>
                            <h5 class="fw-bold mb-1">{{ __('dashboard.my_books') }}</h5>
                            <p class="text-muted small mb-0">{{ __('message.table_actions') }}</p>
                        </div>

                        <span class="badge text-bg-primary rounded-pill px-3 py-2 fs-6">
                            {{ $userBooks->total() }}
                        </span>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table books-table align-middle mb-0 text-center">
                            <thead>
                                <tr>
                                    <th>{{ __('message.table_hash') }}</th>
                                    <th>{{ __('message.table_title') }}</th>
                                    <th>{{ __('message.table_author') }}</th>
                                    <th>{{ __('message.table_category') }}</th>
                                    <th>{{ __('message.table_status') }}</th>
                                    <th>{{ __('message.published_at') }}</th>
                                    <th>{{ __('message.table_actions') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($userBooks as $key => $book)
                                    @php
                                        $statusClasses = match($book->status) {
                                            'approved' => 'bg-success-subtle text-success border border-success-subtle',
                                            'published' => 'bg-success-subtle text-success border border-success-subtle',
                                            'pending' => 'bg-warning-subtle text-warning border border-warning-subtle',
                                            'rejected' => 'bg-danger-subtle text-danger border border-danger-subtle',
                                            default => 'bg-secondary-subtle text-secondary border border-secondary-subtle',
                                        };
                                    @endphp

                                    <tr>
                                        <td>
                                            <span class="fw-bold text-primary">#{{ $book->id }}</span>
                                        </td>

                                        <td class="text-start">
                                            <div class="book-title">{{ $book->getTitleAttribute() }}</div>
                                            <div class="book-meta">{{ __('message.table_hash') }}: {{ $book->id }}</div>
                                        </td>

                                        <td>
                                            <span class="fw-semibold text-dark">{{ $book->author }}</span>
                                        </td>

                                        <td>
                                            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                                                {{ $book->category->getname() ?? 'N/A' }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="status-pill {{ $statusClasses }}">
                                                {{ $book->status ?? 'N/A' }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="text-muted small d-block">{{ $book->created_at }}</span>
                                        </td>

                                        <td>
                                            <div class="d-flex flex-wrap justify-content-center gap-2">

                                                @if($book->status == 'pending' || $book->status == "rejected")
                                                    <a href="{{ route('books.show', $book->id) }}"
                                                       class="btn btn-info btn-sm action-btn disabled">
                                                        {{ __('message.view') }}
                                                    </a>
                                                @else
                                                    <a href="{{ route('books.show', $book->id) }}"
                                                       class="btn btn-info btn-sm action-btn">
                                                        {{ __('message.view') }}
                                                    </a>
                                                @endif

                                                @if($book->status == 'rejected')
                                                    <a href="{{ route('user.books.edit', $book->id) }}"
                                                       class="btn btn-primary btn-sm action-btn">
                                                        {{ __('message.change') }}
                                                    </a>
                                                @else
                                                    <a href="{{ route('user.books.edit', $book->id) }}"
                                                       class="btn btn-primary btn-sm action-btn">
                                                        {{ __('message.edit') }}
                                                    </a>
                                                @endif

                                                <form action="{{ route('user.books.destroy', $book->id) }}"
                                                      method="POST"
                                                      class="d-inline-block"
                                                      onsubmit="return confirm('are you sure?') ">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm action-btn">
                                                        {{ __('message.delete') }}
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <div class="empty-state text-center">
                                                <div class="empty-icon">📘</div>
                                                <h5 class="fw-bold mb-2">{{ __('message.no_books') }}</h5>
                                                <p class="text-muted mb-3">{{ __('dashboard.my_books') }}</p>
                                                <a href="{{ route('user.books.create') }}" class="btn btn-success rounded-3 px-4">
                                                    + {{ __('message.add_record') }}
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

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $userBooks->links() }}
            </div>

        </div>
    </div>
</div>
@endsection