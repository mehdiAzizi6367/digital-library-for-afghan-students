{{-- resources/views/admin/contacts/show.blade.php --}}
@extends('layouts.admin')

@section('title', __('message.view_message'))

@section('content')
<div class="container py-4">

    {{-- Back Button --}}
    <a href="{{ route('contact.message') }}"
       class="btn btn-light rounded-pill px-4 py-2 mb-4 d-inline-flex align-items-center gap-2 shadow-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
            viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
        </svg>
        {{ __('message.back_to_inbox') }}
    </a>

    <div class="row justify-content-center">
        <div class="col-lg-10">

            {{-- Message Card --}}
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                {{-- Header --}}
                <div class="card-header border-0 p-0">
                    <div class="p-4 text-white position-relative overflow-hidden"
                        style="background: linear-gradient(135deg, #1e1b4b, #312e81, #4338ca);">

                        {{-- Decorative shapes --}}
                        <div class="position-absolute rounded-circle opacity-25"
                            style="width:200px; height:200px; background:rgba(255,255,255,0.08);
                            top:-60px; right:-40px;"></div>
                        <div class="position-absolute rounded-circle opacity-25"
                            style="width:120px; height:120px; background:rgba(255,255,255,0.06);
                            bottom:-30px; left:10%;"></div>

                        <div class="position-relative" style="z-index:2;">

                            {{-- Status Badge --}}
                            <div class="mb-3">
                                @if($contact->is_read)
                                    <span class="badge rounded-pill px-3 py-2"
                                        style="background: rgba(16,185,129,0.2); border: 1px solid rgba(16,185,129,0.4); color: #6ee7b7;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                            fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                            <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 2.354 7.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                                        </svg>
                                        {{ __('message.read') }}
                                    </span>
                                @else
                                    <span class="badge rounded-pill px-3 py-2"
                                        style="background: rgba(245,158,11,0.2); border: 1px solid rgba(245,158,11,0.4); color: #fcd34d;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                            fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        </svg>
                                        {{ __('message.unread') }}
                                    </span>
                                @endif
                            </div>

                            {{-- Sender Info --}}
                            <div class="d-flex align-items-center gap-3">
                                <div class="d-flex align-items-center justify-content-center rounded-circle text-white fw-bold flex-shrink-0"
                                    style="width:56px; height:56px; font-size:22px;
                                    background: linear-gradient(135deg, #6366f1, #8b5cf6);
                                    border: 3px solid rgba(255,255,255,0.2);
                                    box-shadow: 0 4px 15px rgba(99,102,241,0.4);">
                                    {{ strtoupper(substr($contact->name, 0, 1)) }}
                                </div>
                                <div>
                                    <h4 class="fw-bold text-white mb-1">
                                        {{ $contact->name }}
                                    </h4>
                                    <a href="mailto:{{ $contact->email }}"
                                       class="text-decoration-none"
                                       style="color: rgba(255,255,255,0.7);">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                                            fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Z"/>
                                        </svg>
                                        {{ $contact->email }}
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Body --}}
                <div class="card-body p-4">

                    {{-- Subject --}}
                    <div class="mb-4">
                        <label class="text-muted small fw-bold text-uppercase mb-2 d-block"
                            style="letter-spacing: 0.8px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                <path d="M7.003 14s-7-6.37-7-10a5 5 0 0 1 10 0 5 5 0 0 1 10 0c0 3.63-7 10-7 10z"/>
                            </svg>
                            {{ __('message.subject') }}
                        </label>
                        <div class="p-3 rounded-3"
                            style="background: linear-gradient(135deg, #eef2ff, #e0e7ff);
                            border: 1px solid #c7d2fe;">
                            <h5 class="fw-bold mb-0" style="color: #312e81;">
                                {{ $contact->subject }}
                            </h5>
                        </div>
                    </div>

                    {{-- Message --}}
                    <div class="mb-4">
                        <label class="text-muted small fw-bold text-uppercase mb-2 d-block"
                            style="letter-spacing: 0.8px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12z"/>
                            </svg>
                            {{ __('message.message') }}
                        </label>
                        <div class="p-4 rounded-3 position-relative"
                            style="background: #fafbff; border: 1px solid #e5e7eb;
                            border-left: 4px solid #6366f1;">

                            {{-- Quote mark --}}
                            <span class="position-absolute" style="top: -10px; left: 16px;
                                font-size: 3.5rem; color: rgba(99,102,241,0.12);
                                font-family: Georgia, serif; line-height: 1;">
                                &ldquo;
                            </span>

                            <p class="mb-0" style="color: #1e293b; font-size: 1rem;
                                line-height: 1.9; font-weight: 500; white-space: pre-wrap;
                                direction: auto; text-align: start;">{{ $contact->message }}</p>
                        </div>
                    </div>

                    {{-- Received Date --}}
                    @if($contact->created_at)
                        <div class="mb-4">
                            <label class="text-muted small fw-bold text-uppercase mb-2 d-block"
                                style="letter-spacing: 0.8px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                    fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                    <path d="M8 3.5a.5.5 0 0 0-1 0V8a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 7.71V3.5z"/>
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                </svg>
                                {{ __('message.received_at') }}
                            </label>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                                    {{ $contact->created_at->format('M d, Y') }}
                                </span>
                                <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                                    {{ $contact->created_at->format('h:i A') }}
                                </span>
                                <span class="text-muted small">
                                    ({{ $contact->created_at->diffForHumans() }})
                                </span>
                            </div>
                        </div>
                    @endif

                </div>

                {{-- Footer Actions --}}
                <div class="card-footer bg-white border-top p-4">
                    <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center">

                        <div class="d-flex gap-2 flex-wrap">

                          {{-- Reply Button --}}
                                <a href="{{ route('contact.reply', $contact->id) }}"
                                class="btn rounded-3 px-4 d-inline-flex align-items-center gap-2"
                                style="background: linear-gradient(135deg, #10b981, #059669);
                                color: white; font-weight: 700;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M5.921 11.9 1.353 8.62a.719.719 0 0 1 0-1.238L5.921 4.1A.716.716 0 0 1 7 4.719V6c1.5 0 6 0 7 8-2.5-4.5-7-4-7-4v1.281c0 .56-.606.898-1.079.62z"/>
                                    </svg>
                                    {{ __('message.reply') }}
                                </a>

                            {{-- Toggle Read/Unread --}}
                            <form action="{{ route('contact.toggleRead', $contact->id) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')

                                @if(!$contact->is_read)
                                    <button type="submit"
                                        class="btn btn-success rounded-3 px-4 d-inline-flex align-items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 2.354 7.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                                        </svg>
                                        {{ __('message.mark_as_read') }}
                                    </button>
                                @else
                                    <button type="submit"
                                        class="btn btn-warning rounded-3 px-4 d-inline-flex align-items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Z"/>
                                        </svg>
                                        {{ __('message.mark_as_unread') }}
                                    </button>
                                @endif
                            </form>

                        </div>

                        {{-- Delete --}}
                        <form action="{{ route('contact.destroy', $contact->id) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('{{ __('message.delete_confirm') }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-outline-danger rounded-3 px-4 d-inline-flex align-items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                </svg>
                                {{ __('message.delete') }}
                            </button>
                        </form>

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection