@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>{{ __('message.edit') }} book</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Titles -->
        <div class="mb-3">
            <label>{{ __('message.title_en') }}</label>
            <input type="text" name="title_en" class="form-control" value="{{ old('title_en', $book->title_en) }}">
        </div>
        <div class="mb-3">
            <label>{{ __('message.title_ps') }}</label>
            <input type="text" name="title_ps" class="form-control" value="{{ old('title_ps', $book->title_ps) }}">
        </div>
        <div class="mb-3">
            <label>{{__('message.title_fa')}}</label>
            <input type="text" name="title_fa" class="form-control" value="{{ old('title_fa', $book->title_fa) }}">
        </div>

        <!-- Descriptions -->
        <div class="mb-3">
            <label>{{ __('message.description_en') }}</label>
            <textarea name="description_en" class="form-control">{{ old('description_en', $book->getDescription()) }}</textarea>
        </div>
        <div class="mb-3">
            <label>{{ __('message.description_ps') }}</label>
            <textarea name="description_ps" class="form-control">{{ old('description_ps', $book->description_ps) }}</textarea>
        </div>
        <div class="mb-3">
            <label>{{ __('message.description_fa') }}</label>
            <textarea name="description_fa" class="form-control">{{ old('description_fa', $book->description_fa) }}</textarea>
        </div>

        <!-- Author -->
        <div class="mb-3">
            <label>{{ __('message.author') }}</label>
            <input type="text" name="author" class="form-control" value="{{ old('author', $book->author) }}">
        </div>

        <!-- ISBN -->
        <div class="mb-3">
            <label>{{ __('message.isbn') }}</label>
            <input type="text" name="isbn" class="form-control" value="{{ old('isbn', $book->isbn) }}">
        </div>

        <!-- Category -->
        <div class="mb-3">
            <label>{{ __('message.categories') }}</label>
            <select name="category_id" class="form-select">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->getname() }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Thumbnail -->
           {{-- ========================= --}}
                          <!-- EDITION  -->
                    {{-- ========================= --}}
                <div class="mb-3">
                    <label class="form-label">{{ __('message.edition') }}<span class="text-danger">*</span></label>
                    <input type="text" name="edition" class="form-control" value="{{ old("edition",$book->edition) }}" placeholder="{{ __('message.edition_placeholder') }}">
                    @error('edition') <small class="text-danger">{{ $message }}</small> @enderror
                    {{-- ========================= --}}
                    
                </div>
        <div class="mb-3">
            <label>{{ __('message.thumbnail') }}</label>
            <input type="file" name="thumbnail" class="form-control">
            @if($book->thumbnail)
                <div class="mt-2">
                    <img src="{{ asset('storage/'.$book->thumbnail) }}" style="width:150px; height:auto;">
                </div>
            @endif
        </div>
        <!-- Submit -->
        <button class="btn btn-success">{{ __('message.update') }}</button>
        <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">{{ __('message.cancel') }}</a>
    </form>
</div>
@endsection