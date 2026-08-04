@extends('layouts.admin')

@section('title', __('dashboard.admin_settings'))

@section('content')
<div class="container py-4" style="max-width: 900px;">

    {{-- Page Header --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h2 class="fw-bold text-dark mb-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="me-2 text-primary" viewBox="0 0 16 16">
                    <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                    <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319z"/>
                </svg>
                {{ __('dashboard.admin_settings') }}
            </h2>
            <p class="text-muted small mb-0">{{ __('dashboard.admin_settings_subtitle') }}</p>
        </div>
    </div>

    {{-- Success Alert --}}
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

    {{-- Settings Form --}}
    <form action="/admin/settings" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- ==================== SECTION 1: Hero Section ==================== --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
            <div class="card-header bg-white border-bottom py-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <div class="p-2 rounded-3" style="background-color: #e0e7ff;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#4f46e5" viewBox="0 0 16 16">
                            <path d="M2.5 0a.5.5 0 0 1 .5.5V1h10V.5a.5.5 0 0 1 1 0V1h.5A1.5 1.5 0 0 1 16 2.5v12a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-12A1.5 1.5 0 0 1 1.5 1H2V.5a.5.5 0 0 1 .5-.5z"/>
                        </svg>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-semibold text-dark">{{ __('dashboard.hero_section') }}</h5>
                        <p class="mb-0 text-muted" style="font-size: 12px;">{{ __('dashboard.hero_section_subtitle') }}</p>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                <div class="row g-4">
                    {{-- Hero Title English --}}
                    <div class="col-md-6">
                        <label for="hero_title_en" class="form-label fw-medium text-dark small">
                            {{ __('dashboard.hero_title_en') }}
                            <span class="badge bg-primary-subtle text-primary border ms-1" style="font-size:10px;">EN</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#6c757d" viewBox="0 0 16 16">
                                    <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5V2z"/>
                                </svg>
                            </span>
                            <input type="text" name="hero_title_en" id="hero_title_en"
                                class="form-control border-start-0 ps-0 @error('hero_title_en') is-invalid @enderror"
                                value="{{ $setting->hero_title_en }}"
                                placeholder="{{ __('dashboard.hero_title_en_placeholder') }}" />
                            @error('hero_title_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Hero Title Pashto --}}
                    <div class="col-md-6">
                        <label for="hero_title_ps" class="form-label fw-medium text-dark small">
                            {{ __('dashboard.hero_title_ps') }}
                            <span class="badge bg-success-subtle text-success border ms-1" style="font-size:10px;">PS</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">🇦🇫</span>
                            <input type="text" name="hero_title_ps" id="hero_title_ps"
                                class="form-control border-start-0 ps-0 @error('hero_title_ps') is-invalid @enderror"
                                value="{{ $setting->hero_title_ps }}"
                                placeholder="{{ __('dashboard.hero_title_ps_placeholder') }}"
                                dir="rtl" />
                            @error('hero_title_ps')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Hero Description English --}}
                    <div class="col-md-6">
                        <label for="hero_description_en" class="form-label fw-medium text-dark small">
                            {{ __('dashboard.hero_desc_en') }}
                            <span class="badge bg-primary-subtle text-primary border ms-1" style="font-size:10px;">EN</span>
                        </label>
                        <textarea name="hero_description_en" id="hero_description_en" rows="3"
                            class="form-control @error('hero_description_en') is-invalid @enderror"
                            placeholder="{{ __('dashboard.hero_desc_en_placeholder') }}"
                        >{{ $setting->hero_description_en }}</textarea>
                        @error('hero_description_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Hero Description Pashto --}}
                    <div class="col-md-6">
                        <label for="hero_description_ps" class="form-label fw-medium text-dark small">
                            {{ __('dashboard.hero_desc_ps') }}
                            <span class="badge bg-success-subtle text-success border ms-1" style="font-size:10px;">PS</span>
                        </label>
                        <textarea name="hero_description_ps" id="hero_description_ps" rows="3"
                            class="form-control @error('hero_description_ps') is-invalid @enderror"
                            placeholder="{{ __('dashboard.hero_desc_ps_placeholder') }}"
                            dir="rtl"
                        >{{ $setting->hero_description_ps }}</textarea>
                        @error('hero_description_ps')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- ==================== SECTION 2: About Digital Library ==================== --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
            <div class="card-header bg-white border-bottom py-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <div class="p-2 rounded-3" style="background-color: #dbeafe;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#2563eb" viewBox="0 0 16 16">
                            <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                        </svg>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-semibold text-dark">{{ __('dashboard.about_library') }}</h5>
                        <p class="mb-0 text-muted" style="font-size: 12px;">{{ __('dashboard.about_library_subtitle') }}</p>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                <div class="row g-4">
                    {{-- About English --}}
                    <div class="col-md-6">
                        <label class="form-label fw-medium text-dark small">
                            {{ __('dashboard.about_en') }}
                            <span class="badge bg-primary-subtle text-primary border ms-1" style="font-size:10px;">EN</span>
                        </label>
                        <textarea name="about_digital_library_en" rows="4"
                            class="form-control @error('about_digital_library_en') is-invalid @enderror"
                            placeholder="{{ __('dashboard.about_en_placeholder') }}"
                        >{{ $setting->about_digital_library_en }}</textarea>
                        @error('about_digital_library_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- About Pashto --}}
                    <div class="col-md-6">
                        <label class="form-label fw-medium text-dark small">
                            {{ __('dashboard.about_ps') }}
                            <span class="badge bg-success-subtle text-success border ms-1" style="font-size:10px;">PS</span>
                        </label>
                        <textarea name="about_digital_library_ps" rows="4"
                            class="form-control @error('about_digital_library_ps') is-invalid @enderror"
                            placeholder="{{ __('dashboard.about_ps_placeholder') }}"
                            dir="rtl"
                        >{{ $setting->about_digital_library_ps }}</textarea>
                        @error('about_digital_library_ps')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- ==================== SECTION 3: Mission & Vision ==================== --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
            <div class="card-header bg-white border-bottom py-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <div class="p-2 rounded-3" style="background-color: #fef3c7;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#d97706" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.399l-.254.001-.082-.381 2.04-.287h.136l-.217 1.028zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-semibold text-dark">{{ __('dashboard.mission_vision') }}</h5>
                        <p class="mb-0 text-muted" style="font-size: 12px;">{{ __('dashboard.mission_vision_subtitle') }}</p>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                <div class="row g-4">
                    {{-- Mission English --}}
                    <div class="col-md-6">
                        <label class="form-label fw-medium text-dark small">
                            {{ __('dashboard.mission_en') }}
                            <span class="badge bg-primary-subtle text-primary border ms-1" style="font-size:10px;">EN</span>
                        </label>
                        <textarea name="mission_vision_en" rows="4"
                            class="form-control @error('mission_vision_en') is-invalid @enderror"
                            placeholder="{{ __('dashboard.mission_en_placeholder') }}"
                        >{{ $setting->mission_vision_en }}</textarea>
                        @error('mission_vision_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Mission Pashto --}}
                    <div class="col-md-6">
                        <label class="form-label fw-medium text-dark small">
                            {{ __('dashboard.mission_ps') }}
                            <span class="badge bg-success-subtle text-success border ms-1" style="font-size:10px;">PS</span>
                        </label>
                        <textarea name="mission_vision_ps" rows="4"
                            class="form-control @error('mission_vision_ps') is-invalid @enderror"
                            placeholder="{{ __('dashboard.mission_ps_placeholder') }}"
                            dir="rtl"
                        >{{ $setting->mission_vision_ps }}</textarea>
                        @error('mission_vision_ps')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- ==================== SECTION 4: Purposes ==================== --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
            <div class="card-header bg-white border-bottom py-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <div class="p-2 rounded-3" style="background-color: #dcfce7;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#16a34a" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                        </svg>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-semibold text-dark">{{ __('dashboard.purposes') }}</h5>
                        <p class="mb-0 text-muted" style="font-size: 12px;">{{ __('dashboard.purposes_subtitle') }}</p>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                <div class="row g-4">
                    {{-- Purpose English --}}
                    <div class="col-md-6">
                        <label class="form-label fw-medium text-dark small">
                            {{ __('dashboard.purpose_en') }}
                            <span class="badge bg-primary-subtle text-primary border ms-1" style="font-size:10px;">EN</span>
                        </label>
                        <textarea name="purpose_en" rows="4"
                            class="form-control @error('purpose_en') is-invalid @enderror"
                            placeholder="{{ __('dashboard.purpose_en_placeholder') }}"
                        >{{ $setting->purpose_en }}</textarea>
                        @error('purpose_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Purpose Pashto --}}
                    <div class="col-md-6">
                        <label class="form-label fw-medium text-dark small">
                            {{ __('dashboard.purpose_ps') }}
                            <span class="badge bg-success-subtle text-success border ms-1" style="font-size:10px;">PS</span>
                        </label>
                        <textarea name="purpose_ps" rows="4"
                            class="form-control @error('purpose_ps') is-invalid @enderror"
                            placeholder="{{ __('dashboard.purpose_ps_placeholder') }}"
                            dir="rtl"
                        >{{ $setting->purpose_ps }}</textarea>
                        @error('purpose_ps')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- ==================== SECTION 5: Footer ==================== --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
            <div class="card-header bg-white border-bottom py-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <div class="p-2 rounded-3" style="background-color: #f3e8ff;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#7c3aed" viewBox="0 0 16 16">
                            <path d="M0 1.5A1.5 1.5 0 0 1 1.5 0h13A1.5 1.5 0 0 1 16 1.5v2A1.5 1.5 0 0 1 14.5 5H1.5A1.5 1.5 0 0 1 0 3.5v-2zM0 8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V8z"/>
                        </svg>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-semibold text-dark">{{ __('dashboard.footer_section') }}</h5>
                        <p class="mb-0 text-muted" style="font-size: 12px;">{{ __('dashboard.footer_section_subtitle') }}</p>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                <div class="row g-4">
                    {{-- Footer English --}}
                    <div class="col-md-6">
                        <label class="form-label fw-medium text-dark small">
                            {{ __('dashboard.footer_en') }}
                            <span class="badge bg-primary-subtle text-primary border ms-1" style="font-size:10px;">EN</span>
                        </label>
                        <textarea name="footer_text_en" rows="3"
                            class="form-control @error('footer_text_en') is-invalid @enderror"
                            placeholder="{{ __('dashboard.footer_en_placeholder') }}"
                        >{{ $setting->footer_text_en }}</textarea>
                        @error('footer_text_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Footer Pashto --}}
                    <div class="col-md-6">
                        <label class="form-label fw-medium text-dark small">
                            {{ __('dashboard.footer_ps') }}
                            <span class="badge bg-success-subtle text-success border ms-1" style="font-size:10px;">PS</span>
                        </label>
                        <textarea name="footer_text_ps" rows="3"
                            class="form-control @error('footer_text_ps') is-invalid @enderror"
                            placeholder="{{ __('dashboard.footer_ps_placeholder') }}"
                            dir="rtl"
                        >{{ $setting->footer_text_ps }}</textarea>
                        @error('footer_text_ps')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- ==================== SECTION 6: Logo ==================== --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
            <div class="card-header bg-white border-bottom py-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <div class="p-2 rounded-3" style="background-color: #fce7f3;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#db2777" viewBox="0 0 16 16">
                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                            <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                        </svg>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-semibold text-dark">{{ __('dashboard.logo_section') }}</h5>
                        <p class="mb-0 text-muted" style="font-size: 12px;">{{ __('dashboard.logo_section_subtitle') }}</p>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                <div class="row align-items-center g-4">
                    {{-- Current Logo Preview --}}
                    <div class="col-md-4 text-center">
                        @if($setting->logo)
                            <div class="p-3 bg-light rounded-4 d-inline-block">
                                <img src="{{ asset('uploads/'.$setting->logo) }}"
                                    class="rounded-3"
                                    style="max-width: 120px; max-height: 120px; object-fit: contain;"
                                    alt="{{ __('dashboard.current_logo') }}" />
                            </div>
                            <p class="text-muted small mt-2 mb-0">{{ __('dashboard.current_logo') }}</p>
                        @else
                            <div class="p-4 bg-light rounded-4 d-inline-flex align-items-center justify-content-center"
                                style="width: 120px; height: 120px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#adb5bd" viewBox="0 0 16 16">
                                    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                    <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12z"/>
                                </svg>
                            </div>
                            <p class="text-muted small mt-2 mb-0">{{ __('dashboard.no_logo') }}</p>
                        @endif
                    </div>

                    {{-- Upload Logo --}}
                    <div class="col-md-8">
                        <label for="logo" class="form-label fw-medium text-dark small">
                            {{ __('dashboard.upload_logo') }}
                        </label>
                        <input type="file" name="logo" id="logo"
                            class="form-control @error('logo') is-invalid @enderror"
                            accept="image/*"
                            onchange="previewLogo(event)" />
                        @error('logo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div class="mt-2 small text-muted">
                            {{ __('dashboard.logo_hint') }}
                        </div>

                        {{-- Preview New Upload --}}
                        <div id="logo-preview-container" class="mt-3 d-none">
                            <p class="small fw-medium text-dark mb-2">{{ __('dashboard.new_logo_preview') }}</p>
                            <img id="logo-preview" class="rounded-3 border" style="max-width: 120px; max-height: 120px; object-fit: contain;" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ==================== SAVE BUTTON ==================== --}}
        <div class="d-flex justify-content-end gap-3 mb-5">
            <button type="submit" class="btn btn-primary rounded-3 px-5 py-2 fw-medium shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                </svg>
                {{ __('dashboard.save_settings') }}
            </button>
        </div>

    </form>
</div>

{{-- Logo Preview Script --}}
<script>
    function previewLogo(event) {
        const container = document.getElementById('logo-preview-container');
        const preview = document.getElementById('logo-preview');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                container.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection