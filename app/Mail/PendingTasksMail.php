<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PendingTasksMail extends Mailable
{
    use Queueable, SerializesModels;

    public $tasks;
    public $user;

    /**
     * Create a new message instance.
     * 
     * List of pending tasks
     * Recipient user
     * 
     * @param \Illuminate\Support\Collection $tasks 
     * @param \App\Models\User $user
     */
    public function __construct($tasks, $user)
    {
        $this->tasks = $tasks;
        $this->user = $user;
    }

    /**
     * Build the message.
     * 
     * Sets the subject and view for the email.
     * Passes the tasks and user data.
     * 
     * @return PendingTasksMail
     */
    public function build()
    {
        return $this->subject('Pending Tasks')
            ->view('emails.pendingTasks')
            ->with([
                'tasks' => $this->tasks,
                'user' => $this->user,
            ]);
    }

    // /**
    //  * Get the message envelope.
    //  */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Pending Tasks Mail',
    //     );
    // }

    // /**
    //  * Get the message content definition.
    //  */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    // /**
    //  * Get the attachments for the message.
    //  *
    //  * @return array<int, \Illuminate\Mail\Mailables\Attachment>
    //  */
    // public function attachments(): array
    // {
    //     return [];
    // }
}
