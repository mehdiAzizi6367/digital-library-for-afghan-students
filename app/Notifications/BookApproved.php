<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\models\Book;
use Illuminate\Notifications\Notification;

class BookApproved extends Notification
{
    use Queueable;

    protected $book;

    /**
     * Create a new notification instance.
     */
    public function __construct($book)
    {
        $this->book = $book;
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
            'title' => 'Book Approved ✅',
            'message' => 'Your book "' . $this->book->title . '" has been approved and published.',

            // Book info
            'book_id' => $this->book->id,
            'book_title' => $this->book->title,

            // Optional link (user side)
            'url' => route('user.books.show', $this->book->id),

            'status' => 'approved',
            'created_at' => now()->toDateTimeString(),
        ];
    }
  

    public function approve($id)
    {
        $book = Book::findOrFail($id);

        $book->status = 'approved';
        $book->rejection_reason = null;
        $book->save();

        // Notify user
        $book->user->notify(new BookApproved($book));

        return back()->with('success', 'Book approved successfully');
    }
}