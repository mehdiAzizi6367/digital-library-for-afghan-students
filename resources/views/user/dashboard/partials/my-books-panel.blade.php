<div class="panel-card">
    <div class="panel-title">Your Uploaded Books</div>

    <div class="panel-grid">
        <div class="panel-stat">
            <span class="label">Total Uploaded</span>
            <span class="value">{{ $totalBooks ?? 0 }}</span>
        </div>
        <div class="panel-stat">
            <span class="label">Status</span>
            <span class="value">{{ $book_reasons ? 'Action Needed' : 'Healthy' }}</span>
        </div>
    </div>

    <div class="table-responsive mt-4">
        <table class="table table-striped table-bordered text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Published</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($userBooks as $key => $book)
                    <tr>
                        <td>{{ $book->id }}</td>
                        <td>{{ $book->getTitleAttribute() }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->category->getname() ?? 'N/A' }}</td>
                        <td>{{ $book->status ?? 'N/A' }}</td>
                        <td>{{ $book->created_at }}</td>
                        <td>
                            @if($book->status == 'pending' || $book->status == 'rejected')
                                <a href="{{ route('books.show', $book->id) }}" class="btn btn-info btn-sm disabled">{{ __('message.view') }}</a>
                            @else
                                <a href="{{ route('books.show', $book->id) }}" class="btn btn-info btn-sm">{{ __('message.view') }}</a>
                            @endif

                            @if($book->status == 'rejected')
                                <a href="{{ route('user.books.edit', $book->id) }}" class="btn btn-primary btn-sm">{{ __('message.change') }}</a>
                            @else
                                <a href="{{ route('user.books.edit', $book->id) }}" class="btn btn-primary btn-sm">{{ __('message.edit') }}</a>
                            @endif

                            <form action="{{ route('user.books.destroy', $book->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('{{ __('message.confirm_delete') }}')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">{{ __('message.delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">{{ __('message.no_books') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
