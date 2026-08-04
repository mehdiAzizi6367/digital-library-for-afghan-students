<section>
    {{-- Section Header --}}
    <header class="mb-4">
        <h2 class="fw-semibold fs-5 text-dark mb-1">
            {{ __('profile.update_pass') }}
        </h2>
        <p class="text-muted small mb-0">
            {{ __('profile.update_password') }}
        </p>
    </header>

    {{-- Password Update Form --}}
    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        {{-- Current Password --}}
        <div class="mb-4">
            <label for="update_password_current_password" class="form-label fw-medium text-dark small">
                {{ __('profile.current_password') }}
            </label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0">
                    <svg width="16" height="16" fill="none" stroke="#6c757d" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </span>
                <input
                    id="update_password_current_password"
                    name="current_password"
                    type="password"
                    class="form-control border-start-0 ps-0 @if($errors->updatePassword->get('current_password')) is-invalid @endif"
                    autocomplete="current-password"
                    placeholder="{{ __('profile.current_password_placeholder') }}"
                />
                <button class="btn btn-light border border-start-0" type="button"
                    onclick="togglePassword('update_password_current_password', this)">
                    <svg width="16" height="16" fill="none" stroke="#6c757d" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
                @if($errors->updatePassword->get('current_password'))
                    <div class="invalid-feedback">
                        {{ implode(' ', $errors->updatePassword->get('current_password')) }}
                    </div>
                @endif
            </div>
        </div>

        {{-- New Password --}}
        <div class="mb-4">
            <label for="update_password_password" class="form-label fw-medium text-dark small">
                {{ __('profile.new_password') }}
            </label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0">
                    <svg width="16" height="16" fill="none" stroke="#6c757d" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                </span>
                <input
                    id="update_password_password"
                    name="password"
                    type="password"
                    class="form-control border-start-0 ps-0 @if($errors->updatePassword->get('password')) is-invalid @endif"
                    autocomplete="new-password"
                    placeholder="{{ __('profile.new_password_placeholder') }}"
                />
                <button class="btn btn-light border border-start-0" type="button"
                    onclick="togglePassword('update_password_password', this)">
                    <svg width="16" height="16" fill="none" stroke="#6c757d" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
                @if($errors->updatePassword->get('password'))
                    <div class="invalid-feedback">
                        {{ implode(' ', $errors->updatePassword->get('password')) }}
                    </div>
                @endif
            </div>

            {{-- Password Strength Indicator --}}
            <div class="mt-2">
                <div class="progress" style="height: 4px; border-radius: 2px;">
                    <div class="progress-bar" id="password-strength-bar"
                        role="progressbar" style="width: 0%; background-color: #dee2e6;"
                        aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
                <p class="small mt-1 mb-0" id="password-strength-text" style="font-size: 11px; color: #adb5bd;">
                    {{ __('profile.password_strength') }}
                </p>
            </div>
        </div>

        {{-- Confirm Password --}}
        <div class="mb-4">
            <label for="update_password_password_confirmation" class="form-label fw-medium text-dark small">
                {{ __('profile.confirm_password') }}
            </label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0">
                    <svg width="16" height="16" fill="none" stroke="#6c757d" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </span>
                <input
                    id="update_password_password_confirmation"
                    name="password_confirmation"
                    type="password"
                    class="form-control border-start-0 ps-0 @if($errors->updatePassword->get('password_confirmation')) is-invalid @endif"
                    autocomplete="new-password"
                    placeholder="{{ __('profile.confirm_password_placeholder') }}"
                />
                <button class="btn btn-light border border-start-0" type="button"
                    onclick="togglePassword('update_password_password_confirmation', this)">
                    <svg width="16" height="16" fill="none" stroke="#6c757d" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
                @if($errors->updatePassword->get('password_confirmation'))
                    <div class="invalid-feedback">
                        {{ implode(' ', $errors->updatePassword->get('password_confirmation')) }}
                    </div>
                @endif
            </div>
        </div>

        {{-- Submit Button + Success Message --}}
        <div class="d-flex align-items-center gap-3 mt-4">
            <button type="submit" class="btn btn-primary px-4 py-2 rounded-3 fw-medium">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="me-2">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 13l4 4L19 7" />
                </svg>
                {{ __('profile.save') }}
            </button>

            @if (session('status') === 'password-updated')
                <div class="d-flex align-items-center gap-1 text-success small fw-medium"
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ __('profile.password_updated') }}
                </div>
            @endif
        </div>

    </form>
</section>

{{-- Toggle Password & Strength JS --}}
<script>
    // Toggle Password Visibility
    function togglePassword(fieldId, btn) {
        const input = document.getElementById(fieldId);
        if (input.type === 'password') {
            input.type = 'text';
            btn.style.color = '#0d6efd';
        } else {
            input.type = 'password';
            btn.style.color = '#6c757d';
        }
    }

    // Password Strength Checker
    document.getElementById('update_password_password')
        .addEventListener('input', function () {
            const val = this.value;
            const bar = document.getElementById('password-strength-bar');
            const text = document.getElementById('password-strength-text');

            let strength = 0;
            if (val.length >= 8) strength++;
            if (/[A-Z]/.test(val)) strength++;
            if (/[0-9]/.test(val)) strength++;
            if (/[^A-Za-z0-9]/.test(val)) strength++;

            const levels = [
                { width: '0%',   color: '#dee2e6', label: '' },
                { width: '25%',  color: '#dc3545', label: '{{ __("profile.strength_weak") }}' },
                { width: '50%',  color: '#fd7e14', label: '{{ __("profile.strength_fair") }}' },
                { width: '75%',  color: '#ffc107', label: '{{ __("profile.strength_good") }}' },
                { width: '100%', color: '#198754', label: '{{ __("profile.strength_strong") }}' },
            ];

            bar.style.width = levels[strength].width;
            bar.style.backgroundColor = levels[strength].color;
            text.textContent = levels[strength].label;
            text.style.color = levels[strength].color;
        });
</script>