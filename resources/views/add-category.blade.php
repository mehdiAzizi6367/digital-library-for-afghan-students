@extends('layouts.app')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <form action="{{ route('user.books.create') }}">
            <label for="category">Add catgory</label>
            <div class="form-group d-flex">
                <input type="text" name="category" class='form-control' placeholder="Enter category">
                <input type="submit" class="btn btn-primary">
            </div>
        </form>

    </div>
</div>
    

@endsection