@extends('layouts.admin')

@section('title', __('message.messages'))

@section('content')
<div class="container py-4">

    {{-- Page Header --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h2 class="fw-bold text-dark mb-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="me-2 text-primary" viewBox="0 0 16 16">
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
                </svg>
                {{ __('message.messages') }}
            </h2>
            <p class="text-muted small mb-0">
                {{ __('message.messages_subtitle') }}
            </p>
        </div>

        {{-- Total Badge --}}
        <div>
            <span class="badge rounded-pill bg-primary-subtle text-primary border px-3 py-2">
                {{ __('message.total') }}: {{ $contacts->count() }}
            </span>
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 rounded-3 mb-4" role="alert">
            <div class="d-flex align-items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </svg>
                <strong>{{ __('message.success') }}</strong> {{ session('success') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('message.close') }}"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 rounded-3 mb-4" role="alert">
            <div class="d-flex align-items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                </svg>
                <strong>{{ __('message.error') }}</strong> {{ session('error') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('message.close') }}"></button>
        </div>
    @endif

    {{-- Main Card --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

        {{-- Card Header --}}
        <div class="card-header bg-white border-bottom py-3 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div class="d-flex align-items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#6c757d" viewBox="0 0 16 16">
                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Z"/>
                    </svg>
                    <h5 class="mb-0 fw-semibold text-dark">{{ __('message.inbox') }}</h5>
                </div>
                <small class="text-muted">{{ __('message.inbox_subtitle') }}</small>
            </div>
        </div>

        {{-- Table --}}
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3">#</th>
                            <th class="py-3 text-start">{{ __('message.name') }}</th>
                            <th class="py-3 text-start">{{ __('message.email') }}</th>
                            <th class="py-3 text-start">{{ __('message.subject') }}</th>
                            <th class="py-3 text-start">{{ __('message.message') }}</th>
                            <th class="py-3">{{ __('message.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contacts as $contact)
                        <tr>
                            {{-- Row Number --}}
                            <td class="fw-semibold text-muted">
                                {{ $loop->iteration }}
                            </td>

                            {{-- Name --}}
                            <td class="text-start">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="d-flex align-items-center justify-content-center rounded-circle text-white fw-bold flex-shrink-0"
                                        style="width:36px; height:36px; font-size:14px; background: linear-gradient(135deg, #4f46e5, #7c3aed);">
                                        {{ strtoupper(substr($contact->name, 0, 1)) }}
                                    </div>
                                    <span class="fw-semibold text-dark">{{ $contact->name }}</span>
                                </div>
                            </td>

                            {{-- Email --}}
                            <td class="text-start">
                                <a href="mailto:{{ $contact->email }}" class="text-decoration-none text-primary small">
                                    {{ $contact->email }}
                                </a>
                            </td>

                            {{-- Subject --}}
                            <td class="text-start">
                                <span class="badge bg-info-subtle text-info border rounded-pill px-3 py-2">
                                    {{ Str::limit($contact->subject, 30) }}
                                </span>
                            </td>

                            {{-- Message --}}
                            <td class="text-start">
                                <button class="btn btn-link btn-sm p-0 text-decoration-none text-muted"
                                    data-bs-toggle="modal"
                                    data-bs-target="#messageModal{{ $contact->id }}">
                                    <span class="text-truncate d-inline-block" style="max-width: 180px;">
                                        {{ Str::limit($contact->message, 40) }}
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="ms-1 text-primary" viewBox="0 0 16 16">
                                        <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z"/>
                                    </svg>
                                </button>

                                {{-- Message Modal --}}
                                <div class="modal fade" id="messageModal{{ $contact->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow rounded-4 overflow-hidden">

                                            <div class="modal-header border-0 pb-0 px-4 pt-4">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="d-flex align-items-center justify-content-center rounded-circle text-white fw-bold"
                                                        style="width:46px; height:46px; font-size:18px; background: linear-gradient(135deg, #4f46e5, #7c3aed);">
                                                        {{ strtoupper(substr($contact->name, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <h5 class="fw-bold text-dark mb-0">{{ $contact->name }}</h5>
                                                        <a href="mailto:{{ $contact->email }}" class="text-muted small text-decoration-none">
                                                            {{ $contact->email }}
                                                        </a>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body px-4 py-3">
                                                {{-- Subject --}}
                                                <div class="mb-3">
                                                    <p class="text-muted small fw-medium mb-1">{{ __('message.subject') }}</p>
                                                    <span class="badge bg-info-subtle text-info border px-3 py-2 rounded-pill">
                                                        {{ $contact->subject }}
                                                    </span>
                                                </div>

                                                {{-- Message --}}
                                                <div>
                                                    <p class="text-muted small fw-medium mb-1">{{ __('message.message') }}</p>
                                                    <div class="p-3 bg-light rounded-3 text-dark small" style="line-height: 1.8;">
                                                        {{ $contact->message }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer border-0 px-4 pb-4 pt-0 gap-2">
                                                <button type="button" class="btn btn-light rounded-3 px-4" data-bs-dismiss="modal">
                                                    {{ __('message.close') }}
                                                </button>
                                                <a href="mailto:{{ $contact->email }}" class="btn btn-success rounded-3 px-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Z"/>
                                                    </svg>
                                                    {{ __('message.respond') }}
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- Action --}}
                            <td>
                                <a href="mailto:{{ $contact->email }}" class="btn btn-success btn-sm rounded-3 px-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Z"/>
                                    </svg>
                                    {{ __('message.respond') }}
                                </a>
                            </td>
                        </tr>

                        @empty
                        {{-- Empty State --}}
                        <tr>
                            <td colspan="6" class="py-5">
                                <div class="d-flex flex-column align-items-center text-center px-3">
                                    <div class="mb-3">
                                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                            style="width:72px; height:72px; background-color:#f3f4f6;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#adb5bd" viewBox="0 0 16 16">
                                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <h6 class="fw-semibold text-dark mb-1">{{ __('message.no_messages') }}</h6>
                                    <p class="text-muted small mb-0">{{ __('message.no_messages_subtitle') }}</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Card Footer with Pagination --}}
        @if(method_exists($contacts, 'hasPages') && $contacts->hasPages())
            <div class="card-footer bg-white border-top py-3 px-4">
                {{ $contacts->links() }}
            </div>
        @endif

    </div>
</div>

<script src="{{ asset('bootstrap.bundle.js') }}"></script>
@endsection