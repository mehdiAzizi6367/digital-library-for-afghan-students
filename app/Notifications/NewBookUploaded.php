<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class NewBookUploaded extends Notification
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
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['database']; // store in DB only
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable)
    {
        return [
            'title' => 'New Book Uploaded',
            'message' => 'A new book "' . $this->book->title . '" has been uploaded.',
            
            // Book info
            'book_id' => $this->book->id,
            'book_title' => $this->book->title,

            // User info (who uploaded)
            'uploaded_by' => $this->book->user->name,
            'user_id' => $this->book->user->id,

            // Optional: link for admin to review
            'url' => route('admin.books.show', $this->book->id),

            // Time
            'created_at' => now()->toDateTimeString(),
        ];
    }
}