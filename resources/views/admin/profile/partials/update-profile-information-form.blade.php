<section>
    {{-- Section Header --}}
    <header class="mb-4">
        <h2 class="fw-semibold fs-5 text-dark mb-1">
            {{ __('profile.information') }}
        </h2>
        <p class="text-muted small mb-0">
            {{ __('profile.update') }}
        </p>
    </header>

    {{-- Verification Form (hidden) --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- Profile Update Form --}}
    <form method="post" action="{{ route('admin.profile.update') }}">
        @csrf
        @method('patch')

        {{-- Name Field --}}
        <div class="mb-4">
            <label for="name" class="form-label fw-medium text-dark small">
                {{ __('message.name') }}
            </label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0">
                    <svg width="16" height="16" fill="none" stroke="#6c757d" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </span>
                <input
                    id="name"
                    name="name"
                    type="text"
                    class="form-control border-start-0 ps-0 @error('name') is-invalid @enderror"
                    value="{{ old('name', $user->name) }}"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="{{ __('profile.name_placeholder') }}"
                />
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Email Field --}}
        <div class="mb-4">
            <label for="email" class="form-label fw-medium text-dark small">
                {{ __('message.email') }}
            </label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0">
                    <svg width="16" height="16" fill="none" stroke="#6c757d" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </span>
                <input
                    id="email"
                    name="email"
                    type="email"
                    class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror"
                    value="{{ old('email', $user->email) }}"
                    required
                    autocomplete="username"
                    placeholder="{{ __('profile.email_placeholder') }}"
                />
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email Verification Notice --}}
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="alert alert-warning d-flex align-items-start gap-2 mt-3 py-2 px-3 rounded-3" role="alert">
                    <svg width="18" height="18" fill="none" stroke="#856404" viewBox="0 0 24 24" class="mt-1 flex-shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                    </svg>
                    <div>
                        <p class="mb-1 small text-warning-emphasis">
                            {{ __('profile.email_unverified') }}
                        </p>
                        <button form="send-verification"
                            class="btn btn-link p-0 small text-decoration-underline text-warning-emphasis fw-medium">
                            {{ __('profile.resend_verification') }}
                        </button>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 mb-0 small text-success fw-medium">
                                ✅ {{ __('profile.verification_sent') }}
                            </p>
                        @endif
                    </div>
                </div>
            @endif
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

            @if (session('status') === 'profile-updated')
                <div class="d-flex align-items-center gap-1 text-success small fw-medium"
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ __('profile.saved_success') }}
                </div>
            @endif
        </div>

    </form>
</section>