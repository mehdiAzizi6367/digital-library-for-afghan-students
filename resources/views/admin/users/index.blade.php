@extends('layouts.admin')

@section('title','Users')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between mb-3">
        <h1>All Users</h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add User</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif 
    <div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Joined At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
              @php
                $new= "New";
              @endphp
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }} <sup class=" badge text-white bg-danger">{{ ($user->name_ps || $user->name_fa)? '':$new}}</sup></td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>{{ $user->created_at->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline-block;">
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
    {{ $users->links() }}
</div>
@endsection