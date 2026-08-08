@extends('layouts.admin')

@section('title', __('message.messages'))

@section('content')
<div class="container py-4">

    {{-- Page Header --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h2 class="fw-bold text-dark mb-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                    class="me-2 text-primary" viewBox="0 0 16 16">
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
                </svg>
                {{ __('message.messages') }}
            </h2>
            <p class="text-muted small mb-0">
                {{ __('message.messages_subtitle') }}
            </p>
        </div>

        {{-- Badges --}}
        <div class="d-flex gap-2 flex-wrap">
            <span class="badge rounded-pill bg-primary-subtle text-primary border px-3 py-2">
                {{ __('message.total') }}: {{ $contacts->count() }}
            </span>
            <span class="badge rounded-pill bg-warning-subtle text-warning border px-3 py-2">
                {{ __('message.unread') }}:
                {{ $contacts->where('is_read', false)->count() }}
            </span>
            <span class="badge rounded-pill bg-success-subtle text-success border px-3 py-2">
                {{ __('message.read') }}:
                {{ $contacts->where('is_read', true)->count() }}
            </span>
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 rounded-3 mb-4" role="alert">
            <div class="d-flex align-items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                    viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </svg>
                <strong>{{ __('message.success') }}!</strong> {{ session('success') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="{{ __('message.close') }}"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 rounded-3 mb-4" role="alert">
            <div class="d-flex align-items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                    viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                </svg>
                <strong>{{ __('message.error') }}!</strong> {{ session('error') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="{{ __('message.close') }}"></button>
        </div>
    @endif

    {{-- Main Card --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

        {{-- Card Header --}}
        <div class="card-header bg-white border-bottom py-3 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div class="d-flex align-items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#6c757d"
                        viewBox="0 0 16 16">
                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Z"/>
                    </svg>
                    <h5 class="mb-0 fw-semibold text-dark">{{ __('message.inbox') }}</h5>
                </div>
                <div class="d-flex gap-2 align-items-center">
                    {{-- Filter buttons --}}
                    <a href="{{ route('admin.contact.message') }}"
                       class="btn btn-sm {{ !request('filter') ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill px-3">
                        {{ __('message.all') }}
                    </a>
                    <a href="{{ route('admin.contact.message', ['filter' => 'unread']) }}"
                       class="btn btn-sm {{ request('filter') == 'unread' ? 'btn-warning' : 'btn-outline-warning' }} rounded-pill px-3">
                        {{ __('message.unread') }}
                    </a>
                    <a href="{{ route('admin.contact.message', ['filter' => 'read']) }}"
                       class="btn btn-sm {{ request('filter') == 'read' ? 'btn-success' : 'btn-outline-success' }} rounded-pill px-3">
                        {{ __('message.read') }}
                    </a>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3 text-center" style="width: 50px;">#</th>
                            <th class="py-3 text-center" style="width: 50px;">
                                {{-- Status icon header --}}
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="#6c757d" viewBox="0 0 16 16">
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                </svg>
                            </th>
                            <th class="py-3 text-start">{{ __('message.name') }}</th>
                            <th class="py-3 text-start">{{ __('message.email') }}</th>
                            <th class="py-3 text-start">{{ __('message.subject') }}</th>
                            <th class="py-3 text-center" style="width: 220px;">
                                {{ __('message.action') }}
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($contacts as $contact)
                        <tr class="{{ !$contact->is_read ? 'bg-primary bg-opacity-10 fw-semibold' : '' }}"
                            style="border-left: 3px solid {{ !$contact->is_read ? '#4f46e5' : 'transparent' }};">

                            {{-- Row Number --}}
                            <td class="text-center text-muted">
                                {{ $loop->iteration }}
                            </td>

                            {{-- Read/Unread Dot --}}
                            <td class="text-center">
                                @if(!$contact->is_read)
                                    <span class="d-inline-block rounded-circle"
                                        style="width: 10px; height: 10px; background: #4f46e5;"
                                        title="{{ __('message.unread') }}">
                                    </span>
                                @else
                                    <span class="d-inline-block rounded-circle"
                                        style="width: 10px; height: 10px; background: #d1d5db;"
                                        title="{{ __('message.read') }}">
                                    </span>
                                @endif
                            </td>

                            {{-- Name --}}
                            <td class="text-start">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="d-flex align-items-center justify-content-center rounded-circle text-white fw-bold flex-shrink-0"
                                        style="width:36px; height:36px; font-size:14px;
                                        background: linear-gradient(135deg,
                                            {{ !$contact->is_read ? '#4f46e5, #7c3aed' : '#9ca3af, #6b7280' }});">
                                        {{ strtoupper(substr($contact->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <span class="d-block text-dark"
                                            style="font-weight: {{ !$contact->is_read ? '700' : '500' }};">
                                            {{ $contact->name }}
                                        </span>
                                        <small class="text-muted d-block d-md-none">
                                            {{ $contact->email }}
                                        </small>
                                    </div>
                                </div>
                            </td>

                            {{-- Email --}}
                            <td class="text-start d-none d-md-table-cell">
                                <a href="mailto:{{ $contact->email }}"
                                    class="text-decoration-none text-primary small">
                                    {{ $contact->email }}
                                </a>
                            </td>

                            {{-- Subject --}}
                            <td class="text-start">
                                <span class="badge {{ !$contact->is_read ? 'bg-primary-subtle text-primary' : 'bg-light text-muted' }} border rounded-pill px-3 py-2">
                                    {{ Str::limit($contact->subject, 25) }}
                                </span>
                            </td>
                            {{-- Actions --}}
                            <td class="text-center">
                                <div class="d-flex justify-between flex-row gap-1">

                                    {{-- VIEW Button --}}
                                    <a href="{{ route('contact.show', $contact->id) }}"
                                       class="btn btn-primary btn-sm rounded-3 px-3 d-inline-flex align-items-center gap-1"
                                       title="{{ __('message.view') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                        </svg>
                                        <span class="d-none d-lg-inline">{{ __('message.view') }}</span>
                                    </a>

                                    {{-- MARK AS READ / UNREAD Toggle --}}
                                    <form action="{{ route('contact.toggleRead', $contact->id) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')

                                        @if(!$contact->is_read)
                                            {{-- Mark as Read --}}
                                            <button type="submit"
                                                class="btn btn-success btn-sm rounded-3 px-3 d-inline-flex align-items-center gap-1"
                                                title="{{ __('message.mark_as_read') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 2.354 7.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                                                </svg>
                                                <span class="d-none d-lg-inline">
                                                    {{ __('message.mark_as_read') }}
                                                </span>
                                            </button>
                                        @else
                                            {{-- Mark as Unread --}}
                                            <button type="submit"
                                                class="btn btn-warning btn-sm rounded-3 px-3 d-inline-flex align-items-center gap-1"
                                                title="{{ __('message.mark_as_unread') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Z"/>
                                                </svg>
                                                <span class="d-none d-lg-inline">
                                                    {{ __('message.mark_as_unread') }}
                                                </span>
                                            </button>
                                        @endif
                                    </form>

                                    {{-- DELETE Button --}}
                                    <form action="{{ route('contact.destroy', $contact->id) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('{{ __('message.delete_confirm') }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-danger btn-sm rounded-3 px-3 d-inline-flex align-items-center gap-1"
                                            title="{{ __('message.delete') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                            </svg>
                                            <span class="d-none d-lg-inline">
                                                {{ __('message.delete') }}
                                            </span>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                        @empty
                        {{-- Empty State --}}
                        <tr>
                            <td colspan="7" class="py-5">
                                <div class="d-flex flex-column align-items-center text-center px-3">
                                    <div class="mb-3">
                                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                            style="width:72px; height:72px; background-color:#f3f4f6;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                fill="#adb5bd" viewBox="0 0 16 16">
                                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <h6 class="fw-semibold text-dark mb-1">
                                        {{ __('message.no_messages') }}
                                    </h6>
                                    <p class="text-muted small mb-0">
                                        {{ __('message.no_messages_subtitle') }}
                                    </p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        @if(method_exists($contacts, 'hasPages') && $contacts->hasPages())
            <div class="card-footer bg-white border-top py-3 px-4">
                {{ $contacts->links() }}
            </div>
        @endif

    </div>
</div>
@endsection