<?php

namespace App\Events;

use App\Models\Book;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class BookReturned
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Book $book;
    public User $user;
    /**
     * Create a new event instance.
     */
    public function __construct(Book $book, User $user)
    {
        $this->book = $book;
        $this->user = $user;

        // Log or simulate email notification
        Log::info("Book '{$book->title}' has been returned by {$user->name} (ID: {$user->id})");
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
