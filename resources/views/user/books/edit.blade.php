@extends('layouts.user')

@section('title', __('message.edit_book'))

@section('content')

<div class="book-edit-page py-4 py-md-5">
    <div class="container">

        {{-- ═══════════════════════════════
             SUCCESS ALERT
        ═══════════════════════════════ --}}
        @if(session('success'))
            <div class="row justify-content-center mb-3 anim-in">
                <div class="col-lg-10">
                    <div class="success-alert d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-success bg-opacity-10 d-flex align-items-center justify-content-center"
                             style="width:36px;height:36px;">
                            <i class="fas fa-check text-success"></i>
                        </div>
                        <div class="flex-grow-1">
                            <strong class="text-success">{{ session('success') }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- ═══════════════════════════════
             REJECTION REASON ALERT
        ═══════════════════════════════ --}}
        @if($book->status == 'rejected' && $book->rejection_reason)
            <div class="row justify-content-center mb-3 anim-in">
                <div class="col-lg-8">
                    <div class="alert mb-0 d-flex align-items-start gap-3"
                         style="border:none; border-radius:14px; border-left:4px solid #ef4444; background:#fef2f2; padding:16px 18px;">
                        <div class="rounded-circle bg-danger bg-opacity-10 d-flex align-items-center justify-content-center flex-shrink-0"
                             style="width:40px;height:40px;">
                            <i class="fas fa-exclamation-triangle text-danger"></i>
                        </div>
                        <div>
                            <strong class="text-danger d-block mb-1">
                                <i class="fas fa-ban me-1"></i>
                                {{ __('message.rejection_reason') }}
                            </strong>
                            <p class="text-muted mb-0 small">
                                {{ $book->rejection_reason }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="form-card anim-in">

                    {{-- ═══════════════════════════════
                         HEADER
                    ═══════════════════════════════ --}}
                    <div class="form-header text-center">
                        <div class="position-relative" style="z-index:2;">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-4 bg-white bg-opacity-25 mb-3"
                                 style="width:64px;height:64px;">
                                <i class="fas fa-pen-fancy text-white" style="font-size:28px;"></i>
                            </div>
                            <h3 class="fw-bold mb-2">{{ __('message.edit_book') }}</h3>
                            <p class="mb-0 opacity-75 small">
                                {{ __('message.edit_book_hint') }}
                            </p>

                            {{-- Status Badge --}}
                            @php
                                $statusClass = match($book->status) {
                                    'approved', 'published' => 'bg-success',
                                    'pending'               => 'bg-warning text-dark',
                                    'rejected'              => 'bg-danger',
                                    default                 => 'bg-secondary',
                                };
                            @endphp
                            <div class="mt-3">
                                <span class="badge {{ $statusClass }} rounded-pill px-3 py-2 small">
                                    <i class="fas fa-circle me-1" style="font-size:6px;vertical-align:middle;"></i>
                                    {{ ucfirst($book->status ?? 'N/A') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- ═══════════════════════════════
                         FORM
                    ═══════════════════════════════ --}}
                    <form action="{{ route('user.books.update', $book->id) }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- ── BOOK META CARD ── --}}
                        <div class="form-section" style="background:#fafbff;">
                            <div class="book-meta-card">
                                <div class="book-meta-avatar">
                                    <i class="fas fa-book"></i>
                                </div>
                                <div class="book-meta-info">
                                    <strong>{{ $book->getTitleAttribute() }}</strong>
                                    <small>
                                        <i class="fas fa-hashtag"></i> ID: {{ $book->id }}
                                        &nbsp;•&nbsp;
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ $book->created_at ? $book->created_at->format('Y-m-d') : '-' }}
                                        &nbsp;•&nbsp;
                                        <i class="fas fa-user"></i>
                                        {{ $book->author ?? '-' }}
                                    </small>
                                </div>
                            </div>
                        </div>

                        {{-- ── BOOK INFO ── --}}
                        <div class="form-section">
                            <div class="section-title">
                                <i class="fas fa-info-circle"></i>
                                {{ __('message.book_info') }}
                            </div>

                            <div class="row g-3">
                                {{-- Title --}}
                                <div class="col-md-6">
                                    <label for="title" class="form-label">
                                        <i class="fas fa-heading"></i>
                                        {{ __('message.book_title') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           name="title_en"
                                           id="title"
                                           value="{{ old('title_en', $book->getTitleAttribute()) }}"
                                           placeholder="{{ __('message.book_title_placeholder') }}"
                                           class="form-control @error('title_en') is-invalid @enderror">
                                    @error('title_en')
                                        <div class="error-message">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Author --}}
                                <div class="col-md-6">
                                    <label for="author" class="form-label">
                                        <i class="fas fa-user-edit"></i>
                                        {{ __('message.author') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           name="author"
                                           id="author"
                                           value="{{ old('author', $book->author) }}"
                                           placeholder="{{ __('message.author_placeholder') }}"
                                           class="form-control @error('author') is-invalid @enderror">
                                    @error('author')
                                        <div class="error-message">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- ── CATEGORY ── --}}
                        <div class="form-section">
                            <div class="section-title">
                                <i class="fas fa-folder"></i>
                                {{ __('message.categorization') }}
                            </div>

                            <label for="category_id" class="form-label">
                                <i class="fas fa-tags"></i>
                                {{ __('message.categories') }}
                                <span class="text-danger">*</span>
                            </label>
                            <select name="category_id"
                                    id="category_id"
                                    class="form-select @error('category_id') is-invalid @enderror">
                                <option value="">{{ __('message.select_category') }}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        @selected(old('category_id', $book->category_id) == $category->id)>
                                        {{ $category->getname() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- ── DESCRIPTION ── --}}
                        <div class="form-section">
                            <div class="section-title">
                                <i class="fas fa-align-left"></i>
                                {{ __('message.book_description') }}
                            </div>

                            <label for="description" class="form-label">
                                <i class="fas fa-file-alt"></i>
                                {{ __('message.description') }}
                                <small class="text-muted ms-auto">{{ __('message.optional') }}</small>
                            </label>
                            <textarea name="description"
                                      id="description"
                                      rows="4"
                                      placeholder="{{ __('message.description_placeholder') }}"
                                      class="form-control @error('description') is-invalid @enderror">{{ old('description', $book->description) }}</textarea>
                            @error('description')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- ══════════════════════════════════════
                             📄 BOOK FILE (PDF) — WAS MISSING
                        ══════════════════════════════════════ --}}
                        <div class="form-section">
                            <div class="section-title">
                                <i class="fas fa-file-pdf"></i>
                                {{ __('message.book_file') }}
                            </div>

                            {{-- Current File --}}
                            @if($book->file)
                                <div class="current-file-box">
                                    <div class="current-file-icon">
                                        <i class="fas fa-file-pdf"></i>
                                    </div>
                                    <div class="current-file-info">
                                        <div class="current-file-name">
                                            {{ basename($book->file) }}
                                        </div>
                                        <div class="current-file-meta">
                                            <i class="fas fa-check-circle text-success me-1"></i>
                                            {{ __('message.current') }} {{ __('message.book_file') }}
                                        </div>
                                    </div>
                                    <a href="{{ asset('storage/'.$book->file) }}"
                                       target="_blank"
                                       class="btn btn-sm btn-outline-primary rounded-3 px-3 py-1"
                                       style="font-size:12px; font-weight:600;">
                                        <i class="fas fa-eye me-1"></i>
                                        {{ __('message.view') }}
                                    </a>
                                    <span class="current-file-badge">
                                        {{ __('message.uploaded') }}
                                    </span>
                                </div>
                                <p class="replace-hint">
                                    <i class="fas fa-info-circle"></i>
                                    {{ __('message.replace_file_hint') }}
                                </p>
                            @endif

                            {{-- Upload Zone --}}
                            <div class="file-upload-zone" id="fileZone">
                                <div class="file-upload-icon">
                                    <i class="fas fa-file-upload text-danger" style="font-size:18px;"></i>
                                </div>
                                <div class="file-upload-text" id="fileText">
                                    {{ $book->file ? __('message.upload_new_file') : __('message.upload_book_file') }}
                                </div>
                                <div class="file-upload-hint">PDF, DOC, DOCX (Max 10MB)</div>
                                <input type="file"
                                       name="file"
                                       id="bookFile"
                                       accept=".pdf,.doc,.docx"
                                       class="@error('file') is-invalid @enderror">
                            </div>

                            @error('file')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- ── THUMBNAIL ── --}}
                        <div class="form-section">
                            <div class="section-title">
                                <i class="fas fa-image"></i>
                                {{ __('message.thumbnail_image') }}
                            </div>

                            {{-- Current Thumbnail --}}
                            @if($book->thumbnail)
                                <div class="current-thumbnail">
                                    <img src="{{ asset('storage/'.$book->thumbnail) }}"
                                         alt="Current Thumbnail">
                                    <span class="current-badge">
                                        <i class="fas fa-check-circle text-success"></i>
                                        {{ __('message.current') }}
                                    </span>
                                </div>
                                <p class="replace-hint">
                                    <i class="fas fa-info-circle"></i>
                                    {{ __('message.replace_thumbnail_hint') }}
                                </p>
                            @endif

                            {{-- Upload Zone --}}
                            <div class="file-upload-zone" id="thumbnailZone">
                                <div class="file-upload-icon">
                                    <i class="fas fa-cloud-upload-alt text-primary" style="font-size:18px;"></i>
                                </div>
                                <div class="file-upload-text" id="thumbnailText">
                                    {{ __('message.upload_new_thumbnail') }}
                                </div>
                                <div class="file-upload-hint">PNG, JPG, WEBP (Max 2MB)</div>
                                <input type="file"
                                       name="thumbnail"
                                       id="thumbnail"
                                       accept="image/*"
                                       class="@error('thumbnail') is-invalid @enderror">
                            </div>

                            <img id="imagePreview" class="image-preview" src="#" alt="Preview">

                            @error('thumbnail')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- ── ACTION BUTTONS ── --}}
                        <div class="form-section" style="background:#fafbff;">
                            <div class="row g-2">
                                <div class="col-sm-4">
                                    <a href="{{ route('user.books.index') }}"
                                       class="btn btn-cancel w-100">
                                        <i class="fas fa-arrow-left me-1"></i>
                                        {{ __('message.cancel') }}
                                    </a>
                                </div>
                                <div class="col-sm-8">
                                    <button type="submit" class="btn btn-update w-100">
                                        <i class="fas fa-save me-2"></i>
                                        {{ __('message.update_book') }}
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection