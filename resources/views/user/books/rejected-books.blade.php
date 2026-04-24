{{-- resources/views/user/books/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4">📚 {{ __('dashboard.my_books') }}</h2>

    <a href="{{ route('user.books.create') }}" class="btn btn-success mb-3">+{{ __('message.add_record') }}</a>

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
                       
                         <th>{{ __('message.table_rejection_reason') }}</th>
                        <th>{{ __('message.table_actions') }}</th>
                    </tr>
                </thead>
                
                <tbody>
                  
                        @forelse($rejected_books as $book)
                          @if($book->status == 'rejected')
                
                            <tr>

                                <td>{{ $book->id }}</td>
                                <td>{{ $book->getTitleAttribute() }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->category->getname() ?? 'N/A' }}</td> 
                                <td>{{ $book->status??  'N/A' }}</td> 
                                <td>{{ $book->rejection_reason}}</td>
                                <td class="d-flex align-items-center"> 
                                    @if($book->status =="rejected")
                                    @else
                                     <a href="{{ route('books.show', $book->id) }}" class="btn btn-info btn-sm " >{{ __('message.view') }}</a>
                                    @endif
                                       @if($book->status == 'rejected')
                                       <a href="{{ route('user.books.edit', $book->id) }}" class="btn btn-primary btn-sm">{{ __('message.change') }}</a>
    
                                       @else
                                       <a href="{{ route('user.books.edit', $book->id) }}" class="btn btn-primary btn-sm">{{ __('message.edit') }}</a>
                                       @endif
                                    <form action="{{ route('user.books.destroy', $book->id) }}" 
                                            method="POST" 
                                            class="d-inline-block" 
                                            onsubmit="return confirm('{{ __('message.confirm_delete') }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">{{ __('message.delete') }}</button>
                                        </form>
                                     </td>
                            </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">{{ __('message.no_books');}}</td>
                            </tr>
                        @endforelse
    
                </tbody>
            </table>
        </div>
    </div>
    {{-- This will render the pagination links (works out-of-the-box with Bootstrap 5 if you are using it). --}}
    <!-- Pagination links -->

</div>
@include('footer.footer')
@endsection