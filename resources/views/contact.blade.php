@extends('layouts.app')

@section('content')

<div class="container py-5">

<h2 class="text-center fw-bold mb-4">{{ __('message.contact') }}</h2>

<p class="text-center text-muted mb-5">
  {{ __('message.message') }}
</p>

<div class="row g-4">
<!-- Contact Form -->
    <div class="col-md-7">

        <div class="card shadow-sm p-4">

        <h4 class="fw-bold mb-3">{{ __('message.send_message') }}</h4>

        <form action="{{ route('contact') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">{{ __('message.name') }}<sup class="text-danger fw-bold">*</sup> </label>
                <input type="text" class="form-control" name="name" placeholder="{{ __('message.name') }}" value="{{ old('name') }}">
                @error('name') <small  class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">{{ __('message.email') }} <sup class="text-danger fw-bold">*</sup></label>
                <input type="email" class="form-control" name="email" placeholder="{{ __('message.email') }}" value="{{ old('email') }}">
                @error('email') <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">{{ __('message.book_title') }}<sup class="text-danger fw-bold">*</sup></label>
                <input type="text" class="form-control" name="subject" placeholder="{{ __('message.book_title') }}"  value="{{ old('subject') }}">
                @error('subject')<small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('message.send_message') }}<sup class="text-danger fw-bold">*</sup></label>
                <textarea class="form-control" rows="5" name="message" placeholder="{{ __('message.send_message') }}" value="{{ old('message') }}"></textarea>
                @error('message') <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button class="btn btn-primary w-100">
            {{ __('message.send_message') }}
            </button>
        </form>
        </div>
    </div>
    <!-- Contact Information -->
<div class="col-md-5">
    <div class="card shadow-sm p-4">
    <h4 class="fw-bold mb-3">{{ __('message.contact') }}</h4>
    <p><strong >{{ __('message.email') }}:</strong> <a href="mailto:">samiaziziazizi6367@gmail.com</a></p>
    <p><strong>{{ __('message.mobile') }}:</strong> +93 770216367</p>
    <p><strong>{{ __('message.mobile') }}:</strong> +93 731777395</p>
    <p><strong>{{ __('message.email') }}:</strong><a href="mailto:"> maaznaizi2001@gmail.com</a></p>
    <p><strong>{{ __('message.mobile') }}:</strong> +93 784763743</p>
    <p><strong>{{ __('message.address') }}:</strong> Jalalabad, Nangarhar, Afghanistan</p>
    <hr>
    <p class="text-muted">
    Our team will respond to your message as soon as possible.
    </p>
    </div>
 </div>
</div>
</div>
<!-- Footer -->
    <footer class="bg-dark text-white text-center py-4">
        <div class="container">
        <h5 class="fw-bold mb-2">
        Afghan Student Digital Library
        </h5>
        <p class="text-secondary">
        Providing free educational resources for Afghan students.
        </p>
        <p class="text-secondary">
        © 2026 All Rights Reserved With Azizi
        </p>
        </div>
    </footer>
@endsection