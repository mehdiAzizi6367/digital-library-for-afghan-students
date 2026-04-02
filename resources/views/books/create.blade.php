@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4 text-center">📚 Add New Book</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm p-4">

                <form action="{{ route('user.books.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Title --}}
                    <div class="mb-3">
                        <label class="form-label">Book Title *</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- Author --}}
                    <div class="mb-3">
                        <label class="form-label">Author *</label>
                        <input type="text" name="author" class="form-control" value="{{ old('author') }}">
                        @error('author') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- Category --}}
                    <div class="mb-3">
                        <label class="form-label">Category *</label>
                        <select name="category_id" class="form-select">
                            <option value="">Select Category</option>

                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                                </option>
                            @endforeach

                        </select>
                        @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                        @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- Book File --}}
                    <div class="mb-3">
                        <label class="form-label">Upload Book (PDF / EPUB) *</label>
                        <input type="file" name="file" class="form-control">
                        @error('file') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- Book Cover Image --}}
                    <div class="mb-3">
                        <label class="form-label">Book Cover Image</label>
                        <input type="file" name="thumbnail" class="form-control">
                        @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <button class="btn btn-primary w-100">
                        Add Book
                    </button>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection