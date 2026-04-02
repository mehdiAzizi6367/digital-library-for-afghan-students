@extends('layouts.admin')

@section('content')
<div class="container">

    <h2 class="mb-4">{{ __('dashboard.pending_books') }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered text-center ">
        <thead class="table-dark">
            <tr>
                <th>Title</th>
                <th>User</th>
                <th>Action</th>
                <th>Preview</th>
            </tr>
        </thead>
        <tbody>

        @forelse($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->user->name }}</td>
                <td>

                    <!-- ✅ Approve -->
                    <form action="{{ route('admin.books.approve', $book->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button class="btn btn-success btn-sm">
                            Approve
                        </button>
                    </form>

                    <!-- ❌ Reject Button -->
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $book->id }}">
                        Reject
                    </button>
                    <a href="{{ route('translate',$book->id) }}" class="btn btn-success btn-sm">translate</a>
                
                    <!-- ❌ Reject Modal -->
                    <div class="modal fade" id="rejectModal{{ $book->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <form action="{{ route('admin.books.reject', $book->id) }}" method="POST">
                                    @csrf

                                    <div class="modal-header">
                                        <h5 class="modal-title">Reject Book</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <label>Reason:</label>
                                        <textarea name="reason" class="form-control" required></textarea>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">
                                            Submit Reject
                                        </button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </td>
           
               
                <td>
                       <a href="{{ route('books.read',$book->id) }}" class="btn btn-success btn-sm " >Review </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">No pending books</td>
                <td colspan="3"></td>
            </tr>
        @endforelse

        </tbody>
    </table>

</div>
@endsection