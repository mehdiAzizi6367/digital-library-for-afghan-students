@extends('layouts.admin')

@section('title','Add Category')

@section('content')
<div class="container-fluid">
    <h1>Add New Category</h1>
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Category Name</label>
            <input type="text" name="name_en" class="form-control" value="{{ old('name_en') }}" >
             @error('name_en') <small class="text-danger">{{ $message }}</small>
             @enderror
        </div>
        <button type="submit" class="btn btn-success">Add Category</button>
    </form>
</div>
@endsection