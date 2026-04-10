@extends('layouts.admin')

@section('title','Edit Category')

@section('content')
<div class="container-fluid">
    <h1>Edit Category</h1>
    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Category Name(English)</label>
            <input type="text" name="name_en" class="form-control" value="{{ old('name_en',$category->getname()) }}" >
             @error('name_en') <small class="text-danger">{{ $message }}</small>
             @enderror
        </div>
        <div class="mb-3">
            <label>Category Name(pashto)</label>
            <input type="text" name="name_ps" class="form-control" value="{{ old('name_ps') }}" >
           
        </div>
        <div class="mb-3">
            <label>Category Name(Dari)</label>
            <input type="text" name="name_fa" class="form-control" value="{{ old('name_fa') }}" >
                  </div>
        <button type="submit" class="btn btn-primary">Update Category</button>
    </form>
</div>
@endsection