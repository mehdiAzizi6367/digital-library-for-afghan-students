@extends('layouts.admin')

@section('title','Edit Category')

@section('content')
<div class="container-fluid">
    <h1>Edit Category</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Category Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name',$category->name) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Category</button>
    </form>
</div>
@endsection