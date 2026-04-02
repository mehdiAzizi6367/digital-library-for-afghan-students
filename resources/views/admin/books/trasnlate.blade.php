@extends('layouts.admin')

@section('content')
<div class="container py-5">

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h2>Edit Translations: {{ $book->title_en }}</h2>

    <form action="{{ route('admin.books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Pashto Title --}}
        <div class="mb-3">
            <label>Title (Pashto)</label>
            <input type="text" name="title_ps" class="form-control" value="{{ $book->title_en }}">
        </div>

        {{-- Dari Title --}}
        <div class="mb-3">
            <label>Title (Dari)</label>
            <input type="text" name="title_fa" class="form-control" value="{{ old('title_fa', $book->title_en) }}">
        </div>

        {{-- Pashto Description --}}
        <div class="mb-3">
            <label>Description (Pashto)</label>
            <textarea name="description_ps" class="form-control" rows="3">{{ old('description_ps', $book->description_en) }}</textarea>
        </div>

        {{-- Dari Description --}}
        <div class="mb-3">
            <label>Description (Dari)</label>
            <textarea name="description_fa" class="form-control" rows="3">{{ old('description_fa', $book->description_en) }}</textarea>
        </div>

        <button class="btn btn-primary">Update Translations</button>
    </form>
</div>
@endsection

