@extends('layouts.admin')

@section('content')
<div class="container mt-4">

    <h3 class="mb-4">
        <i class="bi bi-pencil-square"></i> {{ __('message.edit') }} Book
    </h3>

    {{-- Success --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    {{-- Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-triangle"></i>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm border-0 bg-light">
        <div class="card-body">

            <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">

                    {{-- Title EN (Required) --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-type"></i> {{ __('message.title_en') }}
                        </label>
                        <input type="text" name="title_en" class="form-control"
                               value="{{ old('title_en', $book->title_en) }}">
                        @error('title_en')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Title PS (Optional) --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-type"></i> {{ __('message.title_ps') }} (Optional)
                        </label>
                        <input type="text" name="title_ps" class="form-control"
                               placeholder="Optional"
                               value="{{ old('title_ps', $book->title_ps ?? '') }}">
                    </div>

                    {{-- Title FA (Optional) --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-type"></i> {{ __('message.title_fa') }} (Optional)
                        </label>
                        <input type="text" name="title_fa" class="form-control"
                               placeholder="Optional"
                               value="{{ old('title_fa', $book->title_fa ?? '') }}">
                    </div>

                    {{-- Author --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-person"></i> {{ __('message.author') }}
                        </label>
                        <input type="text" name="author" class="form-control"
                               value="{{ old('author', $book->author) }}">
                    </div>

                    {{-- ISBN --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-upc-scan"></i> {{ __('message.isbn') }}
                        </label>
                        <input type="text" name="isbn" class="form-control"
                               value="{{ old('isbn', $book->isbn) }}">
                    </div>

                    {{-- Edition --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-journal-bookmark"></i> {{ __('message.edition') }}
                        </label>
                        <input type="text" name="edition" class="form-control"
                               value="{{ old('edition', $book->edition) }}">
                    </div>

                    {{-- Category --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-tags"></i> {{ __('message.categories') }}
                        </label>
                        <select name="category_id" class="form-select">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $book->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->getname() }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Description EN --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-card-text"></i> {{ __('message.description_en') }}
                        </label>
                        <textarea name="description_en" class="form-control" rows="3">{{ old('description_en', $book->description_en) }}</textarea>
                    </div>

                    {{-- Description PS (Optional) --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-card-text"></i> {{ __('message.description_ps') }} (Optional)
                        </label>
                        <textarea name="description_ps" class="form-control" rows="3"
                                  placeholder="Optional">{{ old('description_ps', $book->description_ps ?? '') }}</textarea>
                    </div>

                    {{-- Description FA (Optional) --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-card-text"></i> {{ __('message.description_fa') }} (Optional)
                        </label>
                        <textarea name="description_fa" class="form-control" rows="3"
                                  placeholder="Optional">{{ old('description_fa', $book->description_fa ?? '') }}</textarea>
                    </div>

                    {{-- Thumbnail --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-image"></i> {{ __('message.thumbnail') }}
                        </label>
                        <input type="file" name="thumbnail" class="form-control">

                        @if($book->thumbnail)
                            <div class="mt-2">
                                <img src="{{ asset('storage/'.$book->thumbnail) }}"
                                     class="img-thumbnail" width="120">
                            </div>
                        @endif
                    </div>

                </div>

                {{-- Buttons --}}
                <div class="mt-3">
                    <button class="btn btn-success">
                        <i class="bi bi-check-circle"></i> {{ __('message.update') }}
                    </button>

                    <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> {{ __('message.cancel') }}
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection