{{-- resources/views/admin/message/reply.blade.php --}}
@extends('layouts.admin')

@section('title', __('message.reply_to_message'))

@section('content')
<div class="container py-4">

    {{-- Back Button --}}
    <a href="{{ route('contact.show', $contact->id) }}"
       class="btn btn-light rounded-pill px-4 py-2 mb-4 d-inline-flex align-items-center gap-2 shadow-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
            viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
        </svg>
        {{ __('message.back_to_message') }}
    </a>

    <div class="row justify-content-center">
        <div class="col-lg-10">

            {{-- Alerts --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 rounded-3 mb-4">
                    <div class="d-flex align-items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                            fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </svg>
                        <strong>{{ __('message.success') }}!</strong> {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 rounded-3 mb-4">
                    <div class="d-flex align-items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                            fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                        </svg>
                        <strong>{{ __('message.error') }}!</strong> {{ session('error') }}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- ================================
                 ORIGINAL MESSAGE CARD
            ================================= --}}
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">

                {{-- Header --}}
                <div class="card-header border-0 p-0">
                    <div class="p-4 text-white position-relative overflow-hidden"
                        style="background: linear-gradient(135deg, #1e1b4b, #312e81, #4338ca);">

                        {{-- Decorative --}}
                        <div class="position-absolute rounded-circle opacity-25"
                            style="width:180px; height:180px; background:rgba(255,255,255,0.07);
                            top:-50px; right:-30px;"></div>
                        <div class="position-absolute rounded-circle opacity-25"
                            style="width:100px; height:100px; background:rgba(255,255,255,0.05);
                            bottom:-25px; left:8%;"></div>

                        <div class="position-relative" style="z-index:2;">

                            <div class="d-flex align-items-center gap-2 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    fill="currentColor" viewBox="0 0 16 16" style="opacity:0.7;">
                                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Z"/>
                                </svg>
                                <span class="small fw-bold" style="color: rgba(255,255,255,0.6); letter-spacing: 1px; text-transform: uppercase;">
                                    {{ __('message.original_message') }}
                                </span>
                            </div>

                            {{-- Sender Info --}}
                            <div class="d-flex align-items-center gap-3">
                                <div class="d-flex align-items-center justify-content-center rounded-circle text-white fw-bold flex-shrink-0"
                                    style="width:50px; height:50px; font-size:20px;
                                    background: linear-gradient(135deg, #6366f1, #8b5cf6);
                                    border: 2px solid rgba(255,255,255,0.2);
                                    box-shadow: 0 4px 15px rgba(99,102,241,0.4);">
                                    {{ strtoupper(substr($contact->name, 0, 1)) }}
                                </div>
                                <div>
                                    <h5 class="fw-bold text-white mb-1">{{ $contact->name }}</h5>
                                    <span style="color: rgba(255,255,255,0.6); font-size: 0.88rem;">
                                        {{ $contact->email }}
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Original Message Body --}}
                <div class="card-body p-4">

                    {{-- Subject --}}
                    <div class="mb-3">
                        <label class="fw-bold small text-uppercase mb-2 d-block"
                            style="color: #374151; letter-spacing: 0.8px; font-size: 0.73rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                                fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm-1 2a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2V4Z"/>
                            </svg>
                            {{ __('message.subject') }}
                        </label>
                        <div class="p-3 rounded-3"
                            style="background: linear-gradient(135deg, #eef2ff, #e0e7ff);
                            border: 1px solid #c7d2fe;">
                            <span class="fw-bold" style="color: #312e81;">
                                {{ $contact->subject }}
                            </span>
                        </div>
                    </div>

                    {{-- Message --}}
                    <div>
                        <label class="fw-bold small text-uppercase mb-2 d-block"
                            style="color: #374151; letter-spacing: 0.8px; font-size: 0.73rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                                fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12z"/>
                            </svg>
                            {{ __('message.message') }}
                        </label>
                        <div class="p-3 rounded-3 position-relative"
                            style="background: #f9fafb; border: 1px solid #e5e7eb;
                            border-left: 3px solid #6366f1;">

                            <span class="position-absolute" style="top: -8px; left: 14px;
                                font-size: 3rem; color: rgba(99,102,241,0.12);
                                font-family: Georgia, serif; line-height: 1;">
                                &ldquo;
                            </span>

                            <p class="mb-0" style="color: #111827; font-size: 0.95rem;
                                line-height: 1.85; font-weight: 500; white-space: pre-wrap;
                                direction: auto; text-align: start;">{{ $contact->message }}</p>
                        </div>
                    </div>

                    {{-- Date --}}
                    @if($contact->created_at)
                        <div class="mt-3 d-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                                fill="#9ca3af" viewBox="0 0 16 16">
                                <path d="M8 3.5a.5.5 0 0 0-1 0V8a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 7.71V3.5z"/>
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                            </svg>
                            <small class="text-muted">
                                {{ $contact->created_at->format('M d, Y h:i A') }}
                                ({{ $contact->created_at->diffForHumans() }})
                            </small>
                        </div>
                    @endif

                </div>
            </div>

            {{-- ================================
                 PREVIOUS REPLIES
            ================================= --}}
            @if($contact->replies && $contact->replies->count() > 0)
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                    <div class="card-header bg-white border-bottom py-3 px-4">
                        <div class="d-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                fill="#6366f1" viewBox="0 0 16 16">
                                <path d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7z"/>
                            </svg>
                            <h6 class="mb-0 fw-bold" style="color: #111827;">
                                {{ __('message.previous_replies') }}
                                <span class="badge bg-primary-subtle text-primary rounded-pill ms-2 px-2">
                                    {{ $contact->replies->count() }}
                                </span>
                            </h6>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        @foreach($contact->replies as $reply)
                            <div class="mb-4 pb-4 {{ !$loop->last ? 'border-bottom' : '' }}">

                                {{-- Reply Header --}}
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="d-flex align-items-center justify-content-center rounded-circle text-white fw-bold"
                                            style="width:36px; height:36px; font-size:14px;
                                            background: linear-gradient(135deg, #10b981, #059669);">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="fw-bold d-block" style="color: #111827; font-size: 0.9rem;">
                                                {{ $reply->admin->name ?? __('message.admin') }}
                                            </span>
                                            <small style="color: #6b7280;">
                                                {{ __('message.admin_reply') }}
                                            </small>
                                        </div>
                                    </div>

                                    <small style="color: #9ca3af;">
                                        {{ $reply->created_at->format('M d, Y h:i A') }}
                                    </small>
                                </div>

                                {{-- Reply Subject --}}
                                @if($reply->subject)
                                    <div class="mb-2">
                                        <span class="badge bg-success-subtle text-success border rounded-pill px-3 py-2">
                                            {{ $reply->subject }}
                                        </span>
                                    </div>
                                @endif

                                {{-- Reply Message --}}
                                <div class="p-3 rounded-3"
                                    style="background: #f0fdf4; border: 1px solid #bbf7d0;
                                    border-left: 3px solid #10b981;">
                                    <p class="mb-0" style="color: #111827; font-size: 0.95rem;
                                        line-height: 1.85; white-space: pre-wrap;
                                        direction: auto; text-align: start;">{{ $reply->message }}</p>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- ================================
                 REPLY FORM
            ================================= --}}
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                {{-- Form Header --}}
                <div class="card-header border-0 p-0">
                    <div class="p-4 text-white position-relative overflow-hidden"
                        style="background: linear-gradient(135deg, #064e3b, #065f46, #047857);">

                        <div class="position-absolute rounded-circle opacity-25"
                            style="width:150px; height:150px; background:rgba(255,255,255,0.06);
                            top:-40px; right:-20px;"></div>

                        <div class="position-relative" style="z-index:2;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="d-flex align-items-center justify-content-center rounded-3"
                                    style="width:46px; height:46px;
                                    background: rgba(255,255,255,0.12);
                                    border: 1px solid rgba(255,255,255,0.15);">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                        fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M5.921 11.9 1.353 8.62a.719.719 0 0 1 0-1.238L5.921 4.1A.716.716 0 0 1 7 4.719V6c1.5 0 6 0 7 8-2.5-4.5-7-4-7-4v1.281c0 .56-.606.898-1.079.62z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="fw-bold text-white mb-1">
                                        {{ __('message.compose_reply') }}
                                    </h5>
                                    <span style="color: rgba(255,255,255,0.6); font-size: 0.85rem;">
                                        {{ __('message.replying_to') }}: {{ $contact->name }}
                                        ({{ $contact->email }})
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Form Body --}}
                <div class="card-body p-4">
                    <form action="{{ route('contact.reply.send', $contact->id) }}"
                          method="POST" id="replyForm">
                        @csrf

                        {{-- To (readonly) --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-uppercase"
                                style="color: #374151; letter-spacing: 0.8px; font-size: 0.73rem;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                                    fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Z"/>
                                </svg>
                                {{ __('message.to') }}
                            </label>
                            <div class="d-flex align-items-center gap-2 p-3 rounded-3"
                                style="background: #f9fafb; border: 1px solid #e5e7eb;">
                                <div class="d-flex align-items-center justify-content-center rounded-circle text-white fw-bold"
                                    style="width:32px; height:32px; font-size:13px;
                                    background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                                    {{ strtoupper(substr($contact->name, 0, 1)) }}
                                </div>
                                <div>
                                    <span class="fw-bold d-block" style="color: #111827; font-size: 0.9rem;">
                                        {{ $contact->name }}
                                    </span>
                                    <small style="color: #6b7280;">{{ $contact->email }}</small>
                                </div>
                            </div>
                        </div>

                        {{-- Subject --}}
                        <div class="mb-4">
                            <label for="reply_subject" class="form-label fw-bold small text-uppercase"
                                style="color: #374151; letter-spacing: 0.8px; font-size: 0.73rem;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                                    fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                    <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Z"/>
                                </svg>
                                {{ __('message.reply_subject') }}
                            </label>
                            <input type="text" name="subject" id="reply_subject"
                                class="form-control rounded-3 py-3 px-4 @error('subject') is-invalid @enderror"
                                value="{{ old('subject', 'Re: ' . $contact->subject) }}"
                                placeholder="{{ __('message.enter_reply_subject') }}"
                                style="border: 2px solid #e5e7eb; font-size: 0.95rem; font-weight: 600;
                                color: #111827;">
                            @error('subject')
                                <div class="invalid-feedback fw-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Reply Message --}}
                        <div class="mb-4">
                            <label for="reply_message" class="form-label fw-bold small text-uppercase"
                                style="color: #374151; letter-spacing: 0.8px; font-size: 0.73rem;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                                    fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                    <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12z"/>
                                </svg>
                                {{ __('message.your_reply') }}
                                <span class="text-danger">*</span>
                            </label>
                            <textarea name="message" id="reply_message" rows="8"
                                class="form-control rounded-3 py-3 px-4 @error('message') is-invalid @enderror"
                                placeholder="{{ __('message.type_your_reply') }}"
                                required
                                style="border: 2px solid #e5e7eb; font-size: 0.95rem; font-weight: 500;
                                color: #111827; line-height: 1.8; resize: vertical;
                                direction: auto;">{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback fw-bold">{{ $message }}</div>
                            @enderror

                            {{-- Character counter --}}
                            <div class="d-flex justify-content-between mt-2">
                                <small style="color: #9ca3af;">
                                    {{ __('message.reply_hint') }}
                                </small>
                                <small id="charCount" style="color: #9ca3af;">
                                    0 {{ __('message.characters') }}
                                </small>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center pt-3"
                            style="border-top: 1px solid #f3f4f6;">

                            <div class="d-flex gap-2 flex-wrap">

                                {{-- Send Reply --}}
                                <button type="submit"
                                    class="btn px-4 py-2 rounded-3 fw-bold d-inline-flex align-items-center gap-2"
                                    style="background: linear-gradient(135deg, #10b981, #059669);
                                    color: white; box-shadow: 0 4px 15px rgba(16,185,129,0.3);
                                    border: none; font-size: 0.93rem;"
                                    id="sendBtn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                                    </svg>
                                    {{ __('message.send_reply') }}
                                </button>

                                {{-- Send & Mark Read --}}
                                <button type="submit" name="mark_read" value="1"
                                    class="btn px-4 py-2 rounded-3 fw-bold d-inline-flex align-items-center gap-2"
                                    style="background: linear-gradient(135deg, #6366f1, #8b5cf6);
                                    color: white; box-shadow: 0 4px 15px rgba(99,102,241,0.3);
                                    border: none; font-size: 0.93rem;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 2.354 7.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                                    </svg>
                                    {{ __('message.send_and_mark_read') }}
                                </button>

                            </div>

                            {{-- Cancel --}}
                            <a href="{{ route('contact.show', $contact->id) }}"
                               class="btn btn-light rounded-3 px-4 py-2 fw-bold d-inline-flex align-items-center gap-2"
                               style="color: #374151; font-size: 0.93rem;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                                {{ __('message.cancel') }}
                            </a>

                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>
</div>

{{-- Character counter script --}}
<script>
    const textarea = document.getElementById('reply_message');
    const charCount = document.getElementById('charCount');

    if (textarea && charCount) {
        textarea.addEventListener('input', function () {
            charCount.textContent = this.value.length + ' {{ __("message.characters") }}';
        });
    }
</script>
@endsection