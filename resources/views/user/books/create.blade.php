@extends('layouts.app')

@section('content')
<div class="container py-5">
    
    @if(session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="fw-bold mb-4 text-center">
                📚 {{ __('message.add_record') }}
            </h2>
            <div class="card shadow-sm p-4">
                <form action="{{ route('user.books.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf                
                 <!-- English Title (Required) -->
                <div class="mb-3">
                    <label class="form-label">{{ __('message.book_title') }} (English)<span class="text-danger">*</span></label>
                    <input type="text" name="title_en" class="form-control" value="{{ old('title_en') }}" >
                    @error('title_en') <small class="text-danger">{{ $message }}</small> @enderror
                </div>                               
                    {{-- ========================= --}}
                    {{-- ✍️ AUTHOR --}}
                    {{-- ========================= --}}
                    <div class="mb-3">
                        <label class="form-label">{{ __('message.author') }}<span class="text-danger">*</span></label>
                        <input type="text" name="author" class="form-control" value="{{ old('author') }}">
                        @error('author') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- ========================= --}}
                    {{-- 📂 CATEGORY (DYNAMIC) --}}
                    {{-- ========================= --}}
                    <div class="mb-3">
                        <label class="form-label">{{ __('message.categories') }}<span class="text-danger">*</span></label>
                        <select name="category_id" class="form-select">
                            <option value="">{{ __('message.select_category') }}</option>

                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{-- 🔥 Dynamic localization --}}
                                     {{ $category->getName() }}
                                </option>
                            @endforeach

                        </select>
                        @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- ========================= --}}
                    {{-- 📝 DESCRIPTION (OPTIONAL MULTI-LANGUAGE) --}}
                    {{-- ========================= --}}
                 <!-- English Description -->
                <div class="mb-3">
                    <label class="form-label">{{ __('message.description') }} (English)</label>
                    <textarea name="description_en" class="form-control" rows="2">{{ old('description_en') }}</textarea>
                    @error('description_en') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                    {{-- ========================= --}}
                    {{-- ISBN --}}
                    {{-- ========================= --}}
                    <div class="mb-3">
                        <label class="form-label">{{ __('message.isbn') }}</label>
                        <input type="text" name="isbn" class="form-control" value="{{ old('isbn') }}"
                        placeholder="{{ __('message.isbn_placeholder') }}">
                        @error('isbn') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    {{-- ========================= --}}
                    {{-- 🖼️ THUMBNAIL --}}
                    {{-- ========================= --}}
                    <div class="mb-3">
                        <label class="form-label">{{ __('message.upload_image') }}</label>
                        <input type="file" name="thumbnail" class="form-control" value="{{ old('thumbnail') }}">
                        @error('thumbnail') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    
                    {{-- ========================= --}}
                    {{-- 📄 BOOK FILE --}}
                    {{-- ========================= --}}
                    <div class="mb-3">
                        <label class="form-label">{{ __('message.upload_book') }} (PDF / EPUB)<span class="text-danger">*</span> </label>
                        <input type="file" name="file" class="form-control" value="{{ old('file') }}">
                        @error('file') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    {{-- ========================= --}}
                          <!-- EDITION  -->
                    {{-- ========================= --}}
                    <div class="mb-3">
                        <label class="form-label">{{ __('message.edition') }}<span class="text-danger">*</span></label>
                        <input type="text" name="edition" class="form-control" value="{{ old("edition") }}" placeholder="{{ __('message.edition_placeholder') }}">
                        @error('edition') <small class="text-danger">{{ $message }}</small> @enderror
                        {{-- ========================= --}}
                        
                    </div>
                    
                        <span class="text-danger">*</span> required

               
                    {{-- 🚀 SUBMIT --}}
                    {{-- ========================= --}}
                    <button class="btn btn-primary w-100">
                        {{ __('message.add_record') }}
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
@include('footer.footer')
@endsection