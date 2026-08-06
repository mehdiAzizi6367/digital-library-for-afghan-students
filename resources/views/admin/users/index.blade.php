@extends('layouts.admin')

@section('title', __('users.all_users'))

@section('content')
<div class="container py-4">

    {{-- Page Header --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h2 class="fw-bold text-dark mb-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="me-2 text-primary" viewBox="0 0 16 16">
                    <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002A.274.274 0 0 1 15 13H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                </svg>
                {{ __('users.all_users') }}
            </h2>
            <p class="text-muted small mb-0">{{ __('users.all_users_subtitle') }}</p>
        </div>

        <div class="d-flex align-items-center gap-3">
            <span class="badge rounded-pill bg-primary-subtle text-primary border px-3 py-2">
                {{ __('users.total') }}: {{ $users->total() }}
            </span>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary rounded-3 px-4 py-2 fw-medium">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5V7h2.5a.5.5 0 0 1 0 1H8.5v2.5a.5.5 0 0 1-1 0V8H5a.5.5 0 0 1 0-1h2.5V4.5A.5.5 0 0 1 8 4z"/>
                </svg>
                {{ __('users.add_user') }}
            </a>
        </div>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 rounded-3 mb-4" role="alert">
            <div class="d-flex align-items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </svg>
                <strong>{{ __('users.success') }}</strong> {{ session('success') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Main Card --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

        {{-- Card Header --}}
        <div class="card-header bg-white border-bottom py-3 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div class="d-flex align-items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#6c757d" viewBox="0 0 16 16">
                        <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8z"/>
                        <path d="M1 14s-1 0-1-1 1-4 5-4c.39 0 .758.019 1.11.057A4.5 4.5 0 0 0 5 10.5"/>
                    </svg>
                    <h5 class="mb-0 fw-semibold text-dark">{{ __('users.users_list') }}</h5>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-danger-subtle text-danger border px-2 py-1 rounded-pill" style="font-size:11px;">
                        🔴 {{ __('users.badge_incomplete') }}
                    </span>
                    <span class="badge bg-success-subtle text-success border px-2 py-1 rounded-pill" style="font-size:11px;">
                        🟢 {{ __('users.badge_active') }}
                    </span>
                    <span class="badge bg-secondary-subtle text-secondary border px-2 py-1 rounded-pill" style="font-size:11px;">
                        ⚪ {{ __('users.badge_inactive') }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3 ps-4">#</th>
                            <th class="py-3">{{ __('users.name') }}</th>
                            <th class="py-3">{{ __('users.email') }}</th>
                            <th class="py-3 text-center">{{ __('users.status') }}</th>
                            <th class="py-3">{{ __('users.joined_at') }}</th>
                            <th class="py-3 text-center">{{ __('users.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            {{-- Row Number --}}
                            <td class="ps-4 fw-semibold text-muted">
                                {{ $loop->iteration }}
                            </td>

                            {{-- Name + Avatar + New Badge --}}
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    {{-- Avatar --}}
                                    <div class="d-flex align-items-center justify-content-center rounded-circle text-white fw-bold flex-shrink-0"
                                        style="width:38px; height:38px; font-size:15px;
                                        background: linear-gradient(135deg,
                                        {{ $user->role === 'admin' ? '#d97706, #f59e0b' : '#4f46e5, #7c3aed' }});">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>

                                    <div>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="fw-semibold text-dark">{{ $user->name }}</span>
                                            @if(!$user->name_ps && !$user->name_fa)
                                                <span class="badge bg-danger rounded-pill px-2 py-1" style="font-size:10px;">
                                                    {{ __('users.new_badge') }}
                                                </span>
                                            @endif
                                        </div>
                                        <small class="text-muted" style="font-size:11px;">
                                            {{ $user->role === 'admin' ? __('users.role_admin') : __('users.role_user') }}
                                        </small>
                                    </div>
                                </div>
                            </td>

                            {{-- Email --}}
                            <td>
                                <a href="mailto:{{ $user->email }}" class="text-decoration-none text-primary small">
                                    {{ $user->email }}
                                </a>
                            </td>
                            {{-- Status Badge --}}
                            <td class="text-center">
                                @if($user->is_active)
                                    <span class="badge bg-success-subtle text-success border rounded-pill px-3 py-2">
                                        <span class="me-1">🟢</span>
                                        {{ __('users.active') }}
                                    </span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary border rounded-pill px-3 py-2">
                                        <span class="me-1">⚪</span>
                                        {{ __('users.inactive') }}
                                    </span>
                                @endif
                            </td>

                            {{-- Joined At --}}
                            <td class="text-muted small">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="me-1 text-muted" viewBox="0 0 16 16">
                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5z"/>
                                </svg>
                                {{ $user->created_at->format('d M Y') }}
                            </td>

                            {{-- Actions --}}
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center gap-2">

                                    {{-- Edit --}}
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                        class="btn btn-outline-warning btn-sm rounded-3 px-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                            <path d="M15.502.3a.5.5 0 0 1 0 .706L14.459 2.05l-1.5-1.5L14.002.3a.5.5 0 0 1 .708 0z"/>
                                            <path d="M13.006 2.707l-1.5-1.5L3.17 9.544l1.5 1.5 8.336-8.337z"/>
                                            <path d="M2.623 10.256l-.94 3.129 3.13-.94L2.622 10.256z"/>
                                        </svg>
                                        {{ __('users.edit') }}
                                    </a>

                                    {{-- Toggle Active/Inactive --}}
                                    <form action="{{ route('admin.users.toggle', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-sm rounded-3 px-3 {{ $user->is_active ? 'btn-outline-danger' : 'btn-outline-success' }}">
                                            @if($user->is_active)
                                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5z"/>
                                                    <path d="M3.5 3.5A.5.5 0 0 1 4 4v8a.5.5 0 0 1-1 0V4a.5.5 0 0 1 .5-.5z"/>
                                                </svg>
                                                {{ __('users.disable') }}
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
                                                </svg>
                                                {{ __('users.activate') }}
                                            @endif
                                        </button>
                                    </form>

                                    {{-- Delete Button --}}
                                    <button class="btn btn-outline-danger btn-sm rounded-3 px-3"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $user->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                        {{ __('users.delete') }}
                                    </button>
                                </div>

                                {{-- Delete Modal --}}
                                <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-sm">
                                        <div class="modal-content border-0 shadow rounded-4 overflow-hidden">
                                            <div class="modal-body text-center p-4">
                                                <div class="mb-3">
                                                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                                        style="width:64px; height:64px; background-color:#fee2e2;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#dc3545" viewBox="0 0 16 16">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1z"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <h5 class="fw-bold text-dark mb-1">
                                                    {{ __('users.delete_confirm_title') }}
                                                </h5>
                                                <p class="text-muted small mb-0">
                                                    {{ __('users.delete_confirm_message') }}
                                                    <strong>{{ $user->name }}</strong>?
                                                </p>
                                            </div>
                                            <div class="modal-footer border-0 justify-content-center gap-2 pb-4 pt-0">
                                                <button type="button" class="btn btn-light rounded-3 px-4" data-bs-dismiss="modal">
                                                    {{ __('users.cancel') }}
                                                </button>
                                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger rounded-3 px-4">
                                                        {{ __('users.delete') }}
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
                            <td colspan="7" class="py-5">
                                <div class="d-flex flex-column align-items-center text-center px-3">
                                    <div class="mb-3">
                                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                            style="width:72px; height:72px; background-color:#f3f4f6;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#adb5bd" viewBox="0 0 16 16">
                                                <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002A.274.274 0 0 1 15 13H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <h6 class="fw-semibold text-dark mb-1">{{ __('users.no_users') }}</h6>
                                    <p class="text-muted small mb-3">{{ __('users.no_users_message') }}</p>
                                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm rounded-3 px-4">
                                        {{ __('users.add_first_user') }}
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
        @if($users->hasPages())
            <div class="card-footer bg-white border-top py-3 px-4">
                {{ $users->links() }}
            </div>
        @endif

    </div>
</div>

<script src="{{ asset('bootstrap.bundle.js') }}"></script>
@endsection