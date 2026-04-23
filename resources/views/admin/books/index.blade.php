@extends('layouts.admin')
@section('title','Books')

@section('content')
<div class="container-fluid"> 
    <div class="d-flex justify-content-between mb-3">
        <h1>All Books</h1>
        <a href="{{ route('admin.books.create') }}" class="btn btn-primary">{{ __('message.add_record') }}</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
     <div class="table-responsive">
        <table class="table table-bordered table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>{{ __('message.table_hash') }}</th>
                    <th>{{ __('message.table_title') }}</th> 
                    <th>{{ __('message.table_category') }}</th>
                    <th>{{ __('message.table_uploaded') }}</th>
                    <th>{{ __('message.author') }}</th>
                    <th>{{ __('message.table_status') }}</th>
                    <th>{{ __('message.table_actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book) 
                    <!-- @if($book->status == 'approved') -->
                        <tr>
                            <td>{{ $book->id}}</td>
                        <td>{{ $book->getTitle() }}</td>
                        <td>{{ substr($book->category->getname(),0,15) ?? '-' }}</td>
                        <td>{{ $book->author }}</td>
                            <td>{{ $book->user->name ?? '-' }}</td>
                            <td>{{ $book->status }}</td>                            
                            <td class="d-flex justify-center">             
                              <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-sm btn-warning me-2 ">{{ __('message.edit') }}</a>
                                <form action="{{ route('admin.books.destroy', $book) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('{{ __('message.confirm_delete') }}')" class="btn btn-sm btn-danger">{{ __('message.delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    <!-- @endif -->
                @endforeach
            </tbody>
        </table>
     </div>
    {{ $books->links() }}
</div>

@endsection
