@extends('layouts.admin')

@section('title', __('message.edit') . ' - ' . $book->getTitleAttribute())

<style>
    /* ═══════════ Form Header ═══════════ */
    .form-header {
        background: linear-gradient(135deg, #f59e0b 0%, #f97316 50%, #ef4444 100%);
        position: relative;
        overflow: hidden;
    }

    .form-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 220px;
        height: 220px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
    }

    .form-header::after {
        content: '';
        position: absolute;
        bottom: -40%;
        left: 5%;
        width: 160px;
        height: 160px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }

    /* ═══════════ Form Card ═══════════ */
    .form-card {
        background: #fff;
        border: 1px solid rgba(0, 0, 0, 0.04);
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
    }

    /* ═══════════ Section Divider ═══════════ */
    .section-title {
        font-size: 14px;
        font-weight: 700;
        color: #374151;
        padding-bottom: 10px;
        border-bottom: 2px solid #f3f4f6;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .section-icon {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        flex-shrink: 0;
    }

    /* ═══════════ Custom Label ═══════════ */
    .custom-label {
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .custom-label i {
        color: #9ca3af;
        font-size: 13px;
    }

    .required-dot {
        width: 6px;
        height: 6px;
        background: #ef4444;
        border-radius: 50%;
        display: inline-block;
        flex-shrink: 0;
    }

    .optional-badge {
        font-size: 10px;
        font-weight: 600;
        color: #9ca3af;
        background: #f3f4f6;
        padding: 2px 7px;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* ═══════════ Custom Input ═══════════ */
    .custom-input {
        border: 1.5px solid #e5e7eb;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 14px;
        transition: all 0.2s ease;
        background: #fafafa;
        color: #111827;
    }

    .custom-input:focus {
        border-color: #f59e0b;
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
        background: #fff;
        outline: none;
    }

    .custom-input.is-invalid {
        border-color: #ef4444;
        background: #fff5f5;
    }

    .custom-input::placeholder {
        color: #c0c4cc;
        font-size: 13px;
    }

    /* ═══════════ Language Tab Pills ═══════════ */
    .lang-pills {
        display: flex;
        gap: 6px;
        margin-bottom: 16px;
        flex-wrap: wrap;
    }

    .lang-pill {
        padding: 5px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        border: 1.5px solid #e5e7eb;
        background: #f9fafb;
        color: #6b7280;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
    }

    .lang-pill:hover {
        border-color: #f59e0b;
        color: #f59e0b;
        background: #fffbeb;
    }

    .lang-pill.active {
        border-color: #f59e0b;
        background: #fffbeb;
        color: #f59e0b;
    }

    /* ═══════════ Field Error ═══════════ */
    .field-error {
        font-size: 12px;
        color: #ef4444;
        margin-top: 5px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* ═══════════ Thumbnail Preview ═══════════ */
    .thumb-preview-wrap {
        position: relative;
        display: inline-block;
        margin-top: 10px;
    }

    .thumb-preview-wrap img {
        width: 100px;
        height: 130px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid #e5e7eb;
    }

    .thumb-badge {
        position: absolute;
        top: -6px;
        right: -6px;
        background: #10b981;
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        padding: 3px 7px;
        border-radius: 10px;
        border: 2px solid #fff;
    }

    /* ═══════════ File Upload Area ═══════════ */
    .file-upload-area {
        border: 2px dashed #e5e7eb;
        border-radius: 12px;
        padding: 18px;
        text-align: center;
        background: #fafbfc;
        transition: all 0.2s ease;
        cursor: pointer;
        position: relative;
    }

    .file-upload-area:hover {
        border-color: #f59e0b;
        background: #fffbeb;
    }

    .file-upload-area input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    /* ═══════════ Alert Custom ═══════════ */
    .alert-soft-success {
        background: rgba(16, 185, 129, 0.08);
        border: 1px solid rgba(16, 185, 129, 0.2);
        color: #065f46;
        border-radius: 12px;
        padding: 14px 18px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        font-weight: 500;
    }

    .alert-soft-danger {
        background: rgba(239, 68, 68, 0.06);
        border: 1px solid rgba(239, 68, 68, 0.2);
        color: #7f1d1d;
        border-radius: 12px;
        padding: 14px 18px;
        font-size: 14px;
    }

    /* ═══════════ Submit Button ═══════════ */
    .btn-update {
        background: linear-gradient(135deg, #f59e0b, #f97316);
        border: none;
        color: #fff;
        padding: 11px 28px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 14px;
        transition: all 0.25s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-update:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(245, 158, 11, 0.35);
        color: #fff;
    }

    .btn-update:active {
        transform: translateY(0);
    }

    /* ═══════════ Breadcrumb ═══════════ */
    .page-breadcrumb {
        font-size: 13px;
    }

    .page-breadcrumb a {
        color: #6b7280;
        text-decoration: none;
        transition: color 0.2s;
    }

    .page-breadcrumb a:hover {
        color: #f59e0b;
    }

    /* ═══════════ Lang Tab Content ═══════════ */
    .lang-tab-content {
        display: none;
    }

    .lang-tab-content.active {
        display: block;
    }

    /* ═══════════ Mobile ═══════════ */
    @media (max-width: 768px) {
        .btn-update {
            width: 100%;
            justify-content: center;
        }

        .btn-cancel-wrap {
            width: 100%;
        }

        .btn-cancel-wrap a {
            width: 100%;
        }
    }
</style>


@section('content')
<div class="container-fluid py-2">

    {{-- ═══════════ BREADCRUMB ═══════════ --}}
    <nav class="page-breadcrumb mb-3">
        <a href="{{ route('admin.dashboard') }}">
            <i class="bi bi-house me-1"></i>{{ __('message.dashboard') }}
        </a>
        <span class="mx-2 text-muted">/</span>
        <a href="{{ route('admin.books.index') }}">{{ __('dashboard.manage_books') }}</a>
        <span class="mx-2 text-muted">/</span>
        <span class="text-dark fw-semibold">
            {{ __('message.edit') }} — {{ Str::limit($book->getTitleAttribute(), 40) }}
        </span>
    </nav>

    {{-- ═══════════ ALERTS ═══════════ --}}
    @if(session('success'))
        <div class="alert-soft-success mb-3">
            <i class="bi bi-check-circle-fill text-success fs-5"></i>
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert-soft-danger mb-3">
            <div class="d-flex align-items-center gap-2 mb-2">
                <i class="bi bi-exclamation-triangle-fill text-danger"></i>
                <strong>{{ __('dashboard.fix_errors') }}</strong>
            </div>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ═══════════ FORM HEADER ═══════════ --}}
    <div class="form-header p-4 rounded-top-4">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-white bg-opacity-25 rounded-3 p-2 d-flex align-items-center justify-content-center"
                 style="width:48px;height:48px;">
                <i class="bi bi-pencil-square text-white fs-4"></i>
            </div>
            <div>
                <h4 class="fw-bold text-white mb-0">
                    {{ __('message.edit') }} — {{ Str::limit($book->getTitleAttribute(), 50) }}
                </h4>
                <small class="text-white-50">{{ __('dashboard.edit_book_subtitle') }}</small>
            </div>
        </div>
    </div>

    {{-- ═══════════ FORM BODY ═══════════ --}}
    <div class="form-card rounded-bottom-4 p-4 mb-4">
        <form action="{{ route('admin.books.update', $book->id) }}"
              method="POST"
              enctype="multipart/form-data"
              id="editBookForm">
            @csrf
            @method('PUT')

            <div class="row g-4">

                {{-- ══════ LEFT COLUMN ══════ --}}
                <div class="col-lg-8">

                    {{-- ─── Section: Basic Info ─── --}}
                    <div class="section-title">
                        <div class="section-icon bg-warning bg-opacity-10 text-warning">
                            <i class="bi bi-info-circle-fill"></i>
                        </div>
                        {{ __('dashboard.book_details') }}
                    </div>

                    {{-- Author + Edition Row --}}
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="custom-label">
                                <i class="bi bi-person-fill"></i>
                                {{ __('message.author') }}
                                <span class="required-dot"></span>
                            </label>
                            <input type="text"
                                   name="author"
                                   class="form-control custom-input @error('author') is-invalid @enderror"
                                   value="{{ old('author', $book->author) }}"
                                   placeholder="{{ __('dashboard.author_placeholder') }}">
                            @error('author')
                                <div class="field-error">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="custom-label">
                                <i class="bi bi-bookmark-star-fill"></i>
                                {{ __('message.edition') }}
                            </label>
                            <input type="text"
                                   name="edition"
                                   class="form-control custom-input @error('edition') is-invalid @enderror"
                                   value="{{ old('edition', $book->edition) }}"
                                   placeholder="{{ __('message.edition_placeholder') }}">
                            @error('edition')
                                <div class="field-error">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    {{-- Category --}}
                    <div class="mb-4">
                        <label class="custom-label">
                            <i class="bi bi-tags-fill"></i>
                            {{ __('message.categories') }}
                            <span class="required-dot"></span>
                        </label>
                        <select name="category_id"
                                class="form-select custom-input @error('category_id') is-invalid @enderror">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $book->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->getname() }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="field-error">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- ─── Section: Multilingual Titles ─── --}}
                    <div class="section-title">
                        <div class="section-icon bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-translate"></i>
                        </div>
                        {{ __('dashboard.multilingual_titles') }}
                    </div>

                    {{-- Language Pills for Titles --}}
                    <div class="lang-pills" id="titlePills">
                        <button type="button" class="lang-pill active"
                                onclick="switchTab('title', 'en', this)">
                            🇬🇧 English
                        </button>
                        <button type="button" class="lang-pill"
                                onclick="switchTab('title', 'ps', this)">
                            🇦🇫 پښتو
                        </button>
                        <button type="button" class="lang-pill"
                                onclick="switchTab('title', 'fa', this)">
                            🇮🇷 دری
                        </button>
                    </div>

                    {{-- Title EN --}}
                    <div id="title-en" class="lang-tab-content active mb-3">
                        <label class="custom-label">
                            <i class="bi bi-type-h1"></i>
                            {{ __('message.title_en') }}
                            <span class="required-dot"></span>
                        </label>
                        <input type="text"
                               name="title_en"
                               class="form-control custom-input @error('title_en') is-invalid @enderror"
                               value="{{ old('title_en', $book->title_en) }}"
                               placeholder="{{ __('dashboard.title_placeholder') }}">
                        @error('title_en')
                            <div class="field-error">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Title PS --}}
                    <div id="title-ps" class="lang-tab-content mb-3">
                        <label class="custom-label">
                            <i class="bi bi-type-h1"></i>
                            {{ __('message.title_ps') }}
                            <span class="optional-badge ms-1">{{ __('dashboard.optional') }}</span>
                        </label>
                        <input type="text"
                               name="title_ps"
                               class="form-control custom-input"
                               dir="rtl"
                               value="{{ old('title_ps', $book->title_ps ?? '') }}"
                               placeholder="{{ __('dashboard.title_placeholder') }}">
                    </div>

                    {{-- Title FA --}}
                    <div id="title-fa" class="lang-tab-content mb-3">
                        <label class="custom-label">
                            <i class="bi bi-type-h1"></i>
                            {{ __('message.title_fa') }}
                            <span class="optional-badge ms-1">{{ __('dashboard.optional') }}</span>
                        </label>
                        <input type="text"
                               name="title_fa"
                               class="form-control custom-input"
                               dir="rtl"
                               value="{{ old('title_fa', $book->title_fa ?? '') }}"
                               placeholder="{{ __('dashboard.title_placeholder') }}">
                    </div>

                    {{-- ─── Section: Multilingual Descriptions ─── --}}
                    <div class="section-title mt-2">
                        <div class="section-icon bg-info bg-opacity-10 text-info">
                            <i class="bi bi-card-text"></i>
                        </div>
                        {{ __('dashboard.multilingual_descriptions') }}
                    </div>

                    {{-- Language Pills for Descriptions --}}
                    <div class="lang-pills" id="descPills">
                        <button type="button" class="lang-pill active"
                                onclick="switchTab('desc', 'en', this)">
                            🇬🇧 English
                        </button>
                        <button type="button" class="lang-pill"
                                onclick="switchTab('desc', 'ps', this)">
                            🇦🇫 پښتو
                        </button>
                        <button type="button" class="lang-pill"
                                onclick="switchTab('desc', 'fa', this)">
                            🇮🇷 دری
                        </button>
                    </div>

                    {{-- Description EN --}}
                    <div id="desc-en" class="lang-tab-content active mb-3">
                        <label class="custom-label">
                            <i class="bi bi-text-paragraph"></i>
                            {{ __('message.description_en') }}
                            <span class="required-dot"></span>
                        </label>
                        <textarea name="description_en"
                                  class="form-control custom-input @error('description_en') is-invalid @enderror"
                                  rows="4"
                                  placeholder="{{ __('dashboard.description_placeholder') }}">{{ old('description_en', $book->description_en) }}</textarea>
                        @error('description_en')
                            <div class="field-error">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Description PS --}}
                    <div id="desc-ps" class="lang-tab-content mb-3">
                        <label class="custom-label">
                            <i class="bi bi-text-paragraph"></i>
                            {{ __('message.description_ps') }}
                            <span class="optional-badge ms-1">{{ __('dashboard.optional') }}</span>
                        </label>
                        <textarea name="description_ps"
                                  class="form-control custom-input"
                                  rows="4"
                                  dir="rtl"
                                  placeholder="{{ __('dashboard.description_placeholder') }}">{{ old('description_ps', $book->description_ps ?? '') }}</textarea>
                    </div>

                    {{-- Description FA --}}
                    <div id="desc-fa" class="lang-tab-content mb-3">
                        <label class="custom-label">
                            <i class="bi bi-text-paragraph"></i>
                            {{ __('message.description_fa') }}
                            <span class="optional-badge ms-1">{{ __('dashboard.optional') }}</span>
                        </label>
                        <textarea name="description_fa"
                                  class="form-control custom-input"
                                  rows="4"
                                  dir="rtl"
                                  placeholder="{{ __('dashboard.description_placeholder') }}">{{ old('description_fa', $book->description_fa ?? '') }}</textarea>
                    </div>

                </div>

                {{-- ══════ RIGHT COLUMN ══════ --}}
                <div class="col-lg-4">

                    {{-- ─── Section: Cover Image ─── --}}
                    <div class="section-title">
                        <div class="section-icon bg-success bg-opacity-10 text-success">
                            <i class="bi bi-image-fill"></i>
                        </div>
                        {{ __('dashboard.cover_image') }}
                    </div>

                    {{-- Current Cover --}}
                    @if($book->thumbnail)
                        <div class="mb-3">
                            <label class="custom-label mb-2">
                                <i class="bi bi-eye-fill text-success"></i>
                                {{ __('dashboard.current_cover') }}
                            </label>
                            <div>
                                <div class="thumb-preview-wrap">
                                    <img src="{{ asset('storage/'.$book->thumbnail) }}"
                                         alt="{{ $book->getTitleAttribute() }}"
                                         id="currentCover">
                                    <span class="thumb-badge">
                                        <i class="bi bi-check2"></i> {{ __('dashboard.current') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Upload New Cover --}}
                    <div class="mb-4">
                        <label class="custom-label mb-2">
                            <i class="bi bi-arrow-repeat text-warning"></i>
                            {{ __('dashboard.replace_cover') }}
                            <span class="optional-badge ms-1">{{ __('dashboard.optional') }}</span>
                        </label>
                        <div class="file-upload-area" id="coverDropArea">
                            <input type="file"
                                   name="thumbnail"
                                   id="coverInput"
                                   accept="image/*">
                            <i class="bi bi-cloud-arrow-up text-warning fs-3 d-block mb-1"></i>
                            <div class="small fw-semibold text-dark">
                                {{ __('dashboard.drag_drop_image') }}
                            </div>
                            <div class="text-muted mt-1" style="font-size:12px;">
                                {{ __('dashboard.or') }}
                                <span class="text-warning fw-semibold">
                                    {{ __('dashboard.browse_files') }}
                                </span>
                            </div>
                            <div class="text-muted mt-1" style="font-size:11px;">
                                PNG, JPG, WEBP — {{ __('dashboard.max_size') }}: 2MB
                            </div>
                            <div class="mt-2" id="newCoverName"
                                 style="display:none;font-size:12px;color:#f59e0b;font-weight:600;"></div>
                        </div>

                        {{-- New Cover Live Preview --}}
                        <img id="newCoverPreview"
                             alt="New Cover"
                             style="display:none;width:100%;max-height:200px;
                                    object-fit:cover;border-radius:10px;
                                    margin-top:10px;border:2px solid #fde68a;">

                        @error('thumbnail')
                            <div class="field-error mt-2">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- ─── Book Info Summary ─── --}}
                    <div class="rounded-3 p-3 bg-light border mb-3">
                        <div class="fw-bold small mb-2 text-muted text-uppercase"
                             style="letter-spacing:0.5px;">
                            <i class="bi bi-info-circle me-1"></i>
                            {{ __('dashboard.book_info') }}
                        </div>
                        <div class="d-flex flex-column gap-2">
                            <div class="d-flex justify-content-between small">
                                <span class="text-muted">{{ __('message.table_status') }}</span>
                                @if($book->status === 'approved')
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill">
                                        <i class="bi bi-check-circle me-1"></i>{{ __('dashboard.approved') }}
                                    </span>
                                @elseif($book->status === 'pending')
                                    <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill">
                                        <i class="bi bi-clock me-1"></i>{{ __('dashboard.pending') }}
                                    </span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill">
                                        <i class="bi bi-x-circle me-1"></i>{{ __('dashboard.rejected') }}
                                    </span>
                                @endif
                            </div>
                            <div class="d-flex justify-content-between small">
                                <span class="text-muted">{{ __('dashboard.uploaded_by') }}</span>
                                <span class="fw-semibold">{{ $book->user->name ?? '-' }}</span>
                            </div>
                            <div class="d-flex justify-content-between small">
                                <span class="text-muted">{{ __('dashboard.created_at') }}</span>
                                <span class="fw-semibold">
                                    {{ $book->created_at->format('M d, Y') }}
                                </span>
                            </div>
                            <div class="d-flex justify-content-between small">
                                <span class="text-muted">{{ __('dashboard.downloads') }}</span>
                                <span class="fw-semibold text-primary">
                                    {{ number_format($book->downloads ?? 0) }}
                                </span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            {{-- ═══════════ SUBMIT SECTION ═══════════ --}}
            <hr class="my-4" style="border-color: #f3f4f6;">

            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <a href="{{ route('admin.books.index') }}"
                   class="btn btn-outline-secondary rounded-3 px-4 btn-cancel-wrap">
                    <i class="bi bi-arrow-left me-1"></i>
                    {{ __('message.cancel') }}
                </a>

                <button type="submit" class="btn-update">
                    <i class="bi bi-check-circle"></i>
                    {{ __('message.update') }}
                </button>
            </div>

        </form>
    </div>

</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ═══════════ Cover Image Preview ═══════════
    const coverInput = document.getElementById('coverInput');
    const newCoverPreview = document.getElementById('newCoverPreview');
    const newCoverName = document.getElementById('newCoverName');
    const currentCover = document.getElementById('currentCover');

    if (coverInput) {
        coverInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    // Show new preview
                    newCoverPreview.src = e.target.result;
                    newCoverPreview.style.display = 'block';

                    // Dim current cover to show it will be replaced
                    if (currentCover) {
                        currentCover.style.opacity = '0.4';
                        currentCover.style.transition = 'opacity 0.3s ease';
                    }
                };
                reader.readAsDataURL(file);

                // Show file name
                newCoverName.textContent = '✓ ' + file.name;
                newCoverName.style.display = 'block';
            }
        });

        // Drag & Drop for cover
        const coverDropArea = document.getElementById('coverDropArea');
        if (coverDropArea) {
            ['dragenter', 'dragover'].forEach(evt => {
                coverDropArea.addEventListener(evt, function (e) {
                    e.preventDefault();
                    this.style.borderColor = '#f59e0b';
                    this.style.background = '#fffbeb';
                });
            });

            ['dragleave', 'drop'].forEach(evt => {
                coverDropArea.addEventListener(evt, function (e) {
                    e.preventDefault();
                    this.style.borderColor = '';
                    this.style.background = '';
                });
            });
        }
    }

});

// ═══════════ Language Tab Switcher ═══════════
function switchTab(group, lang, clickedBtn) {

    // Hide all content tabs of this group
    document.querySelectorAll('[id^="' + group + '-"]').forEach(function (el) {
        el.classList.remove('active');
    });

    // Remove active from all pills in this group
    const pills = clickedBtn.closest('.lang-pills').querySelectorAll('.lang-pill');
    pills.forEach(function (pill) {
        pill.classList.remove('active');
    });

    // Show selected tab
    const target = document.getElementById(group + '-' + lang);
    if (target) target.classList.add('active');

    // Activate clicked pill
    clickedBtn.classList.add('active');
}
</script>
@endsection