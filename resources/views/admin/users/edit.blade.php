@extends('layouts.admin')

@section('title', __('users.edit_user'))

@section('content')
<div class="container py-4" style="max-width: 860px;">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.users.index') }}" class="text-decoration-none text-muted">
                    {{ __('users.all_users') }}
                </a>
            </li>
            <li class="breadcrumb-item active">{{ __('users.edit_user') }}</li>
        </ol>
    </nav>

    {{-- Page Header --}}
    <div class="d-flex align-items-center gap-3 mb-4">
        {{-- User Avatar --}}
        <div class="d-flex align-items-center justify-content-center rounded-circle text-white fw-bold flex-shrink-0"
            style="width:56px; height:56px; font-size:22px;
            background: linear-gradient(135deg,
            {{ $user->role === 'admin' ? '#d97706, #f59e0b' : '#4f46e5, #7c3aed' }});">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
        <div>
            <h2 class="fw-bold text-dark mb-0">{{ __('users.edit_user') }}</h2>
            <p class="text-muted small mb-0">
                {{ __('users.edit_user_subtitle') }}:
                <strong class="text-dark">{{ $user->name }}</strong>
            </p>
        </div>
    </div>

    {{-- Error Alert --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 rounded-3 mb-4" role="alert">
            <div class="d-flex align-items-start gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="flex-shrink-0 mt-1" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                </svg>
                <div>
                    <strong class="d-block mb-1">{{ __('users.error_title') }}</strong>
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li class="small">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- ===== SECTION 1: Personal Information ===== --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
            <div class="card-header bg-white border-bottom py-3 px-4"
                style="background: linear-gradient(to right, #eef2ff, #ffffff) !important;">
                <div class="d-flex align-items-center gap-2">
                    <div class="p-2 rounded-3" style="background-color: #e0e7ff;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#4f46e5" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4z"/>
                        </svg>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-semibold text-dark">{{ __('users.personal_info') }}</h6>
                        <p class="mb-0 text-muted" style="font-size:12px;">{{ __('users.personal_info_subtitle') }}</p>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                <div class="row g-4">

                    {{-- Name English --}}
                    <div class="col-md-4">
                        <label for="name" class="form-label fw-medium text-dark small">
                            {{ __('users.name_en') }}
                            <span class="badge bg-primary-subtle text-primary border ms-1" style="font-size:10px;">EN</span>
                            <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="#6c757d" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0z"/>
                                </svg>
                            </span>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control border-start-0 ps-0 @error('name') is-invalid @enderror"
                                value="{{ old('name', $user->name) }}"
                                placeholder="{{ __('users.name_en_placeholder') }}"
                                required
                            />
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Name Pashto --}}
                    <div class="col-md-4">
                        <label for="name_ps" class="form-label fw-medium text-dark small">
                            {{ __('users.name_ps') }}
                            <span class="badge bg-success-subtle text-success border ms-1" style="font-size:10px;">PS</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">🇦🇫</span>
                            <input
                                type="text"
                                id="name_ps"
                                name="name_ps"
                                class="form-control border-start-0 ps-0 @error('name_ps') is-invalid @enderror"
                                value="{{ old('name_ps', $user->name_ps) }}"
                                placeholder="{{ __('users.name_ps_placeholder') }}"
                                dir="rtl"
                            />
                            @error('name_ps')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Name Dari --}}
                    <div class="col-md-4">
                        <label for="name_fa" class="form-label fw-medium text-dark small">
                            {{ __('users.name_fa') }}
                            <span class="badge bg-info-subtle text-info border ms-1" style="font-size:10px;">FA</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">🇮🇷</span>
                            <input
                                type="text"
                                id="name_fa"
                                name="name_fa"
                                class="form-control border-start-0 ps-0 @error('name_fa') is-invalid @enderror"
                                value="{{ old('name_fa', $user->name_fa) }}"
                                placeholder="{{ __('users.name_fa_placeholder') }}"
                                dir="rtl"
                            />
                            @error('name_fa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="col-md-12">
                        <label for="email" class="form-label fw-medium text-dark small">
                            {{ __('users.email') }}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="#6c757d" viewBox="0 0 16 16">
                                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
                                </svg>
                            </span>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror"
                                value="{{ old('email', $user->email) }}"
                                placeholder="{{ __('users.email_placeholder') }}"
                                required
                            />
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- ===== SECTION 2: Role ===== --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
            <div class="card-header bg-white border-bottom py-3 px-4"
                style="background: linear-gradient(to right, #fefce8, #ffffff) !important;">
                <div class="d-flex align-items-center gap-2">
                    <div class="p-2 rounded-3" style="background-color: #fef3c7;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#d97706" viewBox="0 0 16 16">
                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
                            <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                        </svg>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-semibold text-dark">{{ __('users.role_section') }}</h6>
                        <p class="mb-0 text-muted" style="font-size:12px;">{{ __('users.role_section_subtitle') }}</p>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">

                {{-- Hidden select for form --}}
                <select name="role" id="roleSelect" class="d-none" required>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                </select>

                <div class="row g-3">

                    {{-- Admin Card --}}
                    <div class="col-md-6">
                        <div class="role-card border rounded-4 p-3 h-100
                            {{ $user->role == 'admin' ? 'border-warning bg-warning-subtle' : '' }}"
                            onclick="selectRole('admin')" id="card-admin"
                            style="cursor: pointer; transition: all 0.2s;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="p-2 rounded-3 flex-shrink-0" style="background-color:#fef3c7;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#d97706" viewBox="0 0 16 16">
                                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                                    </svg>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="fw-semibold text-dark mb-0">{{ __('users.role_admin') }}</p>
                                    <p class="text-muted mb-0" style="font-size:12px;">{{ __('users.role_admin_desc') }}</p>
                                </div>
                                <div id="check-admin" class="{{ $user->role == 'admin' ? '' : 'd-none' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#d97706" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- User Card --}}
                    <div class="col-md-6">
                        <div class="role-card border rounded-4 p-3 h-100
                            {{ $user->role == 'user' ? 'border-primary bg-primary-subtle' : '' }}"
                            onclick="selectRole('user')" id="card-user"
                            style="cursor: pointer; transition: all 0.2s;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="p-2 rounded-3 flex-shrink-0" style="background-color:#e0e7ff;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#4f46e5" viewBox="0 0 16 16">
                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4z"/>
                                    </svg>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="fw-semibold text-dark mb-0">{{ __('users.role_user') }}</p>
                                    <p class="text-muted mb-0" style="font-size:12px;">{{ __('users.role_user_desc') }}</p>
                                </div>
                                <div id="check-user" class="{{ $user->role == 'user' ? '' : 'd-none' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#4f46e5" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- ===== SECTION 3: Account Info (Read Only) ===== --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
            <div class="card-header bg-white border-bottom py-3 px-4"
                style="background: linear-gradient(to right, #f0fdf4, #ffffff) !important;">
                <div class="d-flex align-items-center gap-2">
                    <div class="p-2 rounded-3" style="background-color:#dcfce7;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#16a34a" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.399l-.254.001-.082-.381 2.04-.287h.136l-.217 1.028zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-semibold text-dark">{{ __('users.account_info') }}</h6>
                        <p class="mb-0 text-muted" style="font-size:12px;">{{ __('users.account_info_subtitle') }}</p>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                <div class="row g-3">

                    {{-- Status --}}
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded-3 text-center">
                            <p class="text-muted small mb-1">{{ __('users.status') }}</p>
                            @if($user->is_active)
                                <span class="badge bg-success-subtle text-success border rounded-pill px-3 py-2">
                                    🟢 {{ __('users.active') }}
                                </span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary border rounded-pill px-3 py-2">
                                    ⚪ {{ __('users.inactive') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Joined At --}}
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded-3 text-center">
                            <p class="text-muted small mb-1">{{ __('users.joined_at') }}</p>
                            <span class="fw-semibold text-dark small">
                                {{ $user->created_at->format('d M Y') }}
                            </span>
                        </div>
                    </div>

                    {{-- Profile Completion --}}
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded-3 text-center">
                            <p class="text-muted small mb-1">{{ __('users.profile_completion') }}</p>
                            @if($user->name_ps && $user->name_fa)
                                <span class="badge bg-success-subtle text-success border rounded-pill px-3 py-2">
                                    ✅ {{ __('users.complete') }}
                                </span>
                            @else
                                <span class="badge bg-danger-subtle text-danger border rounded-pill px-3 py-2">
                                    ⚠️ {{ __('users.incomplete') }}
                                </span>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- ===== Action Buttons ===== --}}
        <div class="d-flex align-items-center justify-content-between gap-3 mb-5">
            <a href="{{ route('admin.users.index') }}" class="btn btn-light rounded-3 px-4 py-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
                {{ __('users.back') }}
            </a>

            <button type="submit" class="btn btn-primary rounded-3 px-5 py-2 fw-medium shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                </svg>
                {{ __('users.update_user') }}
            </button>
        </div>

    </form>
</div>

{{-- Role Selection Script --}}
<script>
    function selectRole(role) {
        const roles = ['admin', 'user'];
        const colors = { admin: 'warning', user: 'primary' };

        roles.forEach(r => {
            const card = document.getElementById('card-' + r);
            const check = document.getElementById('check-' + r);
            card.classList.remove(
                'border-warning', 'bg-warning-subtle',
                'border-primary', 'bg-primary-subtle'
            );
            check.classList.add('d-none');
        });

        const selected = document.getElementById('card-' + role);
        const check = document.getElementById('check-' + role);
        selected.classList.add('border-' + colors[role], 'bg-' + colors[role] + '-subtle');
        check.classList.remove('d-none');

        document.getElementById('roleSelect').value = role;
    }
</script>

<script src="{{ asset('bootstrap.bundle.js') }}"></script>
@endsection