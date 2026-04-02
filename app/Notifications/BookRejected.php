<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;

class BookRejected extends Notification
{
    use Queueable;

    protected $book;
    protected $reason;

    /**
     * Create a new notification instance.
     */
    public function __construct($book, $reason)
    {
        $this->book = $book;
        $this->reason = $reason;
    }

    /**
     * Delivery channels
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Data stored in database
     */
    public function toArray($notifiable)
    {
        return [
            'title' => 'Book Rejected ❌',
            'message' => 'Your book "' . $this->book->title . '" was rejected.',

            // Book info
            'book_id' => $this->book->id,
            'book_title' => $this->book->title,

            // Rejection reason
            'reason' => $this->reason,

            // Optional link (edit/resubmit)
            'url' => route('user.books.edit', $this->book->id),

            'status' => 'rejected',
            'created_at' => now()->toDateTimeString(),
        ];
    }
  

    public function reject(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:500'
        ]);

        $book = Book::findOrFail($id);

        $book->status = 'rejected';
        $book->rejection_reason = $request->reason;
        $book->save();

        // Notify user
        $book->user->notify(new BookRejected($book, $request->reason));

        return back()->with('error', 'Book rejected successfully');
    }
}