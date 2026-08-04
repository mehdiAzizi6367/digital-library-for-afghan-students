@extends('layouts.admin')

@section('title', __('dashboard.add_category'))

@section('content')
<div class="container py-4">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.categories.index') }}" class="text-decoration-none text-muted">
                    {{ __('dashboard.all_categories') }}
                </a>
            </li>
            <li class="breadcrumb-item active">{{ __('dashboard.add_category') }}</li>
        </ol>
    </nav>

    {{-- Page Header --}}
    <div class="mb-4">
        <h2 class="fw-bold text-dark mb-1">{{ __('dashboard.add_new_category') }}</h2>
        <p class="text-muted small mb-0">{{ __('dashboard.add_new_category_subtitle') }}</p>
    </div>

    {{-- Form Card --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden" style="max-width: 680px;">
        <div class="card-header bg-white border-bottom py-3 px-4">
            <div class="d-flex align-items-center gap-2">
                <div class="p-2 rounded-3" style="background-color: #e0f2fe;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#0284c7" viewBox="0 0 16 16">
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                </div>
                <h5 class="mb-0 fw-semibold text-dark">{{ __('dashboard.category_details') }}</h5>
            </div>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                {{-- English Name --}}
                <div class="mb-4">
                    <label for="name_en" class="form-label fw-medium text-dark small">
                        {{ __('dashboard.category_name_en') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#6c757d" viewBox="0 0 16 16">
                                <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H2z"/>
                                <path d="M11.5 4a.5.5 0 0 1 0 1H9.167l-.932 3.726A.5.5 0 0 1 7.75 9H4.5a.5.5 0 0 1 0-1h2.818l.932-3.726A.5.5 0 0 1 8.75 4h2.75z"/>
                            </svg>
                        </span>
                        <input
                            type="text"
                            id="name_en"
                            name="name_en"
                            class="form-control border-start-0 ps-0 @error('name_en') is-invalid @enderror"
                            value="{{ old('name_en') }}"
                            placeholder="{{ __('dashboard.category_name_en_placeholder') }}"
                            required
                        />
                        @error('name_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Pashto Name --}}
                <div class="mb-4">
                    <label for="name_ps" class="form-label fw-medium text-dark small">
                        {{ __('dashboard.category_name_ps') }}
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">🇦🇫</span>
                        <input
                            type="text"
                            id="name_ps"
                            name="name_ps"
                            class="form-control border-start-0 ps-0"
                            value="{{ old('name_ps') }}"
                            placeholder="{{ __('dashboard.category_name_ps_placeholder') }}"
                            dir="rtl"
                        />
                    </div>
                </div>

                {{-- Dari Name --}}
                <div class="mb-4">
                    <label for="name_fa" class="form-label fw-medium text-dark small">
                        {{ __('dashboard.category_name_fa') }}
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">🇮🇷</span>
                        <input
                            type="text"
                            id="name_fa"
                            name="name_fa"
                            class="form-control border-start-0 ps-0"
                            value="{{ old('name_fa') }}"
                            placeholder="{{ __('dashboard.category_name_fa_placeholder') }}"
                            dir="rtl"
                        />
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="d-flex align-items-center gap-3 pt-2">
                    <button type="submit" class="btn btn-success rounded-3 px-4 py-2 fw-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                            <path d="M13.485 1.929a.75.75 0 0 1 .086 1.057l-7 8a.75.75 0 0 1-1.08.03l-3-3a.75.75 0 0 1 1.06-1.06l2.435 2.434 6.47-7.394a.75.75 0 0 1 1.03-.067z"/>
                        </svg>
                        {{ __('dashboard.add_category') }}
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-light rounded-3 px-4 py-2">
                        {{ __('dashboard.cancel') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection