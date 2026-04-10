@extends('layouts.admin')

@section('title','Edit User')

@section('content')
<div class="container-fluid">
    <h1>Edit User</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name(English)</label>
            <input type="text" name="name" class="form-control" value="{{ old('name',$user->name) }}" required>
        </div>
         <div class="mb-3">
            <label>Name(Pashto)</label>
            <input type="text" name="name_ps" class="form-control" value="{{ old('name',$user->name_fa) }}" required>
        </div>
        <div class="mb-3">
            <label>Name(Dari)</label>
            <input type="text" name="name_fa" class="form-control" value="{{ old('name',$user->name_ps) }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email',$user->email) }}" required>
        </div>
        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-control" required>
                <option value="admin" @selected($user->role=='admin')>Admin</option>
                <option value="user" @selected($user->role=='user')>User</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
</div>
@endsection