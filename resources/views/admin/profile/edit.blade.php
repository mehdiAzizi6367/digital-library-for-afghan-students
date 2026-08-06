@extends('layouts.admin')
@section('content')
    <x-slot name="header">
        <div class="d-flex align-items-center gap-3">
            <div class="p-2 bg-primary rounded-3">
                <svg class="text-white" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <div>
                <h2 class="fw-bold fs-4 text-dark mb-0">
                    {{ __('profile.information') }}
                </h2>
                <p class="text-muted small mb-0">Manage your account settings and preferences</p>
            </div>
        </div>
    </x-slot>

    <div class="py-5">
        <div class="container" style="max-width: 860px;">

            {{-- Step Indicator --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body px-4 py-3">
                    <div class="d-flex align-items-center justify-content-between">

                        {{-- Step 1 --}}
                        <div class="d-flex align-items-center gap-2">
                            <span class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-white fw-semibold"
                                style="width:34px; height:34px; font-size:14px;">1</span>
                            <span class="text-primary fw-medium d-none d-sm-block small">{{__('profile.information')  }}</span>
                        </div>

                        <div class="flex-fill mx-3" style="height: 2px; background-color: #dee2e6;"></div>

                        {{-- Step 2 --}}
                        <div class="d-flex align-items-center gap-2">
                            <span class="d-flex align-items-center justify-content-center rounded-circle fw-semibold"
                                style="width:34px; height:34px; font-size:14px; background-color:#e7f0ff; color:#0d6efd;">2</span>
                            <span class="text-muted fw-medium d-none d-sm-block small">{{ __('profile.password')}}</span>
                        </div>

                        <div class="flex-fill mx-3" style="height: 2px; background-color: #dee2e6;"></div>

                        {{-- Step 3 --}}
                        <div class="d-flex align-items-center gap-2">
                            <span class="d-flex align-items-center justify-content-center rounded-circle fw-semibold"
                                style="width:34px; height:34px; font-size:14px; background-color:#fff0f0; color:#dc3545;">3</span>
                            <span class="text-muted fw-medium d-none d-sm-block small">{{ __('profile.danger_zone') }}</span>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Section 1: Profile Information --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
                {{-- Card Header --}}
                <div class="card-header border-bottom d-flex align-items-center gap-3 py-3 px-4"
                    style="background: linear-gradient(to right, #eef2ff, #ffffff);">
                    <div class="p-2 rounded-3" style="background-color: #e0e7ff;">
                        <svg width="20" height="20" fill="none" stroke="#4f46e5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                  
                </div>
                {{-- Card Body --}}
                <div class="card-body px-4 py-4">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Section 2: Update Password --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
                {{-- Card Header --}}
                <div class="card-header border-bottom d-flex align-items-center gap-3 py-3 px-4"
                    style="background: linear-gradient(to right, #eff6ff, #ffffff);">
                    <div class="p-2 rounded-3" style="background-color: #dbeafe;">
                        <svg width="20" height="20" fill="none" stroke="#2563eb" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                  
                </div>
                {{-- Card Body --}}
                <div class="card-body px-4 py-4">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Section 3: Delete Account --}}
            <div class="card shadow-sm rounded-4 mb-4 overflow-hidden" style="border: 1px solid #fecaca;">
                {{-- Card Header --}}
                <div class="card-header border-bottom d-flex align-items-center gap-3 py-3 px-4"
                    style="background: linear-gradient(to right, #fff5f5, #ffffff); border-bottom-color: #fecaca;">
                    <div class="p-2 rounded-3" style="background-color: #fee2e2;">
                        <svg width="20" height="20" fill="none" stroke="#dc3545" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <div>
                        <h5 class="fw-semibold mb-0" style="color: #dc3545;">Danger Zone</h5>
                        <p class="mb-0" style="font-size: 12px; color: #f87171;">Permanently delete your account and all data</p>
                    </div>
                </div>
                {{-- Card Body --}}
                <div class="card-body px-4 py-4">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

            {{-- Footer Note --}}
            <div class="text-center text-muted pb-3" style="font-size: 12px;">
                🔒 Your data is safe and encrypted. Changes are saved instantly.
            </div>

        </div>
    </div>
@endsection