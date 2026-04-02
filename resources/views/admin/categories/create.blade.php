@extends('layouts.admin')

@section('title','Add Category')

@section('content')
<div class="container-fluid">
    <h1>Add New Category</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Category Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <button type="submit" class="btn btn-success">Add Category</button>
    </form>
</div>
@endsection