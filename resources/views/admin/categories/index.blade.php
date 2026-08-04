@extends('layouts.admin')

@section('title', __('dashboard.all_categories'))

@section('content')
<div class="container py-4">

    {{-- Page Header --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h2 class="fw-bold text-dark mb-1">
                {{ __('dashboard.all_categories') }}
            </h2>
            <p class="text-muted small mb-0">
                {{ __('dashboard.all_categories_subtitle') }}
            </p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <span class="badge rounded-pill bg-primary-subtle text-primary border px-3 py-2">
                {{ __('dashboard.total') }}: {{ $categories->total() }}
            </span>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary rounded-3 px-4 py-2 fw-medium">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
                {{ __('dashboard.add_category') }}
            </a>
        </div>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 rounded-3 mb-4" role="alert">
            <div class="d-flex align-items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </svg>
                <strong>{{ __('dashboard.success') }}</strong> {{ session('success') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('dashboard.close') }}"></button>
        </div>
    @endif

    {{-- Main Card --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white border-bottom py-3 px-4">
            <div class="d-flex align-items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#6c757d" viewBox="0 0 16 16">
                    <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3z"/>
                    <path d="M5 4h6v1H5V4zm0 3h6v1H5V7zm0 3h4v1H5v-1z"/>
                </svg>
                <h5 class="mb-0 fw-semibold text-dark">{{ __('dashboard.categories_list') }}</h5>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3">#</th>
                            <th class="py-3">{{ __('dashboard.name_en') }}</th>
                            <th class="py-3">{{ __('dashboard.name_fa') }}</th>
                            <th class="py-3">{{ __('dashboard.name_ps') }}</th>
                            <th class="py-3">{{ __('dashboard.created_at') }}</th>
                            <th class="py-3">{{ __('dashboard.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td class="fw-semibold text-muted">{{ $loop->iteration }}</td>

                            <td>
                                <span class="fw-semibold text-dark">{{ $category->getname() }}</span>
                            </td>

                            <td>
                                <span class="badge bg-info-subtle text-info border px-3 py-2 rounded-pill">
                                    {{ $category->name_fa ?? '—' }}
                                </span>
                            </td>

                            <td>
                                <span class="badge bg-success-subtle text-success border px-3 py-2 rounded-pill">
                                    {{ $category->name_ps ?? '—' }}
                                </span>
                            </td>

                            <td class="text-muted small">
                                {{ $category->created_at->format('d M Y') }}
                            </td>

                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    {{-- Edit --}}
                                    <a href="{{ route('admin.categories.edit', $category) }}"
                                        class="btn btn-outline-warning btn-sm rounded-3 px-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                            <path d="M15.502.3a.5.5 0 0 1 0 .706L14.459 2.05l-1.5-1.5L14.002.3a.5.5 0 0 1 .5-.5.5.5 0 0 1 .5.5zM13.006 2.707l-1.5-1.5L3.17 9.544l1.5 1.5 8.336-8.337z"/>
                                            <path d="M2.623 10.256l-.94 3.129 3.13-.94L2.622 10.256zM1 13.5V16h2.5l.5-.5-2.5-2.5-.5.5z"/>
                                        </svg>
                                        {{ __('dashboard.edit') }}
                                    </a>

                                    {{-- Delete --}}
                                    <button class="btn btn-outline-danger btn-sm rounded-3 px-3"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $category->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                        {{ __('dashboard.delete') }}
                                    </button>
                                </div>

                                {{-- Delete Confirmation Modal --}}
                                <div class="modal fade" id="deleteModal{{ $category->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-sm">
                                        <div class="modal-content border-0 shadow rounded-4 overflow-hidden">
                                            <div class="modal-body text-center p-4">
                                                <div class="mb-3">
                                                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                                        style="width:64px; height:64px; background-color:#fee2e2;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#dc3545" viewBox="0 0 16 16">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <h5 class="fw-bold text-dark mb-2">{{ __('dashboard.delete_confirm_title') }}</h5>
                                                <p class="text-muted small mb-0">{{ __('dashboard.delete_confirm_message') }}</p>
                                            </div>
                                            <div class="modal-footer border-0 justify-content-center gap-2 pb-4">
                                                <button type="button" class="btn btn-light rounded-3 px-4" data-bs-dismiss="modal">
                                                    {{ __('dashboard.cancel') }}
                                                </button>
                                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger rounded-3 px-4">
                                                        {{ __('dashboard.delete') }}
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-5">
                                <div class="d-flex flex-column align-items-center text-center px-3">
                                    <div class="mb-3">
                                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                            style="width:64px; height:64px; background-color:#f3f4f6;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#adb5bd" viewBox="0 0 16 16">
                                                <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <h6 class="fw-semibold text-dark mb-1">{{ __('dashboard.no_categories') }}</h6>
                                    <p class="text-muted small mb-3">{{ __('dashboard.no_categories_message') }}</p>
                                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm rounded-3 px-4">
                                        {{ __('dashboard.add_first_category') }}
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        @if($categories->hasPages())
            <div class="card-footer bg-white border-top py-3 px-4">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
</div>
@endsection