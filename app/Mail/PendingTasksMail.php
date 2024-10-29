<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use App\Models\User;

class PendingTasksMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Collection $tasks;
    public User $user;

    /**
     * Create a new message instance.
     * 
     * @param Collection $tasks List of pending tasks
     * @param User $user Recipient user
     */
    public function __construct(Collection $tasks, User $user)
    {
        $this->tasks = $tasks;
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pending Tasks',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.pendingTasks',
            with: [
                'tasks' => $this->tasks,
                'user' => $this->user,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
