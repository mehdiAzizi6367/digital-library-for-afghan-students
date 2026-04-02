@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">My Profile </h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('users.updateProfile') }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}">
        </div>

        <div class="mb-3">
            <label>Password (leave blank if unchanged)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Update Profile</button>
    </form>

    <hr class="my-4">

    <form method="POST" action="{{ route('users.destroyProfile') }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete your account?')">Delete Account</button>
    </form>
</div>
@endsection