@extends('layouts.admin')

@section('title', __('dashboard.add_book'))


<style>
    /* ═══════════ Form Card ═══════════ */
    .form-card {
        background: #fff;
        border: 1px solid rgba(0, 0, 0, 0.04);
        box-shadow: 0 1px 6px rgba(0, 0, 0, 0.04);
    }

    /* ═══════════ Form Header ═══════════ */
    .form-header {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
        position: relative;
        overflow: hidden;
    }

    .form-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
    }

    /* ═══════════ Section Title ═══════════ */
    .section-title {
        font-size: 15px;
        font-weight: 700;
        color: #374151;
        padding-bottom: 10px;
        border-bottom: 2px solid #f3f4f6;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .section-title .section-icon {
        width: 32px;
        height: 32px;
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
        font-size: 14px;
    }

    .custom-label .required-dot {
        width: 6px;
        height: 6px;
        background: #ef4444;
        border-radius: 50%;
        display: inline-block;
    }

    /* ═══════════ Custom Input ═══════════ */
    .custom-input {
        border: 1.5px solid #e5e7eb;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 14px;
        transition: all 0.2s ease;
        background: #fafafa;
    }

    .custom-input:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        background: #fff;
    }

    .custom-input::placeholder {
        color: #c0c4cc;
    }

    /* ═══════════ File Upload Area ═══════════ */
    .file-upload-area {
        border: 2px dashed #e5e7eb;
        border-radius: 12px;
        padding: 24px;
        text-align: center;
        background: #fafbfc;
        transition: all 0.2s ease;
        cursor: pointer;
        position: relative;
    }

    .file-upload-area:hover {
        border-color: #6366f1;
        background: #f5f3ff;
    }

    .file-upload-area.dragover {
        border-color: #6366f1;
        background: #ede9fe;
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

    .file-upload-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        margin: 0 auto 10px;
    }

    .file-name-display {
        font-size: 12px;
        color: #6366f1;
        font-weight: 600;
        margin-top: 6px;
        display: none;
    }

    /* ═══════════ Submit Button ═══════════ */
    .btn-submit {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border: none;
        color: #fff;
        padding: 12px 32px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 15px;
        transition: all 0.25s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(99, 102, 241, 0.3);
        color: #fff;
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    /* ═══════════ Preview Image ═══════════ */
    .cover-preview {
        width: 100%;
        max-height: 200px;
        object-fit: cover;
        border-radius: 10px;
        margin-top: 10px;
        display: none;
        border: 2px solid #e5e7eb;
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
        color: #6366f1;
    }

    /* ═══════════ Error Style ═══════════ */
    .field-error {
        font-size: 12px;
        color: #ef4444;
        margin-top: 4px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .field-error i {
        font-size: 12px;
    }

    /* ═══════════ Tips Card ═══════════ */
    .tips-card {
        background: #fffbeb;
        border: 1px solid #fef3c7;
        border-radius: 12px;
    }

    .tips-card .tip-item {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        font-size: 13px;
        color: #92400e;
    }

    .tips-card .tip-item i {
        color: #f59e0b;
        margin-top: 2px;
        flex-shrink: 0;
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
        <span class="text-dark fw-semibold">{{ __('dashboard.add_book') }}</span>
    </nav>

    {{-- ═══════════ FORM HEADER ═══════════ --}}
    <div class="form-header p-4 rounded-top-4">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-white bg-opacity-25 rounded-3 p-2 d-flex align-items-center justify-content-center"
                 style="width:48px;height:48px;">
                <i class="bi bi-journal-plus text-white fs-4"></i>
            </div>
            <div>
                <h4 class="fw-bold text-white mb-0">{{ __('dashboard.add_book') }}</h4>
                <small class="text-white-50">{{ __('dashboard.add_book_subtitle') }}</small>
            </div>
        </div>
    </div>

    {{-- ═══════════ FORM BODY ═══════════ --}}
    <div class="form-card rounded-bottom-4 p-4 mb-4">
        <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data"
              id="addBookForm">
            @csrf

            <div class="row g-4">

                {{-- ══════ LEFT COLUMN ══════ --}}
                <div class="col-lg-7">

                    {{-- Section: Book Details --}}
                    <div class="section-title">
                        <div class="section-icon bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-info-circle-fill"></i>
                        </div>
                        {{ __('dashboard.book_details') }}
                    </div>

                    {{-- Title --}}
                    <div class="mb-3">
                        <label class="custom-label">
                            <i class="bi bi-type-h1"></i>
                            {{ __('message.table_title') }}
                            <span class="required-dot"></span>
                        </label>
                        <input type="text"
                               name="title_en"
                               class="form-control custom-input @error('title_en') is-invalid @enderror"
                               value="{{ old('title_en') }}"
                               placeholder="{{ __('dashboard.title_placeholder') }}"
                               required>
                        @error('title_en')
                            <div class="field-error">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Author --}}
                    <div class="mb-3">
                        <label class="custom-label">
                            <i class="bi bi-person-fill"></i>
                            {{ __('message.table_author') }}
                            <span class="required-dot"></span>
                        </label>
                        <input type="text"
                               name="author"
                               class="form-control custom-input @error('author') is-invalid @enderror"
                               value="{{ old('author') }}"
                               placeholder="{{ __('dashboard.author_placeholder') }}"
                               required>
                        @error('author')
                            <div class="field-error">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Category + Edition Row --}}
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="custom-label">
                                    <i class="bi bi-tags-fill"></i>
                                    {{ __('message.table_category') }}
                                    <span class="required-dot"></span>
                                </label>
                                <select name="category_id"
                                        class="form-select custom-input @error('category_id') is-invalid @enderror"
                                        required>
                                    <option value="">{{ __('dashboard.select_category') }}</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="custom-label">
                                    <i class="bi bi-bookmark-star-fill"></i>
                                    {{ __('message.edition') }}
                                    <span class="required-dot"></span>
                                </label>
                                <input type="text"
                                       name="edition"
                                       class="form-control custom-input @error('edition') is-invalid @enderror"
                                       value="{{ old('edition') }}"
                                       placeholder="{{ __('message.edition_placeholder') }}">
                                @error('edition')
                                    <div class="field-error">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label class="custom-label">
                            <i class="bi bi-text-paragraph"></i>
                            {{ __('dashboard.description') }}
                        </label>
                        <textarea name="description_en"
                                  class="form-control custom-input @error('description_en') is-invalid @enderror"
                                  rows="4"
                                  placeholder="{{ __('dashboard.description_placeholder') }}">{{ old('description_en') }}</textarea>
                        @error('description_en')
                            <div class="field-error">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>

                {{-- ══════ RIGHT COLUMN ══════ --}}
                <div class="col-lg-5">

                    {{-- Section: Upload Files --}}
                    <div class="section-title">
                        <div class="section-icon bg-success bg-opacity-10 text-success">
                            <i class="bi bi-cloud-arrow-up-fill"></i>
                        </div>
                        {{ __('dashboard.upload_files') }}
                    </div>

                    {{-- Book Cover --}}
                    <div class="mb-4">
                        <label class="custom-label mb-2">
                            <i class="bi bi-image-fill"></i>
                            {{ __('dashboard.cover_image') }}
                        </label>
                        <div class="file-upload-area" id="coverDropArea">
                            <input type="file"
                                   name="thumbnail"
                                   id="coverInput"
                                   accept="image/*">
                            <div class="file-upload-icon bg-primary bg-opacity-10 text-primary">
                                <i class="bi bi-image"></i>
                            </div>
                            <div class="fw-semibold small text-dark">
                                {{ __('dashboard.drag_drop_image') }}
                            </div>
                            <div class="text-muted" style="font-size:12px;">
                                {{ __('dashboard.or') }}
                                <span class="text-primary fw-semibold">
                                    {{ __('dashboard.browse_files') }}
                                </span>
                            </div>
                            <div class="text-muted mt-1" style="font-size:11px;">
                                PNG, JPG, WEBP ({{ __('dashboard.max_size') }}: 2MB)
                            </div>
                            <div class="file-name-display" id="coverFileName"></div>
                        </div>
                        <img id="coverPreview" class="cover-preview" alt="Cover Preview">
                        @error('thumbnail')
                            <div class="field-error">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Book File PDF --}}
                    <div class="mb-4">
                        <label class="custom-label mb-2">
                            <i class="bi bi-file-earmark-pdf-fill text-danger"></i>
                            {{ __('dashboard.book_file') }}
                            <span class="required-dot"></span>
                        </label>
                        <div class="file-upload-area" id="pdfDropArea">
                            <input type="file"
                                   name="file"
                                   id="pdfInput"
                                   accept=".pdf"
                                   required>
                            <div class="file-upload-icon bg-danger bg-opacity-10 text-danger">
                                <i class="bi bi-file-earmark-pdf"></i>
                            </div>
                            <div class="fw-semibold small text-dark">
                                {{ __('dashboard.drag_drop_pdf') }}
                            </div>
                            <div class="text-muted" style="font-size:12px;">
                                {{ __('dashboard.or') }}
                                <span class="text-primary fw-semibold">
                                    {{ __('dashboard.browse_files') }}
                                </span>
                            </div>
                            <div class="text-muted mt-1" style="font-size:11px;">
                                PDF ({{ __('dashboard.max_size') }}: 50MB)
                            </div>
                            <div class="file-name-display" id="pdfFileName"></div>
                        </div>
                        @error('file')
                            <div class="field-error">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Tips --}}
                    <div class="tips-card p-3">
                        <div class="fw-bold small mb-2 text-warning">
                            <i class="bi bi-lightbulb-fill me-1"></i>
                            {{ __('dashboard.tips') }}
                        </div>
                        <div class="d-flex flex-column gap-2">
                            <div class="tip-item">
                                <i class="bi bi-check-circle-fill"></i>
                                {{ __('dashboard.tip_cover') }}
                            </div>
                            <div class="tip-item">
                                <i class="bi bi-check-circle-fill"></i>
                                {{ __('dashboard.tip_pdf') }}
                            </div>
                            <div class="tip-item">
                                <i class="bi bi-check-circle-fill"></i>
                                {{ __('dashboard.tip_description') }}
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            {{-- ═══════════ SUBMIT SECTION ═══════════ --}}
            <hr class="my-4" style="border-color: #f3f4f6;">

            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <a href="{{ route('admin.books.index') }}" class="btn btn-outline-secondary rounded-3 px-4">
                    <i class="bi bi-arrow-left me-1"></i>
                    {{ __('message.cancel') }}
                </a>

                <button type="submit" class="btn-submit">
                    <i class="bi bi-plus-circle"></i>
                    {{ __('message.add_record') }}
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
    const coverPreview = document.getElementById('coverPreview');
    const coverFileName = document.getElementById('coverFileName');
    const coverDropArea = document.getElementById('coverDropArea');

    if (coverInput) {
        coverInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                coverFileName.textContent = file.name;
                coverFileName.style.display = 'block';

                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        coverPreview.src = e.target.result;
                        coverPreview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        // Drag & drop visual
        ['dragenter', 'dragover'].forEach(evt => {
            coverDropArea.addEventListener(evt, function (e) {
                e.preventDefault();
                this.classList.add('dragover');
            });
        });

        ['dragleave', 'drop'].forEach(evt => {
            coverDropArea.addEventListener(evt, function (e) {
                e.preventDefault();
                this.classList.remove('dragover');
            });
        });
    }

    // ═══════════ PDF File Name Display ═══════════
    const pdfInput = document.getElementById('pdfInput');
    const pdfFileName = document.getElementById('pdfFileName');
    const pdfDropArea = document.getElementById('pdfDropArea');

    if (pdfInput) {
        pdfInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                pdfFileName.textContent = file.name;
                pdfFileName.style.display = 'block';
            }
        });

        ['dragenter', 'dragover'].forEach(evt => {
            pdfDropArea.addEventListener(evt, function (e) {
                e.preventDefault();
                this.classList.add('dragover');
            });
        });

        ['dragleave', 'drop'].forEach(evt => {
            pdfDropArea.addEventListener(evt, function (e) {
                e.preventDefault();
                this.classList.remove('dragover');
            });
        });
    }

});
</script>
@endsection