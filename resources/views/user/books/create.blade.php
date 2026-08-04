@extends('layouts.user')

@section('title', __('message.add_record'))

@section('content')

 <style>
    /* ── Required Badge ── */
    .required-badge {
        display: inline-block;
        background: #fee2e2;
        color: #dc2626;
        font-size: 9px;
        font-weight: 700;
        padding: 2px 6px;
        border-radius: 4px;
        letter-spacing: 0.05em;
        margin-{{ in_array(app()->getLocale(), ['ps','dr','fa','ar']) ? 'right' : 'left' }}: 6px;
    }

    /* ── Animations ── */
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(15px); }
        to   { opacity: 1; transform: translateY(0);    }
    }
    .anim-in { animation: slideUp 0.5s ease both; }

    /* ── Mobile ── */
    @media (max-width: 768px) {
        .form-header {
            padding: 24px 20px;
        }
        .form-section {
            padding: 20px;
        }
    }
 </style>

<div class="book-form-page py-4 py-md-5">
    <div class="container">

        {{-- ═══════════════════════════════
             SUCCESS ALERT
        ═══════════════════════════════ --}}
        @if(session('success'))
            <div class="row justify-content-center mb-3 anim-in">
                <div class="col-lg-8">
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

        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="form-card anim-in">

                    {{-- ═══════════════════════════════
                         HEADER
                    ═══════════════════════════════ --}}
                    <div class="form-header text-center">
                        <div class="position-relative" style="z-index:2;">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-4 bg-white bg-opacity-25 mb-3"
                                 style="width:64px;height:64px;">
                                <i class="fas fa-book-open text-white" style="font-size:28px;"></i>
                            </div>
                            <h3 class="fw-bold mb-2">{{ __('message.add_record') }}</h3>
                            <p class="mb-0 opacity-75 small">
                                {{ __('message.add_book_hint') }}
                            </p>
                        </div>
                    </div>

                    {{-- ═══════════════════════════════
                         FORM
                    ═══════════════════════════════ --}}
                    <form action="{{ route('user.books.store') }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf

                        {{-- ── BOOK INFO SECTION ── --}}
                        <div class="form-section">
                            <div class="section-title">
                                <i class="fas fa-info-circle"></i>
                                {{ __('message.book_info') }}
                            </div>

                            {{-- Book Title (English) --}}
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="fas fa-heading"></i>
                                    {{ __('message.book_title') }} (English)
                                    <span class="required-badge">{{ __('message.required') }}</span>
                                </label>
                                <input type="text"
                                       name="title_en"
                                       class="form-control"
                                       value="{{ old('title_en') }}"
                                       placeholder="{{ __('message.book_title_placeholder') }}">
                                @error('title_en')
                                    <small class="text-danger d-block mt-1">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            {{-- Author --}}
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="fas fa-user-edit"></i>
                                    {{ __('message.author') }}
                                    <span class="required-badge">{{ __('message.required') }}</span>
                                </label>
                                <input type="text"
                                       name="author"
                                       class="form-control"
                                       value="{{ old('author') }}"
                                       placeholder="{{ __('message.author_placeholder') }}">
                                @error('author')
                                    <small class="text-danger d-block mt-1">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            {{-- Edition --}}
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="fas fa-bookmark"></i>
                                    {{ __('message.edition') }}
                                    <span class="required-badge">{{ __('message.required') }}</span>
                                </label>
                                <input type="text"
                                       name="edition"
                                       class="form-control"
                                       value="{{ old('edition') }}"
                                       placeholder="{{ __('message.edition_placeholder') }}">
                                @error('edition')
                                    <small class="text-danger d-block mt-1">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>

                        {{-- ── CATEGORY SECTION ── --}}
                        <div class="form-section">
                            <div class="section-title">
                                <i class="fas fa-folder"></i>
                                {{ __('message.categorization') }}
                            </div>

                            <div class="mb-0">
                                <label class="form-label">
                                    <i class="fas fa-tags"></i>
                                    {{ __('message.categories') }}
                                    <span class="required-badge">{{ __('message.required') }}</span>
                                </label>
                                <select name="category_id" id="category" class="form-select">
                                    <option value="">{{ __('message.select_category') }}</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->getName() }}
                                        </option>
                                    @endforeach
                                    <option value="other"
                                        {{ old('category_id') == 'other' ? 'selected' : '' }}>
                                        ➕ {{ __('message.other') }}
                                    </option>
                                </select>
                                @error('category_id')
                                    <small class="text-danger d-block mt-1">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </small>
                                @enderror

                                {{-- Custom Category (Slides in) --}}
                                <div id="otherCategoryDiv"
                                     class="{{ old('category_id') == 'other' ? 'show' : '' }}">
                                    <div class="d-flex align-items-center gap-2 p-2 rounded-3"
                                         style="background:#fff7ed;border:1px solid #fed7aa;">
                                        <i class="fas fa-lightbulb text-warning"></i>
                                        <input type="text"
                                               name="custom_category"
                                               class="form-control border-0 bg-transparent shadow-none p-0"
                                               placeholder="{{ __('message.enter_category') }}"
                                               value="{{ old('custom_category') }}">
                                    </div>
                                </div>
                                @error('custom_category')
                                    <small class="text-danger d-block mt-1">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>

                        {{-- ── DESCRIPTION SECTION ── --}}
                        <div class="form-section">
                            <div class="section-title">
                                <i class="fas fa-align-left"></i>
                                {{ __('message.book_description') }}
                            </div>

                            <div class="mb-0">
                                <label class="form-label">
                                    <i class="fas fa-file-alt"></i>
                                    {{ __('message.description') }} (English)
                                    <small class="text-muted ms-auto">{{ __('message.optional') }}</small>
                                </label>
                                <textarea name="description_en"
                                          class="form-control"
                                          rows="3"
                                          placeholder="{{ __('message.description_placeholder') }}">{{ old('description_en') }}</textarea>
                                @error('description_en')
                                    <small class="text-danger d-block mt-1">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>

                        {{-- ── UPLOADS SECTION ── --}}
                        <div class="form-section">
                            <div class="section-title">
                                <i class="fas fa-cloud-upload-alt"></i>
                                {{ __('message.uploads') }}
                            </div>

                            {{-- Thumbnail --}}
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="fas fa-image"></i>
                                    {{ __('message.upload_image') }}
                                    <small class="text-muted ms-auto">{{ __('message.optional') }}</small>
                                </label>
                                <div class="file-upload-zone" id="thumbnailZone">
                                    <div class="file-upload-icon">
                                        <i class="fas fa-image text-primary" style="font-size:20px;"></i>
                                    </div>
                                    <div class="file-upload-text" id="thumbnailText">
                                        {{ __('message.upload_thumbnail_text') }}
                                    </div>
                                    <div class="file-upload-hint">PNG, JPG, WEBP (Max 2MB)</div>
                                    <input type="file"
                                           name="thumbnail"
                                           id="thumbnailInput"
                                           accept="image/*">
                                </div>
                                <img id="imagePreview" class="image-preview" src="#" alt="Preview">
                                @error('thumbnail')
                                    <small class="text-danger d-block mt-1">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            {{-- Book File --}}
                            <div class="mb-0">
                                <label class="form-label">
                                    <i class="fas fa-file-pdf"></i>
                                    {{ __('message.upload_book') }} (PDF / EPUB)
                                    <span class="required-badge">{{ __('message.required') }}</span>
                                </label>
                                <div class="file-upload-zone" id="fileZone">
                                    <div class="file-upload-icon">
                                        <i class="fas fa-file-alt text-success" style="font-size:20px;"></i>
                                    </div>
                                    <div class="file-upload-text" id="fileText">
                                        {{ __('message.upload_book_text') }}
                                    </div>
                                    <div class="file-upload-hint">PDF, EPUB (Max 20MB)</div>
                                    <input type="file"
                                           name="file"
                                           id="fileInput"
                                           accept=".pdf,.epub">
                                </div>
                                @error('file')
                                    <small class="text-danger d-block mt-1">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>

                        {{-- ──  / SUBMIT ── --}}
                        <div class="form-section" style="background:#fafbff;">

                            <div class="required-note mb-3">
                                <span class="dot">*</span>
                                {{ __('message.required_field_note') }}
                            </div>

                            <div class="row g-2">
                                <div class="col-sm-4">
                                    <a href="{{ route('user.dashboard') }}"
                                       class="btn btn-cancel w-100">
                                        <i class="fas fa-times me-1"></i>
                                        {{ __('message.cancel') }}
                                    </a>
                                </div>
                                <div class="col-sm-8">
                                    <button type="submit" class="btn btn-submit w-100">
                                        <i class="fas fa-cloud-upload-alt me-2"></i>
                                        {{ __('message.add_record') }}
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