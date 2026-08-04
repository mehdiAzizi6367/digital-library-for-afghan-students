@extends('layouts.admin')

@section('title', __('users.add_user'))

@section('content')
<div class="container py-4" style="max-width: 780px;">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.users.index') }}" class="text-decoration-none text-muted">
                    {{ __('users.all_users') }}
                </a>
            </li>
            <li class="breadcrumb-item active">{{ __('users.add_user') }}</li>
        </ol>
    </nav>

    {{-- Page Header --}}
    <div class="d-flex align-items-center gap-3 mb-4">
        <div class="p-3 rounded-4" style="background-color: #e0e7ff;">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#4f46e5" viewBox="0 0 16 16">
                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.143 10 6 10c-2.144 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
            </svg>
        </div>
        <div>
            <h2 class="fw-bold text-dark mb-1">{{ __('users.add_new_user') }}</h2>
            <p class="text-muted small mb-0">{{ __('users.add_new_user_subtitle') }}</p>
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

    {{-- Form Card --}}
    <form action="{{ route('admin.users.store') }}" method="POST" id="addUserForm">
        @csrf

        {{-- ===== SECTION 1: Personal Info ===== --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
            <div class="card-header bg-white border-bottom py-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <div class="p-2 rounded-3" style="background-color: #e0e7ff;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#4f46e5" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0z"/>
                        </svg>
                    </div>
                    <h6 class="mb-0 fw-semibold text-dark">{{ __('users.personal_info') }}</h6>
                </div>
            </div>

            <div class="card-body p-4">
                <div class="row g-4">

                    {{-- Name --}}
                    <div class="col-md-6">
                        <label for="name" class="form-label fw-medium text-dark small">
                            {{ __('users.name') }}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#6c757d" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4z"/>
                                </svg>
                            </span>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control border-start-0 ps-0 @error('name') is-invalid @enderror"
                                value="{{ old('name') }}"
                                placeholder="{{ __('users.name_placeholder') }}"
                                required
                            />
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="col-md-6">
                        <label for="email" class="form-label fw-medium text-dark small">
                            {{ __('users.email') }}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#6c757d" viewBox="0 0 16 16">
                                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Z"/>
                                </svg>
                            </span>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
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

        {{-- ===== SECTION 2: Security ===== --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
            <div class="card-header bg-white border-bottom py-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <div class="p-2 rounded-3" style="background-color: #dbeafe;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#2563eb" viewBox="0 0 16 16">
                            <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                        </svg>
                    </div>
                    <h6 class="mb-0 fw-semibold text-dark">{{ __('users.security') }}</h6>
                </div>
            </div>

            <div class="card-body p-4">
                <div class="row g-4">

                    {{-- Password --}}
                    <div class="col-md-6">
                        <label for="password" class="form-label fw-medium text-dark small">
                            {{ __('users.password') }}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#6c757d" viewBox="0 0 16 16">
                                    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2z"/>
                                </svg>
                            </span>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control border-start-0 border-end-0 ps-0 @error('password') is-invalid @enderror"
                                placeholder="{{ __('users.password_placeholder') }}"
                                required
                            />
                            <button type="button" class="btn btn-light border border-start-0"
                                onclick="togglePassword('password', this)">
                                <svg width="16" height="16" fill="none" stroke="#6c757d" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Password Strength --}}
                        <div class="mt-2">
                            <div class="progress" style="height: 4px; border-radius: 2px;">
                                <div class="progress-bar" id="strength-bar"
                                    role="progressbar" style="width: 0%;"
                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                            <p class="small mt-1 mb-0" id="strength-text" style="font-size: 11px; color: #adb5bd;">
                                {{ __('users.password_strength') }}
                            </p>
                        </div>
                    </div>

                    {{-- Confirm Password --}}
                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label fw-medium text-dark small">
                            {{ __('users.confirm_password') }}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#6c757d" viewBox="0 0 16 16">
                                    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2z"/>
                                </svg>
                            </span>
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="form-control border-start-0 border-end-0 ps-0"
                                placeholder="{{ __('users.confirm_password_placeholder') }}"
                                required
                            />
                            <button type="button" class="btn btn-light border border-start-0"
                                onclick="togglePassword('password_confirmation', this)">
                                <svg width="16" height="16" fill="none" stroke="#6c757d" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>

                        {{-- Match Indicator --}}
                        <p class="small mt-2 mb-0" id="match-text" style="font-size: 11px; color: #adb5bd;">
                            {{ __('users.password_match_hint') }}
                        </p>
                    </div>

                </div>
            </div>
        </div>

        {{-- ===== SECTION 3: Role ===== --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
            <div class="card-header bg-white border-bottom py-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <div class="p-2 rounded-3" style="background-color: #fef3c7;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#d97706" viewBox="0 0 16 16">
                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
                            <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                        </svg>
                    </div>
                    <h6 class="mb-0 fw-semibold text-dark">{{ __('users.role_section') }}</h6>
                </div>
            </div>

            <div class="card-body p-4">
                <div class="row g-3">

                    {{-- Role Selection Cards --}}
                    <div class="col-12">
                        <label class="form-label fw-medium text-dark small">
                            {{ __('users.role') }}
                            <span class="text-danger">*</span>
                        </label>

                        {{-- Hidden Select (for form submission) --}}
                        <select name="role" id="roleSelect" class="d-none @error('role') is-invalid @enderror" required>
                            <option value="">{{ __('users.select_role') }}</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                        </select>
                        @error('role')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Admin Role Card --}}
                    <div class="col-md-6">
                        <div class="role-card border rounded-4 p-3 cursor-pointer h-100 {{ old('role') == 'admin' ? 'border-warning bg-warning-subtle' : '' }}"
                            onclick="selectRole('admin')" id="card-admin"
                            style="cursor: pointer; transition: all 0.2s;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="p-2 rounded-3 flex-shrink-0" style="background-color: #fef3c7;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#d97706" viewBox="0 0 16 16">
                                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="fw-semibold text-dark mb-0">{{ __('users.role_admin') }}</p>
                                    <p class="text-muted mb-0" style="font-size: 12px;">{{ __('users.role_admin_desc') }}</p>
                                </div>
                                <div class="ms-auto">
                                    <div id="check-admin" class="{{ old('role') == 'admin' ? '' : 'd-none' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#d97706" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- User Role Card --}}
                    <div class="col-md-6">
                        <div class="role-card border rounded-4 p-3 cursor-pointer h-100 {{ old('role') == 'user' ? 'border-primary bg-primary-subtle' : '' }}"
                            onclick="selectRole('user')" id="card-user"
                            style="cursor: pointer; transition: all 0.2s;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="p-2 rounded-3 flex-shrink-0" style="background-color: #e0e7ff;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#4f46e5" viewBox="0 0 16 16">
                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="fw-semibold text-dark mb-0">{{ __('users.role_user') }}</p>
                                    <p class="text-muted mb-0" style="font-size: 12px;">{{ __('users.role_user_desc') }}</p>
                                </div>
                                <div class="ms-auto">
                                    <div id="check-user" class="{{ old('role') == 'user' ? '' : 'd-none' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#4f46e5" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- ===== Action Buttons ===== --}}
        <div class="d-flex align-items-center justify-content-end gap-3 mb-5">
            <a href="{{ route('admin.users.index') }}" class="btn btn-light rounded-3 px-4 py-2">
                {{ __('users.cancel') }}
            </a>
            <button type="submit" class="btn btn-success rounded-3 px-5 py-2 fw-medium shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm4.5-8a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H15v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H14V5.5a.5.5 0 0 1 .5-.5z"/>
                </svg>
                {{ __('users.add_user') }}
            </button>
        </div>

    </form>
</div>

{{-- Scripts --}}
<script>
    // Toggle Password Visibility
    function togglePassword(fieldId, btn) {
        const input = document.getElementById(fieldId);
        input.type = input.type === 'password' ? 'text' : 'password';
        btn.style.color = input.type === 'text' ? '#0d6efd' : '#6c757d';
    }

    // Password Strength Checker
    document.getElementById('password').addEventListener('input', function () {
        const val = this.value;
        const bar = document.getElementById('strength-bar');
        const text = document.getElementById('strength-text');
        let strength = 0;
        if (val.length >= 8) strength++;
        if (/[A-Z]/.test(val)) strength++;
        if (/[0-9]/.test(val)) strength++;
        if (/[^A-Za-z0-9]/.test(val)) strength++;

        const levels = [
            { width: '0%',   color: '#dee2e6', label: '' },
            { width: '25%',  color: '#dc3545', label: '⚠️ {{ __("users.strength_weak") }}' },
            { width: '50%',  color: '#fd7e14', label: '🔶 {{ __("users.strength_fair") }}' },
            { width: '75%',  color: '#ffc107', label: '🔷 {{ __("users.strength_good") }}' },
            { width: '100%', color: '#198754', label: '✅ {{ __("users.strength_strong") }}' },
        ];
        bar.style.width = levels[strength].width;
        bar.style.backgroundColor = levels[strength].color;
        text.textContent = levels[strength].label;
        text.style.color = levels[strength].color;
    });

    // Password Match Checker
    document.getElementById('password_confirmation').addEventListener('input', function () {
        const pass = document.getElementById('password').value;
        const text = document.getElementById('match-text');
        if (this.value === '') {
            text.textContent = '{{ __("users.password_match_hint") }}';
            text.style.color = '#adb5bd';
        } else if (this.value === pass) {
            text.textContent = '✅ {{ __("users.password_match") }}';
            text.style.color = '#198754';
        } else {
            text.textContent = '❌ {{ __("users.password_no_match") }}';
            text.style.color = '#dc3545';
        }
    });

    // Role Card Selection
    function selectRole(role) {
        const roles = ['admin', 'user'];
        const colors = { admin: 'warning', user: 'primary' };

        roles.forEach(r => {
            const card = document.getElementById('card-' + r);
            const check = document.getElementById('check-' + r);
            card.classList.remove('border-warning', 'bg-warning-subtle', 'border-primary', 'bg-primary-subtle');
            check.classList.add('d-none');
        });

        const selected = document.getElementById('card-' + role);
        const check = document.getElementById('check-' + role);
        selected.classList.add('border-' + colors[role], 'bg-' + colors[role] + '-subtle');
        check.classList.remove('d-none');

        document.getElementById('roleSelect').value = role;
    }
</script>
@endsection