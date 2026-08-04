@extends('layouts.admin')

@section('content')
<div class="container py-4">
    {{-- Page Header --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h2 class="fw-bold text-dark mb-1">
                {{ __('dashboard.pending_books') }}
            </h2>
            <p class="text-muted mb-0">
                {{ __('dashboard.pending_books_subtitle') }}
            </p>
        </div>

        <div>
            <span class="badge rounded-pill bg-warning-subtle text-warning border px-3 py-2">
                {{ __('dashboard.total_pending') }}: {{ $books->count() }}
            </span>
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 rounded-3" role="alert">
            <strong>{{ __('dashboard.success') }}</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('dashboard.close') }}"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 rounded-3" role="alert">
            <strong>{{ __('dashboard.error') }}</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('dashboard.close') }}"></button>
        </div>
    @endif

    {{-- Main Card --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white border-bottom py-3 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <h5 class="mb-0 fw-semibold text-dark">
                    {{ __('dashboard.pending_books_list') }}
                </h5>
                <small class="text-muted">
                    {{ __('dashboard.review_and_manage_books') }}
                </small>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3">#</th>
                            <th class="py-3">{{ __('dashboard.title') }}</th>
                            <th class="py-3">{{ __('dashboard.user') }}</th>
                            <th class="py-3">{{ __('dashboard.category') }}</th>
                            <th class="py-3">{{ __('dashboard.created_at') }}</th>
                            <th class="py-3">{{ __('dashboard.action') }}</th>
                            <th class="py-3">{{ __('dashboard.preview') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                    @forelse($books as $book)
                        <tr>
                            <td class="fw-semibold text-muted">{{ $loop->iteration }}</td>

                            <td>
                                <div class="fw-semibold text-dark">
                                    {{ $book->getTitleAttribute() }}
                                </div>
                            </td>

                            <td>
                                <span class="badge bg-primary-subtle text-primary border px-3 py-2 rounded-pill">
                                    {{ $book->user->name }}
                                </span>
                            </td>

                            <td>
                                <span class="badge bg-secondary-subtle text-secondary border px-3 py-2 rounded-pill">
                                    {{ $book->category->getname() }}
                                </span>
                            </td>

                            <td class="text-muted">
                                {{ Str::limit($book->created_at, 11) }}
                            </td>

                            <td>
                                <div class="d-flex justify-content-center flex-wrap gap-2">
                                    {{-- Approve --}}
                                    <form action="{{ route('admin.books.approve', $book->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button class="btn btn-success btn-sm rounded-3 px-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                                <path d="M13.485 1.929a.75.75 0 0 1 .086 1.057l-7 8a.75.75 0 0 1-1.08.03l-3-3a.75.75 0 0 1 1.06-1.06l2.435 2.434 6.47-7.394a.75.75 0 0 1 1.03-.067z"/>
                                            </svg>
                                            {{ __('dashboard.approve') }}
                                        </button>
                                    </form>

                                    {{-- Reject Button --}}
                                    <button class="btn btn-outline-danger btn-sm rounded-3 px-3" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $book->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                            <path d="M2.146 2.146a.5.5 0 0 1 .708 0L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854a.5.5 0 0 1 0-.708z"/>
                                        </svg>
                                        {{ __('dashboard.reject') }}
                                    </button>
                                </div>

                                {{-- Reject Modal --}}
                                <div class="modal fade" id="rejectModal{{ $book->id }}" tabindex="-1" aria-labelledby="rejectModalLabel{{ $book->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow rounded-4 overflow-hidden">
                                            <form action="{{ route('admin.books.reject', $book->id) }}" method="POST">
                                                @csrf

                                                <div class="modal-header bg-danger text-white border-0">
                                                    <h5 class="modal-title" id="rejectModalLabel{{ $book->id }}">
                                                        {{ __('dashboard.reject_book') }}
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="{{ __('dashboard.close') }}"></button>
                                                </div>

                                                <div class="modal-body p-4">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-medium">
                                                            {{ __('dashboard.rejection_reason') }}
                                                        </label>
                                                        <textarea
                                                            name="reason"
                                                            class="form-control rounded-3"
                                                            rows="4"
                                                            required
                                                            placeholder="{{ __('dashboard.rejection_reason_placeholder') }}"
                                                        ></textarea>
                                                    </div>

                                                    <div class="small text-muted">
                                                        {{ __('dashboard.rejection_note') }}
                                                    </div>
                                                </div>

                                                <div class="modal-footer border-0 pt-0 px-4 pb-4">
                                                    <button type="button" class="btn btn-light rounded-3 px-4" data-bs-dismiss="modal">
                                                        {{ __('dashboard.cancel') }}
                                                    </button>
                                                    <button type="submit" class="btn btn-danger rounded-3 px-4">
                                                        {{ __('dashboard.submit_reject') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <a href="{{ route('books.read', $book->id) }}" class="btn btn-outline-success btn-sm rounded-3 px-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.12 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5A2.5 2.5 0 1 0 8 10.5a2.5 2.5 0 0 0 0-5z"/>
                                    </svg>
                                    {{ __('dashboard.review') }}
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-5">
                                <div class="d-flex flex-column align-items-center justify-content-center text-center px-3">
                                    <div class="mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" fill="#adb5bd" viewBox="0 0 16 16">
                                            <path d="M14 4.5V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h7.5L14 4.5zM10.5 2H3v12h10V5h-2.5a.5.5 0 0 1-.5-.5V2z"/>
                                        </svg>
                                    </div>
                                    <h6 class="fw-semibold text-dark mb-1">{{ __('dashboard.no_pending_books') }}</h6>
                                    <p class="text-muted mb-0">{{ __('dashboard.no_pending_books_message') }}</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('bootstrap.bundle.js') }}"></script>
@endsection