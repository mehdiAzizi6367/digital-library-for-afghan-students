@extends('layouts.admin')

@section('title','Add Book')

@section('content')
<div class="container-fluid">
    <h1>Add New Book</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title_en" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label>Author</label>
            <input type="text" name="author" class="form-control" value="{{ old('author') }}" required>
        </div>

        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->getname() }}</option>
                @endforeach
         </select>
        </div>
             {{-- Description --}}
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description_en" class="form-control" rows="3">{{ old('description') }}</textarea>
            @error('description') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
                {{-- ISBN --}}
        <div class="mb-3">
            <!-- pattern="^(97(8|9))?\d{9}(\d|X)$" isbn for book  -->
            <label class="form-label">ISBN (for English books)</label>
            <input type="text" name="isbn" class="form-control"
            placeholder="978-0132350884"
            title="Enter a valid ISBN-10 or ISBN-13"
            >
            @error('isbn') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

                {{-- Book File --}}
         <div class="mb-3">
            <label>Book File (PDF)</label>
            <input type="file" name="file" class="form-control" required>
        </div>

        {{-- Book Cover Image --}}
        <div class="mb-3">
            <label class="form-label">Book Cover Image</label>
            <input type="file" name="thumbnail" class="form-control">
            @error('image') <small class="text-danger">{{ $message }}</small> @enderror
        </div>


        <button type="submit" class="btn btn-success">{{ __('message.add_record') }}</button>
    </form>
</div>
@endsection