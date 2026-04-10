@extends('layouts.admin')

@section('title','Categories')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between mb-3">
        <h1>All Categories</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Add Category</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name(English)</th>
                    <th>Name(Dari)</th>
                    <th>Name(Pashto)</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td class="">{{ $category->id }}</td>
                    <td>{{ $category->getname() }}</td>
                    <td>{{ $category->name_fa}}</td>
                    <td>{{ $category->name_ps}}</td>
                    <td>{{ $category->created_at->format('d M Y') }}</td>
                    <td class="d-flex ms-1">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-warning me-3">Edit</a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $categories->links() }}
</div>
@endsection