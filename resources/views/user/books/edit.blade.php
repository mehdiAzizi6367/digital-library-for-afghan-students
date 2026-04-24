{{-- resources/views/user/books/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4">✏️ Edit Book</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card p-4 shadow-sm">
        <form action="{{ route('user.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title_en" id="title" value="{{ old('title_en', $book->getTitleAttribute()) }}" class="form-control @error('title') is-invalid @enderror">
                @error('title_en')<small class="text-danger"> {{ $message }}</span></small>@enderror
            </div>

            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" name="author" id="author" value="{{ old('author', $book->author) }}" class="form-control @error('author') is-invalid @enderror">
                @error('author')<small class="text-danger"> {{ $message }}</span></small>@enderror
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $book->category_id) == $category->id)>{{ $category->getname()}}</option>
                    @endforeach
                </select>
                @error('category_id')<small class="text-danger"> {{ $message }}</span></small>@enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $book->description) }}</textarea>
                @error('description')<small class="text-danger"> {{ $message }}</span></small>@enderror
            </div>

            <div class="mb-3">
                <label for="thumbnail" class="form-label">Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror">
                @if($book->thumbnail)
                    <img src="{{ asset('storage/'.$book->thumbnail) }}" alt="Thumbnail" class="mt-2" style="height:100px; object-fit:cover;">
                @endif
                @error('thumbnail')<small class="text-danger"> {{ $message }}</span></small>@enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Book</button>
            <a href="{{ route('user.books.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection