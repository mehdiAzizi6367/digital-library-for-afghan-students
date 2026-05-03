@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4">📚Recycle books or book that you trashed</h2>
    <h2 class="fw-bold mb-4 text-danger"> Notice: if you click delete you will unable to recover the book!</h2>

    <a href="{{ route('user.books.index') }}" class="btn btn-success mb-3">Back</a>

    <div class="card p-4 shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>{{ __('message.table_hash') }}</th>
                        <th>{{ __('message.table_title') }}</th>
                        <th>{{ __('message.table_author') }}</th>
                        <th>{{ __('message.table_category') }}</th>
                        <th>{{ __('message.table_status') }}</th>
                       
                         <th>{{ __('message.published_at') }}</th>
                        <th>{{ __('message.table_actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $key => $book)
                        <tr>
                         
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->getTitleAttribute() }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->category->getname() ?? 'N/A' }}</td> 
                            <td>{{ $book->status??  'N/A' }}</td> 
                            <td>{{ $book->created_at}}</td>
                            <td> 
                              
                                   <a href="{{ route('book.restore',$book->id) }}" class="btn btn-success btn-sm">Restore</a>
                                <form action="{{ route('book.delete', $book->id) }}" 
                                        method="POST" 
                                        class="d-inline-block" 
                                        onsubmit="return confirm('{{ __('message.confirm_delete') }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">{{ __('message.delete') }}</button>
                                </form>
                            
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No book Trashed yet!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            
        </div>
    </div>
    <!-- Pagination links -->
<div class="d-flex justify-content-center my-5">
    {{ $books->links() }}
</div>
</div>

@endsection